<?php
/**
 * The template part for displaying post
 *
 * @package VW Maintenance Services 
 * @subpackage vw_maintenance_services
 * @since VW Maintenance Services 1.0
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class('inner-service'); ?>>
  <div class="post-main-box">
    <?php
      if ( ! is_single() ) {

        // If not a single post, highlight the gallery.
        if ( get_post_gallery() ) {
          echo '<div class="entry-gallery">';
            echo ( get_post_gallery() );
          echo '</div>';
        };
      };
    ?>
    <div class="new-text">
      <h3 class="section-title"><?php the_title();?></h3>
      <div class="post-info">
        <span class="entry-date"><?php the_date(); ?></span><span>|</span>
        <span class="entry-author"> <?php the_author(); ?></span>
        <hr>
      </div>
      <p><?php $excerpt = get_the_excerpt(); echo esc_html( vw_maintenance_services_string_limit_words( $excerpt,20 ) ); ?></p>
      <div class="content-bttn">
        <a class="view-more" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e( 'Read More', 'vw-maintenance-services' ); ?><i class="fa fa-angle-right"></i></a>
      </div>
    </div>
  </div>
</div>