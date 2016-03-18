<div id="media-archive__features" class="fs-grid archive__featured">

<?php 
  $features = get_field('featured');
  $i = 0; foreach ( $features as $post ) : setup_postdata( $post ); 
  $thumb_id = get_post_thumbnail_id();
  $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'large', true);
  $thumb_url = $thumb_url_array[0];
?>

<?php if($i == 0): ?>
<div class="fs-row" style="display:none;">
  <div id="feature-<?php echo $i ?>" class="fs-cell fs-all-full">
    <a href="<?php the_permalink(); ?>" class="covered"></a>
    <div class="wrapper">
      <div class="hero hero bg--gray" style="background-image: url(<?php echo $thumb_url ?>)"></div>
    </div>
    <div class="fs-row">
      <div class="fs-cell fs-all-full">
        <div class="fs-cell fs-all-full text-center">
        <br>
        <span class="accent accent__sm"><?php the_field('event_speaker'); ?></span><br>
        <span class="title title__sm"><?php the_title(); ?></span><br>
        <span class="accent accent__sm"><?php the_field('event_subtitle'); ?></span><br>
      </div>
      </div>
    </div>
  </div>
</div>
<hr class="invisible">
<?php endif; ?>

<?php if($i == 1): ?><div class="fs-row equalized" data-equalize-options='{"target":".equalized__element"}'><?php endif; ?>

<?php if($i > 0): ?>
<div id="feature-<?php echo $i ?>" class="archive__featured-item fs-cell fs-all-half fs-sm-full equalized__element">
  <a href="<?php the_permalink(); ?>" class="covered"></a>
  <div class="wrapper">
    <img src="<?php echo $thumb_url ?>" class="img-responsive" ?>
    <div class="fs-row">
      <div class="fs-cell fs-all-full text-center">
        <br>
        <span class="accent accent__sm"><?php the_field('event_speaker'); ?></span><br>
        <span class="title title__sm"><?php the_title(); ?></span><br>
        <span class="accent accent__sm"><?php the_field('event_subtitle'); ?></span><br>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>

<?php if($i == 2): ?></div><?php endif; ?>

<?php $i++; endforeach; wp_reset_postdata(); ?>

</div>