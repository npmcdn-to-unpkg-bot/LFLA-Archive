<?php 
  $width = "fs-lg-fifth fs-md-half fs-sm-full archive__latest__grid-item equal";
  
  $searchQuery = $_GET['query'];
  $date = $_GET['date'];
  $date = '2012';

  $events = tribe_get_events( array(
    'posts_per_page' => 15,
    'order'          => 'DESC',
    //'post_status'    => 'publish',
    //'post_type'      => 'tribe_events',
    'end_date' => current_time( 'Y-m-d' ),
    //'meta_key'       => '_thumbnail_id',
    //'orderby'        => '_EventStartDate',  
    //'s'              => $searchQuery,
    'meta_query'  => array(
      //'relation'    => 'AND',
        array(
        //'key' => '_EventStartDate',
        //'value' => '1995',
        //'type' => 'DATE',
        //'compare' => '<='
      ),
    ) 
  ));
  $current_posts = get_posts( $current_args );
?>


<div id="media-archive__latest">
  <div class="iso-grid fs-row archive__latest">
    <?php foreach ( $events as $post ) : setup_postdata( $post ); ?>
    <div class="iso-grid__item fs-cell <?php echo $width; ?>">
      <div>
        <a href="<?php the_permalink(); ?>" class="coveredss"></a>
        <?php 
          if (has_post_thumbnail()){
            //the_post_thumbnail('original', array('class' => 'archive__latest-thumb img-responsive'));
            $thumb_id = get_post_thumbnail_id();
            $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
            $thumb = $thumb_url_array[0];
          } else {
            $images = get_field('gallery');
            $image = $images[0];
            $imageid = $image['id'];
            if($images){
              //echo '<img class="archive__latest-thumb img-responsive" src="' .$image['sizes']['large'].'" alt="'. $image['alt'].'" />';
              $thumb = $image['sizes']['large'];
            } else {
              //echo 'hello';
              echo '<div class="hero hero--xs archive__latest-thumb bg--blue"></div>';  
            } 
          }
        ?>
        <div class="archive__latest-thumb" style="background-image:url(<?php echo $thumb; ?>);"></div>
        <?php echo media_category(); ?>
        <header class="bg--white">
          <?php if(get_field('event_speaker')): ?><span class="accent accent__sm"><?php the_field('event_speaker'); ?></span><br><?php endif; ?>
          <span class="accent accent__sm"><?php echo tribe_get_start_date( $post, false, 'M Y' ); ?></span><br>
          <span class="title title__xs"><?php echo strip_tags(get_the_title()); ?></span> <?php if(get_field('event_subtitle')):?>— <?php endif; ?>
          <em><span class="title title__xxs"><?php echo strip_tags(get_field('event_subtitle')); ?></span></em><br>
          
          <!--<?php if(get_field('gallery')): ?><span class="ss-gizmo ss-gallery"></span><?php endif; ?>-->
          <!--<?php if(get_field('podcast')): ?><span class="ss-gizmo ss-music"></span><?php endif; ?>-->
          <!--<?php if(get_field('video')): ?><span class="ss-gizmo ss-video"></span><?php endif; ?>-->
        </header>
      </div>
    </div>
    <?php endforeach; wp_reset_postdata(); ?>

    <?php echo do_shortcode('[ajax_load_more post_type="post, tribe_events" offset="10" posts_per_page="10" pause="true" transition="fade" images_loaded="true"]' );?>

  </div>
</div>
