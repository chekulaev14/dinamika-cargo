<?php
/**
 * Plugin Name: WordPress Feature API Loader
 * Description: Загружает WordPress Feature API для интеграции с MCP
 * Version: 1.0.0
 * Author: Admin
 * License: GPL v2 or later
 */

// Безопасная загрузка WordPress Feature API
function wp_feature_api_loader_init() {
    // Включаем основной файл плагина - он автоматически регистрируется с менеджером версий
    require_once ABSPATH . 'vendor/automattic/wp-feature-api/wp-feature-api.php';

    // Регистрируем наши функции после инициализации API
    add_action( 'wp_feature_api_init', 'wp_feature_api_loader_register_features' );
}

// Хук в plugins_loaded - Feature API сам решит, какую версию использовать
add_action( 'plugins_loaded', 'wp_feature_api_loader_init' );

/**
 * Регистрируем функции, предоставляемые этим плагином
 */
function wp_feature_api_loader_register_features() {
    // Регистрируем базовые функции WordPress
    wp_register_feature( array(
        'id' => 'wordpress/basic-info',
        'name' => 'WordPress Basic Info',
        'description' => 'Получить базовую информацию о WordPress сайте',
        'callback' => 'wp_feature_api_loader_basic_info_callback',
        'type' => 'tool',
        'input_schema' => array(
            'type' => 'object',
            'properties' => array(),
        ),
    ) );

    wp_register_feature( array(
        'id' => 'wordpress/site-status',
        'name' => 'Site Status',
        'description' => 'Проверить статус сайта и активных плагинов',
        'callback' => 'wp_feature_api_loader_site_status_callback',
        'type' => 'tool',
        'input_schema' => array(
            'type' => 'object',
            'properties' => array(),
        ),
    ) );
}

/**
 * Callback для базовой информации о WordPress
 */
function wp_feature_api_loader_basic_info_callback() {
    return array(
        'site_title' => get_bloginfo( 'name' ),
        'site_description' => get_bloginfo( 'description' ),
        'site_url' => get_bloginfo( 'url' ),
        'wordpress_version' => get_bloginfo( 'version' ),
        'php_version' => PHP_VERSION,
        'active_theme' => wp_get_theme()->get( 'Name' ),
    );
}

/**
 * Callback для статуса сайта
 */
function wp_feature_api_loader_site_status_callback() {
    $active_plugins = get_option( 'active_plugins' );
    $plugins_info = array();
    
    foreach ( $active_plugins as $plugin ) {
        $plugin_data = get_plugin_data( WP_PLUGIN_DIR . '/' . $plugin );
        $plugins_info[] = array(
            'name' => $plugin_data['Name'],
            'version' => $plugin_data['Version'],
            'description' => $plugin_data['Description'],
        );
    }

    return array(
        'site_status' => 'active',
        'active_plugins_count' => count( $active_plugins ),
        'active_plugins' => $plugins_info,
        'memory_limit' => WP_MEMORY_LIMIT,
        'max_upload_size' => wp_max_upload_size(),
    );
}




