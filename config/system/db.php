<?php

$wgMiserMode = true;

$wgDBtype = 'mysql';
$wgDBserver = 'db';
$wgDBname = getenv( 'MYSQL_DATABASE' );
$wgDBuser = getenv( 'MYSQL_USER' );
$wgDBpassword = getenv( 'MYSQL_PASSWORD' );

