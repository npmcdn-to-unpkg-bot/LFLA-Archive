<?php 
  $width = "fs-lg-third fs-md-half fs-sm-half archive__latest__grid-item";

  $current_args = array(
    'posts_per_page' => 24,
    'order'          => 'DESC',
    'orderby'        => 'title',
    'post_status'    => 'private',
    'paged'          => $paged,
    //'orderby'        => 'rand',
    'meta_key'      => 'event_date',
    'orderby'        => 'meta_value_num',
    'meta_query' => array(
      array(
        'key' => 'gallery',
        'value'   => null,
        'compare' => 'NOT IN'
      )
    )
  );
  $current_posts = get_posts( $current_args );
  $current_id = $current_posts[0]->ID;
?>


<div id="media-archive__latest">
  <div class="iso-grid fs-row archive__latest">
    <?php foreach ( $current_posts as $post ) : setup_postdata( $post ); ?>
    <div class="iso-grid__item fs-cell <?php echo $width; ?>">
      <div>
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
              echo '<div class="hero hero--sm archive__latest-thumb bg--gray"></div>';  
            } 
          }
        ?>
        <header class="text-center">
          <span class="accent accent__sm"><?php the_field('event_date'); ?></span><br>
          <span class="accent accent__sm"><?php the_field('event_speaker'); ?></span><br>
          <span class="title title__xs"><?php the_title(); ?></span>
        </header>
      </div>
    </div>
    <?php endforeach; wp_reset_postdata(); ?>
    <?php echo do_shortcode('[ajax_load_more offset="24" button_label="Load More" button_loading_label="Loading" post_status="private" post_type="post" pause="true" scroll="false" transition="fade" posts_per_page="12"]' );?>

  </div>
</div>
