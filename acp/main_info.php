<?php

namespace clausi\wowroster\acp;

class main_info
{
	function module()
	{
		return array(
			'filename'	=> '\clausi\wowroster\acp\main_module',
			'title'		=> 'ACP_WOWROSTER_TITLE',
			'version'	=> '1.0.0',
			'modes'		=> array(
				'settings' => array(
					'title' => 'ACP_EPGP_SETTINGS', 
					'auth' => 'ext_clausi/wowroster && acl_a_wowroster', 
					'cat' => array('ACP_WOWROSTER_TITLE')
				),
			),
		);
	}
}
