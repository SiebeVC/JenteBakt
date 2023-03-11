<?php

function jb_theme_support()
{
    add_theme_support('title-tag');
    add_theme_support('custom-logo');
    add_theme_support('post-thumbnails');
}

add_action('after_setup_theme', 'jb_theme_support');

function jb_register_widgets() {
    register_sidebar(
        array(
            'name' => 'Footer Title 1',
            'id' => 'footer-title-1',
            'before_title' => '',
            'after_title' => '',
            'before_widget' => '',
            'after_widget' => '',
        )
    );

    register_sidebar(
        array(
            'name' => 'Footer Text 1',
            'id' => 'footer-text-1',
            'before_title' => '',
            'after_title' => '',
            'before_widget' => '',
            'after_widget' => '',
        )
    );

    register_sidebar(
        array(
            'name' => 'Footer Title 2',
            'id' => 'footer-title-2',
            'before_title' => '',
            'after_title' => '',
            'before_widget' => '',
            'after_widget' => '',
        )
    );

    register_sidebar(
        array(
            'name' => 'Footer Text 2',
            'id' => 'footer-text-2',
            'before_title' => '',
            'after_title' => '',
            'before_widget' => '<span>',
            'after_widget' => '</span>',
        )
    );

    register_sidebar(
        array(
            'name' => 'Lowest Footer Text',
            'id' => 'lowest-footer-text',
            'before_title' => '',
            'after_title' => '',
            'before_widget' => '',
            'after_widget' => '',
        )
    );

    register_sidebar(
        array(
            'name' => 'Email',
            'id' => 'email',
            'before_title' => '',
            'after_title' => '',
            'before_widget' => '',
            'after_widget' => '',
        )
    );
}

add_action('widgets_init', 'jb_register_widgets');


function SearchFilter($query) {
    if ($query->is_search) {
        $query->set('post_type', 'post');
    }
    return $query;
}

add_filter('pre_get_posts','SearchFilter');


function jb_menus(){
    $locations = array(
        'primary' => "Navbar",
        'secondary' => "Navbar2"
        
    );

    register_nav_menus($locations);
}

add_action('init', 'jb_menus');

function jb_register_styles(){
    $version = wp_get_theme()->get('Version');

    wp_enqueue_style('jb-reset', get_template_directory_uri() . '/assets/css/reset.css', array(), $version, 'all');
    wp_enqueue_style('jb-styles', get_template_directory_uri() . '/assets/css/styles.css', array('jb-reset'), $version, 'all');
    wp_enqueue_style('jb_google_icons', 'https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0', array(), $version, 'all');
}

add_action('wp_enqueue_scripts', 'jb_register_styles');
