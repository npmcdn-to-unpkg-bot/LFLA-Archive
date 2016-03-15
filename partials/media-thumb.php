<?php 

  $thumb_id = get_post_thumbnail_id();
  $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
  
  $images = get_field('gallery');
  $image = $images[0];
  $imageid = $image['id'];

  if ($thumb_id) {
    $thumb_url = $thumb_url_array[0];  
  } else {
    $thumb_url = $image['sizes']['large'];
  }
  
?>

<div class="fs-cell fs-lg-fourth fs-md-third fs-sm-half fs-contained">
  <div class="archive-item">
    <div class="archive-item__thumb bg--black" style="background-image:url(<?php echo $thumb_url; ?>);"></div>
    <div class="archive-item__content">
      <div class="wrapper">
        <span class="archive-item__speaker accent accent--sm color--gray"><?php the_field('event_speaker'); ?></span>
        <h3 class="archive-item__title title title--sm">
          <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>
      </div>
    </div>
  </div>
</div>
