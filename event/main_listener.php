<?php

namespace clausi\wowroster\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* Event listener
*/
class main_listener implements EventSubscriberInterface
{
	
	static public function getSubscribedEvents()
	{
		return array(
			'core.user_setup'	=> 'load_language_on_setup',
			'core.page_header'	=> 'add_page_header_link',
			// ACP event
			'core.permissions'	=> 'add_permission',
		);
	}

	protected $helper;
	protected $template;
	protected $config;
	protected $auth;


	public function __construct(\phpbb\controller\helper $helper, \phpbb\template\template $template, \phpbb\config\config $config, \phpbb\auth\auth $auth)
	{
		$this->helper = $helper;
		$this->template = $template;
		$this->config = $config;
		$this->auth = $auth;
	}

	public function load_language_on_setup($event)
	{
		$lang_set_ext = $event['lang_set_ext'];
		$lang_set_ext[] = array(
			'ext_name' => 'clausi/wowroster',
			'lang_set' => 'wowroster_common',
		);
		$event['lang_set_ext'] = $lang_set_ext;
	}
	
	public function add_permission($event)
	{
		$permissions = $event['permissions'];
		$permissions['a_wowroster'] = array('lang' => 'ACL_A_WOWROSTER', 'cat' => 'misc');
		$event['permissions'] = $permissions;
	}

	public function add_page_header_link($event)
	{
		$this->template->assign_vars(array(
			'U_WOWROSTER'	=> $this->helper->route('clausi_wowroster_controller'),
			'S_CLAUSI_WOWROSTER_ACTIVE' => $this->config['clausi_wowroster_active'],
		));
	}
}
