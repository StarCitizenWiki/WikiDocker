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

Set a database user and password in `.env` and `config/system/db.php`.  

Add the Star Citizen Wiki API key to `config/extensions/config/apiunto.php`.

Change the site verification key in `config/extensions/config/wikiseo.php`.

Set the `smtp` password in `config/system/mail.php`.

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
$ chmod -R g+w /etc/star-citizen.wiki /var/lib/star-citizen.wiki /srv/star-citizen.wiki/sitemap /var/lib/star-citizen.wiki/cache /etc/star-citizen.wiki/.smw.json
$ chmod g+rwx /var/lib/star-citizen.wiki/esdata
$ chgrp 0 /var/lib/star-citizen.wiki/esdata
$ chmod g+rwx /srv/star-citizen.wiki/sitemap /srv/star-citizen.wiki/images
```

Start the database and wiki container:
```shell script
su scwiki
docker-compose up -d db
docker-compose up -d star-citizen.wiki_live
``` 

Visit `http://0.0.0.0:8080/mw-config/index.php`, start the installation and input the value of `$wgUpgradeKey` if asked.  

The `LocalSettings` file created in the installation step can be safely discarded.  

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
docker exec -it star-citizen.wiki_live /bin/bash

php maintenance/update.php --quick
```

## Configuration
### Database
Configuration file: [`config/system/db.php`](config/system/db.php)

### Mails
Configuration file: [`config/system/mail.php`](config/system/mail.php)  
Used for sending mails from the wiki.

### SEO and Site verification
Configuration file: [`config/extensions/config/wikiseo.php`](config/extensions/config/wikiseo.php)

### Wiki API Config
Configuration file: [`config/extensions/config/apiunto.php`](config/extensions/config/apiunto.php)
Settings for the [Star Citizen Wiki API](https://api.star-citizen.wiki).

## Stack
The Wiki stack consists of the following services:
* star-citizen.wiki
  * MediaWiki 1.35.1
  * Including
    * ffmpeg
    * ghostscript / poppler-utils
  * PHP Extensions
    * CURL
    * DOM
    * JSON
    * ZIP
    * REDIS
  * Extensions and Skins bundled in the container
    * [mediawiki/advanced-search](https://www.mediawiki.org/wiki/Extension:AdvancedSearch)
    * [mediawiki/apiunto](https://github.com/StarCitizenWiki/Apiunto)
    * [mediawiki/approved-revs](https://www.mediawiki.org/wiki/Extension:ApprovedRevs)
    * [mediawiki/capiunto](https://www.mediawiki.org/wiki/Extension:Capiunto)
    * [mediawiki/citizen-skin](https://github.com/StarCitizenTools/mediawiki-skins-Citizen)
    * [mediawiki/cirrus-search](https://www.mediawiki.org/wiki/Extension:CirrusSearch)
    * [mediawiki/cloud-flare](https://github.com/StarCitizenTools/mediawiki-extensions-CloudFlare)
    * [mediawiki/cookie-warning](https://www.mediawiki.org/wiki/Extension:CookieWarning)
    * [mediawiki/disambiguator](https://www.mediawiki.org/wiki/Extension:Disambiguator)
    * [mediawiki/discussion-tools](https://www.mediawiki.org/wiki/Extension:DiscussionTools)
    * [mediawiki/echo](https://www.mediawiki.org/wiki/Extension:Echo)
    * [mediawiki/elastica](https://www.mediawiki.org/wiki/Extension:Elastica)
    * [mediawiki/labeled-section-transclusion](https://www.mediawiki.org/wiki/Extension:Labeled_Section_Transclusion)
    * [mediawiki/linter](https://www.mediawiki.org/wiki/Extension:Linter)
    * [mediawiki/oauth](https://www.mediawiki.org/wiki/Extension:OAuth)
    * [mediawiki/plausible](https://www.mediawiki.org/wiki/Extension:Plausible)
    * [mediawiki/popups](https://www.mediawiki.org/wiki/Extension:Popups)
    * [mediawiki/related-articles](https://www.mediawiki.org/wiki/Extension:RelatedArticles)
    * [mediawiki/sandbox-link](https://www.mediawiki.org/wiki/Extension:SandboxLink)
    * [mediawiki/semantic-media-wiki](https://www.mediawiki.org/wiki/Extension:Semantic_MediaWiki)
    * [mediawiki/semantic-scribunto](https://www.mediawiki.org/wiki/Extension:Semantic_Scribunto)
    * [mediawiki/semantic-result-formats](https://www.mediawiki.org/wiki/Extension:Semantic_Result_Formats)
    * [mediawiki/swift-mailer](https://www.mediawiki.org/wiki/Extension:SwiftMailer)
    * [mediawiki/template-styles](https://www.mediawiki.org/wiki/Extension:TemplateStyles)
    * [mediawiki/template-styles-extender](https://www.mediawiki.org/wiki/Extension:TemplateStylesExtender)
    * [mediawiki/timed-media-handler](https://www.mediawiki.org/wiki/Extension:TimedMediaHandler)
    * [mediawiki/thanks](https://www.mediawiki.org/wiki/Extension:Thanks)
    * [mediawiki/upload-wizard](https://www.mediawiki.org/wiki/Extension:UploadWizard)
    * [mediawiki/variables](https://www.mediawiki.org/wiki/Extension:Variables)
    * [mediawiki/webp](https://www.mediawiki.org/wiki/Extension:WebP)
    * [octfx/wikiseo](https://www.mediawiki.org/wiki/Extension:WikiSEO)
* db
  * MariaDB Server
* elasticsearch
  * ElasticSearch 6.5.4 (MW Version including Plugins)
* ofelia
  * Cron Container
  * [Semantic MediaWiki Jobs](container-config/ofelia.ini)
  * [Queue](queue.sh)
    * Runs every 10 seconds
  * Sitemap generation
    * Runs daily
* redis
  * Caching
  
## Upgrade notes
After a major update OAuth Consumers seem to get invalidated.  
For each registered consumer a new one needs to get created.
 
## Further notes
The MediaWiki Container service name _cannot_ have the same name as the domain the wiki is running on.  
If both names are equal, and the wiki is running on https, VisualEditor will fail to connect.
