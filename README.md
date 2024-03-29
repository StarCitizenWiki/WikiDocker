<p align="center">
    <a href="https://hub.docker.com/r/scwiki/wiki" alt="Docker Hub">
        <img src="https://img.shields.io/docker/pulls/scwiki/wiki" />
    </a>
    <img src="https://img.shields.io/docker/image-size/scwiki/wiki" />
</p>

# Star Citizen Wiki Docker
The Docker configuration powering https://star-citizen.wiki.

`docker pull scwiki/wiki:dev`

## Installation
Create the user and allow it to use docker:
```shell
adduser scwiki

usermod -aG docker scwiki
```

And add the resulting UID and GUID to `.env`

Create the network:
```shell script
docker network create --subnet=172.16.0.0/29 star-citizen.wiki
```

Replace `$wgSecretKey` in `LocalSettings.php`.
```shell script
# Generates a 64 character long hex string 
echo "$(openssl rand -hex 32)"
# Or
php -r "echo(bin2hex(openssl_random_pseudo_bytes(32)));"
```

Replace `$wgUpgradeKey` in `LocalSettings.php`.
```shell script
# Generates a 8 character long hex string 
echo "$(openssl rand -hex 8)"
# Or
php -r "echo(bin2hex(openssl_random_pseudo_bytes(8)))";
```

Copy `.env-example` to `.env` and populate the available fields.

Update `$wgServer` and `$wgCanonicalServer` in `LocalSettings.php`

_Note:_  
Elasticsearch requires `vm.max_map_count` to be set to at least `262144`.  
Run: `sysctl -w vm.max_map_count=262144`

Create required folders:
```shell script
$ mkdir -p /etc/star-citizen.wiki
$ mkdir -p /var/lib/star-citizen.wiki/{esdata,redis,db,cache}
$ mkdir -p /srv/star-citizen.wiki/{images,sitemap}
```

Copy files to destination:
```shell script
$ cp ./LocalSettings.php ./.smw.json /etc/star-citizen.wiki
$ cp -R ./config /etc/star-citizen.wiki
$ cp -R ./container-config /etc/star-citizen.wiki
$ cp -R ./includes /etc/star-citizen.wiki

$ chown -R scwiki: /etc/star-citizen.wiki /var/lib/star-citizen.wiki /srv/star-citizen.wiki/sitemap
$ chown -R scwiki:www-data /srv/star-citizen.wiki/sitemap /srv/star-citizen.wiki/images /var/lib/star-citizen.wiki/cache /etc/star-citizen.wiki/.smw.json
$ chmod -R g+w /var/lib/star-citizen.wiki /srv/star-citizen.wiki/sitemap /var/lib/star-citizen.wiki/cache /etc/star-citizen.wiki/.smw.json
$ chmod g+rwx /var/lib/star-citizen.wiki/esdata
$ chgrp 0 /var/lib/star-citizen.wiki/esdata
$ chmod g+rwx /srv/star-citizen.wiki/sitemap /srv/star-citizen.wiki/images
```

Start the database and wiki container:
```shell script
su scwiki
docker-compose up -d star-citizen.wiki-varnish

docker exec -it star-citizen.wiki-live /bin/bash

# This creates the database and installs the wiki
# You should use the user / db / password configured in the .env file
# See https://www.mediawiki.org/wiki/Manual:Install.php for more information
php maintenance/install.php \
  --confpath /dev/null \
  --dbserver db \
  --dbuser scw \
  --dbpass scw \
  --dbname scw \
  --pass ADMIN_PASSWORD \
  WIKI_NAME \
  ADMIN_NAME
``` 

Stop all container:
```shell script
docker-compose down
```

Uncomment the `LocalSettings.php` mount and start the stack.
```shell
docker-compose up -d
```

Connect to the container and run the update script:
```shell script
docker exec -it star-citizen.wiki-live /bin/bash

php maintenance/update.php --quick
```

## Configuration

### Traefik
If you are running traefik remove the `ports` portion from the varnish container and uncomment the `expose` part.

For local traefik instances without SSL you need to remove all labels containing `tls` and change out the entry point from `https` to `http` (or the name you set in your traefik config).  

Also when not using the Star Citizen Wiki Traefik config you need to remove the labels containing `middlewares`.

