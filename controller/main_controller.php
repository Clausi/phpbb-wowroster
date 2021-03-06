<?php

namespace clausi\wowroster\controller;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;


class main_controller implements main_interface
{
	protected $config;
	protected $helper;
	protected $template;
	protected $user;
	protected $auth;
	protected $cp;
	protected $container;
	protected $db;
	protected $u_action;
	
	protected $guild;
	
	protected $wowrosterTable;

	public function __construct(\phpbb\config\config $config, \phpbb\auth\auth $auth, \phpbb\controller\helper $helper, \phpbb\db\driver\driver_interface $db, \phpbb\template\template $template, \phpbb\user $user, \phpbb\request\request $request, ContainerInterface $container)
	{
		$this->config = $config;
		$this->template = $template;
		$this->user = $user;
		$this->helper = $helper;
		$this->auth = $auth;
		$this->db = $db;
		$this->request = $request;
		$this->container = $container;
		
		$this->wowrosterTable = $this->container->getParameter('tables.clausi.wowroster');
	}
	
	
	public function index()
	{
		if($this->config['clausi_wowroster_active'] == 0) 
		{
			$this->template->assign_var('WOWROSTER_MESSAGE', $this->user->lang['WOWROSTER_INACTIVE']);
			return $this->helper->render('wowroster_error.html', $this->user->lang['WOWROSTER_PAGE'], 404);
		}
		
		return $this->helper->render('wowroster_index.html', $this->user->lang['WOWROSTER_PAGE']);
	}
	
	
	public function cron($key = '')
	{
		if($key !== $this->config['clausi_wowroster_cron_key']) 
		{
			$this->template->assign_var('WOWROSTER_MESSAGE', $this->user->lang['WOWROSTER_ACCESS']);
			return $this->helper->render('wowroster_error.html', $this->user->lang['WOWROSTER_PAGE'], 403);
		}
		
		return $this->helper->render('wowroster_cron.html', $this->user->lang['WOWROSTER_PAGE']);
	}
	
	
	private function var_display($var)
	{
		$error = "<pre>";
		print_r($var);
		$error = "</pre>";
	}
	
}
