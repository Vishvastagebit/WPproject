<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Ecommerce Watch Store 
 */

get_header(); ?>

<?php do_action( 'ecommerce_watch_store_page_top' ); ?>

<main id="maincontent" class="middle-align pt-5" role="main"> 
    <div class="container">
        <?php $ecommerce_watch_store_theme_lay = get_theme_mod( 'ecommerce_watch_store_page_layout','One_Column');
            if($ecommerce_watch_store_theme_lay == 'One_Column'){ ?>
                <?php if(get_theme_mod('ecommerce_watch_store_single_page_breadcrumb1',true) == 1){ ?>
                    <div class="breadcrumbs">
                        <?php ecommerce_watch_store_the_breadcrumb(); ?>
                    </div>
                <?php }?>
                <?php while ( have_posts() ) : the_post();
                    get_template_part( 'template-parts/content-page'); 
                endwhile; ?>
        <?php }else if($ecommerce_watch_store_theme_lay == 'Right_Sidebar'){ ?>
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <?php if(get_theme_mod('ecommerce_watch_store_single_page_breadcrumb',true) == 1){ ?>
                        <div class="breadcrumbs">
                            <?php ecommerce_watch_store_the_breadcrumb(); ?>
                        </div>
                    <?php }?>
                    <?php while ( have_posts() ) : the_post();
                        get_template_part( 'template-parts/content-page'); 
                    endwhile; ?>
                </div>
                <div id="sidebar" class="col-lg-4 col-md-4">
                    <?php dynamic_sidebar('sidebar-2'); ?>
                </div>
            </div>
        <?php }else if($ecommerce_watch_store_theme_lay == 'Left_Sidebar'){ ?>
            <div class="row">
                <div id="sidebar" class="col-lg-4 col-md-4">
                    <?php dynamic_sidebar('sidebar-2'); ?>
                </div>
                <div class="col-lg-8 col-md-8">
                    <?php if(get_theme_mod('ecommerce_watch_store_single_page_breadcrumb',true) == 1){ ?>
                        <div class="breadcrumbs">
                            <?php ecommerce_watch_store_the_breadcrumb(); ?>
                        </div>
                    <?php }?>
                    <?php while ( have_posts() ) : the_post();
                        get_template_part( 'template-parts/content-page'); 
                    endwhile; ?>
                </div>
            </div>
        <?php }else {?>
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <?php if(get_theme_mod('ecommerce_watch_store_single_page_breadcrumb',true) == 1){ ?>
                        <div class="breadcrumbs">
                            <?php ecommerce_watch_store_the_breadcrumb(); ?>
                        </div>
                    <?php }?>
                    <?php while ( have_posts() ) : the_post();
                        get_template_part( 'template-parts/content-page'); 
                    endwhile; ?>
                </div>
                <div id="sidebar" class="col-lg-4 col-md-4">
                    <?php dynamic_sidebar('sidebar-2'); ?>
                </div>
            </div>
        <?php } ?>
        <?php echo esc_html (ecommerce_watch_store_edit_link()); ?>
    </div>
</main>

<?php do_action( 'ecommerce_watch_store_page_bottom' ); ?>

<?php get_footer(); ?>