<?php

return array(
    // The environment: development, testing, or production
    'environment' => 'development',

    /**
      * Post types to register:
      *
      * Should have a corresponding Model (inheriting from Starch\Core\Post) and Controller class
      * (which will inherit from \Starch\Core\Controller or, more likely, \Starch\Core\TemplateController)
      */
    'post_types' => array(),

    // Should pages have an excerpt field
    'page_excerpts' => true,

    // Featured image on posts/pages
    'post_thumbnails' => true,

    // Thumbnails: array of thumbnail sizes
    'thumbnails' => array(
        array('featured-image', 320, 960, true)
    ),

    // Should jQuery be included in the <head>
    'deregister_jquery' => true,

    // Admin scripts, relative to assets/admin directory (.js not required)
    'admin_scripts' => array('admin'),

    // Admin CSS
    'admin_css' => array('admin'),

    // Hide slug box on post edit page for Editors (only Admin will see)
    'hide_slug_box' => true,

    // Hide admin bar for Subscribers
    'hide_admin_bar' => true,

    // Redirect /wp-admin/ for Subscribers
    'redirect_wp_admin' => '/',

    // Hide options from non-admin
    // Options: posts, settings, profile, plugins, media, comments, links, appearance, users, tools
    'hide' => array('posts', 'media', 'links', 'comments', 'profile', 'settings', 'tools')
);