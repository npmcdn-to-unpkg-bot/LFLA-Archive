<div id="media-archive__features" class="fs-grid archive__featured">
  <div class="archive__slider fs__carousel" data-carousel-options='{"contained":false}'>

<?php 
  $features = get_field('featured');
  if($features): 
  $i = 0; foreach ( $features as $post ) : setup_postdata( $post ); 
  $thumb_id = get_post_thumbnail_id();
  $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'large', true);
  $thumb_url = $thumb_url_array[0];
?>
  <div>
    <div class="fs-row">
      <div class="fs-cell fs-all-full">
        <div class="fs-cell fs-lg-8 fs-md-3 fs-sm-3 fs-contained">
          <div class="hero slider hero relative bg--gray hero--bg" style="background-image: url(<?php echo $thumb_url; ?>);"></div>
        </div>
        <div class="fs-cell fs-lg-4 fs-md-3 fs-sm-3 fs-contained">
          <div class="hero relative bg--bgGray">
            <div class="centered centered--full text-center wrapper">
              <?php echo featured_category(); ?>
              <br>
              <span class="accent accent__sm"><?php echo tribe_get_start_date($post, false, 'M d, Y'); ?></span><br>
              <span class="title"><?php the_title(); ?></span><br>
              <em><span class="title title__sm "><?php the_field('event_subtitle'); ?></span></em><br>
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
    

<?php $i++; endforeach; endif; wp_reset_postdata(); ?>

  </div>
</div>
