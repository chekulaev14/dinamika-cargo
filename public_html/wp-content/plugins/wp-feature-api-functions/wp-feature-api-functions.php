<?php
/**
 * Plugin Name: WordPress Feature API Functions
 * Description: Регистрирует базовые функции WordPress через Feature API
 * Version: 1.0.0
 * Author: Admin
 * License: GPL v2 or later
 */

// Регистрируем функции на init хуке
add_action( 'init', 'wp_feature_api_register_basic_functions' );

/**
 * Регистрируем базовые функции WordPress
 */
function wp_feature_api_register_basic_functions() {
    // Проверяем, что Feature API загружен
    if ( ! function_exists( 'wp_register_feature' ) ) {
        return;
    }

    // Функция для получения информации о сайте
    wp_register_feature( array(
        'id' => 'wordpress/site-info',
        'name' => 'Site Information',
        'description' => 'Получить базовую информацию о WordPress сайте',
        'callback' => 'wp_feature_api_site_info_callback',
        'type' => 'tool',
        'input_schema' => array(
            'type' => 'object',
            'properties' => array(),
        ),
    ) );

    // Функция для получения списка плагинов
    wp_register_feature( array(
        'id' => 'wordpress/plugins-list',
        'name' => 'Plugins List',
        'description' => 'Получить список активных плагинов',
        'callback' => 'wp_feature_api_plugins_list_callback',
        'type' => 'tool',
        'input_schema' => array(
            'type' => 'object',
            'properties' => array(),
        ),
    ) );

    // Функция для получения информации о теме
    wp_register_feature( array(
        'id' => 'wordpress/theme-info',
        'name' => 'Theme Information',
        'description' => 'Получить информацию об активной теме',
        'callback' => 'wp_feature_api_theme_info_callback',
        'type' => 'tool',
        'input_schema' => array(
            'type' => 'object',
            'properties' => array(),
        ),
    ) );
}

/**
 * Callback для информации о сайте
 */
function wp_feature_api_site_info_callback() {
    return array(
        'site_title' => get_bloginfo( 'name' ),
        'site_description' => get_bloginfo( 'description' ),
        'site_url' => get_bloginfo( 'url' ),
        'wordpress_version' => get_bloginfo( 'version' ),
        'php_version' => PHP_VERSION,
        'memory_limit' => WP_MEMORY_LIMIT,
        'max_upload_size' => wp_max_upload_size(),
    );
}

/**
 * Callback для списка плагинов
 */
function wp_feature_api_plugins_list_callback() {
    $active_plugins = get_option( 'active_plugins' );
    $plugins_info = array();
    
    foreach ( $active_plugins as $plugin ) {
        $plugin_data = get_plugin_data( WP_PLUGIN_DIR . '/' . $plugin );
        $plugins_info[] = array(
            'name' => $plugin_data['Name'],
            'version' => $plugin_data['Version'],
            'description' => $plugin_data['Description'],
            'author' => $plugin_data['Author'],
        );
    }

    return array(
        'active_plugins_count' => count( $active_plugins ),
        'active_plugins' => $plugins_info,
    );
}

/**
 * Callback для информации о теме
 */
function wp_feature_api_theme_info_callback() {
    $theme = wp_get_theme();
    return array(
        'name' => $theme->get( 'Name' ),
        'version' => $theme->get( 'Version' ),
        'description' => $theme->get( 'Description' ),
        'author' => $theme->get( 'Author' ),
        'template' => $theme->get_template(),
        'stylesheet' => $theme->get_stylesheet(),
    );
}
