<?php

### Administrator
$wgGroupPermissions['sysop']['flow-create-board'] = true;
$wgGroupPermissions['sysop']['viewlinktolatest'] = true;
$wgGroupPermissions['sysop']['deletelogentry'] = true;
$wgGroupPermissions['sysop']['deleterevision'] = true;
$wgGroupPermissions['sysop']['mwoauthupdateownconsumer'] = true;
$wgGroupPermissions['sysop']['mwoauthmanageconsumer'] = true;
$wgGroupPermissions['sysop']['mwoauthsuppress'] = true;
$wgGroupPermissions['sysop']['mwoauthviewsuppressed'] = true;
$wgGroupPermissions['sysop']['mwoauthviewprivate'] = true;
$wgGroupPermissions['sysop']['mwoauthmanagemygrants'] = true;
$wgGroupPermissions['sysop']['upload_by_url'] = true;

$wgAddGroups['sysop'] = ['sysop', 'bot', 'Mitarbeiter', 'Vertraut'];
$wgRemoveGroups['sysop'] = ['sysop', 'bot', 'Mitarbeiter', 'Vertraut'];