## Stack
The Wiki stack consists of the following services:
* star-citizen.wiki
  * MediaWiki 1.39.x
  * Including
    * ffmpeg
    * ghostscript / poppler-utils
    * luasandbox
    * webp
    * zip / unzip
  * PHP Extensions
    * CURL
    * DOM
    * IMAGICK
    * JSON
    * REDIS
    * SOCKETS
    * ZIP
  * Extensions and Skins bundled in the container
    * [mediawiki/admin-links](https://www.mediawiki.org/wiki/Extension:AdminLinks)
    * [mediawiki/advanced-search](https://www.mediawiki.org/wiki/Extension:AdvancedSearch)
    * [mediawiki/apiunto](https://github.com/StarCitizenWiki/Apiunto)
    * [mediawiki/capiunto](https://www.mediawiki.org/wiki/Extension:Capiunto)
    * [mediawiki/cirrus-search](https://www.mediawiki.org/wiki/Extension:CirrusSearch)
    * [mediawiki/citizen-skin](https://github.com/StarCitizenTools/mediawiki-skins-Citizen)
    * [mediawiki/cldr](https://www.mediawiki.org/wiki/Extension:CLDR)
    * [mediawiki/commons-metadata](https://www.mediawiki.org/wiki/Extension:CommonsMetadata)
    * [mediawiki/cookie-warning](https://www.mediawiki.org/wiki/Extension:CookieWarning)
    * [mediawiki/disambiguator](https://www.mediawiki.org/wiki/Extension:Disambiguator)
    * [mediawiki/discord-notifications](https://github.com/kulttuuri/DiscordNotifications)
    * [mediawiki/discussion-tools](https://www.mediawiki.org/wiki/Extension:DiscussionTools)
    * [mediawiki/echo](https://www.mediawiki.org/wiki/Extension:Echo)
    * [mediawiki/elastica](https://www.mediawiki.org/wiki/Extension:Elastica)
    * [mediawiki/embed-video (Fork)](https://github.com/StarCitizenWiki/mediawiki-extensions-EmbedVideo)
    * [mediawiki/json-config](https://www.mediawiki.org/wiki/Extension:JsonConfig)
    * [mediawiki/labeled-section-transclusion](https://www.mediawiki.org/wiki/Extension:Labeled_Section_Transclusion)
    * [mediawiki/linter](https://www.mediawiki.org/wiki/Extension:Linter)
    * [mediawiki/media-search](https://www.mediawiki.org/wiki/Extension:MediaSearch)
    * [mediawiki/multi-purge](https://www.mediawiki.org/wiki/Extension:MultiPurge)
    * [mediawiki/oauth](https://www.mediawiki.org/wiki/Extension:OAuth)
    * [mediawiki/page-forms](https://www.mediawiki.org/wiki/Extension:Page_Forms)
    * [mediawiki/plausible](https://www.mediawiki.org/wiki/Extension:Plausible)
    * [mediawiki/popups](https://www.mediawiki.org/wiki/Extension:Popups)
    * [mediawiki/related-articles](https://www.mediawiki.org/wiki/Extension:RelatedArticles)
    * [mediawiki/sandbox-link](https://www.mediawiki.org/wiki/Extension:SandboxLink)
    * [mediawiki/semantic-media-wiki](https://www.mediawiki.org/wiki/Extension:Semantic_MediaWiki)
    * [mediawiki/semantic-result-formats](https://www.mediawiki.org/wiki/Extension:Semantic_Result_Formats)
    * [mediawiki/semantic-scribunto](https://www.mediawiki.org/wiki/Extension:Semantic_Scribunto)
    * [mediawiki/semantic-drolldown](https://www.mediawiki.org/wiki/Extension:Semantic_DrillDown)
    * [mediawiki/short-description](https://www.mediawiki.org/wiki/Extension:ShortDescription)
    * [mediawiki/symfony-mailer](https://github.com/StarCitizenWiki/mediawiki-extensions-SymfonyMailer)
    * [mediawiki/tabber-neue](https://www.mediawiki.org/wiki/Extension:TabberNeue)
    * [mediawiki/template-styles](https://www.mediawiki.org/wiki/Extension:TemplateStyles)
    * [mediawiki/template-styles-extender](https://www.mediawiki.org/wiki/Extension:TemplateStylesExtender)
    * [mediawiki/thanks](https://www.mediawiki.org/wiki/Extension:Thanks)
    * [mediawiki/upload-wizard](https://www.mediawiki.org/wiki/Extension:UploadWizard)
    * [mediawiki/universal-language-selector](https://www.mediawiki.org/wiki/Extension:UniversalLanguageSelector)
    * [octfx/wikiseo](https://www.mediawiki.org/wiki/Extension:WikiSEO)
* db
  * MariaDB Server
* elasticsearch
  * ElasticSearch 7.10.2 ("Official" Version)
* elasticsearch-smw
  * ElasticSearch 7.10.2 ("Official" Version)
* ofelia
  * Cron Container
  * [Semantic MediaWiki Jobs](container-config/ofelia.ini)
  * [Queue](queue.sh)
    * Runs every 10 seconds
  * Sitemap generation
    * Runs daily
* redis (keydb)
  * JobQueue
  * Caching
* Varnish
  * Page Cache

## Cloudflare Settings
### Page Rules
The following page rules are used for CloudFlare

* `star-citizen.wiki/thumb.php?*`
  * Cache-Level: Cache Everything
  * Browser-Cache-TTL: 1 Year
  * Edge-Cache-TTL: 1 Month
  * Always Online: Yes
* `star-citizen.wiki/load.php?*`
  * Cache-Level: Cache Everything
  * Browser-Cache-TTL: 1 Year
  * Edge-Cache-TTL: 1 Month
  * Always Online: Yes

### Firewall Rules
Visit Firewall -> Firewall Rules and add the following code to a new rule.

This will disable bots trying to edit pages, visit special pages, or the login view.
```
(http.request.uri.query contains "action=edit" and cf.client.bot) or
(http.request.uri.query contains "action=visualeditor" and cf.client.bot) or
(http.request.uri.query contains "Anmelden" and cf.client.bot) or
(http.request.uri.path contains "Spezial" and cf.client.bot) or
(http.request.uri.query contains "Spezial" and cf.client.bot) or
(http.request.uri.query contains "UserLogin" and cf.client.bot) or
(http.request.uri.path contains "Special" and cf.client.bot) or
(http.request.uri.query contains "Special" and cf.client.bot)
```

## Upgrade notes
After a major update OAuth Consumers seem to get invalidated.  
For each registered consumer a new one needs to get created.
 
## Further notes
The MediaWiki Container service name _cannot_ have the same name as the domain the wiki is running on.  
If both names are equal, and the wiki is running on https, VisualEditor will fail to connect.

## Upload Wizard Messages
To use the custom licenses in UW you need to create the following system [messages](messages/uploadwizard-custom-messages.txt)

## MariaDB Healthchecks
MariaDB moved to a new healthcheck syntax. For databases that already exist, a local user must be added:
```sql
CREATE USER 'mysql'@'127.0.0.1';
GRANT USAGE ON *.* to 'mysql'@'127.0.0.1';
```