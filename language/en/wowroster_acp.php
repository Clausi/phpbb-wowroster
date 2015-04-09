<?php

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	'ACP_WOWROSTER_ACTIVE' => 'WoW Roster active?',
	'ACP_WOWROSTER_CRON_ACTIVE' => 'WoW Roster cron active?',
	'ACP_WOWROSTER_CRON_EXPLAIN' => 'phpBB internal forum cron will be used, note that this can make several forum calls slow. Consider using the external cron by calling it with your servers crontab. This option does not depend on an active wow roster module (see option above).',
	'ACP_WOWROSTER_SETTING_SAVED' => 'Settings saved',
	'ACP_WOWROSTER_CRON_MANUAL' => 'Manual call of wow roster cron',
	'ACP_WOWROSTER_CRON_INTERVAL' => 'Cron interval',
	'ACP_WOWROSTER_CRON_INTERVAL_EXPLAIN' => 'How often your roster is pulled from the armory using the forum internal cron. Recommendation: Most guilds are very stable so only pull your roster once or twice a day => 720 minutes.',
	'ACP_WOWROSTER_CONFIG_EXPLAIN' => 'Remember to fill out all needed config settings within "wowarmoryapi_config.php"',
));
