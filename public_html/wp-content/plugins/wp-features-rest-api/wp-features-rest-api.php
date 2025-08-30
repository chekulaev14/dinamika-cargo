<?php
/**
 * Plugin Name: WordPress Features REST API
 * Description: Предоставляет REST API для WordPress Feature API
 * Version: 1.0.0
 * Author: Admin
 * License: GPL v2 or later
 */

// Регистрируем REST API routes
add_action( 'rest_api_init', 'wp_features_rest_api_init' );

function wp_features_rest_api_init() {
    // Регистрируем namespace
    register_rest_route( 'wp-features/v1', '/tools', array(
        'methods' => 'GET',
        'callback' => 'wp_features_get_tools',
        'permission_callback' => 'wp_features_check_permission',
    ) );

    register_rest_route( 'wp-features/v1', '/tools/(?P<id>[a-zA-Z0-9\/\-_]+)', array(
        'methods' => 'GET',
        'callback' => 'wp_features_get_tool',
        'permission_callback' => 'wp_features_check_permission',
    ) );

    register_rest_route( 'wp-features/v1', '/tools/(?P<id>[a-zA-Z0-9\/\-_]+)/execute', array(
        'methods' => 'POST',
        'callback' => 'wp_features_execute_tool',
        'permission_callback' => 'wp_features_check_permission',
    ) );
}

function wp_features_check_permission() {
    // Простая проверка - можно улучшить
    return current_user_can( 'manage_options' );
}

function wp_features_get_tools() {
    if ( ! function_exists( 'wp_get_features' ) ) {
        return new WP_Error( 'feature_api_not_available', 'Feature API not available', array( 'status' => 500 ) );
    }

    $features = wp_get_features();
    $tools = array();

    foreach ( $features as $feature ) {
        $tools[] = array(
            'id' => $feature->get_id(),
            'name' => $feature->get_name(),
            'description' => $feature->get_description(),
            'type' => $feature->get_type(),
            'input_schema' => $feature->get_input_schema(),
        );
    }

    return rest_ensure_response( $tools );
}

function wp_features_get_tool( $request ) {
    if ( ! function_exists( 'wp_get_features' ) ) {
        return new WP_Error( 'feature_api_not_available', 'Feature API not available', array( 'status' => 500 ) );
    }

    $tool_id = $request['id'];
    $features = wp_get_features();

    foreach ( $features as $feature ) {
        if ( $feature->get_id() === $tool_id ) {
            return rest_ensure_response( array(
                'id' => $feature->get_id(),
                'name' => $feature->get_name(),
                'description' => $feature->get_description(),
                'type' => $feature->get_type(),
                'input_schema' => $feature->get_input_schema(),
            ) );
        }
    }

    return new WP_Error( 'tool_not_found', 'Tool not found', array( 'status' => 404 ) );
}

function wp_features_execute_tool( $request ) {
    if ( ! function_exists( 'wp_get_features' ) ) {
        return new WP_Error( 'feature_api_not_available', 'Feature API not available', array( 'status' => 500 ) );
    }

    $tool_id = $request['id'];
    $params = $request->get_json_params() ?: array();
    $features = wp_get_features();

    foreach ( $features as $feature ) {
        if ( $feature->get_id() === $tool_id ) {
            $callback = $feature->get_callback();
            if ( is_callable( $callback ) ) {
                try {
                    $result = call_user_func( $callback, $params );
                    return rest_ensure_response( array(
                        'success' => true,
                        'result' => $result,
                    ) );
                } catch ( Exception $e ) {
                    return new WP_Error( 'execution_error', $e->getMessage(), array( 'status' => 500 ) );
                }
            } else {
                return new WP_Error( 'invalid_callback', 'Invalid callback', array( 'status' => 500 ) );
            }
        }
    }

    return new WP_Error( 'tool_not_found', 'Tool not found', array( 'status' => 404 ) );
}




