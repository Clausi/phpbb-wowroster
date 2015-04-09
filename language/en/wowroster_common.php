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
	'WOWROSTER' => 'WoW Roster',
	'WOWROSTER_PAGE' => 'Roster',
	'WOWROSTER_INACTIVE' => 'WoW Roster not active.',
	'WOWROSTER_ACCESS' => 'No access',
));
