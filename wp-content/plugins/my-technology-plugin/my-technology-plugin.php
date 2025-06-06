<?php
/**
 * Plugin Name: Technology Post Type
 * Description: Custom post type 'Technology'
 * Version: 1.0
 * Author: vishva tatamiya
 */

// Register Custom Post Type
function register_technology_post_type() {
    $labels = array(
        'name'                  => 'Technologies',
        'singular_name'         => 'Technology',
        'menu_name'             => 'Technology',
        'name_admin_bar'        => 'Technology',
        'add_new'               => 'Add New',
        'add_new_item'          => 'Add New Technology',
        'edit_item'             => 'Edit Technology',
        'new_item'              => 'New Technology',
        'view_item'             => 'View Technology',
        'search_items'          => 'Search Technologies',
        'not_found'             => 'No technologies found',
        'not_found_in_trash'    => 'No technologies found in Trash',
    );

    $args = array(
        'label'                 => 'Technology',
        'labels'                => $labels,
        'public'                => true,
        'has_archive'           => true,
        'rewrite'               => array('slug' => 'technology'),
        'supports'              => array('title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_rest'          => true,
    );

    register_post_type('technology', $args);
}
add_action('init', 'register_technology_post_type');

function register_technology_taxonomy() {
    $labels = array(
        'name'              => 'Technology Categories',
        'singular_name'     => 'Technology Category',
        'search_items'      => 'Search Technology Categories',
        'all_items'         => 'All Technology Categories',
        'parent_item'       => 'Parent Technology Category',
        'parent_item_colon' => 'Parent Technology Category:',
        'edit_item'         => 'Edit Technology Category',
        'update_item'       => 'Update Technology Category',
        'add_new_item'      => 'Add New Technology Category',
        'new_item_name'     => 'New Technology Category Name',
        'menu_name'         => 'Tech Categories',
    );

    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true, 
        'public'            => true,
        'show_ui'           => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'rewrite'           => array('slug' => 'tech-category'),
    );

    register_taxonomy('tech_category', array('technology'), $args);
}
add_action('init', 'register_technology_taxonomy');

add_filter('theme_page_templates', 'my_plugin_add_page_template');
add_filter('template_include', 'my_plugin_load_page_template');

function my_plugin_add_page_template($templates) {
    $templates['custom-template.php'] = 'Custom Technology Template';
    return $templates;
}

function my_plugin_load_page_template($template) {
    if (is_page()) {
        $page_template = get_page_template_slug();
        if ($page_template === 'custom-template.php') {
            $plugin_template = plugin_dir_path(__FILE__) . 'templates/custom-template.php';
            if (file_exists($plugin_template)) {
                return $plugin_template;
            }
        }
    }
    return $template;
}
