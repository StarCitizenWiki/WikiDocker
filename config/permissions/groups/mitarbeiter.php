<?php

### Mitarbeiter
$wgGroupPermissions['Mitarbeiter'] = $wgGroupPermissions['user'];
$wgGroupPermissions['Mitarbeiter']['move'] = true;
$wgGroupPermissions['Mitarbeiter']['movefile'] = true;
$wgGroupPermissions['Mitarbeiter']['move-categorypages'] = true;
$wgGroupPermissions['Mitarbeiter']['editsemiprotected'] = true;
$wgGroupPermissions['Mitarbeiter']['autopatrol'] = true;
$wgGroupPermissions['Mitarbeiter']['approverevisions'] = true;
$wgGroupPermissions['Mitarbeiter']['delete'] = true;
$wgGroupPermissions['Mitarbeiter']['undelete'] = true;
$wgGroupPermissions['Mitarbeiter']['upload_by_url'] = true;

$wgGroupPermissions['Mitarbeiter']['pagetranslation'] = true;
$wgGroupPermissions['Mitarbeiter']['translate'] = true;
$wgGroupPermissions['Mitarbeiter']['translate-messagereview'] = true;

$wgGroupPermissions['Mitarbeiter']['adminlinks'] = true;

$wgGroupPermissions['Mitarbeiter']['editrestrictedfields'] = true;
