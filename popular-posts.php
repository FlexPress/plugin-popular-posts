<?php

/**
 * Plugin Name: Popular Posts
 * Plugin URI: https://github.com/FlexPress/plugin-popular-posts
 * Description: FlexPress based plugin
 * Version: 1.0.0
 * Author: FlexPress
 * Author URI: https://github.com/FlexPress
 * License: MIT
 */

use FlexPress\Plugins\PopularPosts\DependencyInjection\DependencyInjectionContainer;

// Include autoloader if installed on it's own.
$autoloadFile = __DIR__ . '/vendor/autoload.php';
if (file_exists($autoloadFile)) {
    require_once($autoloadFile);
}

// Dependency Injection
$dic = new DependencyInjectionContainer();
$dic->init();

// Run app
$dic['PopularPosts']->init(__FILE__);
