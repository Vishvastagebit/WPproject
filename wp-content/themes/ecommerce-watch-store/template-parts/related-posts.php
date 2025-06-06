<?php
/**
 * Related posts based on categories and tags.
 * 
 */

$ecommerce_watch_store_archive_year  = get_the_time('Y'); 
$ecommerce_watch_store_archive_month = get_the_time('m'); 
$ecommerce_watch_store_archive_day   = get_the_time('d'); 


$ecommerce_watch_store_related_posts_taxonomy = get_theme_mod( 'ecommerce_watch_store_related_posts_taxonomy', 'category' );

$ecommerce_watch_store_post_args = array(
    'posts_per_page'    => absint( get_theme_mod( 'ecommerce_watch_store_related_posts_count', '3' ) ),
    'orderby'           => 'rand',
    'post__not_in'      => array( get_the_ID() ),
);

$ecommerce_watch_store_tax_terms = wp_get_post_terms( get_the_ID(), 'category' );
$ecommerce_watch_store_terms_ids = array();
foreach( $ecommerce_watch_store_tax_terms as $tax_term ) {
	$ecommerce_watch_store_terms_ids[] = $tax_term->term_id;
}

$ecommerce_watch_store_post_args['category__in'] = $ecommerce_watch_store_terms_ids; 

if(get_theme_mod('ecommerce_watch_store_related_post',true)==1){

$ecommerce_watch_store_related_posts = new WP_Query( $ecommerce_watch_store_post_args );

if ( $ecommerce_watch_store_related_posts->have_posts() ) : ?>
    <div class="related-post">
        <h3 class="py-3"><?php echo esc_html(get_theme_mod('ecommerce_watch_store_related_post_title','Related Post'));?></h3>
        <div class="row">
            <?php while ( $ecommerce_watch_store_related_posts->have_posts() ) : $ecommerce_watch_store_related_posts->the_post(); ?>
                <div class="col-xl-4 col-lg-6 col-md-6 col-12">
                    <article id="post-<?php the_ID(); ?>" <?php post_class('inner-service'); ?>>
                        <div class="post-main-box">
                            <?php if( get_theme_mod( 'ecommerce_watch_store_related_image_hide_show',true) == 1) { ?>
                                <div class="box-image">
                                    <?php 
                                        if(has_post_thumbnail()) { 
                                          the_post_thumbnail(); 
                                        }
                                    ?>
                                </div>
                            <?php } ?>
                            <h2 class="section-title"><a href="<?php echo esc_url(get_permalink()); ?>"><?php the_title();?><span class="screen-reader-text"><?php the_title(); ?></span></a></h2>
                            <?php if( get_theme_mod( 'ecommerce_watch_store_related_toggle_postdate',true) == 1 || get_theme_mod( 'ecommerce_watch_store_related_toggle_author',true) == 1 || get_theme_mod( 'ecommerce_watch_store_related_toggle_comments',true) == 1 || get_theme_mod( 'ecommerce_watch_store_related_toggle_time',true) == 1) { ?>
                                <div class="post-info p-2 my-3">
                                  <?php if(get_theme_mod('ecommerce_watch_store_related_toggle_postdate',true)==1){ ?>
                                    <i class="<?php echo esc_attr(get_theme_mod('ecommerce_watch_store_related_postdate_icon','fas fa-calendar-alt')); ?> me-2"></i><span class="entry-date"><a href="<?php echo esc_url( get_day_link( $ecommerce_watch_store_archive_year, $ecommerce_watch_store_archive_month, $ecommerce_watch_store_archive_day)); ?>"><?php echo esc_html( get_the_date() ); ?><span class="screen-reader-text"><?php echo esc_html( get_the_date() ); ?></span></a></span><span><?php echo esc_html(get_theme_mod('ecommerce_watch_store_related_post_meta_field_separator', '|'));?></span>
                                  <?php } ?>

                                  <?php if(get_theme_mod('ecommerce_watch_store_related_toggle_author',true)==1){ ?>
                                    <i class="<?php echo esc_attr(get_theme_mod('ecommerce_watch_store_related_author_icon','fas fa-user')); ?> me-2"></i><span class="entry-author"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' )) ); ?>"><?php the_author(); ?><span class="screen-reader-text"><?php the_author(); ?></span></a></span><span><?php echo esc_html(get_theme_mod('ecommerce_watch_store_related_post_meta_field_separator', '|'));?></span>
                                  <?php } ?>

                                  <?php if(get_theme_mod('ecommerce_watch_store_related_toggle_comments',true)==1){ ?>
                                    <i class="<?php echo esc_attr(get_theme_mod('ecommerce_watch_store_related_comments_icon','fa fa-comments')); ?> me-2" aria-hidden="true"></i><span class="entry-comments"><?php comments_number( __('0 Comment', 'ecommerce-watch-store'), __('0 Comments', 'ecommerce-watch-store'), __('% Comments', 'ecommerce-watch-store') ); ?></span><span><?php echo esc_html(get_theme_mod('ecommerce_watch_store_related_post_meta_field_separator', '|'));?></span>
                                  <?php } ?>

                                  <?php if(get_theme_mod('ecommerce_watch_store_related_toggle_time',true)==1){ ?>
                                    <i class="<?php echo esc_attr(get_theme_mod('ecommerce_watch_store_related_time_icon','fas fa-clock')); ?> me-2"></i><span class="entry-time"><?php echo esc_html( get_the_time() ); ?></span>
                                  <?php } ?>
                                  <?php echo esc_html (ecommerce_watch_store_edit_link()); ?>
                                </div>
                            <?php } ?>
                            <div class="new-text">
                                <div class="entry-content">
                                    <?php $ecommerce_watch_store_theme_lay = get_theme_mod( 'ecommerce_watch_store_excerpt_settings','Excerpt');
                                        if($ecommerce_watch_store_theme_lay == 'Content'){ ?>
                                          <?php the_content(); ?>
                                        <?php }
                                        if($ecommerce_watch_store_theme_lay == 'Excerpt'){ ?>
                                          <?php if(get_the_excerpt()) { ?>
                                            <p><?php $ecommerce_watch_store_excerpt = get_the_excerpt(); echo esc_html( ecommerce_watch_store_string_limit_words( $ecommerce_watch_store_excerpt, esc_attr(get_theme_mod('ecommerce_watch_store_related_posts_excerpt_number','30')))); ?></p>
                                          <?php }?>
                                        <?php }?>
                                </div>
                            </div>
                            <?php if( get_theme_mod('ecommerce_watch_store_related_button_text','Read More') != ''){ ?>
                                <div class="more-btn">
                                    <a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html(get_theme_mod('ecommerce_watch_store_related_button_text',__('Read More','ecommerce-watch-store')));?><span class="screen-reader-text"><?php echo esc_html(get_theme_mod('ecommerce_watch_store_related_button_text',__('Read More','ecommerce-watch-store')));?></span><span class="top-icon"></span></a>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="clearfix"></div>
                    </article>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
<?php endif;
wp_reset_postdata();

}