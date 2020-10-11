<?php
# Default User Settings and Autopromote Groups
require_once __DIR__ . '/defaults.php';

# Group Permissions
require_once __DIR__ . '/groups/all.php';
require_once __DIR__ . '/groups/autoconfirmed.php';
require_once __DIR__ . '/groups/emailconfirmed.php';

require_once __DIR__ . '/groups/bot.php';

require_once __DIR__ . '/groups/trusted.php';

require_once __DIR__ . '/groups/sysop.php';
require_once __DIR__ . '/groups/bureaucrat.php';

## Mitarbeiter / Sichter 'extend' user
require_once __DIR__ . '/groups/user.php';
require_once __DIR__ . '/groups/mitarbeiter.php';
