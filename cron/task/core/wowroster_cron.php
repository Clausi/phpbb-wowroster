<?php

namespace clausi\wowroster\cron\task\core;

use Symfony\Component\DependencyInjection\ContainerInterface;

class wowroster_cron extends \phpbb\cron\task\base
{
	protected $config;
	protected $db;
	protected $container;
	protected $wowroster;
	
	protected $wowrosterTable;

	
	public function __construct(\phpbb\config\config $config, \phpbb\db\driver\driver_interface $db, ContainerInterface $container, \clausi\wowroster\controller\main_controller $wowroster)
	{
		$this->config = $config;
		$this->db = $db;
		$this->container = $container;
		$this->wowroster = $wowroster;
		
		$this->wowrosterTable = $this->container->getParameter('tables.clausi.wowroster');
	}
	
	/**
	* Runs this cron task.
	*
	* @return null
	*/
	public function run()
	{
		// echo "run";
		$this->getRoster();
	}
	
	
	private function getRoster()
	{
		
		$this->config->set('clausi_wowroster_cron_lastrun', time());
	}

	
	/**
	* Returns whether this cron task can run, given current board configuration.
	*
	* @return bool
	*/
	public function is_runnable()
	{
		if( $this->config['clausi_wowroster_cron_active'] && $this->config['clausi_wowroster_bnetkey'] != '' ) return true;
		
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
		return $this->config['clausi_wowroster_cron_lastrun'] < time() - ($this->config['clausi_wowroster_cron_interval'] * 60);
	}
}
