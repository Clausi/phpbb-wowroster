<?php

namespace clausi\wowroster\migrations;

class release_1_0_0 extends \phpbb\db\migration\migration
{
	static public function depends_on()
	{
		return array('\phpbb\db\migration\data\v31x\v313');
	}

	public function update_data()
	{
		return array(
			array('config.add', array('clausi_wowroster_active', 0)),
			array('config.add', array('clausi_wowroster_cron_active', 1)),
			array('config.add', array('clausi_wowroster_last_gc', 0, true)),
			array('config.add', array('clausi_wowroster_gc', 43200)),
			// External cron trigger key
			array('config.add', array('clausi_wowroster_cron_key', substr(md5(microtime()),rand(0,26),5))),

			array('module.add', array(
				'acp',
				'ACP_CAT_DOT_MODS',
				'ACP_WOWROSTER_TITLE'
			)),
			array('module.add', array(
				'acp',
				'ACP_WOWROSTER_TITLE',
				array(
					'module_basename' => '\clausi\wowroster\acp\main_module',
					'modes' => array('settings'),
				),
			)),
			
			// Add permission
			array('permission.add', array('a_wowroster', true)),
			// Set permissions
			array('permission.permission_set', array('ROLE_ADMIN_FULL', 'a_wowroster')),
			array('permission.permission_set', array('ROLE_ADMIN_STANDARD', 'a_wowroster')),
		);
	}
	
	// Create wowroster tables
	public function update_schema()
	{
		return array(
			'add_tables' => array(
			
				$this->table_prefix . 'wowroster' => array(
					'COLUMNS' => array(
						'roster_id' => array('UINT', NULL, 'auto_increment'),
						'uniquekey' => array('VCHAR', ''),
						'name' => array('VCHAR', ''),
						'realm' => array('VCHAR', ''),
						'battlegroup' => array('VCHAR', NULL),
						'guild' => array('VCHAR', NULL),
						'guildRealm' => array('VCHAR', NULL),
						'rank' => array('TINT:2', 0),
						'class' => array('TINT:2', 0),
						'race' => array('TINT:2', 0),
						'gender' => array('TINT:1', 0),
						'level' => array('USINT', 0),
						'achievementPoints' => array('UINT', 0),
						'thumbnail' => array('VCHAR', NULL),
						'spec' => array('MTEXT', NULL),
						'created' => array('TIMESTAMP', 0),
						'modified' => array('TIMESTAMP', 0),
						'deleted' => array('TIMESTAMP', 0),
					),
					'PRIMARY_KEY'	=> 'roster_id',
					'KEYS'=> array(
						'roster_uk' => array('UNIQUE', 'uniquekey'),
						'r_name' => array('INDEX', 'name'),
						'r_realm' => array('INDEX', 'realm'),
					),
				),
				
				$this->table_prefix . 'wowguild' => array(
					'COLUMNS' => array(
						'guild_id' => array('UINT', NULL, 'auto_increment'),
						'name' => array('VCHAR', ''),
						'realm' => array('VCHAR', ''),
						'battlegroup' => array('VCHAR', NULL),
						'level' => array('TINT:3', 0),
						'side' => array('TINT:1', 0),
						'achievementPoints' => array('UINT', 0),
						'emblem' => array('MTEXT', NULL),
						'created' => array('TIMESTAMP', 0),
						'modified' => array('TIMESTAMP', 0),
						'deleted' => array('TIMESTAMP', 0),
					),
					'PRIMARY_KEY'	=> 'guild_id',
					'KEYS'=> array(
						'g_name' => array('INDEX', 'name'),
						'g_realm' => array('INDEX', 'realm'),
					),
				),

			),

		);
	}
	
	// Remove wowroster tables
	public function revert_schema()
	{
		return array(
			'drop_tables' => array(
				$this->table_prefix . 'wowroster',
				$this->table_prefix . 'wowguild',
			),
		);
	}

}
