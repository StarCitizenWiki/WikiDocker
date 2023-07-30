<?php

$wgMiserMode = true;

$wgDBtype = 'mysql';
$wgDBserver = '10.16.0.6';
$wgDBname = getenv( 'MYSQL_DATABASE' );
$wgDBuser = getenv( 'MYSQL_USER' );
$wgDBpassword = getenv( 'MYSQL_PASSWORD' );

