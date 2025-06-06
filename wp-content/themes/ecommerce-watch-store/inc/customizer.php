<?php
/**
 * Ecommerce Watch Store Theme Customizer
 *
 * @package Ecommerce Watch Store
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

function ecommerce_watch_store_custom_controls() {
	load_template( trailingslashit( get_template_directory() ) . '/inc/custom-controls.php' );
}
add_action( 'customize_register', 'ecommerce_watch_store_custom_controls' );

function ecommerce_watch_store_customize_register( $wp_customize ) {


	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	load_template( trailingslashit( get_template_directory() ) . '/inc/icon-picker.php' );

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector' => '.logo .site-title a',
	 	'render_callback' => 'ecommerce_watch_store_Customize_partial_blogname',
	));

	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector' => 'p.site-description',
		'render_callback' => 'ecommerce_watch_store_Customize_partial_blogdescription',
	));

	// add home page setting pannel
	$wp_customize->add_panel( 'ecommerce_watch_store_panel_id', array(
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => esc_html__( 'Homepage Settings', 'ecommerce-watch-store' ),
		'priority' => 10,
	));

 	// Header Background color
	$wp_customize->add_setting('ecommerce_watch_store_header_background_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ecommerce_watch_store_header_background_color', array(
		'label'    => __('Header Background Color', 'ecommerce-watch-store'),
		'section'  => 'header_image',
	)));

	$wp_customize->add_setting('ecommerce_watch_store_header_img_position',array(
	  'default' => 'center top',
	  'transport' => 'refresh',
	  'sanitize_callback' => 'ecommerce_watch_store_sanitize_choices'
	));
	$wp_customize->add_control('ecommerce_watch_store_header_img_position',array(
		'type' => 'select',
		'label' => __('Header Image Position','ecommerce-watch-store'),
		'section' => 'header_image',
		'choices' 	=> array(
			'left top' 		=> esc_html__( 'Top Left', 'ecommerce-watch-store' ),
			'center top'   => esc_html__( 'Top', 'ecommerce-watch-store' ),
			'right top'   => esc_html__( 'Top Right', 'ecommerce-watch-store' ),
			'left center'   => esc_html__( 'Left', 'ecommerce-watch-store' ),
			'center center'   => esc_html__( 'Center', 'ecommerce-watch-store' ),
			'right center'   => esc_html__( 'Right', 'ecommerce-watch-store' ),
			'left bottom'   => esc_html__( 'Bottom Left', 'ecommerce-watch-store' ),
			'center bottom'   => esc_html__( 'Bottom', 'ecommerce-watch-store' ),
			'right bottom'   => esc_html__( 'Bottom Right', 'ecommerce-watch-store' ),
		),
		));

	//Menus Settings
	$wp_customize->add_section( 'ecommerce_watch_store_menu_section' , array(
    	'title' => __( 'Menus Settings', 'ecommerce-watch-store' ),
		'panel' => 'ecommerce_watch_store_panel_id'
	) );

	$wp_customize->add_setting('ecommerce_watch_store_navigation_menu_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ecommerce_watch_store_navigation_menu_font_size',array(
		'label'	=> __('Menus Font Size','ecommerce-watch-store'),
		'description'	=> __('Enter a value in pixels. Example:20px','ecommerce-watch-store'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'ecommerce-watch-store' ),
        ),
		'section'=> 'ecommerce_watch_store_menu_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting('ecommerce_watch_store_navigation_menu_font_weight',array(
        'default' => 600,
        'transport' => 'refresh',
        'sanitize_callback' => 'ecommerce_watch_store_sanitize_choices'
	));
	$wp_customize->add_control('ecommerce_watch_store_navigation_menu_font_weight',array(
        'type' => 'select',
        'label' => __('Menus Font Weight','ecommerce-watch-store'),
        'section' => 'ecommerce_watch_store_menu_section',
        'choices' => array(
        	'100' => __('100','ecommerce-watch-store'),
            '200' => __('200','ecommerce-watch-store'),
            '300' => __('300','ecommerce-watch-store'),
            '400' => __('400','ecommerce-watch-store'),
            '500' => __('500','ecommerce-watch-store'),
            '600' => __('600','ecommerce-watch-store'),
            '700' => __('700','ecommerce-watch-store'),
            '800' => __('800','ecommerce-watch-store'),
            '900' => __('900','ecommerce-watch-store'),
        ),
	) );

	// text trasform
	$wp_customize->add_setting('ecommerce_watch_store_menu_text_transform',array(
		'default'=> 'Uppercase',
		'sanitize_callback'	=> 'ecommerce_watch_store_sanitize_choices'
	));
	$wp_customize->add_control('ecommerce_watch_store_menu_text_transform',array(
		'type' => 'radio',
		'label'	=> __('Menu Text Transform','ecommerce-watch-store'),
		'choices' => array(
            'Uppercase' => __('Uppercase','ecommerce-watch-store'),
            'Capitalize' => __('Capitalize','ecommerce-watch-store'),
            'Lowercase' => __('Lowercase','ecommerce-watch-store'),
        ),
		'section'=> 'ecommerce_watch_store_menu_section',
	));

	$wp_customize->add_setting('ecommerce_watch_store_menus_item_style',array(
        'default' => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'ecommerce_watch_store_sanitize_choices'
	));
	$wp_customize->add_control('ecommerce_watch_store_menus_item_style',array(
        'type' => 'select',
        'section' => 'ecommerce_watch_store_menu_section',
		'label' => __('Menu Item Hover Style','ecommerce-watch-store'),
		'choices' => array(
            'None' => __('None','ecommerce-watch-store'),
            'Zoom In' => __('Zoom In','ecommerce-watch-store'),
        ),
	) );

	$wp_customize->add_setting('ecommerce_watch_store_header_menus_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ecommerce_watch_store_header_menus_color', array(
		'label'    => __('Menus Color', 'ecommerce-watch-store'),
		'section'  => 'ecommerce_watch_store_menu_section',
	)));

	$wp_customize->add_setting('ecommerce_watch_store_header_menus_hover_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ecommerce_watch_store_header_menus_hover_color', array(
		'label'    => __('Menus Hover Color', 'ecommerce-watch-store'),
		'section'  => 'ecommerce_watch_store_menu_section',
	)));

	$wp_customize->add_setting('ecommerce_watch_store_header_submenus_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ecommerce_watch_store_header_submenus_color', array(
		'label'    => __('Sub Menus Color', 'ecommerce-watch-store'),
		'section'  => 'ecommerce_watch_store_menu_section',
	)));

	$wp_customize->add_setting('ecommerce_watch_store_header_submenus_hover_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ecommerce_watch_store_header_submenus_hover_color', array(
		'label'    => __('Sub Menus Hover Color', 'ecommerce-watch-store'),
		'section'  => 'ecommerce_watch_store_menu_section',
	)));

	//Header 
	$wp_customize->add_section('ecommerce_watch_store_header_section' , array(
  		'title' => __( 'Header Section', 'ecommerce-watch-store' ),
		'panel' => 'ecommerce_watch_store_panel_id'
	) );

	$wp_customize->add_setting( 'ecommerce_watch_store_header_topbar',array(
		'default' => 0,
		'transport' => 'refresh',
		'sanitize_callback' => 'ecommerce_watch_store_switch_sanitization'
	));
	$wp_customize->add_control( new Ecommerce_Watch_Store_Toggle_Switch_Custom_Control( $wp_customize, 'ecommerce_watch_store_header_topbar',array(
			'label' => esc_html__( 'Show / Hide Topbar','ecommerce-watch-store' ),
			'section' => 'ecommerce_watch_store_header_section'
	)));

	$wp_customize->add_setting('ecommerce_watch_store_offer_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ecommerce_watch_store_offer_text',array(
		'label'	=> esc_html__('Add Advertisement Text','ecommerce-watch-store'),
		'input_attrs' => array(
			'placeholder' => esc_html__( 'FREE SHIPPING WORLDWIDE', 'ecommerce-watch-store' ),
		),
		'section'=> 'ecommerce_watch_store_header_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'ecommerce_watch_store_header_search',array(
    	'default' => 1,
      	'transport' => 'refresh',
      	'sanitize_callback' => 'ecommerce_watch_store_switch_sanitization'
    ));
    $wp_customize->add_control( new Ecommerce_Watch_Store_Toggle_Switch_Custom_Control( $wp_customize, 'ecommerce_watch_store_header_search',array(
      	'label' => esc_html__( 'Show / Hide Search','ecommerce-watch-store' ),
      	'section' => 'ecommerce_watch_store_header_section'
    )));

	$wp_customize->add_setting('ecommerce_watch_store_opensearch_icon',array(
		'default'	=> 'fas fa-search',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new ecommerce_watch_store_Fontawesome_Icon_Chooser(
        $wp_customize,'ecommerce_watch_store_opensearch_icon',array(
		'label'	=> __('Add Open Search Icon','ecommerce-watch-store'),
		'transport' => 'refresh',
		'section'	=> 'ecommerce_watch_store_header_section',
		'setting'	=> 'ecommerce_watch_store_opensearch_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('ecommerce_watch_store_closesearch_icon',array(
		'default'	=> 'fa fa-window-close',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new ecommerce_watch_store_Fontawesome_Icon_Chooser(
        $wp_customize,'ecommerce_watch_store_closesearch_icon',array(
		'label'	=> __('Add Close Search Icon','ecommerce-watch-store'),
		'transport' => 'refresh',
		'section'	=> 'ecommerce_watch_store_header_section',
		'setting'	=> 'ecommerce_watch_store_closesearch_icon',
		'type'		=> 'icon'
	)));
	
	$wp_customize->add_setting( 'ecommerce_watch_store_my_account_hide_show',array(
    	'default' => 1,
      	'transport' => 'refresh',
      	'sanitize_callback' => 'ecommerce_watch_store_switch_sanitization'
    ));
    $wp_customize->add_control( new Ecommerce_Watch_Store_Toggle_Switch_Custom_Control( $wp_customize, 'ecommerce_watch_store_my_account_hide_show',array(
      	'label' => esc_html__( 'Show / Hide Login','ecommerce-watch-store' ),
      	'section' => 'ecommerce_watch_store_header_section'
    )));

	$wp_customize->add_setting('ecommerce_watch_store_myaccount_icon',array(
		'default'	=> 'fas fa-user',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new ecommerce_watch_store_Fontawesome_Icon_Chooser(
        $wp_customize,'ecommerce_watch_store_myaccount_icon',array(
		'label'	=> __('Add Myaccount Icon','ecommerce-watch-store'),
		'transport' => 'refresh',
		'section'	=> 'ecommerce_watch_store_header_section',
		'setting'	=> 'ecommerce_watch_store_myaccount_icon',
		'type'		=> 'icon'
	)));
	
	$wp_customize->add_setting( 'ecommerce_watch_store_cart_hide_show',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'ecommerce_watch_store_switch_sanitization'
    ));
    $wp_customize->add_control( new Ecommerce_Watch_Store_Toggle_Switch_Custom_Control( $wp_customize, 'ecommerce_watch_store_cart_hide_show',
       array(
		'label' => esc_html__( 'Show / Hide Cart','ecommerce-watch-store' ),
		'section' => 'ecommerce_watch_store_header_section'
    )));

	$wp_customize->add_setting('ecommerce_watch_store_heart_icon',array(
		'default'	=> 'far fa-heart',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new ecommerce_watch_store_Fontawesome_Icon_Chooser(
        $wp_customize,'ecommerce_watch_store_heart_icon',array(
		'label'	=> __('Add Wishlist Icon','ecommerce-watch-store'),
		'transport' => 'refresh',
		'section'	=> 'ecommerce_watch_store_header_section',
		'setting'	=> 'ecommerce_watch_store_heart_icon',
		'type'		=> 'icon'
	)));
	
	//Banner
	$wp_customize->add_section( 'ecommerce_watch_store_slidersettings' , array(
		'title'      => __( 'Banner Settings', 'ecommerce-watch-store' ),
		'description' => __('For more options of banner section </br> <a class="go-pro-btn" target="blank" href="https://www.buywptemplates.com/products/watch-store-wordpress-theme">GET PRO</a>','ecommerce-watch-store'),
		'panel' => 'ecommerce_watch_store_panel_id'
	) );

	$wp_customize->add_setting( 'ecommerce_watch_store_slider_hide_show',array(
		'default' => 0,
		'transport' => 'refresh',
		'sanitize_callback' => 'ecommerce_watch_store_switch_sanitization'
	));
	$wp_customize->add_control( new Ecommerce_Watch_Store_Toggle_Switch_Custom_Control( $wp_customize, 'ecommerce_watch_store_slider_hide_show',array(
		'label' => esc_html__( 'Show / Hide Banner','ecommerce-watch-store' ),
		'section' => 'ecommerce_watch_store_slidersettings'
	)));

	$wp_customize->add_setting('ecommerce_watch_store_banner_image',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'ecommerce_watch_store_banner_image',array(
		'label' => __('Banner Background Image','ecommerce-watch-store'),
		'description' => __('Image size (1400px x 750px)','ecommerce-watch-store'),
		'section' => 'ecommerce_watch_store_slidersettings'
	)));

	$wp_customize->add_setting('ecommerce_watch_store_banner_tagline_title',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('ecommerce_watch_store_banner_tagline_title',array(
		'label'	=> __('Banner Title','ecommerce-watch-store'),
		'section'	=> 'ecommerce_watch_store_slidersettings',
		'input_attrs' => array(
			'placeholder' => __( 'Latest Watch Collection', 'ecommerce-watch-store' ),
		),
		'type'		=> 'text'
	));

	$wp_customize->add_setting('ecommerce_watch_store_banner_para_text',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('ecommerce_watch_store_banner_para_text',array(
		'label'	=> __('Banner Small Text','ecommerce-watch-store'),
		'section'	=> 'ecommerce_watch_store_slidersettings',
		'type'		=> 'text',
		'input_attrs' => array(
			'placeholder' => __( 'Raymond Weil’s emblematic collection, nabucco, makes a strong come back this year.', 'ecommerce-watch-store' ),
		),
	));

	$wp_customize->add_setting('ecommerce_watch_store_slider_button_text',array(
		'default'=> 'EXPLORE NOW',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ecommerce_watch_store_slider_button_text',array(
		'label'	=> __('Add Banner Button Text','ecommerce-watch-store'),
		'input_attrs' => array(
		'placeholder' => __( 'EXPLORE NOW', 'ecommerce-watch-store' ),
		),
		'section'=> 'ecommerce_watch_store_slidersettings',
		'type'=> 'text',
	));

	$wp_customize->add_setting('ecommerce_watch_store_slider_button_url',array(
		'default'=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('ecommerce_watch_store_slider_button_url',array(
		'label'	=> esc_html__('Add Button Link','ecommerce-watch-store'),
		'input_attrs' => array(
            'placeholder' => esc_html__( 'www.example.com', 'ecommerce-watch-store' ),
        ),
		'section'=> 'ecommerce_watch_store_slidersettings',
		'type'=> 'url'
	));

	//category Section
	$wp_customize->add_section('ecommerce_watch_store_category_section', array(
		'title'       => __('Category Section', 'ecommerce-watch-store'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','ecommerce-watch-store'),
		'priority'    => null,
		'panel'       => 'ecommerce_watch_store_panel_id',
	));

	$wp_customize->add_setting('ecommerce_watch_store_category_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ecommerce_watch_store_category_text',array(
		'description' => __('<p>1. More options for category section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for category section.</p>','ecommerce-watch-store'),
		'section'=> 'ecommerce_watch_store_category_section',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('ecommerce_watch_store_category_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ecommerce_watch_store_category_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='https://www.buywptemplates.com/products/watch-store-wordpress-theme'>More Info</a>",
		'section'=> 'ecommerce_watch_store_category_section',
		'type'=> 'hidden'
	));

	// Slider Product Section

	$wp_customize->add_setting( 'ecommerce_watch_store_show_hide_product',array(
    	'default' => 0,
      	'transport' => 'refresh',
      	'sanitize_callback' => 'ecommerce_watch_store_switch_sanitization'
    ));
    $wp_customize->add_control( new Ecommerce_Watch_Store_Toggle_Switch_Custom_Control( $wp_customize, 'ecommerce_watch_store_show_hide_product',array(
      	'label' => esc_html__( 'Show / Hide Product','ecommerce-watch-store' ),
      	'section' => 'ecommerce_watch_store_slidersettings'
    )));
	
	$args = array(
       'type'      => 'product',
        'taxonomy' => 'product_cat'
    );
	$categories = get_categories($args);
		$cat_posts = array();
			$i = 0;
			$cat_posts[]='Select';
		foreach($categories as $category){
			if($i==0){
			$default = $category->slug;
			$i++;
		}
		$cat_posts[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('ecommerce_watch_store_product_category',array(
		'default'	=> 'select',
		'sanitize_callback' => 'ecommerce_watch_store_sanitize_choices',
	));
	$wp_customize->add_control('ecommerce_watch_store_product_category',array(
		'type'    => 'select',
		'choices' => $cat_posts,
		'label' => __('Select Popular Product Category','ecommerce-watch-store'),
		'section' => 'ecommerce_watch_store_slidersettings',
	));

	// Product Section
	$wp_customize->add_section( 'ecommerce_watch_store_product_setting' , array(
  	'title'      => __( 'Product Section', 'ecommerce-watch-store' ),
  	'description' => __('For more options of product section </br> <a class="go-pro-btn" target="blank" href="https://www.buywptemplates.com/products/watch-store-wordpress-theme">GET PRO</a>','ecommerce-watch-store'),
		'priority'   => null,
		'panel' => 'ecommerce_watch_store_panel_id'
	) );

	$wp_customize->add_setting( 'ecommerce_watch_store_product_section_hide_show',array(
		'default' => 0,
		'transport' => 'refresh',
		'sanitize_callback' => 'ecommerce_watch_store_switch_sanitization'
	));
	$wp_customize->add_control( new Ecommerce_Watch_Store_Toggle_Switch_Custom_Control( $wp_customize, 'ecommerce_watch_store_product_section_hide_show',array(
		'label' => esc_html__( 'Show / Hide Product Section','ecommerce-watch-store' ),
		'section' => 'ecommerce_watch_store_product_setting'
	)));

	$wp_customize->add_setting('ecommerce_watch_store_product_heading_product',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('ecommerce_watch_store_product_heading_product',array(
		'label'	=> __('Product Section Heading','ecommerce-watch-store'),
		'section'	=> 'ecommerce_watch_store_product_setting',
		'input_attrs' => array(
			'placeholder' => __( 'Universal Timekeepers of the world', 'ecommerce-watch-store' ),
		),
		'type'		=> 'text'
	));

	$wp_customize->add_setting('ecommerce_watch_store_featured_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ecommerce_watch_store_featured_text',array(
		'label'	=> esc_html__('Add Featured Text','ecommerce-watch-store'),
		'input_attrs' => array(
			'placeholder' => esc_html__( 'FEATURED', 'ecommerce-watch-store' ),
		),
		'section'=> 'ecommerce_watch_store_product_setting',
		'type'=> 'text'
	));

	$wp_customize->add_setting('ecommerce_watch_store_best_selling_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ecommerce_watch_store_best_selling_text',array(
		'label'	=> esc_html__('Add Best Selling Text','ecommerce-watch-store'),
		'input_attrs' => array(
			'placeholder' => esc_html__( 'BEST SELLING', 'ecommerce-watch-store' ),
		),
		'section'=> 'ecommerce_watch_store_product_setting',
		'type'=> 'text'
	));

	$wp_customize->add_setting('ecommerce_watch_store_new_arrival_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ecommerce_watch_store_new_arrival_text',array(
		'label'	=> esc_html__('Add New Arrivals Text','ecommerce-watch-store'),
		'input_attrs' => array(
			'placeholder' => esc_html__( 'NEW ARRIVALS', 'ecommerce-watch-store' ),
		),
		'section'=> 'ecommerce_watch_store_product_setting',
		'type'=> 'text'
	));

	$wp_customize->add_setting('ecommerce_watch_store_on_sale_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ecommerce_watch_store_on_sale_text',array(
		'label'	=> esc_html__('Add On Sale Text','ecommerce-watch-store'),
		'input_attrs' => array(
			'placeholder' => esc_html__( 'ON SALE', 'ecommerce-watch-store' ),
		),
		'section'=> 'ecommerce_watch_store_product_setting',
		'type'=> 'text'
	));

	//designer collection Section
	$wp_customize->add_section('ecommerce_watch_store_designer_collection_section', array(
		'title'       => __('Designer Collection Section', 'ecommerce-watch-store'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','ecommerce-watch-store'),
		'priority'    => null,
		'panel'       => 'ecommerce_watch_store_panel_id',
	));

	$wp_customize->add_setting('ecommerce_watch_store_designer_collection_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ecommerce_watch_store_designer_collection_text',array(
		'description' => __('<p>1. More options for designer collection section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for designer collection section.</p>','ecommerce-watch-store'),
		'section'=> 'ecommerce_watch_store_designer_collection_section',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('ecommerce_watch_store_designer_collection_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ecommerce_watch_store_designer_collection_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='https://www.buywptemplates.com/products/watch-store-wordpress-theme'>More Info</a>",
		'section'=> 'ecommerce_watch_store_designer_collection_section',
		'type'=> 'hidden'
	));

	//our team Section
	$wp_customize->add_section('ecommerce_watch_store_our_team_section', array(
		'title'       => __('Our Team Section', 'ecommerce-watch-store'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','ecommerce-watch-store'),
		'priority'    => null,
		'panel'       => 'ecommerce_watch_store_panel_id',
	));

	$wp_customize->add_setting('ecommerce_watch_store_our_team_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ecommerce_watch_store_our_team_text',array(
		'description' => __('<p>1. More options for our_team section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for our_team section.</p>','ecommerce-watch-store'),
		'section'=> 'ecommerce_watch_store_our_team_section',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('ecommerce_watch_store_our_team_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ecommerce_watch_store_our_team_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='https://www.buywptemplates.com/products/watch-store-wordpress-theme'>More Info</a>",
		'section'=> 'ecommerce_watch_store_our_team_section',
		'type'=> 'hidden'
	));

	//team services Section
	$wp_customize->add_section('ecommerce_watch_store_team_services_section', array(
		'title'       => __('Team Services Section', 'ecommerce-watch-store'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','ecommerce-watch-store'),
		'priority'    => null,
		'panel'       => 'ecommerce_watch_store_panel_id',
	));

	$wp_customize->add_setting('ecommerce_watch_store_team_services_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ecommerce_watch_store_team_services_text',array(
		'description' => __('<p>1. More options for team services section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for team services section.</p>','ecommerce-watch-store'),
		'section'=> 'ecommerce_watch_store_team_services_section',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('ecommerce_watch_store_team_services_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ecommerce_watch_store_team_services_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='https://www.buywptemplates.com/products/watch-store-wordpress-theme'>More Info</a>",
		'section'=> 'ecommerce_watch_store_team_services_section',
		'type'=> 'hidden'
	));

	//Most View Product Section
	$wp_customize->add_section('ecommerce_watch_store_most_view_product_section', array(
		'title'       => __('Most View Product Section', 'ecommerce-watch-store'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','ecommerce-watch-store'),
		'priority'    => null,
		'panel'       => 'ecommerce_watch_store_panel_id',
	));

	$wp_customize->add_setting('ecommerce_watch_store_most_view_product_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ecommerce_watch_store_most_view_product_text',array(
		'description' => __('<p>1. More options for most view product section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for most view product section.</p>','ecommerce-watch-store'),
		'section'=> 'ecommerce_watch_store_most_view_product_section',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('ecommerce_watch_store_most_view_product_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ecommerce_watch_store_most_view_product_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='https://www.buywptemplates.com/products/watch-store-wordpress-theme'>More Info</a>",
		'section'=> 'ecommerce_watch_store_most_view_product_section',
		'type'=> 'hidden'
	));

	//latest news Section
	$wp_customize->add_section('ecommerce_watch_store_latest_news_section', array(
		'title'       => __('Latest News Section', 'ecommerce-watch-store'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','ecommerce-watch-store'),
		'priority'    => null,
		'panel'       => 'ecommerce_watch_store_panel_id',
	));

	$wp_customize->add_setting('ecommerce_watch_store_latest_news_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ecommerce_watch_store_latest_news_text',array(
		'description' => __('<p>1. More options for latest news section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for latest news section.</p>','ecommerce-watch-store'),
		'section'=> 'ecommerce_watch_store_latest_news_section',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('ecommerce_watch_store_latest_news_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ecommerce_watch_store_latest_news_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='https://www.buywptemplates.com/products/watch-store-wordpress-theme'>More Info</a>",
		'section'=> 'ecommerce_watch_store_latest_news_section',
		'type'=> 'hidden'
	));

	//new_edition_video Section
	$wp_customize->add_section('ecommerce_watch_store_new_edition_video_section', array(
		'title'       => __('New Edition Video Section', 'ecommerce-watch-store'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','ecommerce-watch-store'),
		'priority'    => null,
		'panel'       => 'ecommerce_watch_store_panel_id',
	));

	$wp_customize->add_setting('ecommerce_watch_store_new_edition_video_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ecommerce_watch_store_new_edition_video_text',array(
		'description' => __('<p>1. More options for new edition video section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for new edition video section.</p>','ecommerce-watch-store'),
		'section'=> 'ecommerce_watch_store_new_edition_video_section',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('ecommerce_watch_store_new_edition_video_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ecommerce_watch_store_new_edition_video_btn',array(
		'description' => "<a class='go-pro' target='_blank' href='https://www.buywptemplates.com/products/watch-store-wordpress-theme'>More Info</a>",
		'section'=> 'ecommerce_watch_store_new_edition_video_section',
		'type'=> 'hidden'
	));

	//Footer Text
	$wp_customize->add_section('ecommerce_watch_store_footer',array(
		'title'	=> esc_html__('Footer Settings','ecommerce-watch-store'),
		'description' => __('For more options of footer section </br> <a class="go-pro-btn" target="blank" href="https://www.buywptemplates.com/products/watch-store-wordpress-theme">GET PRO</a>','ecommerce-watch-store'),
		'panel' => 'ecommerce_watch_store_panel_id',
	));

	// font size
	$wp_customize->add_setting('ecommerce_watch_store_button_footer_font_size',array(
		'default'=> 30,
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ecommerce_watch_store_button_footer_font_size',array(
		'label'	=> __('Footer Heading Font Size','ecommerce-watch-store'),
  		'type'        => 'number',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
		'section'=> 'ecommerce_watch_store_footer',
	));

	$wp_customize->add_setting('ecommerce_watch_store_button_footer_heading_letter_spacing',array(
		'default'=> 1,
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ecommerce_watch_store_button_footer_heading_letter_spacing',array(
		'label'	=> __('Heading Letter Spacing','ecommerce-watch-store'),
  		'type'        => 'number',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
	),
		'section'=> 'ecommerce_watch_store_footer',
	));

	// text trasform
	$wp_customize->add_setting('ecommerce_watch_store_button_footer_text_transform',array(
		'default'=> 'Capitalize',
		'sanitize_callback'	=> 'ecommerce_watch_store_sanitize_choices'
	));
	$wp_customize->add_control('ecommerce_watch_store_button_footer_text_transform',array(
		'type' => 'radio',
		'label'	=> __('Heading Text Transform','ecommerce-watch-store'),
		'choices' => array(
      'Uppercase' => __('Uppercase','ecommerce-watch-store'),
      'Capitalize' => __('Capitalize','ecommerce-watch-store'),
      'Lowercase' => __('Lowercase','ecommerce-watch-store'),
    ),
		'section'=> 'ecommerce_watch_store_footer',
	));

	$wp_customize->add_setting('ecommerce_watch_store_footer_heading_weight',array(
        'default' => 600,
        'transport' => 'refresh',
        'sanitize_callback' => 'ecommerce_watch_store_sanitize_choices'
	));
	$wp_customize->add_control('ecommerce_watch_store_footer_heading_weight',array(
        'type' => 'select',
        'label' => __('Heading Font Weight','ecommerce-watch-store'),
        'section' => 'ecommerce_watch_store_footer',
        'choices' => array(
        	'100' => __('100','ecommerce-watch-store'),
            '200' => __('200','ecommerce-watch-store'),
            '300' => __('300','ecommerce-watch-store'),
            '400' => __('400','ecommerce-watch-store'),
            '500' => __('500','ecommerce-watch-store'),
            '600' => __('600','ecommerce-watch-store'),
            '700' => __('700','ecommerce-watch-store'),
            '800' => __('800','ecommerce-watch-store'),
            '900' => __('900','ecommerce-watch-store'),
        ),
	) );

  $wp_customize->add_setting( 'ecommerce_watch_store_footer_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'ecommerce_watch_store_switch_sanitization'
  ));
  $wp_customize->add_control( new Ecommerce_Watch_Store_Toggle_Switch_Custom_Control( $wp_customize, 'ecommerce_watch_store_footer_hide_show',array(
    'label' => esc_html__( 'Show / Hide Footer','ecommerce-watch-store' ),
    'section' => 'ecommerce_watch_store_footer'
  )));

  $wp_customize->add_setting('ecommerce_watch_store_footer_template',array(
      'default'	=> esc_html('ecommerce_watch_store-footer-one'),
      'sanitize_callback'	=> 'ecommerce_watch_store_sanitize_choices'
  ));
  $wp_customize->add_control('ecommerce_watch_store_footer_template',array(
          'label'	=> esc_html__('Footer style','ecommerce-watch-store'),
          'section'	=> 'ecommerce_watch_store_footer',
          'setting'	=> 'ecommerce_watch_store_footer_template',
          'type' => 'select',
          'choices' => array(
              'ecommerce_watch_store-footer-one' => esc_html__('Style 1', 'ecommerce-watch-store'),
              'ecommerce_watch_store-footer-two' => esc_html__('Style 2', 'ecommerce-watch-store'),
              'ecommerce_watch_store-footer-three' => esc_html__('Style 3', 'ecommerce-watch-store'),
              'ecommerce_watch_store-footer-four' => esc_html__('Style 4', 'ecommerce-watch-store'),
              'ecommerce_watch_store-footer-five' => esc_html__('Style 5', 'ecommerce-watch-store'),
              )
  ));


	$wp_customize->add_setting('ecommerce_watch_store_footer_background_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ecommerce_watch_store_footer_background_color', array(
		'label'    => __('Footer Background Color', 'ecommerce-watch-store'),
		'section'  => 'ecommerce_watch_store_footer',
	)));

	$wp_customize->add_setting('ecommerce_watch_store_footer_background_image',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'ecommerce_watch_store_footer_background_image',array(
      'label' => __('Footer Background Image','ecommerce-watch-store'),
      'section' => 'ecommerce_watch_store_footer'
	)));

	$wp_customize->add_setting('ecommerce_watch_store_footer_img_position',array(
	  'default' => 'center center',
	  'transport' => 'refresh',
	  'sanitize_callback' => 'ecommerce_watch_store_sanitize_choices'
	));
	$wp_customize->add_control('ecommerce_watch_store_footer_img_position',array(
		'type' => 'select',
		'label' => __('Footer Image Position','ecommerce-watch-store'),
		'section' => 'ecommerce_watch_store_footer',
		'choices' 	=> array(
			'left top' 		=> esc_html__( 'Top Left', 'ecommerce-watch-store' ),
			'center top'   => esc_html__( 'Top', 'ecommerce-watch-store' ),
			'right top'   => esc_html__( 'Top Right', 'ecommerce-watch-store' ),
			'left center'   => esc_html__( 'Left', 'ecommerce-watch-store' ),
			'center center'   => esc_html__( 'Center', 'ecommerce-watch-store' ),
			'right center'   => esc_html__( 'Right', 'ecommerce-watch-store' ),
			'left bottom'   => esc_html__( 'Bottom Left', 'ecommerce-watch-store' ),
			'center bottom'   => esc_html__( 'Bottom', 'ecommerce-watch-store' ),
			'right bottom'   => esc_html__( 'Bottom Right', 'ecommerce-watch-store' ),
		),
	));

  // Footer
  $wp_customize->add_setting('ecommerce_watch_store_img_footer',array(
    'default'=> 'scroll',
    'sanitize_callback' => 'ecommerce_watch_store_sanitize_choices'
  ));
  $wp_customize->add_control('ecommerce_watch_store_img_footer',array(
    'type' => 'select',
    'label' => __('Footer Background Attatchment','ecommerce-watch-store'),
    'choices' => array(
      'fixed' => __('fixed','ecommerce-watch-store'),
      'scroll' => __('scroll','ecommerce-watch-store'),
    ),
    'section'=> 'ecommerce_watch_store_footer',
  ));

  // footer padding
  $wp_customize->add_setting('ecommerce_watch_store_footer_padding',array(
    'default'=> '',
    'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control('ecommerce_watch_store_footer_padding',array(
    'label' => __('Footer Top Bottom Padding','ecommerce-watch-store'),
    'description' => __('Enter a value in pixels. Example:20px','ecommerce-watch-store'),
    'input_attrs' => array(
      'placeholder' => __( '10px', 'ecommerce-watch-store' ),
    ),
    'section'=> 'ecommerce_watch_store_footer',
    'type'=> 'text'
  ));

  $wp_customize->add_setting('ecommerce_watch_store_footer_widgets_heading',array(
    'default' => 'Left',
    'transport' => 'refresh',
    'sanitize_callback' => 'ecommerce_watch_store_sanitize_choices'
  ));
  $wp_customize->add_control('ecommerce_watch_store_footer_widgets_heading',array(
    'type' => 'select',
    'label' => __('Footer Widget Heading','ecommerce-watch-store'),
    'section' => 'ecommerce_watch_store_footer',
    'choices' => array(
      'Left' => __('Left','ecommerce-watch-store'),
      'Center' => __('Center','ecommerce-watch-store'),
      'Right' => __('Right','ecommerce-watch-store')
    ),
  ) );

  $wp_customize->add_setting('ecommerce_watch_store_footer_widgets_content',array(
    'default' => 'Left',
    'transport' => 'refresh',
    'sanitize_callback' => 'ecommerce_watch_store_sanitize_choices'
  ));
  $wp_customize->add_control('ecommerce_watch_store_footer_widgets_content',array(
    'type' => 'select',
    'label' => __('Footer Widget Content','ecommerce-watch-store'),
    'section' => 'ecommerce_watch_store_footer',
    'choices' => array(
      'Left' => __('Left','ecommerce-watch-store'),
      'Center' => __('Center','ecommerce-watch-store'),
      'Right' => __('Right','ecommerce-watch-store')
    ),
  	) );

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('ecommerce_watch_store_footer_text', array(
		'selector' => '.copyright p',
		'render_callback' => 'ecommerce_watch_store_Customize_partial_ecommerce_watch_store_footer_text',
	));
	
	$wp_customize->add_setting('ecommerce_watch_store_footer_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ecommerce_watch_store_footer_text',array(
		'label'	=> esc_html__('Copyright Text','ecommerce-watch-store'),
		'input_attrs' => array(
            'placeholder' => esc_html__( 'Copyright 2021, .....', 'ecommerce-watch-store' ),
        ),
		'section'=> 'ecommerce_watch_store_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'ecommerce_watch_store_copyright_hide_show',array(
	  'default' => 1,
	  'transport' => 'refresh',
	  'sanitize_callback' => 'ecommerce_watch_store_switch_sanitization'
	));
	$wp_customize->add_control( new Ecommerce_Watch_Store_Toggle_Switch_Custom_Control( $wp_customize, 'ecommerce_watch_store_copyright_hide_show',array(
		'label' => esc_html__( 'Show / Hide Copyright','ecommerce-watch-store' ),
		'section' => 'ecommerce_watch_store_footer'
	)));

	$wp_customize->add_setting('ecommerce_watch_store_copyright_alingment',array(
        'default' => 'center',
        'sanitize_callback' => 'ecommerce_watch_store_sanitize_choices'
	));
	$wp_customize->add_control(new Ecommerce_Watch_Store_Image_Radio_Control($wp_customize, 'ecommerce_watch_store_copyright_alingment', array(
        'type' => 'select',
        'label' => esc_html__('Copyright Alignment','ecommerce-watch-store'),
        'section' => 'ecommerce_watch_store_footer',
        'settings' => 'ecommerce_watch_store_copyright_alingment',
        'choices' => array(
            'left' => esc_url(get_template_directory_uri()).'/assets/images/copyright1.png',
            'center' => esc_url(get_template_directory_uri()).'/assets/images/copyright2.png',
            'right' => esc_url(get_template_directory_uri()).'/assets/images/copyright3.png'
    ))));

	$wp_customize->add_setting('ecommerce_watch_store_copyright_background_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ecommerce_watch_store_copyright_background_color', array(
		'label'    => __('Copyright Background Color', 'ecommerce-watch-store'),
		'section'  => 'ecommerce_watch_store_footer',
	)));

	$wp_customize->add_setting('ecommerce_watch_store_copyright_font_size',array(
		'default'=> '',
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('ecommerce_watch_store_copyright_font_size',array(
		'label' => __('Copyright Font Size','ecommerce-watch-store'),
		'description' => __('Enter a value in pixels. Example:20px','ecommerce-watch-store'),
		'input_attrs' => array(
		        'placeholder' => __( '10px', 'ecommerce-watch-store' ),
		    ),
		'section'=> 'ecommerce_watch_store_footer',
		'type'=> 'text'
	));

    $wp_customize->add_setting( 'ecommerce_watch_store_hide_show_scroll',array(
    	'default' => 1,
      	'transport' => 'refresh',
      	'sanitize_callback' => 'ecommerce_watch_store_switch_sanitization'
    ));
    $wp_customize->add_control( new Ecommerce_Watch_Store_Toggle_Switch_Custom_Control( $wp_customize, 'ecommerce_watch_store_hide_show_scroll',array(
      	'label' => esc_html__( 'Show / Hide Scroll to Top','ecommerce-watch-store' ),
      	'section' => 'ecommerce_watch_store_footer'
    )));

    //Selective Refresh
	$wp_customize->selective_refresh->add_partial('ecommerce_watch_store_scroll_to_top_icon', array(
		'selector' => '.scrollup i',
		'render_callback' => 'ecommerce_watch_store_Customize_partial_ecommerce_watch_store_scroll_to_top_icon',
	));

    $wp_customize->add_setting('ecommerce_watch_store_scroll_top_alignment',array(
        'default' => 'Right',
        'sanitize_callback' => 'ecommerce_watch_store_sanitize_choices'
	));
	$wp_customize->add_control(new Ecommerce_Watch_Store_Image_Radio_Control($wp_customize, 'ecommerce_watch_store_scroll_top_alignment', array(
        'type' => 'select',
        'label' => esc_html__('Scroll To Top','ecommerce-watch-store'),
        'section' => 'ecommerce_watch_store_footer',
        'settings' => 'ecommerce_watch_store_scroll_top_alignment',
        'choices' => array(
            'Left' => esc_url(get_template_directory_uri()).'/assets/images/layout1.png',
            'Center' => esc_url(get_template_directory_uri()).'/assets/images/layout2.png',
            'Right' => esc_url(get_template_directory_uri()).'/assets/images/layout3.png'
    ))));

     $wp_customize->add_setting('ecommerce_watch_store_scroll_top_icon',array(
    'default' => 'fas fa-long-arrow-alt-up',
    'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control(new Ecommerce_Watch_Store_Fontawesome_Icon_Chooser($wp_customize,'ecommerce_watch_store_scroll_top_icon',array(
    'label' => __('Add Scroll to Top Icon','ecommerce-watch-store'),
    'transport' => 'refresh',
    'section' => 'ecommerce_watch_store_footer',
    'setting' => 'ecommerce_watch_store_scroll_top_icon',
    'type'    => 'icon'
  )));

  $wp_customize->add_setting('ecommerce_watch_store_scroll_to_top_font_size',array(
    'default'=> '',
    'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control('ecommerce_watch_store_scroll_to_top_font_size',array(
    'label' => __('Icon Font Size','ecommerce-watch-store'),
    'description' => __('Enter a value in pixels. Example:20px','ecommerce-watch-store'),
    'input_attrs' => array(
      'placeholder' => __( '10px', 'ecommerce-watch-store' ),
    ),
    'section'=> 'ecommerce_watch_store_footer',
    'type'=> 'text'
  ));

  $wp_customize->add_setting('ecommerce_watch_store_scroll_to_top_padding',array(
    'default'=> '',
    'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control('ecommerce_watch_store_scroll_to_top_padding',array(
    'label' => __('Icon Top Bottom Padding','ecommerce-watch-store'),
    'description' => __('Enter a value in pixels. Example:20px','ecommerce-watch-store'),
    'input_attrs' => array(
      'placeholder' => __( '10px', 'ecommerce-watch-store' ),
    ),
    'section'=> 'ecommerce_watch_store_footer',
    'type'=> 'text'
  ));

  $wp_customize->add_setting('ecommerce_watch_store_scroll_to_top_width',array(
    'default'=> '',
    'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control('ecommerce_watch_store_scroll_to_top_width',array(
    'label' => __('Icon Width','ecommerce-watch-store'),
    'description' => __('Enter a value in pixels Example:20px','ecommerce-watch-store'),
    'input_attrs' => array(
      'placeholder' => __( '10px', 'ecommerce-watch-store' ),
  ),
  'section'=> 'ecommerce_watch_store_footer',
  'type'=> 'text'
  ));

  $wp_customize->add_setting('ecommerce_watch_store_scroll_to_top_height',array(
    'default'=> '',
    'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control('ecommerce_watch_store_scroll_to_top_height',array(
    'label' => __('Icon Height','ecommerce-watch-store'),
    'description' => __('Enter a value in pixels. Example:20px','ecommerce-watch-store'),
    'input_attrs' => array(
      'placeholder' => __( '10px', 'ecommerce-watch-store' ),
    ),
    'section'=> 'ecommerce_watch_store_footer',
    'type'=> 'text'
  ));

  $wp_customize->add_setting( 'ecommerce_watch_store_scroll_to_top_border_radius', array(
    'default'              => '',
    'transport'        => 'refresh',
    'sanitize_callback'    => 'ecommerce_watch_store_sanitize_number_range'
  ) );
  $wp_customize->add_control( 'ecommerce_watch_store_scroll_to_top_border_radius', array(
    'label'       => esc_html__( 'Icon Border Radius','ecommerce-watch-store' ),
    'section'     => 'ecommerce_watch_store_footer',
    'type'        => 'range',
    'input_attrs' => array(
      'step'             => 1,
      'min'              => 1,
      'max'              => 50,
    ),
  ) );

  	$wp_customize->add_setting('ecommerce_watch_store_align_footer_social_icon',array(
        'default' => 'center',
        'sanitize_callback' => 'ecommerce_watch_store_sanitize_choices'
	));
	$wp_customize->add_control('ecommerce_watch_store_align_footer_social_icon',array(
        'type' => 'select',
        'label' => __('Social Icon Alignment ','ecommerce-watch-store'),
        'section' => 'ecommerce_watch_store_footer',
        'choices' => array(
            'left' => __('Left','ecommerce-watch-store'),
            'right' => __('Right','ecommerce-watch-store'),
            'center' => __('Center','ecommerce-watch-store'),
        ),
	) );

   //Blog Post
	$wp_customize->add_panel( 'ecommerce_watch_store_blog_post_parent_panel', array(
		'title' => esc_html__( 'Blog Post Settings', 'ecommerce-watch-store' ),
		'panel' => 'ecommerce_watch_store_panel_id',
		'priority' => 20,
	));

	// Add example section and controls to the middle (second) panel
	$wp_customize->add_section( 'ecommerce_watch_store_post_settings', array(
		'title' => esc_html__( 'Post Settings', 'ecommerce-watch-store' ),
		'panel' => 'ecommerce_watch_store_blog_post_parent_panel',
	));

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('ecommerce_watch_store_toggle_postdate', array(
		'selector' => '.post-main-box h2 a',
		'render_callback' => 'ecommerce_watch_store_Customize_partial_ecommerce_watch_store_toggle_postdate',
	));

	//Blog layout
  $wp_customize->add_setting('ecommerce_watch_store_blog_layout_option',array(
    'default' => 'Default',
    'sanitize_callback' => 'ecommerce_watch_store_sanitize_choices'
  ));
  $wp_customize->add_control(new Ecommerce_Watch_Store_Image_Radio_Control($wp_customize, 'ecommerce_watch_store_blog_layout_option', array(
    'type' => 'select',
    'label' => __('Blog Post Layouts','ecommerce-watch-store'),
    'section' => 'ecommerce_watch_store_post_settings',
    'choices' => array(
        'Default' => esc_url(get_template_directory_uri()).'/assets/images/blog-layout1.png',
        'Center' => esc_url(get_template_directory_uri()).'/assets/images/blog-layout2.png',
        'Left' => esc_url(get_template_directory_uri()).'/assets/images/blog-layout3.png',
  ))));

	$wp_customize->add_setting('ecommerce_watch_store_theme_options',array(
        'default' => 'Right Sidebar',
        'sanitize_callback' => 'ecommerce_watch_store_sanitize_choices'
	));
	$wp_customize->add_control('ecommerce_watch_store_theme_options',array(
        'type' => 'select',
        'label' => esc_html__('Post Sidebar Layout','ecommerce-watch-store'),
        'description' => esc_html__('Here you can change the sidebar layout for posts. ','ecommerce-watch-store'),
        'section' => 'ecommerce_watch_store_post_settings',
        'choices' => array(
            'Left Sidebar' => esc_html__('Left Sidebar','ecommerce-watch-store'),
            'Right Sidebar' => esc_html__('Right Sidebar','ecommerce-watch-store'),
            'One Column' => esc_html__('One Column','ecommerce-watch-store'),
      		'Three Columns' => __('Three Columns','ecommerce-watch-store'),
        		'Four Columns' => __('Four Columns','ecommerce-watch-store'),
            'Grid Layout' => esc_html__('Grid Layout','ecommerce-watch-store')
        ),
	) );

  	$wp_customize->add_setting('ecommerce_watch_store_toggle_postdate_icon',array(
		'default'	=> 'fas fa-calendar-alt',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Ecommerce_Watch_Store_Fontawesome_Icon_Chooser(
        $wp_customize,'ecommerce_watch_store_toggle_postdate_icon',array(
		'label'	=> __('Add Post Date Icon','ecommerce-watch-store'),
		'transport' => 'refresh',
		'section'	=> 'ecommerce_watch_store_post_settings',
		'setting'	=> 'ecommerce_watch_store_toggle_postdate_icon',
		'type'		=> 'icon'
	)));

 	$wp_customize->add_setting( 'ecommerce_watch_store_blog_toggle_postdate',array(
    'default' => 1,
    'transport' => 'refresh',
    'sanitize_callback' => 'ecommerce_watch_store_switch_sanitization'
  ));
  $wp_customize->add_control( new Ecommerce_Watch_Store_Toggle_Switch_Custom_Control( $wp_customize, 'ecommerce_watch_store_blog_toggle_postdate',array(
    'label' => esc_html__( 'Show / Hide Post Date','ecommerce-watch-store' ),
    'section' => 'ecommerce_watch_store_post_settings'
  )));

	$wp_customize->add_setting('ecommerce_watch_store_toggle_author_icon',array(
		'default'	=> 'fas fa-user',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Ecommerce_Watch_Store_Fontawesome_Icon_Chooser(
        $wp_customize,'ecommerce_watch_store_toggle_author_icon',array(
		'label'	=> __('Add Author Icon','ecommerce-watch-store'),
		'transport' => 'refresh',
		'section'	=> 'ecommerce_watch_store_post_settings',
		'setting'	=> 'ecommerce_watch_store_toggle_author_icon',
		'type'		=> 'icon'
	)));

  $wp_customize->add_setting( 'ecommerce_watch_store_blog_toggle_author',array(
	'default' => 1,
	'transport' => 'refresh',
	'sanitize_callback' => 'ecommerce_watch_store_switch_sanitization'
  ));
  $wp_customize->add_control( new Ecommerce_Watch_Store_Toggle_Switch_Custom_Control( $wp_customize, 'ecommerce_watch_store_blog_toggle_author',array(
	'label' => esc_html__( 'Show / Hide Author','ecommerce-watch-store' ),
	'section' => 'ecommerce_watch_store_post_settings'
  )));

  $wp_customize->add_setting('ecommerce_watch_store_toggle_comments_icon',array(
		'default'	=> 'fa fa-comments',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Ecommerce_Watch_Store_Fontawesome_Icon_Chooser(
        $wp_customize,'ecommerce_watch_store_toggle_comments_icon',array(
		'label'	=> __('Add Comments Icon','ecommerce-watch-store'),
		'transport' => 'refresh',
		'section'	=> 'ecommerce_watch_store_post_settings',
		'setting'	=> 'ecommerce_watch_store_toggle_comments_icon',
		'type'		=> 'icon'
	)));

  $wp_customize->add_setting( 'ecommerce_watch_store_blog_toggle_comments',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'ecommerce_watch_store_switch_sanitization'
  ) );
  $wp_customize->add_control( new Ecommerce_Watch_Store_Toggle_Switch_Custom_Control( $wp_customize, 'ecommerce_watch_store_blog_toggle_comments',array(
		'label' => esc_html__( 'Show / Hide Comments','ecommerce-watch-store' ),
		'section' => 'ecommerce_watch_store_post_settings'
  )));

  $wp_customize->add_setting('ecommerce_watch_store_toggle_time_icon',array(
		'default'	=> 'fas fa-clock',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Ecommerce_Watch_Store_Fontawesome_Icon_Chooser(
        $wp_customize,'ecommerce_watch_store_toggle_time_icon',array(
		'label'	=> __('Add Time Icon','ecommerce-watch-store'),
		'transport' => 'refresh',
		'section'	=> 'ecommerce_watch_store_post_settings',
		'setting'	=> 'ecommerce_watch_store_toggle_time_icon',
		'type'		=> 'icon'
	)));

  $wp_customize->add_setting( 'ecommerce_watch_store_blog_toggle_time',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'ecommerce_watch_store_switch_sanitization'
  ) );
  $wp_customize->add_control( new Ecommerce_Watch_Store_Toggle_Switch_Custom_Control( $wp_customize, 'ecommerce_watch_store_blog_toggle_time',array(
		'label' => esc_html__( 'Show / Hide Time','ecommerce-watch-store' ),
		'section' => 'ecommerce_watch_store_post_settings'
  )));

  $wp_customize->add_setting( 'ecommerce_watch_store_featured_image_hide_show',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'ecommerce_watch_store_switch_sanitization'
	));
  $wp_customize->add_control( new Ecommerce_Watch_Store_Toggle_Switch_Custom_Control( $wp_customize, 'ecommerce_watch_store_featured_image_hide_show', array(
		'label' => esc_html__( 'Show / Hide Featured Image','ecommerce-watch-store' ),
		'section' => 'ecommerce_watch_store_post_settings'
  )));

  $wp_customize->add_setting( 'ecommerce_watch_store_featured_image_border_radius', array(
		'default'              => '0',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'ecommerce_watch_store_sanitize_number_range'
	) );
	$wp_customize->add_control( 'ecommerce_watch_store_featured_image_border_radius', array(
		'label'       => esc_html__( 'Featured Image Border Radius','ecommerce-watch-store' ),
		'section'     => 'ecommerce_watch_store_post_settings',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting( 'ecommerce_watch_store_featured_image_box_shadow', array(
		'default'              => '0',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'ecommerce_watch_store_sanitize_number_range'
	) );
	$wp_customize->add_control( 'ecommerce_watch_store_featured_image_box_shadow', array(
		'label'       => esc_html__( 'Featured Image Box Shadow','ecommerce-watch-store' ),
		'section'     => 'ecommerce_watch_store_post_settings',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	//Featured Image
	$wp_customize->add_setting('ecommerce_watch_store_blog_post_featured_image_dimension',array(
       'default' => 'default',
       'sanitize_callback'	=> 'ecommerce_watch_store_sanitize_choices'
	));
	$wp_customize->add_control('ecommerce_watch_store_blog_post_featured_image_dimension',array(
		'type' => 'select',
		'label'	=> __('Blog Post Featured Image Dimension','ecommerce-watch-store'),
		'section'	=> 'ecommerce_watch_store_post_settings',
		'choices' => array(
		'default' => __('Default','ecommerce-watch-store'),
		'custom' => __('Custom Image Size','ecommerce-watch-store'),
      ),
	));

	$wp_customize->add_setting('ecommerce_watch_store_blog_post_featured_image_custom_width',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
		));
	$wp_customize->add_control('ecommerce_watch_store_blog_post_featured_image_custom_width',array(
		'label'	=> __('Featured Image Custom Width','ecommerce-watch-store'),
		'description'	=> __('Enter a value in pixels. Example:20px','ecommerce-watch-store'),
		'input_attrs' => array(
    	'placeholder' => __( '10px', 'ecommerce-watch-store' ),),
		'section'=> 'ecommerce_watch_store_post_settings',
		'type'=> 'text',
		'active_callback' => 'ecommerce_watch_store_blog_post_featured_image_dimension'
		));

	$wp_customize->add_setting('ecommerce_watch_store_blog_post_featured_image_custom_height',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ecommerce_watch_store_blog_post_featured_image_custom_height',array(
		'label'	=> __('Featured Image Custom Height','ecommerce-watch-store'),
		'description'	=> __('Enter a value in pixels. Example:20px','ecommerce-watch-store'),
		'input_attrs' => array(
    	'placeholder' => __( '10px', 'ecommerce-watch-store' ),),
		'section'=> 'ecommerce_watch_store_post_settings',
		'type'=> 'text',
		'active_callback' => 'ecommerce_watch_store_blog_post_featured_image_dimension'
	));

  $wp_customize->add_setting( 'ecommerce_watch_store_excerpt_number', array(
		'default'              => 30,
		'type'                 => 'theme_mod',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'ecommerce_watch_store_sanitize_number_range',
		'sanitize_js_callback' => 'absint',
	) );
	$wp_customize->add_control( 'ecommerce_watch_store_excerpt_number', array(
		'label'       => esc_html__( 'Excerpt length','ecommerce-watch-store' ),
		'section'     => 'ecommerce_watch_store_post_settings',
		'type'        => 'range',
		'settings'    => 'ecommerce_watch_store_excerpt_number',
		'input_attrs' => array(
			'step'             => 5,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting('ecommerce_watch_store_meta_field_separator',array(
		'default'=> '|',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ecommerce_watch_store_meta_field_separator',array(
		'label'	=> __('Add Meta Separator','ecommerce-watch-store'),
		'description' => __('Add the seperator for meta box. Example: "|", "/", etc.','ecommerce-watch-store'),
		'section'=> 'ecommerce_watch_store_post_settings',
		'type'=> 'text'
	));

  $wp_customize->add_setting('ecommerce_watch_store_excerpt_settings',array(
    'default' => 'Excerpt',
    'transport' => 'refresh',
    'sanitize_callback' => 'ecommerce_watch_store_sanitize_choices'
	));
	$wp_customize->add_control('ecommerce_watch_store_excerpt_settings',array(
    'type' => 'select',
    'label' => esc_html__('Post Content','ecommerce-watch-store'),
    'section' => 'ecommerce_watch_store_post_settings',
    'choices' => array(
    	'Content' => esc_html__('Content','ecommerce-watch-store'),
        'Excerpt' => esc_html__('Excerpt','ecommerce-watch-store'),
        'No Content' => esc_html__('No Content','ecommerce-watch-store')
        ),
	) );

  $wp_customize->add_setting('ecommerce_watch_store_blog_page_posts_settings',array(
    'default' => 'Into Blocks',
    'transport' => 'refresh',
    'sanitize_callback' => 'ecommerce_watch_store_sanitize_choices'
	));
	$wp_customize->add_control('ecommerce_watch_store_blog_page_posts_settings',array(
    'type' => 'select',
    'label' => __('Display Blog Posts','ecommerce-watch-store'),
    'section' => 'ecommerce_watch_store_post_settings',
    'choices' => array(
    	'Into Blocks' => __('Into Blocks','ecommerce-watch-store'),
        'Without Blocks' => __('Without Blocks','ecommerce-watch-store')
        ),
	) );

	$wp_customize->add_setting( 'ecommerce_watch_store_blog_pagination_hide_show',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'ecommerce_watch_store_switch_sanitization'
  ));
  $wp_customize->add_control( new Ecommerce_Watch_Store_Toggle_Switch_Custom_Control( $wp_customize, 'ecommerce_watch_store_blog_pagination_hide_show',array(
		'label' => esc_html__( 'Show / Hide Blog Pagination','ecommerce-watch-store' ),
		'section' => 'ecommerce_watch_store_post_settings'
  )));

	$wp_customize->add_setting('ecommerce_watch_store_blog_excerpt_suffix',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ecommerce_watch_store_blog_excerpt_suffix',array(
		'label'	=> __('Add Excerpt Suffix','ecommerce-watch-store'),
		'input_attrs' => array(
            'placeholder' => __( '[...]', 'ecommerce-watch-store' ),
        ),
		'section'=> 'ecommerce_watch_store_post_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'ecommerce_watch_store_blog_pagination_type', array(
    'default'			=> 'blog-page-numbers',
    'sanitize_callback'	=> 'ecommerce_watch_store_sanitize_choices'
  ));
  $wp_customize->add_control( 'ecommerce_watch_store_blog_pagination_type', array(
    'section' => 'ecommerce_watch_store_post_settings',
    'type' => 'select',
    'label' => __( 'Blog Pagination', 'ecommerce-watch-store' ),
    'choices'		=> array(
        'blog-page-numbers'  => __( 'Numeric', 'ecommerce-watch-store' ),
        'next-prev' => __( 'Older Posts/Newer Posts', 'ecommerce-watch-store' ),
  )));

    // Button Settings
	$wp_customize->add_section( 'ecommerce_watch_store_button_settings', array(
		'title' => esc_html__( 'Button Settings', 'ecommerce-watch-store' ),
		'panel' => 'ecommerce_watch_store_blog_post_parent_panel',
	));

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('ecommerce_watch_store_button_text', array(
		'selector' => '.post-main-box .more-btn a',
		'render_callback' => 'ecommerce_watch_store_Customize_partial_ecommerce_watch_store_button_text',
	));

  $wp_customize->add_setting('ecommerce_watch_store_button_text',array(
		'default'=> esc_html__('Read More','ecommerce-watch-store'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ecommerce_watch_store_button_text',array(
		'label'	=> esc_html__('Add Button Text','ecommerce-watch-store'),
		'input_attrs' => array(
    'placeholder' => esc_html__( 'Read More', 'ecommerce-watch-store' ),
        ),
		'section'=> 'ecommerce_watch_store_button_settings',
		'type'=> 'text'
	));

	// font size button
	$wp_customize->add_setting('ecommerce_watch_store_button_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ecommerce_watch_store_button_font_size',array(
		'label'	=> __('Button Font Size','ecommerce-watch-store'),
		'description'	=> __('Enter a value in pixels. Example:20px','ecommerce-watch-store'),
		'input_attrs' => array(
  		'placeholder' => __( '10px', 'ecommerce-watch-store' ),
    ),
  	'type'        => 'text',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
		'section'=> 'ecommerce_watch_store_button_settings',
	));


	$wp_customize->add_setting( 'ecommerce_watch_store_button_border_radius', array(
		'default'              => 5,
		'type'                 => 'theme_mod',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'ecommerce_watch_store_sanitize_number_range',
		'sanitize_js_callback' => 'absint',
	) );
	$wp_customize->add_control( 'ecommerce_watch_store_button_border_radius', array(
		'label'       => esc_html__( 'Button Border Radius','ecommerce-watch-store' ),
		'section'     => 'ecommerce_watch_store_button_settings',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	// button padding
	$wp_customize->add_setting('ecommerce_watch_store_button_top_bottom_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ecommerce_watch_store_button_top_bottom_padding',array(
		'label'	=> __('Button Top Bottom Padding','ecommerce-watch-store'),
		'description'	=> __('Enter a value in pixels. Example:20px','ecommerce-watch-store'),
		'input_attrs' => array(
      'placeholder' => __( '10px', 'ecommerce-watch-store' ),
    ),
		'section'=> 'ecommerce_watch_store_button_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('ecommerce_watch_store_button_left_right_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ecommerce_watch_store_button_left_right_padding',array(
		'label'	=> __('Button Left Right Padding','ecommerce-watch-store'),
		'description'	=> __('Enter a value in pixels. Example:20px','ecommerce-watch-store'),
		'input_attrs' => array(
      'placeholder' => __( '10px', 'ecommerce-watch-store' ),
    ),
		'section'=> 'ecommerce_watch_store_button_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('ecommerce_watch_store_button_letter_spacing',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ecommerce_watch_store_button_letter_spacing',array(
		'label'	=> __('Button Letter Spacing','ecommerce-watch-store'),
		'description'	=> __('Enter a value in pixels. Example:20px','ecommerce-watch-store'),
		'input_attrs' => array(
      	'placeholder' => __( '10px', 'ecommerce-watch-store' ),
  ),
  	'type'        => 'text',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
	),
		'section'=> 'ecommerce_watch_store_button_settings',
	));

	// text trasform
	$wp_customize->add_setting('ecommerce_watch_store_button_text_transform',array(
		'default'=> 'Capitalize',
		'sanitize_callback'	=> 'ecommerce_watch_store_sanitize_choices'
	));
	$wp_customize->add_control('ecommerce_watch_store_button_text_transform',array(
		'type' => 'radio',
		'label'	=> __('Button Text Transform','ecommerce-watch-store'),
		'choices' => array(
      'Uppercase' => __('Uppercase','ecommerce-watch-store'),
      'Capitalize' => __('Capitalize','ecommerce-watch-store'),
      'Lowercase' => __('Lowercase','ecommerce-watch-store'),
    ),
		'section'=> 'ecommerce_watch_store_button_settings',
	));

	// Related Post Settings
	$wp_customize->add_section( 'ecommerce_watch_store_related_posts_settings', array(
		'title' => esc_html__( 'Related Posts Settings', 'ecommerce-watch-store' ),
		'panel' => 'ecommerce_watch_store_blog_post_parent_panel',
	));

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('ecommerce_watch_store_related_post_title', array(
		'selector' => '.related-post h3',
		'render_callback' => 'ecommerce_watch_store_Customize_partial_ecommerce_watch_store_related_post_title',
	));

  $wp_customize->add_setting( 'ecommerce_watch_store_related_post',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'ecommerce_watch_store_switch_sanitization'
  ) );
  $wp_customize->add_control( new Ecommerce_Watch_Store_Toggle_Switch_Custom_Control( $wp_customize, 'ecommerce_watch_store_related_post',array(
		'label' => esc_html__( 'Related Post','ecommerce-watch-store' ),
		'section' => 'ecommerce_watch_store_related_posts_settings'
  )));

  $wp_customize->add_setting('ecommerce_watch_store_related_post_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ecommerce_watch_store_related_post_title',array(
		'label'	=> esc_html__('Add Related Post Title','ecommerce-watch-store'),
		'input_attrs' => array(
            'placeholder' => esc_html__( 'Related Post', 'ecommerce-watch-store' ),
        ),
		'section'=> 'ecommerce_watch_store_related_posts_settings',
		'type'=> 'text'
	));

 	$wp_customize->add_setting('ecommerce_watch_store_related_posts_count',array(
		'default'=> 3,
		'sanitize_callback'	=> 'ecommerce_watch_store_sanitize_number_absint'
	));
	$wp_customize->add_control('ecommerce_watch_store_related_posts_count',array(
		'label'	=> esc_html__('Add Related Post Count','ecommerce-watch-store'),
		'input_attrs' => array(
            'placeholder' => esc_html__( '3', 'ecommerce-watch-store' ),
        ),
		'section'=> 'ecommerce_watch_store_related_posts_settings',
		'type'=> 'number'
	));

	$wp_customize->add_setting( 'ecommerce_watch_store_related_posts_excerpt_number', array(
		'default'              => 20,
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'ecommerce_watch_store_sanitize_number_range'
	) );
	$wp_customize->add_control( 'ecommerce_watch_store_related_posts_excerpt_number', array(
		'label'       => esc_html__( 'Related Posts Excerpt length','ecommerce-watch-store' ),
		'section'     => 'ecommerce_watch_store_related_posts_settings',
		'type'        => 'range',
		'settings'    => 'ecommerce_watch_store_related_posts_excerpt_number',
		'input_attrs' => array(
			'step'             => 5,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting( 'ecommerce_watch_store_related_toggle_postdate',array(
	   'default' => 1,
	   'transport' => 'refresh',
	   'sanitize_callback' => 'ecommerce_watch_store_switch_sanitization'
  	));
   $wp_customize->add_control( new Ecommerce_Watch_Store_Toggle_Switch_Custom_Control( $wp_customize, 'ecommerce_watch_store_related_toggle_postdate',array(
     'label' => esc_html__( 'Show / Hide Post Date','ecommerce-watch-store' ),
     'section' => 'ecommerce_watch_store_related_posts_settings'
   )));

   $wp_customize->add_setting('ecommerce_watch_store_related_postdate_icon',array(
     'default' => 'fas fa-calendar-alt',
     'sanitize_callback' => 'sanitize_text_field'
   ));
   $wp_customize->add_control(new Ecommerce_Watch_Store_Fontawesome_Icon_Chooser(
   $wp_customize,'ecommerce_watch_store_related_postdate_icon',array(
    	'label' => __('Add Post Date Icon','ecommerce-watch-store'),
    	'transport' => 'refresh',
    	'section' => 'ecommerce_watch_store_related_posts_settings',
    	'setting' => 'ecommerce_watch_store_related_postdate_icon',
    	'type'    => 'icon'
  	)));

	$wp_customize->add_setting( 'ecommerce_watch_store_related_toggle_author',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'ecommerce_watch_store_switch_sanitization'
  	));
  	$wp_customize->add_control( new Ecommerce_Watch_Store_Toggle_Switch_Custom_Control( $wp_customize, 'ecommerce_watch_store_related_toggle_author',array(
		'label' => esc_html__( 'Show / Hide Author','ecommerce-watch-store' ),
		'section' => 'ecommerce_watch_store_related_posts_settings'
  	)));

  	$wp_customize->add_setting('ecommerce_watch_store_related_author_icon',array(
    	'default' => 'fas fa-user',
    	'sanitize_callback' => 'sanitize_text_field'
  	));
  	$wp_customize->add_control(new Ecommerce_Watch_Store_Fontawesome_Icon_Chooser(
  	$wp_customize,'ecommerce_watch_store_related_author_icon',array(
    	'label' => __('Add Author Icon','ecommerce-watch-store'),
    	'transport' => 'refresh',
    	'section' => 'ecommerce_watch_store_related_posts_settings',
    	'setting' => 'ecommerce_watch_store_related_author_icon',
    	'type'    => 'icon'
  	)));

	$wp_customize->add_setting( 'ecommerce_watch_store_related_toggle_comments',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'ecommerce_watch_store_switch_sanitization'
  	) );
  	$wp_customize->add_control( new Ecommerce_Watch_Store_Toggle_Switch_Custom_Control( $wp_customize, 'ecommerce_watch_store_related_toggle_comments',array(
		'label' => esc_html__( 'Show / Hide Comments','ecommerce-watch-store' ),
		'section' => 'ecommerce_watch_store_related_posts_settings'
  	)));

  	$wp_customize->add_setting('ecommerce_watch_store_related_comments_icon',array(
    	'default' => 'fa fa-comments',
    	'sanitize_callback' => 'sanitize_text_field'
  	));
  	$wp_customize->add_control(new Ecommerce_Watch_Store_Fontawesome_Icon_Chooser(
  	$wp_customize,'ecommerce_watch_store_related_comments_icon',array(
    	'label' => __('Add Comments Icon','ecommerce-watch-store'),
    	'transport' => 'refresh',
    	'section' => 'ecommerce_watch_store_related_posts_settings',
    	'setting' => 'ecommerce_watch_store_related_comments_icon',
    	'type'    => 'icon'
  	)));

	$wp_customize->add_setting( 'ecommerce_watch_store_related_toggle_time',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'ecommerce_watch_store_switch_sanitization'
  	) );
  	$wp_customize->add_control( new Ecommerce_Watch_Store_Toggle_Switch_Custom_Control( $wp_customize, 'ecommerce_watch_store_related_toggle_time',array(
		'label' => esc_html__( 'Show / Hide Time','ecommerce-watch-store' ),
		'section' => 'ecommerce_watch_store_related_posts_settings'
  	)));

  	$wp_customize->add_setting('ecommerce_watch_store_related_time_icon',array(
    	'default' => 'fas fa-clock',
    	'sanitize_callback' => 'sanitize_text_field'
  	));
  	$wp_customize->add_control(new Ecommerce_Watch_Store_Fontawesome_Icon_Chooser(
  	$wp_customize,'ecommerce_watch_store_related_time_icon',array(
    	'label' => __('Add Time Icon','ecommerce-watch-store'),
    	'transport' => 'refresh',
    	'section' => 'ecommerce_watch_store_related_posts_settings',
    	'setting' => 'ecommerce_watch_store_related_time_icon',
    	'type'    => 'icon'
  	)));

  	$wp_customize->add_setting('ecommerce_watch_store_related_post_meta_field_separator',array(
		'default'=> '|',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ecommerce_watch_store_related_post_meta_field_separator',array(
		'label'	=> __('Add Meta Separator','ecommerce-watch-store'),
		'description' => __('Add the seperator for meta box. Example: "|", "/", etc.','ecommerce-watch-store'),
		'section'=> 'ecommerce_watch_store_related_posts_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'ecommerce_watch_store_related_image_hide_show',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'ecommerce_watch_store_switch_sanitization'
	));
  	$wp_customize->add_control( new Ecommerce_Watch_Store_Toggle_Switch_Custom_Control( $wp_customize, 'ecommerce_watch_store_related_image_hide_show', array(
		'label' => esc_html__( 'Show / Hide Featured Image','ecommerce-watch-store' ),
		'section' => 'ecommerce_watch_store_related_posts_settings'
  	)));

  	$wp_customize->add_setting( 'ecommerce_watch_store_related_image_box_shadow', array(
		'default'              => '0',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'ecommerce_watch_store_sanitize_number_range'
	) );
	$wp_customize->add_control( 'ecommerce_watch_store_related_image_box_shadow', array(
		'label'       => esc_html__( 'Related post Image Box Shadow','ecommerce-watch-store' ),
		'section'     => 'ecommerce_watch_store_related_posts_settings',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

  	$wp_customize->add_setting('ecommerce_watch_store_related_button_text',array(
		'default'=> esc_html__('Read More','ecommerce-watch-store'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ecommerce_watch_store_related_button_text',array(
		'label'	=> esc_html__('Add Button Text','ecommerce-watch-store'),
		'input_attrs' => array(
      'placeholder' => esc_html__( 'Read More', 'ecommerce-watch-store' ),
        ),
		'section'=> 'ecommerce_watch_store_related_posts_settings',
		'type'=> 'text'
	));

	// Single Posts Settings
	$wp_customize->add_section( 'ecommerce_watch_store_single_blog_settings', array(
		'title' => __( 'Single Post Settings', 'ecommerce-watch-store' ),
		'panel' => 'ecommerce_watch_store_blog_post_parent_panel',
	));

  	$wp_customize->add_setting('ecommerce_watch_store_single_postdate_icon',array(
		'default'	=> 'fas fa-calendar-alt',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Ecommerce_Watch_Store_Fontawesome_Icon_Chooser(
        $wp_customize,'ecommerce_watch_store_single_postdate_icon',array(
		'label'	=> __('Add Post Date Icon','ecommerce-watch-store'),
		'transport' => 'refresh',
		'section'	=> 'ecommerce_watch_store_single_blog_settings',
		'setting'	=> 'ecommerce_watch_store_single_postdate_icon',
		'type'		=> 'icon'
	)));

  $wp_customize->add_setting( 'ecommerce_watch_store_single_postdate',array(
    'default' => 1,
    'transport' => 'refresh',
    'sanitize_callback' => 'ecommerce_watch_store_switch_sanitization'
	) );
	$wp_customize->add_control( new Ecommerce_Watch_Store_Toggle_Switch_Custom_Control( $wp_customize, 'ecommerce_watch_store_single_postdate',array(
	   'label' => esc_html__( 'Show / Hide Date','ecommerce-watch-store' ),
	   'section' => 'ecommerce_watch_store_single_blog_settings'
	)));

	$wp_customize->add_setting('ecommerce_watch_store_single_author_icon',array(
		'default'	=> 'fas fa-user',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Ecommerce_Watch_Store_Fontawesome_Icon_Chooser(
        $wp_customize,'ecommerce_watch_store_single_author_icon',array(
		'label'	=> __('Add Author Icon','ecommerce-watch-store'),
		'transport' => 'refresh',
		'section'	=> 'ecommerce_watch_store_single_blog_settings',
		'setting'	=> 'ecommerce_watch_store_single_author_icon',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting( 'ecommerce_watch_store_single_author',array(
	    'default' => 1,
	    'transport' => 'refresh',
	    'sanitize_callback' => 'ecommerce_watch_store_switch_sanitization'
	) );
	$wp_customize->add_control( new Ecommerce_Watch_Store_Toggle_Switch_Custom_Control( $wp_customize, 'ecommerce_watch_store_single_author',array(
	    'label' => esc_html__( 'Show / Hide Author','ecommerce-watch-store' ),
	    'section' => 'ecommerce_watch_store_single_blog_settings'
	)));

   	$wp_customize->add_setting('ecommerce_watch_store_single_comments_icon',array(
		'default'	=> 'fa fa-comments',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Ecommerce_Watch_Store_Fontawesome_Icon_Chooser(
        $wp_customize,'ecommerce_watch_store_single_comments_icon',array(
		'label'	=> __('Add Comments Icon','ecommerce-watch-store'),
		'transport' => 'refresh',
		'section'	=> 'ecommerce_watch_store_single_blog_settings',
		'setting'	=> 'ecommerce_watch_store_single_comments_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting( 'ecommerce_watch_store_single_comments',array(
	    'default' => 1,
	    'transport' => 'refresh',
	    'sanitize_callback' => 'ecommerce_watch_store_switch_sanitization'
	) );
	$wp_customize->add_control( new Ecommerce_Watch_Store_Toggle_Switch_Custom_Control( $wp_customize, 'ecommerce_watch_store_single_comments',array(
	    'label' => esc_html__( 'Show / Hide Comments','ecommerce-watch-store' ),
	    'section' => 'ecommerce_watch_store_single_blog_settings'
	)));

  	$wp_customize->add_setting('ecommerce_watch_store_single_time_icon',array(
		'default'	=> 'fas fa-clock',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Ecommerce_Watch_Store_Fontawesome_Icon_Chooser(
        $wp_customize,'ecommerce_watch_store_single_time_icon',array(
		'label'	=> __('Add Time Icon','ecommerce-watch-store'),
		'transport' => 'refresh',
		'section'	=> 'ecommerce_watch_store_single_blog_settings',
		'setting'	=> 'ecommerce_watch_store_single_time_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting( 'ecommerce_watch_store_single_time',array(
	    'default' => 1,
	    'transport' => 'refresh',
	    'sanitize_callback' => 'ecommerce_watch_store_switch_sanitization'
	) );
	$wp_customize->add_control( new Ecommerce_Watch_Store_Toggle_Switch_Custom_Control( $wp_customize, 'ecommerce_watch_store_single_time',array(
	    'label' => esc_html__( 'Show / Hide Time','ecommerce-watch-store' ),
	    'section' => 'ecommerce_watch_store_single_blog_settings'
	)));

	$wp_customize->add_setting( 'ecommerce_watch_store_toggle_tags',array(
		'default' => 0,
		'transport' => 'refresh',
		'sanitize_callback' => 'ecommerce_watch_store_switch_sanitization'
	));
  $wp_customize->add_control( new Ecommerce_Watch_Store_Toggle_Switch_Custom_Control( $wp_customize, 'ecommerce_watch_store_toggle_tags', array(
		'label' => esc_html__( 'Show / Hide Tags','ecommerce-watch-store' ),
		'section' => 'ecommerce_watch_store_single_blog_settings'
  )));

	$wp_customize->add_setting( 'ecommerce_watch_store_single_post_breadcrumb',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'ecommerce_watch_store_switch_sanitization'
    ) );
 	 $wp_customize->add_control( new Ecommerce_Watch_Store_Toggle_Switch_Custom_Control( $wp_customize, 'ecommerce_watch_store_single_post_breadcrumb',array(
		'label' => esc_html__( 'Show / Hide Breadcrumb','ecommerce-watch-store' ),
		'section' => 'ecommerce_watch_store_single_blog_settings'
    )));

	// Single Posts Category
 	 $wp_customize->add_setting( 'ecommerce_watch_store_single_post_category',array(
		'default' => true,
		'transport' => 'refresh',
		'sanitize_callback' => 'ecommerce_watch_store_switch_sanitization'
    ) );
  	$wp_customize->add_control( new Ecommerce_Watch_Store_Toggle_Switch_Custom_Control( $wp_customize, 'ecommerce_watch_store_single_post_category',array(
		'label' => esc_html__( 'Show / Hide Category','ecommerce-watch-store' ),
		'section' => 'ecommerce_watch_store_single_blog_settings'
    )));

  	 $wp_customize->add_setting( 'ecommerce_watch_store_singlepost_image_box_shadow', array(
		'default'              => '0',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'ecommerce_watch_store_sanitize_number_range'
	) );
	$wp_customize->add_control( 'ecommerce_watch_store_singlepost_image_box_shadow', array(
		'label'       => esc_html__( 'Single post Image Box Shadow','ecommerce-watch-store' ),
		'section'     => 'ecommerce_watch_store_single_blog_settings',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting('ecommerce_watch_store_single_post_meta_field_separator',array(
		'default'=> '|',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ecommerce_watch_store_single_post_meta_field_separator',array(
		'label'	=> __('Add Meta Separator','ecommerce-watch-store'),
		'description' => __('Add the seperator for meta box. Example: "|", "/", etc.','ecommerce-watch-store'),
		'section'=> 'ecommerce_watch_store_single_blog_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'ecommerce_watch_store_single_blog_post_navigation_show_hide',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'ecommerce_watch_store_switch_sanitization'
	));
	$wp_customize->add_control( new Ecommerce_Watch_Store_Toggle_Switch_Custom_Control( $wp_customize, 'ecommerce_watch_store_single_blog_post_navigation_show_hide', array(
		  'label' => esc_html__( 'Show / Hide Post Navigation','ecommerce-watch-store' ),
		  'section' => 'ecommerce_watch_store_single_blog_settings'
	)));

	//navigation text
	$wp_customize->add_setting('ecommerce_watch_store_single_blog_prev_navigation_text',array(
		'default'=> 'PREVIOUS',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ecommerce_watch_store_single_blog_prev_navigation_text',array(
		'label'	=> __('Post Navigation Text','ecommerce-watch-store'),
		'input_attrs' => array(
            'placeholder' => __( 'PREVIOUS', 'ecommerce-watch-store' ),
        ),
		'section'=> 'ecommerce_watch_store_single_blog_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('ecommerce_watch_store_single_blog_next_navigation_text',array(
		'default'=> 'NEXT',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ecommerce_watch_store_single_blog_next_navigation_text',array(
		'label'	=> __('Post Navigation Text','ecommerce-watch-store'),
		'input_attrs' => array(
            'placeholder' => __( 'NEXT', 'ecommerce-watch-store' ),
        ),
		'section'=> 'ecommerce_watch_store_single_blog_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('ecommerce_watch_store_single_blog_comment_title',array(
		'default'=> 'Leave a Reply',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('ecommerce_watch_store_single_blog_comment_title',array(
		'label'	=> __('Add Comment Title','ecommerce-watch-store'),
		'input_attrs' => array(
        'placeholder' => __( 'Leave a Reply', 'ecommerce-watch-store' ),
    	),
		'section'=> 'ecommerce_watch_store_single_blog_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('ecommerce_watch_store_single_blog_comment_button_text',array(
		'default'=> 'Post Comment',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('ecommerce_watch_store_single_blog_comment_button_text',array(
		'label'	=> __('Add Comment Button Text','ecommerce-watch-store'),
		'input_attrs' => array(
    'placeholder' => __( 'Post Comment', 'ecommerce-watch-store' ),
        ),
		'section'=> 'ecommerce_watch_store_single_blog_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('ecommerce_watch_store_single_blog_comment_width',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ecommerce_watch_store_single_blog_comment_width',array(
		'label'	=> __('Comment Form Width','ecommerce-watch-store'),
		'description'	=> __('Enter a value in %. Example:50%','ecommerce-watch-store'),
		'input_attrs' => array(
        'placeholder' => __( '100%', 'ecommerce-watch-store' ),
        ),
		'section'=> 'ecommerce_watch_store_single_blog_settings',
		'type'=> 'text'
	));

	 // Grid layout setting
	$wp_customize->add_section( 'ecommerce_watch_store_grid_layout_settings', array(
		'title' => __( 'Grid Layout Settings', 'ecommerce-watch-store' ),
		'panel' => 'ecommerce_watch_store_blog_post_parent_panel',
	));

  	$wp_customize->add_setting('ecommerce_watch_store_grid_postdate_icon',array(
		'default'	=> 'fas fa-calendar-alt',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Ecommerce_Watch_Store_Fontawesome_Icon_Chooser(
        $wp_customize,'ecommerce_watch_store_grid_postdate_icon',array(
		'label'	=> __('Add Post Date Icon','ecommerce-watch-store'),
		'transport' => 'refresh',
		'section'	=> 'ecommerce_watch_store_grid_layout_settings',
		'setting'	=> 'ecommerce_watch_store_grid_postdate_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting( 'ecommerce_watch_store_grid_postdate',array(
	  'default' => 1,
	  'transport' => 'refresh',
	  'sanitize_callback' => 'ecommerce_watch_store_switch_sanitization'
  ) );
  $wp_customize->add_control( new Ecommerce_Watch_Store_Toggle_Switch_Custom_Control( $wp_customize, 'ecommerce_watch_store_grid_postdate',array(
    'label' => esc_html__( 'Show / Hide Post Date','ecommerce-watch-store' ),
    'section' => 'ecommerce_watch_store_grid_layout_settings'
  )));

	$wp_customize->add_setting('ecommerce_watch_store_grid_author_icon',array(
		'default'	=> 'fas fa-user',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Ecommerce_Watch_Store_Fontawesome_Icon_Chooser(
        $wp_customize,'ecommerce_watch_store_grid_author_icon',array(
		'label'	=> __('Add Author Icon','ecommerce-watch-store'),
		'transport' => 'refresh',
		'section'	=> 'ecommerce_watch_store_grid_layout_settings',
		'setting'	=> 'ecommerce_watch_store_grid_author_icon',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting( 'ecommerce_watch_store_grid_author',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'ecommerce_watch_store_switch_sanitization'
    ) );
    $wp_customize->add_control( new Ecommerce_Watch_Store_Toggle_Switch_Custom_Control( $wp_customize, 'ecommerce_watch_store_grid_author',array(
		'label' => esc_html__( 'Show / Hide Author','ecommerce-watch-store' ),
		'section' => 'ecommerce_watch_store_grid_layout_settings'
    )));

    $wp_customize->add_setting('ecommerce_watch_store_grid_comments_icon',array(
		'default'	=> 'fa fa-comments',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Ecommerce_Watch_Store_Fontawesome_Icon_Chooser(
        $wp_customize,'ecommerce_watch_store_grid_comments_icon',array(
		'label'	=> __('Add Comments Icon','ecommerce-watch-store'),
		'transport' => 'refresh',
		'section'	=> 'ecommerce_watch_store_grid_layout_settings',
		'setting'	=> 'ecommerce_watch_store_grid_comments_icon',
		'type'		=> 'icon'
	)));

  $wp_customize->add_setting( 'ecommerce_watch_store_grid_time',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'ecommerce_watch_store_switch_sanitization'
    ) );
    $wp_customize->add_control( new Ecommerce_Watch_Store_Toggle_Switch_Custom_Control( $wp_customize, 'ecommerce_watch_store_grid_time',array(
		'label' => esc_html__( 'Show / Hide Time','ecommerce-watch-store' ),
		'section' => 'ecommerce_watch_store_grid_layout_settings'
    )));

    $wp_customize->add_setting('ecommerce_watch_store_grid_time_icon',array(
		'default'	=> 'fas fa-clock',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Ecommerce_Watch_Store_Fontawesome_Icon_Chooser(
        $wp_customize,'ecommerce_watch_store_grid_time_icon',array(
		'label'	=> __('Add Time Icon','ecommerce-watch-store'),
		'transport' => 'refresh',
		'section'	=> 'ecommerce_watch_store_grid_layout_settings',
		'setting'	=> 'ecommerce_watch_store_grid_time_icon',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting( 'ecommerce_watch_store_grid_comments',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'ecommerce_watch_store_switch_sanitization'
    ) );
    $wp_customize->add_control( new Ecommerce_Watch_Store_Toggle_Switch_Custom_Control( $wp_customize, 'ecommerce_watch_store_grid_comments',array(
		'label' => esc_html__( 'Show / Hide Comments','ecommerce-watch-store' ),
		'section' => 'ecommerce_watch_store_grid_layout_settings'
    )));

   $wp_customize->add_setting( 'ecommerce_watch_store_grid_image_hide_show',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'ecommerce_watch_store_switch_sanitization'
	));
  	$wp_customize->add_control( new Ecommerce_Watch_Store_Toggle_Switch_Custom_Control( $wp_customize, 'ecommerce_watch_store_grid_image_hide_show', array(
		'label' => esc_html__( 'Show / Hide Featured Image','ecommerce-watch-store' ),
		'section' => 'ecommerce_watch_store_grid_layout_settings'
  	)));


 	$wp_customize->add_setting('ecommerce_watch_store_grid_post_meta_field_separator',array(
		'default'=> '|',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ecommerce_watch_store_grid_post_meta_field_separator',array(
		'label'	=> __('Add Meta Separator','ecommerce-watch-store'),
		'description' => __('Add the seperator for meta box. Example: "|", "/", etc.','ecommerce-watch-store'),
		'section'=> 'ecommerce_watch_store_grid_layout_settings',
		'type'=> 'text'
	));

  $wp_customize->add_setting('ecommerce_watch_store_display_grid_posts_settings',array(
    'default' => 'Into Blocks',
    'transport' => 'refresh',
    'sanitize_callback' => 'ecommerce_watch_store_sanitize_choices'
	));
	$wp_customize->add_control('ecommerce_watch_store_display_grid_posts_settings',array(
    'type' => 'select',
    'label' => __('Display Grid Posts','ecommerce-watch-store'),
    'section' => 'ecommerce_watch_store_grid_layout_settings',
    'choices' => array(
    	'Into Blocks' => __('Into Blocks','ecommerce-watch-store'),
      'Without Blocks' => __('Without Blocks','ecommerce-watch-store')
      ),
	) );

  	$wp_customize->add_setting('ecommerce_watch_store_grid_button_text',array(
		'default'=> esc_html__('Read More','ecommerce-watch-store'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ecommerce_watch_store_grid_button_text',array(
		'label'	=> esc_html__('Add Button Text','ecommerce-watch-store'),
		'input_attrs' => array(
            'placeholder' => esc_html__( 'Read More', 'ecommerce-watch-store' ),
        ),
		'section'=> 'ecommerce_watch_store_grid_layout_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('ecommerce_watch_store_grid_excerpt_suffix',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ecommerce_watch_store_grid_excerpt_suffix',array(
		'label'	=> __('Add Excerpt Suffix','ecommerce-watch-store'),
		'input_attrs' => array(
            'placeholder' => __( '[...]', 'ecommerce-watch-store' ),
        ),
		'section'=> 'ecommerce_watch_store_grid_layout_settings',
		'type'=> 'text'
	));

    $wp_customize->add_setting('ecommerce_watch_store_grid_excerpt_settings',array(
        'default' => 'Excerpt',
        'transport' => 'refresh',
        'sanitize_callback' => 'ecommerce_watch_store_sanitize_choices'
	));
	$wp_customize->add_control('ecommerce_watch_store_grid_excerpt_settings',array(
        'type' => 'select',
        'label' => esc_html__('Grid Post Content','ecommerce-watch-store'),
        'section' => 'ecommerce_watch_store_grid_layout_settings',
        'choices' => array(
        	'Content' => esc_html__('Content','ecommerce-watch-store'),
            'Excerpt' => esc_html__('Excerpt','ecommerce-watch-store'),
            'No Content' => esc_html__('No Content','ecommerce-watch-store')
        ),
	) );

    $wp_customize->add_setting( 'ecommerce_watch_store_grid_featured_image_border_radius', array(
		'default'              => '0',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'ecommerce_watch_store_sanitize_number_range'
	) );
	$wp_customize->add_control( 'ecommerce_watch_store_grid_featured_image_border_radius', array(
		'label'       => esc_html__( 'Grid Featured Image Border Radius','ecommerce-watch-store' ),
		'section'     => 'ecommerce_watch_store_grid_layout_settings',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting( 'ecommerce_watch_store_grid_featured_image_box_shadow', array(
		'default'              => '0',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'ecommerce_watch_store_sanitize_number_range'
	) );
	$wp_customize->add_control( 'ecommerce_watch_store_grid_featured_image_box_shadow', array(
		'label'       => esc_html__( 'Grid Featured Image Box Shadow','ecommerce-watch-store' ),
		'section'     => 'ecommerce_watch_store_grid_layout_settings',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	//Other
	$wp_customize->add_panel( 'ecommerce_watch_store_other_parent_panel', array(
		'title' => esc_html__( 'Other Settings', 'ecommerce-watch-store' ),
		'panel' => 'ecommerce_watch_store_panel_id',
		'priority' => 20,
	));

	// Layout
	$wp_customize->add_section( 'ecommerce_watch_store_left_right', array(
    	'title' => esc_html__('General Settings', 'ecommerce-watch-store'),
		'panel' => 'ecommerce_watch_store_other_parent_panel'
	) );

	$wp_customize->add_setting('ecommerce_watch_store_width_option',array(
        'default' => 'Full Width',
        'sanitize_callback' => 'ecommerce_watch_store_sanitize_choices'
	));
	$wp_customize->add_control(new Ecommerce_Watch_Store_Image_Radio_Control($wp_customize, 'ecommerce_watch_store_width_option', array(
        'type' => 'select',
        'label' => esc_html__('Width Layouts','ecommerce-watch-store'),
        'description' => esc_html__('Here you can change the width layout of Website.','ecommerce-watch-store'),
        'section' => 'ecommerce_watch_store_left_right',
        'choices' => array(
            'Full Width' => esc_url(get_template_directory_uri()).'/assets/images/full-width.png',
            'Wide Width' => esc_url(get_template_directory_uri()).'/assets/images/wide-width.png',
            'Boxed' => esc_url(get_template_directory_uri()).'/assets/images/boxed-width.png',
    ))));

	$wp_customize->add_setting('ecommerce_watch_store_page_layout',array(
        'default' => 'One_Column',
        'sanitize_callback' => 'ecommerce_watch_store_sanitize_choices'
	));
	$wp_customize->add_control('ecommerce_watch_store_page_layout',array(
        'type' => 'select',
        'label' => esc_html__('Page Sidebar Layout','ecommerce-watch-store'),
        'description' => esc_html__('Here you can change the sidebar layout for pages. ','ecommerce-watch-store'),
        'section' => 'ecommerce_watch_store_left_right',
        'choices' => array(
            'Left_Sidebar' => esc_html__('Left Sidebar','ecommerce-watch-store'),
            'Right_Sidebar' => esc_html__('Right Sidebar','ecommerce-watch-store'),
            'One_Column' => esc_html__('One Column','ecommerce-watch-store')
        ),
	) );

	$wp_customize->add_setting( 'ecommerce_watch_store_single_page_breadcrumb1',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'ecommerce_watch_store_switch_sanitization'
    ) );
    $wp_customize->add_control( new Ecommerce_Watch_Store_Toggle_Switch_Custom_Control( $wp_customize, 'ecommerce_watch_store_single_page_breadcrumb1',array(
		'label' => esc_html__( 'Show / Hide Page Breadcrumb','ecommerce-watch-store' ),
		'section' => 'ecommerce_watch_store_left_right'
    )));

    // Pre-Loader
	$wp_customize->add_setting( 'ecommerce_watch_store_loader_enable',array(
        'default' => 0,
        'transport' => 'refresh',
        'sanitize_callback' => 'ecommerce_watch_store_switch_sanitization'
    ) );
    $wp_customize->add_control( new Ecommerce_Watch_Store_Toggle_Switch_Custom_Control( $wp_customize, 'ecommerce_watch_store_loader_enable',array(
        'label' => esc_html__( 'Pre-Loader','ecommerce-watch-store' ),
        'section' => 'ecommerce_watch_store_left_right'
    )));

	$wp_customize->add_setting('ecommerce_watch_store_preloader_bg_color', array(
		'default'           => '#21286A',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ecommerce_watch_store_preloader_bg_color', array(
		'label'    => __('Pre-Loader Background Color', 'ecommerce-watch-store'),
		'section'  => 'ecommerce_watch_store_left_right',
	)));

	$wp_customize->add_setting('ecommerce_watch_store_preloader_border_color', array(
		'default'           => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ecommerce_watch_store_preloader_border_color', array(
		'label'    => __('Pre-Loader Border Color', 'ecommerce-watch-store'),
		'section'  => 'ecommerce_watch_store_left_right',
	)));

	$wp_customize->add_setting('ecommerce_watch_store_breadcrumbs_alignment',array(
        'default' => 'Left',
        'sanitize_callback' => 'ecommerce_watch_store_sanitize_choices'
	));
	$wp_customize->add_control('ecommerce_watch_store_breadcrumbs_alignment',array(
        'type' => 'select',
        'label' => __('Breadcrumbs Alignment','ecommerce-watch-store'),
        'section' => 'ecommerce_watch_store_left_right',
        'choices' => array(
            'Left' => __('Left','ecommerce-watch-store'),
            'Right' => __('Right','ecommerce-watch-store'),
            'Center' => __('Center','ecommerce-watch-store'),
        ),
	) );


    //404 Page Setting
	$wp_customize->add_section('ecommerce_watch_store_404_page',array(
		'title'	=> __('404 Page Settings','ecommerce-watch-store'),
		'panel' => 'ecommerce_watch_store_other_parent_panel',
	));

	$wp_customize->add_setting('ecommerce_watch_store_404_page_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('ecommerce_watch_store_404_page_title',array(
		'label'	=> __('Add Title','ecommerce-watch-store'),
		'input_attrs' => array(
            'placeholder' => __( '404 Not Found', 'ecommerce-watch-store' ),
        ),
		'section'=> 'ecommerce_watch_store_404_page',
		'type'=> 'text'
	));

	$wp_customize->add_setting('ecommerce_watch_store_404_page_content',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('ecommerce_watch_store_404_page_content',array(
		'label'	=> __('Add Text','ecommerce-watch-store'),
		'input_attrs' => array(
            'placeholder' => __( 'Looks like you have taken a wrong turn, Dont worry, it happens to the best of us.', 'ecommerce-watch-store' ),
        ),
		'section'=> 'ecommerce_watch_store_404_page',
		'type'=> 'text'
	));

	$wp_customize->add_setting('ecommerce_watch_store_404_page_button_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ecommerce_watch_store_404_page_button_text',array(
		'label'	=> __('Add Button Text','ecommerce-watch-store'),
		'input_attrs' => array(
            'placeholder' => __( 'GO BACK', 'ecommerce-watch-store' ),
        ),
		'section'=> 'ecommerce_watch_store_404_page',
		'type'=> 'text'
	));

	//No Result Page Setting
	$wp_customize->add_section('ecommerce_watch_store_no_results_page',array(
		'title'	=> __('No Results Page Settings','ecommerce-watch-store'),
		'panel' => 'ecommerce_watch_store_other_parent_panel',
	));

	$wp_customize->add_setting('ecommerce_watch_store_no_results_page_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('ecommerce_watch_store_no_results_page_title',array(
		'label'	=> __('Add Title','ecommerce-watch-store'),
		'input_attrs' => array(
            'placeholder' => __( 'Nothing Found', 'ecommerce-watch-store' ),
        ),
		'section'=> 'ecommerce_watch_store_no_results_page',
		'type'=> 'text'
	));

	$wp_customize->add_setting('ecommerce_watch_store_no_results_page_content',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('ecommerce_watch_store_no_results_page_content',array(
		'label'	=> __('Add Text','ecommerce-watch-store'),
		'input_attrs' => array(
        'placeholder' => __( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'ecommerce-watch-store' ),
        ),
		'section'=> 'ecommerce_watch_store_no_results_page',
		'type'=> 'text'
	));

	//Social Icon Setting
	$wp_customize->add_section('ecommerce_watch_store_social_icon_settings',array(
		'title'	=> __('Social Icons Settings','ecommerce-watch-store'),
		'panel' => 'ecommerce_watch_store_other_parent_panel',
	));

	$wp_customize->add_setting('ecommerce_watch_store_social_icon_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ecommerce_watch_store_social_icon_font_size',array(
		'label'	=> __('Icon Font Size','ecommerce-watch-store'),
		'description'	=> __('Enter a value in pixels. Example:20px','ecommerce-watch-store'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'ecommerce-watch-store' ),
        ),
		'section'=> 'ecommerce_watch_store_social_icon_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('ecommerce_watch_store_social_icon_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ecommerce_watch_store_social_icon_padding',array(
		'label'	=> __('Icon Padding','ecommerce-watch-store'),
		'description'	=> __('Enter a value in pixels. Example:20px','ecommerce-watch-store'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'ecommerce-watch-store' ),
        ),
		'section'=> 'ecommerce_watch_store_social_icon_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('ecommerce_watch_store_social_icon_width',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ecommerce_watch_store_social_icon_width',array(
		'label'	=> __('Icon Width','ecommerce-watch-store'),
		'description'	=> __('Enter a value in pixels. Example:20px','ecommerce-watch-store'),
		'input_attrs' => array(
    'placeholder' => __( '10px', 'ecommerce-watch-store' ),
        ),
		'section'=> 'ecommerce_watch_store_social_icon_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('ecommerce_watch_store_social_icon_height',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ecommerce_watch_store_social_icon_height',array(
		'label'	=> __('Icon Height','ecommerce-watch-store'),
		'description'	=> __('Enter a value in pixels. Example:20px','ecommerce-watch-store'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'ecommerce-watch-store' ),
        ),
		'section'=> 'ecommerce_watch_store_social_icon_settings',
		'type'=> 'text'
	));

	//Responsive Media Settings
	$wp_customize->add_section('ecommerce_watch_store_responsive_media',array(
		'title'	=> esc_html__('Responsive Media','ecommerce-watch-store'),
		'panel' => 'ecommerce_watch_store_other_parent_panel',
	));

	$wp_customize->add_setting( 'ecommerce_watch_store_resp_slider_hide_show',array(
      	'default' => 1,
     	'transport' => 'refresh',
      	'sanitize_callback' => 'ecommerce_watch_store_switch_sanitization'
    ));
    $wp_customize->add_control( new Ecommerce_Watch_Store_Toggle_Switch_Custom_Control( $wp_customize, 'ecommerce_watch_store_resp_slider_hide_show',array(
      	'label' => esc_html__( 'Show / Hide Banner','ecommerce-watch-store' ),
      	'section' => 'ecommerce_watch_store_responsive_media'
    )));

	$wp_customize->add_setting( 'ecommerce_watch_store_responsive_preloader_hide',array(
        'default' => false,
        'transport' => 'refresh',
        'sanitize_callback' => 'ecommerce_watch_store_switch_sanitization'
    ) );
    $wp_customize->add_control( new Ecommerce_Watch_Store_Toggle_Switch_Custom_Control( $wp_customize, 'ecommerce_watch_store_responsive_preloader_hide',array(
        'label' => esc_html__( 'Show / Hide Preloader','ecommerce-watch-store' ),
        'section' => 'ecommerce_watch_store_responsive_media'
    )));

	$wp_customize->add_setting( 'ecommerce_watch_store_resp_topbar_hide_show',array(
      'default' => 0,
      'transport' => 'refresh',
      'sanitize_callback' => 'ecommerce_watch_store_switch_sanitization'
    ));  
    $wp_customize->add_control( new Ecommerce_Watch_Store_Toggle_Switch_Custom_Control( $wp_customize, 'ecommerce_watch_store_resp_topbar_hide_show',array(
      'label' => esc_html__( 'Show / Hide Topbar','ecommerce-watch-store' ),
      'section' => 'ecommerce_watch_store_responsive_media'
    )));

    $wp_customize->add_setting( 'ecommerce_watch_store_sidebar_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'ecommerce_watch_store_switch_sanitization'
    ));  
    $wp_customize->add_control( new Ecommerce_Watch_Store_Toggle_Switch_Custom_Control( $wp_customize, 'ecommerce_watch_store_sidebar_hide_show',array(
      'label' => esc_html__( 'Show / Hide Sidebar','ecommerce-watch-store' ),
      'section' => 'ecommerce_watch_store_responsive_media'
    )));

    $wp_customize->add_setting( 'ecommerce_watch_store_resp_scroll_top_hide_show',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'ecommerce_watch_store_switch_sanitization'
    ));
    $wp_customize->add_control( new Ecommerce_Watch_Store_Toggle_Switch_Custom_Control( $wp_customize, 'ecommerce_watch_store_resp_scroll_top_hide_show',array(
      	'label' => esc_html__( 'Show / Hide Scroll To Top','ecommerce-watch-store' ),
      	'section' => 'ecommerce_watch_store_responsive_media'
    )));

    $wp_customize->add_setting('ecommerce_watch_store_resp_menu_toggle_btn_bg_color', array(
		'default'           => '#21286a',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ecommerce_watch_store_resp_menu_toggle_btn_bg_color', array(
		'label'    => __('Toggle Button Bg Color', 'ecommerce-watch-store'),
		'section'  => 'ecommerce_watch_store_responsive_media',
	)));

    $wp_customize->add_setting('ecommerce_watch_store_res_open_menu_icon',array(
		'default'	=> 'fas fa-bars',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new ecommerce_watch_store_Fontawesome_Icon_Chooser(
        $wp_customize,'ecommerce_watch_store_res_open_menu_icon',array(
		'label'	=> __('Add Open Menu Icon','ecommerce-watch-store'),
		'transport' => 'refresh',
		'section'	=> 'ecommerce_watch_store_responsive_media',
		'setting'	=> 'ecommerce_watch_store_res_open_menu_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('ecommerce_watch_store_res_close_menu_icon',array(
		'default'	=> 'fas fa-times',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new ecommerce_watch_store_Fontawesome_Icon_Chooser(
        $wp_customize,'ecommerce_watch_store_res_close_menu_icon',array(
		'label'	=> __('Add Close Menu Icon','ecommerce-watch-store'),
		'transport' => 'refresh',
		'section'	=> 'ecommerce_watch_store_responsive_media',
		'setting'	=> 'ecommerce_watch_store_res_close_menu_icon',
		'type'		=> 'icon'
	)));

  //Woocommerce settings
	$wp_customize->add_section('ecommerce_watch_store_woocommerce_section', array(
		'title'    => __('WooCommerce Layout', 'ecommerce-watch-store'),
		'priority' => null,
		'panel'    => 'woocommerce',
	));

	// Selective Refresh
	$wp_customize->selective_refresh->add_partial( 'ecommerce_watch_store_woocommerce_shop_page_sidebar', array( 'selector' => '.post-type-archive-product #sidebar', 
		'render_callback' => 'ecommerce_watch_store_customize_partial_ecommerce_watch_store_woocommerce_shop_page_sidebar', ) );

    // Woocommerce Shop Page Sidebar
	$wp_customize->add_setting( 'ecommerce_watch_store_woocommerce_shop_page_sidebar',array(
		'default' => 0,
		'transport' => 'refresh',
		'sanitize_callback' => 'ecommerce_watch_store_switch_sanitization'
    ) );
    $wp_customize->add_control( new ecommerce_watch_store_Toggle_Switch_Custom_Control( $wp_customize, 'ecommerce_watch_store_woocommerce_shop_page_sidebar',array(
		'label' => esc_html__( 'Shop Page Sidebar','ecommerce-watch-store' ),
		'section' => 'ecommerce_watch_store_woocommerce_section'
    )));

    $wp_customize->add_setting('ecommerce_watch_store_shop_page_layout',array(
        'default' => 'Right Sidebar',
        'sanitize_callback' => 'ecommerce_watch_store_sanitize_choices'
	));
	$wp_customize->add_control('ecommerce_watch_store_shop_page_layout',array(
        'type' => 'select',
        'label' => __('Shop Page Sidebar Layout','ecommerce-watch-store'),
        'section' => 'ecommerce_watch_store_woocommerce_section',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','ecommerce-watch-store'),
            'Right Sidebar' => __('Right Sidebar','ecommerce-watch-store'),
        ),
	) );

    // Selective Refresh
	$wp_customize->selective_refresh->add_partial( 'ecommerce_watch_store_woocommerce_single_product_page_sidebar', array( 'selector' => '.single-product #sidebar', 
		'render_callback' => 'ecommerce_watch_store_customize_partial_ecommerce_watch_store_woocommerce_single_product_page_sidebar', ) );

    //Woocommerce Single Product page Sidebar
	$wp_customize->add_setting( 'ecommerce_watch_store_woocommerce_single_product_page_sidebar',array(
		'default' => 0,
		'transport' => 'refresh',
		'sanitize_callback' => 'ecommerce_watch_store_switch_sanitization'
    ) );
    $wp_customize->add_control( new ecommerce_watch_store_Toggle_Switch_Custom_Control( $wp_customize, 'ecommerce_watch_store_woocommerce_single_product_page_sidebar',array(
		'label' => esc_html__( 'Single Product Sidebar','ecommerce-watch-store' ),
		'section' => 'ecommerce_watch_store_woocommerce_section'
    )));

   	$wp_customize->add_setting('ecommerce_watch_store_single_product_layout',array(
        'default' => 'Right Sidebar',
        'sanitize_callback' => 'ecommerce_watch_store_sanitize_choices'
	));
	$wp_customize->add_control('ecommerce_watch_store_single_product_layout',array(
        'type' => 'select',
        'label' => __('Single Product Sidebar Layout','ecommerce-watch-store'),
        'section' => 'ecommerce_watch_store_woocommerce_section',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','ecommerce-watch-store'),
            'Right Sidebar' => __('Right Sidebar','ecommerce-watch-store'),
        ),
	) );
    //Products per page
    $wp_customize->add_setting('ecommerce_watch_store_products_per_page',array(
		'default'=> '9',
		'sanitize_callback'	=> 'ecommerce_watch_store_sanitize_float'
	));
	$wp_customize->add_control('ecommerce_watch_store_products_per_page',array(
		'label'	=> __('Products Per Page','ecommerce-watch-store'),
		'description' => __('Display on shop page','ecommerce-watch-store'),
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 50,
        ),
		'section'=> 'ecommerce_watch_store_woocommerce_section',
		'type'=> 'number',
	));

    //Products per row
    $wp_customize->add_setting('ecommerce_watch_store_products_per_row',array(
		'default'=> '3',
		'sanitize_callback'	=> 'ecommerce_watch_store_sanitize_choices'
	));
	$wp_customize->add_control('ecommerce_watch_store_products_per_row',array(
		'label'	=> __('Products Per Row','ecommerce-watch-store'),
		'description' => __('Display on shop page','ecommerce-watch-store'),
		'choices' => array(
            '2' => '2',
			'3' => '3',
			'4' => '4',
        ),
		'section'=> 'ecommerce_watch_store_woocommerce_section',
		'type'=> 'select',
	));


	//Products padding
	$wp_customize->add_setting('ecommerce_watch_store_products_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ecommerce_watch_store_products_padding_top_bottom',array(
		'label'	=> __('Products Padding Top Bottom','ecommerce-watch-store'),
		'description'	=> __('Enter a value in pixels. Example:20px','ecommerce-watch-store'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'ecommerce-watch-store' ),
        ),
		'section'=> 'ecommerce_watch_store_woocommerce_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting('ecommerce_watch_store_products_padding_left_right',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ecommerce_watch_store_products_padding_left_right',array(
		'label'	=> __('Products Padding Left Right','ecommerce-watch-store'),
		'description'	=> __('Enter a value in pixels. Example:20px','ecommerce-watch-store'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'ecommerce-watch-store' ),
        ),
		'section'=> 'ecommerce_watch_store_woocommerce_section',
		'type'=> 'text'
	));

	//Products box shadow
	$wp_customize->add_setting( 'ecommerce_watch_store_products_box_shadow', array(
		'default'              => '',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'ecommerce_watch_store_sanitize_number_range'
	) );
	$wp_customize->add_control( 'ecommerce_watch_store_products_box_shadow', array(
		'label'       => esc_html__( 'Products Box Shadow','ecommerce-watch-store' ),
		'section'     => 'ecommerce_watch_store_woocommerce_section',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	//Products border radius
    $wp_customize->add_setting( 'ecommerce_watch_store_products_border_radius', array(
		'default'              => '0',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'ecommerce_watch_store_sanitize_number_range'
	) );
	$wp_customize->add_control( 'ecommerce_watch_store_products_border_radius', array(
		'label'       => esc_html__( 'Products Border Radius','ecommerce-watch-store' ),
		'section'     => 'ecommerce_watch_store_woocommerce_section',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting('ecommerce_watch_store_products_btn_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ecommerce_watch_store_products_btn_padding_top_bottom',array(
		'label'	=> __('Products Button Padding Top Bottom','ecommerce-watch-store'),
		'description'	=> __('Enter a value in pixels. Example:20px','ecommerce-watch-store'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'ecommerce-watch-store' ),
        ),
		'section'=> 'ecommerce_watch_store_woocommerce_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting('ecommerce_watch_store_products_btn_padding_left_right',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ecommerce_watch_store_products_btn_padding_left_right',array(
		'label'	=> __('Products Button Padding Left Right','ecommerce-watch-store'),
		'description'	=> __('Enter a value in pixels. Example:20px','ecommerce-watch-store'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'ecommerce-watch-store' ),
        ),
		'section'=> 'ecommerce_watch_store_woocommerce_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'ecommerce_watch_store_products_button_border_radius', array(
		'default'              => '0',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'ecommerce_watch_store_sanitize_number_range'
	) );
	$wp_customize->add_control( 'ecommerce_watch_store_products_button_border_radius', array(
		'label'       => esc_html__( 'Products Button Border Radius','ecommerce-watch-store' ),
		'section'     => 'ecommerce_watch_store_woocommerce_section',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	//Products Sale Badge
	$wp_customize->add_setting('ecommerce_watch_store_woocommerce_sale_position',array(
        'default' => 'right',
        'sanitize_callback' => 'ecommerce_watch_store_sanitize_choices'
	));
	$wp_customize->add_control('ecommerce_watch_store_woocommerce_sale_position',array(
        'type' => 'select',
        'label' => __('Sale Badge Position','ecommerce-watch-store'),
        'section' => 'ecommerce_watch_store_woocommerce_section',
        'choices' => array(
            'left' => __('Left','ecommerce-watch-store'),
            'right' => __('Right','ecommerce-watch-store'),
        ),
	) );

	$wp_customize->add_setting('ecommerce_watch_store_woocommerce_sale_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ecommerce_watch_store_woocommerce_sale_font_size',array(
		'label'	=> __('Sale Font Size','ecommerce-watch-store'),
		'description'	=> __('Enter a value in pixels. Example:20px','ecommerce-watch-store'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'ecommerce-watch-store' ),
        ),
		'section'=> 'ecommerce_watch_store_woocommerce_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting('ecommerce_watch_store_woocommerce_sale_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ecommerce_watch_store_woocommerce_sale_padding_top_bottom',array(
		'label'	=> __('Sale Padding Top Bottom','ecommerce-watch-store'),
		'description'	=> __('Enter a value in pixels. Example:20px','ecommerce-watch-store'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'ecommerce-watch-store' ),
        ),
		'section'=> 'ecommerce_watch_store_woocommerce_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting('ecommerce_watch_store_woocommerce_sale_padding_left_right',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('ecommerce_watch_store_woocommerce_sale_padding_left_right',array(
		'label'	=> __('Sale Padding Left Right','ecommerce-watch-store'),
		'description'	=> __('Enter a value in pixels. Example:20px','ecommerce-watch-store'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'ecommerce-watch-store' ),
        ),
		'section'=> 'ecommerce_watch_store_woocommerce_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'ecommerce_watch_store_woocommerce_sale_border_radius', array(
		'default'              => '100',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'ecommerce_watch_store_sanitize_number_range'
	) );
	$wp_customize->add_control( 'ecommerce_watch_store_woocommerce_sale_border_radius', array(
		'label'       => esc_html__( 'Sale Border Radius','ecommerce-watch-store' ),
		'section'     => 'ecommerce_watch_store_woocommerce_section',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

    //Related Products
	$wp_customize->add_setting( 'ecommerce_watch_store_related_product_show_hide',array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'ecommerce_watch_store_switch_sanitization'
    ) );
    $wp_customize->add_control( new ecommerce_watch_store_Toggle_Switch_Custom_Control( $wp_customize, 'ecommerce_watch_store_related_product_show_hide',array(
        'label' => esc_html__( 'Show / Hide Related product','ecommerce-watch-store' ),
        'section' => 'ecommerce_watch_store_woocommerce_section'
    )));

}

add_action( 'customize_register', 'ecommerce_watch_store_customize_register' );

load_template( trailingslashit( get_template_directory() ) . '/inc/logo/logo-resizer.php' );

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Ecommerce_Watch_Store_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	*/
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/inc/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'Ecommerce_Watch_Store_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section( new Ecommerce_Watch_Store_Customize_Section_Pro( $manager,'ecommerce_watch_store_go_pro', array(
			'priority'   => 1,
			'title'    => esc_html__( 'WATCH STORE PRO', 'ecommerce-watch-store' ),
			'pro_text' => esc_html__( 'UPGRADE PRO', 'ecommerce-watch-store' ),
			'pro_url'  => esc_url('https://www.buywptemplates.com/products/watch-store-wordpress-theme'),
		) )	);

		// Register sections.
		$manager->add_section(new Ecommerce_Watch_Store_Customize_Section_Pro($manager,'ecommerce_watch_store_get_started_link',array(
			'priority'   => 1,
			'title'    => esc_html__( 'DOCUMENTATION', 'ecommerce-watch-store' ),
			'pro_text' => esc_html__( 'DOCS', 'ecommerce-watch-store' ),
			'pro_url'  => esc_url('https://demos.buywptemplates.com/demo/docs/free-ecommerce-watch-store/'),
		)));
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'ecommerce-watch-store-customize-controls', trailingslashit( get_template_directory_uri() ) . '/assets/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'ecommerce-watch-store-customize-controls', trailingslashit( get_template_directory_uri() ) . '/assets/css/customize-controls.css' );
	}
}

// Doing this customizer thang!
Ecommerce_Watch_Store_Customize::get_instance();
