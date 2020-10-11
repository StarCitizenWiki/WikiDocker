<?php

### Mitarbeiter
$wgGroupPermissions['Mitarbeiter'] = $wgGroupPermissions['user'];
$wgGroupPermissions['Mitarbeiter']['move'] = true;
$wgGroupPermissions['Mitarbeiter']['movefile'] = true;
$wgGroupPermissions['Mitarbeiter']['move-categorypages'] = false;
$wgGroupPermissions['Mitarbeiter']['flow-lock'] = false;
$wgGroupPermissions['Mitarbeiter']['editsemiprotected'] = true;
$wgGroupPermissions['Mitarbeiter']['autopatrol'] = true;
$wgGroupPermissions['Mitarbeiter']['approverevisions'] = true;
$wgGroupPermissions['Mitarbeiter']['delete'] = true;
$wgGroupPermissions['Mitarbeiter']['undelete'] = true;
