# Star Citizen Wiki Docker
The Docker configuration powering https://star-citizen.wiki.

## Usage
Replace `$wgSecretKey` in `LocalSettings.php`.
```shell script
# Generates a 64 character long hex string 
echo "$(openssl rand -hex 64)"
# Or
php -r echo(bin2hex(openssl_random_pseudo_bytes(32)));
```

Add the Star Citizen Wiki API key to `config\extensions\config\apiunto.php`.  

Change the site verification key in `config\extensions\config\wikiseo.php`.

Set the `smtp` password in `config\system\mail.php`.

Update the database settings in `config\system\db.php`. 

Create required folders:  
```shell script
$ mkdir -p /etc/star-citizen.wiki
$ mkdir -p /var/lib/star-citizen.wiki
$ mkdir -p /srv/star-citizen.wiki/sitemap
```

Copy files to destination:  
```shell script
$ cp ./LocalSettings.php /etc/star-citizen.wiki
$ cp -R ./config /etc/star-citizen.wiki
$ cp -R ./container-settings /etc/star-citizen.wiki
$ cp -R ./includes /etc/star-citizen.wiki
```

Build the image:
```shell script
./docker-build.sh
```

Start the container:
```shell script
docker-compose up -d
```