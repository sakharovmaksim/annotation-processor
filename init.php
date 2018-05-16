<?php
/**
 * @author Alexander Sokol <sokol@tutu.ru>
 */

/*
 * Initialization
 */

mb_internal_encoding('UTF-8');
mb_regex_encoding('UTF-8');

if (!defined('ROOT_DIR'))
{
	define('ROOT_DIR', __DIR__);
}

require ROOT_DIR . '/vendor/autoload.php';
