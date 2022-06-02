<?php

### Administrator
$wgGroupPermissions['sysop']['viewlinktolatest'] = true;
$wgGroupPermissions['sysop']['deletelogentry'] = true;
$wgGroupPermissions['sysop']['deleterevision'] = true;
$wgGroupPermissions['sysop']['upload_by_url'] = true;

$wgGroupPermissions['sysop']['pagetranslation'] = true;
$wgGroupPermissions['sysop']['translate-manage'] = true;

$wgGroupPermissions['sysop']['interwiki'] = true;

$wgAddGroups['sysop'] = ['sysop', 'bot', 'Mitarbeiter', 'Vertraut'];
$wgRemoveGroups['sysop'] = ['sysop', 'bot', 'Mitarbeiter', 'Vertraut'];
