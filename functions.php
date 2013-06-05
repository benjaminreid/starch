<?php

namespace Starch\Core;

/**
 * Server-side paths
 */

// Theme directory
define('PATH', __DIR__ . '/');
// Framework directory
define('APP', __DIR__ . '/app/');
// Framework core files directory
define('CORE', APP . 'classes/core/');


/**
 * Client-side paths
 */

// Site URL (i.e. http://site.com)
define('SITE_URL', get_bloginfo('url'));
// Theme URL (i.e. http://site.com/wp-content/themes/theme/)
define('URL', get_template_directory_uri() . '/');
// Relative Theme URL (i.e /wp-content/themes/theme/)
define('REL_URL', str_replace(SITE_URL, '', URL));
// Assets URL
define('ASSETS', URL . 'assets/');

/**
 * Auto-loader
 */
include_once CORE . '__autoload.php';

Starch::go();