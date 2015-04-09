<?php

namespace clausi\wowroster\acp;

class main_module
{
	public $u_action;

	function main($id, $mode)
	{
		global $phpbb_container, $request, $user;

		$user->add_lang_ext('clausi/wowroster', 'wowroster_acp');
		$admin_controller = $phpbb_container->get('clausi.wowroster.admin.controller');
		$action = $request->variable('action', '');
		$admin_controller->set_page_url($this->u_action);
		
		switch($mode) 
		{
			case 'settings':
				$this->tpl_name = 'wowroster_settings';
				$this->page_title = $user->lang('ACP_WOWROSTER_SETTINGS');
				$admin_controller->display_options();
			break;
		}
	}
}
