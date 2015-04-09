<?php

namespace clausi\wowroster\controller;

use Symfony\Component\DependencyInjection\ContainerInterface;

interface main_interface
{
	public function index();
	public function cron();
}
