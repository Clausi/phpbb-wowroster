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
	'ACP_WOWROSTER_TITLE' => 'WoW Roster Modul',
	'ACP_WOWROSTER_SETTINGS' => 'Settings',
));
