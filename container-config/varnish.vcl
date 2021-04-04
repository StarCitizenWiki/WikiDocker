vcl 4.0;
# set default backend if no server cluster specified
backend default {
    .host = "172.16.0.3";
    .port = "80";
    # .port = "80" led to issues with competing for the port with apache.
}

# access control list for "purge": open to only localhost and other local nodes
acl purge {
    "127.0.0.1";
    "172.16.0.3";
}

# vcl_recv is called whenever a request is received
sub vcl_recv {
        # Serve objects up to 2 minutes past their expiry if the backend
        # is slow to respond.
        # set req.grace = 120s;

        set req.http.X-Forwarded-For = req.http.X-Forwarded-For + ", " + client.ip;

        set req.backend_hint= default;

        # This uses the ACL action called "purge". Basically if a request to
        # PURGE the cache comes from anywhere other than localhost, ignore it.
        if (req.method == "PURGE") {
            if (!client.ip ~ purge) {
                return (synth(405, "Not allowed."));
            } else {
                return (purge);
            }
        }

        # Pass requests from logged-in users directly.
        # Only detect cookies with "session" and "Token" in file name, otherwise nothing get cached.
        if (req.http.Authorization || req.http.Cookie ~ "session" || req.http.Cookie ~ "Token") {
            return (pass);
        } /* Not cacheable by default */

        # normalize Accept-Encoding to reduce vary
        if (req.http.Accept-Encoding) {
          if (req.http.User-Agent ~ "MSIE 6") {
            unset req.http.Accept-Encoding;
          } elsif (req.http.Accept-Encoding ~ "gzip") {
            set req.http.Accept-Encoding = "gzip";
          } elsif (req.http.Accept-Encoding ~ "deflate") {
            set req.http.Accept-Encoding = "deflate";
          } else {
            unset req.http.Accept-Encoding;
          }
        }

        return (hash);
}

sub vcl_pipe {
        # Note that only the first request to the backend will have
        # X-Forwarded-For set.  If you use X-Forwarded-For and want to
        # have it set for all requests, make sure to have:
        # set req.http.connection = "close";

        # This is otherwise not necessary if you do not do any request rewriting.

        set req.http.connection = "close";
}

# Called if the cache has a copy of the page.
sub vcl_hit {
        if (!obj.ttl > 0s) {
            return (pass);
        }

        # Force lookup if the request is a no-cache request from the client.
        if (req.http.Cache-Control ~ "no-cache") {
            return (miss);
        }
}

# Called after a document has been successfully retrieved from the backend.
sub vcl_backend_response {
       if (beresp.ttl < 48h) {
          set beresp.ttl = 48h;
        }

       if (!beresp.ttl > 0s) {
         set beresp.uncacheable = true;
         return (deliver);
       }

       if (beresp.http.Set-Cookie) {
         set beresp.uncacheable = true;
         return (deliver);
       }

#       if (beresp.http.Cache-Control ~ "(private|no-cache|no-store)") {
#          set beresp.uncacheable = true;
#          return (deliver);
#        }

        if (beresp.http.Authorization && !beresp.http.Cache-Control ~ "public") {
          set beresp.uncacheable = true;
          return (deliver);
        }

        return (deliver);
}