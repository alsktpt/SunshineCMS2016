<?php

/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @package  Laravel
 * @author   Taylor Otwell <taylorotwell@gmail.com>
 */

/**
 * 资讯新站点 - 阳光网站子站点未命名
 *
 * @framework    Laravel 5.1.11 LTS
 * @author 	     Sunshine Studio, Research & Design Center, 2016 Project Group [Unnamed]
 * @director 	 Cornwallis Cheng <ktpt@me.com> <Als_ktpt | Saberchan2014>
 * @version      alpha version 0.4.7
 */

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

// This file allows us to emulate Apache's "mod_rewrite" functionality from the
// built-in PHP web server. This provides a convenient way to test a Laravel
// application without having installed a "real" web server software here.
if ($uri !== '/' && file_exists(__DIR__.'/public'.$uri)) {
    return false;
}

require_once __DIR__.'/public/index.php';
