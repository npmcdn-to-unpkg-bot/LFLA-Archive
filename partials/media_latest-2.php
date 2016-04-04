<?php 
  $width = "fs-xl-fifth fs-lg-fourth fs-md-half fs-sm-full archive__latest__grid-item equal";

  $tax_query = array('relation' => 'AND');

  if (isset($program)) {
    $tax_query[] =  array(
      'taxonomy' => 'tribe_events_cat',
      'field'    => 'slug',
      'terms'    => $program,
    );
  }

  if (isset($venue)) {
    $venue_query[] =  array(
      'key'     => '_EventVenueID',
      'value'   => $venue,
      'compare' => 'LIKE',
    );
  }

  //var_dump($program);

  //$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

  if ( get_query_var('paged') ) {
    $paged = get_query_var('paged');
  } else if ( get_query_var('page') ) {
    $paged = get_query_var('page');
  } else {
    $paged = 1;
  }

  $temp = $wp_query; 
  $wp_query = null; 
  $wp_query = new WP_Query(); 

  $today = date("Y-m-d");  //today's date in MySQL format without the time. Used to compare start date custom field in events. 

  $current_args = array(
    'posts_per_page' => 15,
    'order'          => 'DESC',
    'post_status'    => 'publish',
    'post_type'      => 'tribe_events',
    'eventDisplay'   => 'past',
    //'meta_key'       => '_EventStartDate',
    //'orderby'        => 'meta_value_num', 
    'paged'          => $paged,
    'tax_query'      => $tax_query,
    's'              => $searchQuery,
    'meta_query'     => array(
      array(
        'key'     => '_EventStartDate',
        'value'   => $eventdate,
        'compare' => 'LIKE',
      ),
      array(
        'key'     => '_EventVenueID',
        'value'   => $venue,
        'compare' => 'LIKE',
      ),
    ),
  );
  $wp_query->query($current_args); 
?>

<div id="media-archive__latest">
  <div class="iso-grid fs-row archive__latest">
    <?php if ( have_posts() ) : while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
    <?php #foreach ( $events as $post ) : setup_postdata( $post ); ?>
    <div class="iso-grid__item fs-cell <?php echo $width; ?>">
      <div>
        <a href="<?php the_permalink(); ?>" class="covered"></a>
        <?php 
          $thumb_id = get_post_thumbnail_id();
          $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'large', true);
          $images = get_field('gallery');
          $image = $images[0];
          $imageid = $image['id'];

          if($images){

            $thumb = $image['sizes']['large'];

          } else {

            if(has_post_thumbnail()){

              $thumb = $thumb_url_array[0];

            } else {

              $thumb = '/assets/img/comingsoon.png';

            }

          }
        ?>
        <div class="archive__latest-thumb" style="background-image:url(<?php echo $thumb; ?>);"></div>
        <?php echo media_category(); ?>
        <header class="bg--white">
          <span class="accent accent__sm"><?php echo tribe_get_start_date( $post, false, 'M d, Y' ); ?></span><br>
          <span class="title title__xs"><?php echo strip_tags(get_the_title()); ?></span> <?php if(get_field('event_speaker')):?>— <?php endif; ?>
          <?php if(get_field('event_speaker')): ?><em><span class="title title__xxs"><?php echo strip_tags(get_field('event_speaker')); ?></span></em><br><?php endif; ?>
          
          <!--<?php if(get_field('gallery')): ?><span class="ss-gizmo ss-gallery"></span><?php endif; ?>-->
          <!--<?php if(get_field('podcast')): ?><span class="ss-gizmo ss-music"></span><?php endif; ?>-->
          <!--<?php if(get_field('video')): ?><span class="ss-gizmo ss-video"></span><?php endif; ?>-->
        </header>
      </div>
    </div>
    <?php endwhile; else :?>

    <div class="iso-grid__item fs-cell fs-all-full">
      <div class="hero bg--bgGray relative">
        <div class="centered text-center">
          <span class="title title--md">Sorry, no results.</span><br>
          <a href="/">Go back to the Media Archive</a>
        </div>
      </div>
    </div>

    <?php endif; ?>

    <div class="iso-grid__item archive__latest__grid-item fs-cell fs-all-full">
      <?php numericPostsNav(); ?>
    </div>

    <?php 
      $wp_query = null; 
      $wp_query = $temp;  // Reset
    ?>

  </div>
</div>
