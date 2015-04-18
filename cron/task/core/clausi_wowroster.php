<?php

namespace clausi\wowroster\cron\task\core;

use Symfony\Component\DependencyInjection\ContainerInterface;

class clausi_wowroster extends \phpbb\cron\task\base
{
	protected $config;
	protected $db;
	protected $container;
	protected $wowroster;
	protected $armory;
	protected $guild;
	protected $guildData;
	protected $phpbb_root_path;
	protected $php_ext;
	protected $wowrosterTable;

	
	public function __construct(\phpbb\config\config $config, \phpbb\db\driver\driver_interface $db, ContainerInterface $container, \clausi\wowroster\controller\main_controller $wowroster, $phpbb_root_path, $php_ext)
	{
		$this->config = $config;
		$this->db = $db;
		$this->container = $container;
		$this->wowroster = $wowroster;
		
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $php_ext;
		
		// setup wowarmoryapi
		include_once($this->phpbb_root_path . 'ext/clausi/wowroster/wowarmoryapi_config.'.$this->php_ext);
		$this->armory = new \BattlenetArmory('EU', 'Anetheron');
		$this->armory->UTF8(true);
		$this->armory->setGuildsCacheTTL(1); // ensure guild cache is below cron interval but only once a second calls are possible
		
		// get guild, TODO: use config
		$this->guild = $this->armory->getGuild('Tenebrae');
		$guildData = $this->guild->getData();
		$this->var_display($guildData);
		
		$this->wowrosterTable = $this->container->getParameter('tables.clausi.wowroster');
	}
	
	/**
	* Runs this cron task.
	*
	* @return null
	*/
	public function run()
	{
		echo "run"; // for testing
		$this->getRoster();
		
		$this->config->set('clausi_wowroster_last_gc', time());
	}

	
	/**
	* Returns whether this cron task can run, given current board configuration.
	*
	* @return bool
	*/
	public function is_runnable()
	{
		if( $this->config['clausi_wowroster_cron_active'] ) return true;
		
		return false;
	}
	
	/**
	* Returns whether this cron task should run now, because enough time
	* has passed since it was last run.
	*
	* @return bool
	*/
	public function should_run()
	{
		return true; // for testing
		//return $this->config['clausi_wowroster_last_gc'] < time() - ($this->config['clausi_wowroster_gc'] * 60);
	}
	
	
	// Pull roster from battle.net api
	private function getRoster()
	{
		
	}
	
	private function var_display($var)
	{
		echo "<pre>";
		print_r($var);
		echo "</pre>";
	}
	
}
