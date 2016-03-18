<?php 
  $width = "fs-lg-third fs-md-half fs-sm-full archive__latest__grid-item";
  
  $searchQuery = $_GET['query'];
  $date = $_GET['date'];
  $date = '2012';

  $current_args = array(
    'posts_per_page' => 25,
    'order'          => 'DESC',
    'post_status'    => 'publish',
    'post_type'      => 'tribe_events',
    'meta_key'       => '_thumbnail_id',
    'orderby'        => '_EventStartDate',  
    's'              => $searchQuery,
    'meta_query'  => array(
      //'relation'    => 'AND',
        array(
        //'key' => '_EventStartDate',
        //'value' => '1995',
        //'type' => 'DATE',
        //'compare' => '<='
      ),
    ) 
  );
  $current_posts = get_posts( $current_args );
?>


<div id="media-archive__latest">
  <div class="iso-grid fs-row archive__latest">
    <?php foreach ( $current_posts as $post ) : setup_postdata( $post ); ?>
    <div class="iso-grid__item fs-cell <?php echo $width; ?>">
      <div>
        <a href="<?php the_permalink(); ?>" class="covered"></a>
        <?php $type = get_field('event_type'); ?>
        <?php 
          if($type == 'aloud_centrallib') {
            $type = 'Aloud';
          } 
        ?>

        <span class="archive__latest-category accent"><?php echo $type; ?></span>
        <?php 
          if (has_post_thumbnail()){
            the_post_thumbnail('original', array('class' => 'archive__latest-thumb img-responsive'));
          } else {
            $images = get_field('gallery');
            $image = $images[0];
            $imageid = $image['id'];
            if($images){
              echo '<img class="archive__latest-thumb img-responsive" src="' .$image['sizes']['large'].'" alt="'. $image['alt'].'" />';
            } else {
              echo '<div class="hero hero--xs archive__latest-thumb bg--blue"></div>';  
            } 
          }
        ?>
        <header class="text-center">
          <?php if(get_field('event_speaker')): ?><span class="accent accent__sm"><?php the_field('event_speaker'); ?></span><br><?php endif; ?>
          <span class="title title__xs"><?php echo strip_tags(get_the_title()); ?></span><br>
          <span class="accent accent__sm"><?php echo tribe_get_start_date(); ?></span><br>
        </header>
      </div>
    </div>
    <?php endforeach; wp_reset_postdata(); ?>
    <?php echo do_shortcode('[ajax_load_more post_type="tribe_events" offset="24" transition="none" images_loaded="true"]' );?>

  </div>
</div>
