<?php

namespace clausi\wowroster\controller;

use Symfony\Component\DependencyInjection\ContainerInterface;

class admin_controller implements admin_interface
{
	protected $config;
	protected $db;
	protected $request;
	protected $template;
	protected $user;
	protected $container;
	protected $auth;
	
	protected $wowroster;
	
	protected $wowrosterTable;


	public function __construct(\phpbb\config\config $config, \phpbb\db\driver\driver_interface $db, \phpbb\request\request $request, \phpbb\template\template $template, \phpbb\user $user, \phpbb\auth\auth $auth, ContainerInterface $container, \clausi\wowroster\controller\main_controller $wowroster)
	{
		$this->config = $config;
		$this->db = $db;
		$this->request = $request;
		$this->template = $template;
		$this->user = $user;
		$this->auth = $auth;
		$this->container = $container;
		
		$this->wowroster = $wowroster;
		
		$this->wowrosterTable = $this->container->getParameter('tables.clausi.wowroster');
	}
	
	public function display_options()
	{
		add_form_key('clausi/wowroster');

		if ($this->request->is_set_post('submit'))
		{
			if (!check_form_key('clausi/wowroster'))
			{
				trigger_error('FORM_INVALID');
			}

			$this->set_options();
			trigger_error($this->user->lang('ACP_WOWROSTER_SETTING_SAVED') . adm_back_link($this->u_action));
		}
		

		$this->template->assign_vars(array(
			'U_ACTION'	=> $this->u_action,
			'CLAUSI_WOWROSTER_ACTIVE' => $this->config['clausi_wowroster_active'],
			'CLAUSI_WOWROSTER_CRON_ACTIVE' => $this->config['clausi_wowroster_cron_active'],
			'CLAUSI_WOWROSTER_CRON_KEY' => $this->config['clausi_wowroster_cron_key'],
			'CLAUSI_WOWROSTER_CRON_INTERVAL' => $this->config['clausi_wowroster_cron_interval'],
		));
	}

	
	private function set_options()
	{
		$this->config->set('clausi_wowroster_active', $this->request->variable('clausi_wowroster_active', 0));
		$this->config->set('clausi_wowroster_cron_active', $this->request->variable('clausi_wowroster_cron_active', 0));
		$this->config->set('clausi_wowroster_cron_interval', $this->request->variable('clausi_wowroster_cron_interval', ''));
	}

	
	public function set_page_url($u_action)
	{
		$this->u_action = $u_action;
	}
	
	
	private function var_display($var)
	{
		$error = "<pre>";
		print_r($var);
		$error = "</pre>";
	}
	
}
