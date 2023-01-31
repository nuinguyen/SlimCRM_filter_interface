<?php

defined("BASEPATH") or exit("No direct script access allowed");
/*
Module Name: Demo Filter Interface
Description: Demo
Version: 1.0.0
Requires at least: 2.3.*
Author: SlimCRM
Author URI: https://xxx.com/slimcrm
*/
define('FILTER_INTERFACE_MODULE_NAME', 'filter_interface');


/**
 * Register activation module hook
 */
register_activation_hook(FILTER_INTERFACE_MODULE_NAME, 'filter_interface_module_activation_hook');

function filter_interface_module_activation_hook()
{
    require_once(__DIR__ . '/install.php');
}
