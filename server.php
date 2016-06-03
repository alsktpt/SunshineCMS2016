<?php

/**
 * 阳光网站内容管理框架
 *
 * @package      Laravel 5.1.33 LTS - A PHP Framework For Web Artisans
 * @author 	     Sunshine Studio, Research & Design Center, 2016 Project Group ["Renovators"]
 * @director 	 Cornwallis Cheng <ktpt@me.com> <Als_ktpt | Saberchan2014>
 * @version      alpha version 0.8.9
 */

/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @package  Laravel
 * @author   Taylor Otwell <taylorotwell@gmail.com>
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
