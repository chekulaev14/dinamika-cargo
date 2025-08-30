<?php
function transportex_general_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';

    /* General Section */
    $wp_customize->add_panel( 'general_options', array(
        'priority' => 3,
        'capability' => 'edit_theme_options',
        'title' => __('General Settings', 'transportex'),
    ) );
 
    $wp_customize->add_setting( 
    'breadcrumb_img_type_display' , 
        array(
            'default' => 'scroll',
            'capability'     => 'edit_theme_options',
            'sanitize_callback' => 'transportex_sanitize_select',
            'priority'  => 10,
        ) 
    );
    
    $wp_customize->add_control(
    'breadcrumb_img_type_display' , 
        array(
            'label'          => __( 'Background Attachment', 'transportex' ),
            'section'        => 'header_image',
            'type'           => 'select',
            'choices'        => 
            array(
                'inherit' => __( 'Inherit', 'transportex' ),
                'scroll' => __( 'Scroll', 'transportex' ),
                'fixed'   => __( 'Fixed', 'transportex' )
            ) 
        ) 
    );

    $wp_customize->add_setting(
        'header_img_bg_color', array( 'sanitize_callback' => 'sanitize_text_field',
        'default' =>'#00000033',
    ) );
    
    $wp_customize->add_control(new Transportex_Customize_Alpha_Color_Control( $wp_customize,
        'header_img_bg_color', array(
        'label'      => __('Overlay Color', 'transportex' ),
        'palette' => true,
        'section' => 'header_image')
    ) );
    $wp_customize->add_setting('transportex_title_font_size',
        array(
            'default'           => 34,
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control('transportex_title_font_size',
        array(
            'label'    => esc_html__('Site Title Size', 'transportex'),
            'section'  => 'title_tagline',
            'type'     => 'number',
            'priority' => 50,
        )
    );
   
    //Scroller settings
    $wp_customize->add_section(
        'scroller',
        array(
            'priority'      => 1,
            'title'         => __('Scroller','transportex'),
            'panel'         => 'general_options',
        )
    ); 

    //Enable and disable social icon
    $wp_customize->add_setting(
    'scroller_enable' ,
        array(
            'capability'     => 'edit_theme_options',
            'sanitize_callback' => 'transportex_copyright_sanitize_checkbox',
        )   
    );
    $wp_customize->add_control(
    'scroller_enable',
        array(
            'label' => __('Hide / Show','transportex'),
            'section' => 'scroller',
            'type' => 'checkbox',
        )
    ); 
}
add_action( 'customize_register', 'transportex_general_setting' );
 
function transportex_sanitize_select( $input, $setting ) {
    
    // Ensure input is a slug.
    $input = sanitize_key( $input );
    
    // Get list of choices from the control associated with the setting.
    $choices = $setting->manager->get_control( $setting->id )->choices;
    
    // If the input is a valid key, return it; otherwise, return the default.
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}