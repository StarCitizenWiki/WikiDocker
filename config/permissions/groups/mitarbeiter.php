<?php

### Mitarbeiter
$wgGroupPermissions['Mitarbeiter'] = $wgGroupPermissions['user'];
$wgGroupPermissions['Mitarbeiter']['move'] = true;
$wgGroupPermissions['Mitarbeiter']['movefile'] = true;
$wgGroupPermissions['Mitarbeiter']['move-categorypages'] = true;
$wgGroupPermissions['Mitarbeiter']['editsemiprotected'] = true;
$wgGroupPermissions['Mitarbeiter']['autopatrol'] = true;
$wgGroupPermissions['Mitarbeiter']['delete'] = true;
$wgGroupPermissions['Mitarbeiter']['undelete'] = true;
$wgGroupPermissions['Mitarbeiter']['upload_by_url'] = true;

$wgGroupPermissions['Mitarbeiter']['adminlinks'] = true;

$wgGroupPermissions['Mitarbeiter']['editrestrictedfields'] = true;

$wgGroupPermissions['Mitarbeiter']['skipcaptcha'] = true;
