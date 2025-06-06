<?php
//about theme info
add_action( 'admin_menu', 'ecommerce_watch_store_gettingstarted' );
function ecommerce_watch_store_gettingstarted() {
	add_theme_page( esc_html__('About Ecommerce Watch Store ', 'ecommerce-watch-store'), esc_html__('About Ecommerce Watch Store', 'ecommerce-watch-store'), 'edit_theme_options', 'ecommerce_watch_store_guide', 'ecommerce_watch_store_mostrar_guide');
}

// Add a Custom CSS file to WP Admin Area
function ecommerce_watch_store_admin_theme_style() {
	wp_enqueue_style('ecommerce-watch-store-custom-admin-style', esc_url(get_template_directory_uri()) . '/inc/getstart/getstart.css');
	wp_enqueue_script('ecommerce-watch-store-tabs', esc_url(get_template_directory_uri()) . '/inc/getstart/js/tab.js');
}
add_action('admin_enqueue_scripts', 'ecommerce_watch_store_admin_theme_style');

//guidline for about theme
function ecommerce_watch_store_mostrar_guide() { 
	//custom function about theme customizer
	$ecommerce_watch_store_return = add_query_arg( array()) ;
	$ecommerce_watch_store_theme = wp_get_theme( 'ecommerce-watch-store' );
?>

<div class="wrap getting-started">
		<div class="getting-started__header">
	    	<div>
                <h2 class="tgmpa-notice-warning"></h2>
            </div>
			<div class="row">
				<div class="col-md-5 intro">
					<div class="pad-box">
						<h2><?php esc_html_e( 'Welcome to Ecommerce Watch Store ', 'ecommerce-watch-store' ); ?></h2>
						
						<p class="version"><?php esc_html_e( 'Version', 'ecommerce-watch-store' ); ?>: <?php echo esc_html($ecommerce_watch_store_theme['Version']);?></p>
						<span class="intro__version"><?php esc_html_e( 'Congratulations! You are about to use the most easy to use and flexible WordPress theme.', 'ecommerce-watch-store' ); ?>	
						</span>
    					
						<div class="powered-by">
							<p ><strong><?php esc_html_e( 'All our WordPress themes are modern, minimalist, 100% responsive, seo-friendly,feature-rich, and multipurpose that best suit designers, bloggers and other professionals who are working in the creative fields.', 'ecommerce-watch-store' ); ?></strong></p>
													
						</div>
					</div>
				</div>
				<div class="col-md-7">
					<div class="pro-links">
				    	<a href="<?php echo esc_url( ECOMMERCE_WATCH_STORE_LIVE_DEMO ); ?>" target="_blank"><?php esc_html_e('Live Demo', 'ecommerce-watch-store'); ?></a>
						<a href="<?php echo esc_url( ECOMMERCE_WATCH_STORE_BUY_NOW ); ?>" target="_blank"><?php esc_html_e('Buy Pro', 'ecommerce-watch-store'); ?></a>
						<a href="<?php echo esc_url( ECOMMERCE_WATCH_STORE_PRO_DOC ); ?>" target="_blank"><?php esc_html_e('Pro Documentation', 'ecommerce-watch-store'); ?></a>
					</div>
					<div class="install-plugins">
						<img src="<?php echo esc_url(get_template_directory_uri() . '/inc/getstart/images/responsive.png'); ?>" alt="" />
					</div>
				</div>
			</div>
			<h2 class="tg-docs-section intruction-title" id="section-4"><?php esc_html_e( '1) Setup Ecommerce Watch Store Theme', 'ecommerce-watch-store' ); ?></h2>
			<div class="row">
				<div class="theme-instruction-block col-md-7">
					<div class="pad-box">
	                    <p><?php esc_html_e( 'Ecommerce Watch Store is a sleek and user-friendly digital storefront designed for watch retailers and enthusiasts. With a modern and stylish layout, this theme creates a visually appealing online space, showcasing a wide range of watches in an easy-to-navigate format. Crafted for businesses in the watch industry, the theme offers an engaging online shopping experience for customers seeking quality timepieces. Its design is clean and sophisticated, ensuring that visitors can effortlessly browse through various watch collections, explore detailed product information, and make informed purchasing decisions. Tailored to cater to the needs of watch stores, this theme is not only aesthetically pleasing but also functional. This theme can be used by watch shop,Retail, Online Store, Watches, E-commerce, Fashion, watch store, minimal watch store, watch seller, watch business, watch vendor or a clock shop. Whwether you have jewelry store, glass wear, makeup, women fashion or perfume and fragrance, You can customize this theme for your niche. It provides a seamless and secure platform for transactions, enabling customers to explore the latest watch models, check prices, and complete their purchases with confidence. The responsive design ensures a consistent and enjoyable experience across different devices, including desktops, tablets, and smartphones. For businesses looking to establish a distinctive online presence, the Ecommerce Watch Store WordPress Theme allows for easy customization. You can personalize elements such as logos, colors, and fonts to align with your brand identity, creating a cohesive and memorable representation. The Ecommerce Watch Store WordPress Theme is an ideal solution for watch retailers aiming to thrive in the digital space. Its user-friendly design, functional features, and customization options make it a valuable tool for creating an attractive and efficient online watch store, catering to both the needs of the business and the preferences of watch enthusiasts.', 'ecommerce-watch-store' ); ?><p><br>
						<ol>
							<li><?php esc_html_e( 'Start','ecommerce-watch-store'); ?> <a target="_blank" href="<?php echo esc_url( admin_url('customize.php') ); ?>"><?php esc_html_e( 'Customizing','ecommerce-watch-store'); ?></a> <?php esc_html_e( 'your website.','ecommerce-watch-store'); ?> </li>
							<li><?php esc_html_e( 'Ecommerce Watch Store','ecommerce-watch-store'); ?> <a target="_blank" href="<?php echo esc_url( ECOMMERCE_WATCH_STORE_FREE_THEME_DOC ); ?>"><?php esc_html_e( 'Documentation','ecommerce-watch-store'); ?></a> </li>
						</ol>
                    </div>
              	</div>
				<div class="col-md-5">
					<div class="pad-box">
              			<img class="logo" src="<?php echo esc_url(get_template_directory_uri()); ?>/screenshot.png" alt="" />
              		 </div> 
              	</div>
            </div>
			<div class="col-md-12 text-block">
					<h2 class="dashboard-install-title"><?php esc_html_e( '2) Premium Theme Information.','ecommerce-watch-store'); ?></h2>
					<div class="row">
						<div class="col-md-7">
							<img src="<?php echo esc_url(get_template_directory_uri() . '/inc/getstart/images/responsive1.png'); ?>" alt="">
							<div class="pad-box">
								<h3><?php esc_html_e( 'Pro Theme Description','ecommerce-watch-store'); ?></h3>
	                    		<p class="pad-box-p"><?php esc_html_e( 'Ecommerce Watch Store is a sleek and user-friendly digital storefront designed for watch retailers and enthusiasts. With a modern and stylish layout, this theme creates a visually appealing online space, showcasing a wide range of watches in an easy-to-navigate format. Crafted for businesses in the watch industry, the theme offers an engaging online shopping experience for customers seeking quality timepieces. Its design is clean and sophisticated, ensuring that visitors can effortlessly browse through various watch collections, explore detailed product information, and make informed purchasing decisions. Tailored to cater to the needs of watch stores, this theme is not only aesthetically pleasing but also functional. It provides a seamless and secure platform for transactions, enabling customers to explore the latest watch models, check prices, and complete their purchases with confidence. The responsive design ensures a consistent and enjoyable experience across different devices, including desktops, tablets, and smartphones. For businesses looking to establish a distinctive online presence, the Ecommerce Watch Store WordPress Theme allows for easy customization. You can personalize elements such as logos, colors, and fonts to align with your brand identity, creating a cohesive and memorable representation. The Ecommerce Watch Store WordPress Theme is an ideal solution for watch retailers aiming to thrive in the digital space. Its user-friendly design, functional features, and customization options make it a valuable tool for creating an attractive and efficient online watch store, catering to both the needs of the business and the preferences of watch enthusiasts.', 'ecommerce-watch-store' ); ?><p>
	                    	</div>
						</div>
						<div class="col-md-5 install-plugin-right">
							<div class="pad-box">								
								<h3><?php esc_html_e( 'Pro Theme Features','ecommerce-watch-store'); ?></h3>
								<div class="dashboard-install-benefit">
									<ul>
										<li><?php esc_html_e( 'One click demo importer','ecommerce-watch-store'); ?></li>
										<li><?php esc_html_e( 'Global color option','ecommerce-watch-store'); ?></li>
										<li><?php esc_html_e( 'Responsive design','ecommerce-watch-store'); ?></li>
										<li><?php esc_html_e( 'Favicon, logo, title, and tagline customization','ecommerce-watch-store'); ?></li>
										<li><?php esc_html_e( 'Advanced color options and color pallets','ecommerce-watch-store'); ?></li>
										<li><?php esc_html_e( '100+ font family options','ecommerce-watch-store'); ?></li>
										<li><?php esc_html_e( 'Simple menu option','ecommerce-watch-store'); ?></li>
										<li><?php esc_html_e( 'SEO friendly','ecommerce-watch-store'); ?></li>
										<li><?php esc_html_e( 'Pagination option','ecommerce-watch-store'); ?></li>
										<li><?php esc_html_e( 'Compatible with different WordPress famous plugins like contact form 7','ecommerce-watch-store'); ?></li>
										<li><?php esc_html_e( 'Enable-Disable options on all sections','ecommerce-watch-store'); ?></li>
										<li><?php esc_html_e( 'Well sanitized as per WordPress standards.','ecommerce-watch-store'); ?></li>
										<li><?php esc_html_e( 'Responsive Layout for All Devices','ecommerce-watch-store'); ?></li>
										<li><?php esc_html_e( 'Footer customization options','ecommerce-watch-store'); ?></li>
										<li><?php esc_html_e( 'Fully integrated with the latest font awesome','ecommerce-watch-store'); ?></li>
										<li><?php esc_html_e( 'Background image option','ecommerce-watch-store'); ?></li>
										<li><?php esc_html_e( 'Custom Page Templates','ecommerce-watch-store'); ?></li>
										<li><?php esc_html_e( 'Allow To Set Site Title, Tagline, Logo','ecommerce-watch-store'); ?></li>
										<li><?php esc_html_e( 'Sticky post & comment threads','ecommerce-watch-store'); ?></li>
										<li><?php esc_html_e( 'Section reordering','ecommerce-watch-store'); ?></li>
										<li><?php esc_html_e( 'Customizable home page','ecommerce-watch-store'); ?></li>
										<li><?php esc_html_e( 'Footer widgets & editor style','ecommerce-watch-store'); ?></li>
										<li><?php esc_html_e( 'Social media feature','ecommerce-watch-store'); ?></li>
										<li><?php esc_html_e( 'Slider with unlimited number of slides','ecommerce-watch-store'); ?></li>
										<li><?php esc_html_e( 'Our Cleaning Services Section','ecommerce-watch-store'); ?></li>
										<li><?php esc_html_e( 'Testimonial Section','ecommerce-watch-store'); ?></li>
										<li><?php esc_html_e( 'Our Team Section','ecommerce-watch-store'); ?></li>
										<li><?php esc_html_e( 'Counter Section','ecommerce-watch-store'); ?></li>
										<li><?php esc_html_e( 'Our Project Section','ecommerce-watch-store'); ?></li>
										<li><?php esc_html_e( 'How We Work Section','ecommerce-watch-store'); ?></li>
										<li><?php esc_html_e( 'Pricing Plan Section','ecommerce-watch-store'); ?></li>
										<li><?php esc_html_e( 'Brand Section','ecommerce-watch-store'); ?></li>
										<li><?php esc_html_e( 'Instagram Feed','ecommerce-watch-store'); ?></li>
										<li><?php esc_html_e( 'Newsletter Section','ecommerce-watch-store'); ?></li>
										<li><?php esc_html_e( 'Blog post section','ecommerce-watch-store'); ?></li>								
										<li><?php esc_html_e( 'Contact page template','ecommerce-watch-store'); ?></li>	
										<li><?php esc_html_e( 'Shortcodes for the Custom Posttype','ecommerce-watch-store'); ?></li>			
									</ul>
								</div>
							</div>
						</div>
				</div>
			</div>
		</div>
		<div class="dashboard__blocks">
			<div class="row">
				<div class="col-md-3">
					<h3><?php esc_html_e( 'Get Support','ecommerce-watch-store'); ?></h3>
					<ol>
						<li><a target="_blank" href="<?php echo esc_url( ECOMMERCE_WATCH_STORE_SUPPORT ); ?>"><?php esc_html_e( 'Free Theme Support','ecommerce-watch-store'); ?></a></li>
						<li><a target="_blank" href="<?php echo esc_url( ECOMMERCE_WATCH_STORE_PRO_SUPPORT ); ?>"><?php esc_html_e( 'Premium Theme Support','ecommerce-watch-store'); ?></a></li>
					</ol>
				</div>

				<div class="col-md-3">
					<h3><?php esc_html_e( 'Getting Started','ecommerce-watch-store'); ?></h3>
					<ol>
						<li><?php esc_html_e( 'Start','ecommerce-watch-store'); ?> <a target="_blank" href="<?php echo esc_url( admin_url('customize.php') ); ?>"><?php esc_html_e( 'Customizing','ecommerce-watch-store'); ?></a> <?php esc_html_e( 'your website.','ecommerce-watch-store'); ?> </li>
					</ol>
				</div>
				<div class="col-md-3">
					<h3><?php esc_html_e( 'Help Docs','ecommerce-watch-store'); ?></h3>
					<ol>
						<li><a target="_blank" href="<?php echo esc_url( ECOMMERCE_WATCH_STORE_FREE_THEME_DOC ); ?>"><?php esc_html_e( 'Free Theme Documentation','ecommerce-watch-store'); ?></a></li>
						<li><a target="_blank" href="<?php echo esc_url( ECOMMERCE_WATCH_STORE_PRO_DOC ); ?>"><?php esc_html_e( 'Premium Theme Documentation','ecommerce-watch-store'); ?></a></li>
					</ol>
				</div>
				<div class="col-md-3">
					<h3><?php esc_html_e( 'Buy Premium','ecommerce-watch-store'); ?></h3>
					<ol>
						<a href="<?php echo esc_url( ECOMMERCE_WATCH_STORE_BUY_NOW ); ?>" target="_blank"><?php esc_html_e('Buy Pro', 'ecommerce-watch-store'); ?></a>
					</ol>
				</div>
			</div>
		</div>
	</div>

<?php } ?>