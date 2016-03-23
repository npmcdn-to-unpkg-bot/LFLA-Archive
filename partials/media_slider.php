<div id="media-archive__features" class="fs-grid archive__featured">

<?php 
  $features = get_field('featured');
  if($features): ?>
  <div class="fs-row"><div class="fs-cell fs-all-full"><div class="archive__slider fs__carousel" data-carousel-options='{"contained":false}'>
  <?php $i = 0; foreach ( $features as $post ) : setup_postdata( $post ); 
  $thumb_id = get_post_thumbnail_id();
  $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'large', true);
  $thumb_url = $thumb_url_array[0];
?>

<div class="hero slider hero relative bg--gray hero--overlay hero--bg" style="background-image: url(<?php echo $thumb_url; ?>);">
<a href="<?php the_permalink(); ?>" class="covered"></a>
<div class="centered centered--full">
<div class="fs-row">
<div class="fs-cell fs-lg-9 fs-md-5 fs-sm-3 fs-centered text-center relative">
<br>
<?php echo featured_category(); ?>
<br>
<span class="title title__md color--white"><?php the_title(); ?></span><br>
<div class="archive__featured-icons" style="display:none;">
<?php if(get_field('gallery')): ?><span class="ss-gizmo ss-picture"></span><?php endif; ?>
<?php if(get_field('podcast')): ?><span class="ss-gizmo ss-music"></span><?php endif; ?>
<?php if(get_field('video')): ?><span class="ss-gizmo ss-video"></span><?php endif; ?>
</div>
<em><span class="title title__sm color--white"><?php the_field('event_subtitle'); ?></span></em><br>
<span class="accent accent__sm color--white"><?php echo tribe_get_start_date($post, false, 'M d, Y'); ?></span>
</div>
</div>
</div>
</div>

<?php $i++; endforeach; echo '</div></div></div>'; endif; wp_reset_postdata(); ?>

</div>