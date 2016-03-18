<div class="fs-grid archive__single">

<?php $images = get_field('gallery'); ?>
<?php 
  $bgImage = $images[0];
  $imageid = $bgImage['id'];
  $bgImageUrl = $bgImage['sizes']['large']; 
  if(!$images){
    $thumb_id = get_post_thumbnail_id();
    $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'large', true);
    $bgImageUrl = $thumb_url_array[0];
  } else {
    $bgImageUrl = $bgImage['sizes']['large']; 
  }
?>

<div class="hero relative">
  <div class='centered centered--bottom' style="z-index: 60">
    <div class="fs-row">
      <div class="fs-cell fs-lg-10 fs-md-6 fs-sm-3 fs-centered">
        <div class="text-center">
          <span class="archive__single-title title title__md color--white"><?php the_title(); ?></span><br>
          <span class="accent color--white"><?php the_field('event_speaker'); ?> | <?php echo tribe_get_start_date(); ?></span>
        </div>
      </div>
    </div>
  </div>
  <div class="covered bg--black archive__single-bg--wrapper">
    <div class="archive__single-bg covered" style="background-image:url(<?php echo $bgImageUrl; ?>);"></div>
  </div>
</div>

<div class="archive__single-content">
  <div class="fs-row">
    <div class="fs-cell fs-all-full">
      <div class="text-center">
        <hr class="invisible">
        <div class="title title__xs fs-cell fs-lg-8 fs-md-5 fs-sm-3 fs-centered"><?php the_content(); ?></div>
        <br>
      </div>
    </div>
  </div>
</div>

<?php if($images): ?>

<hr class="divider">
<header class="text-center"><span class="accent">Photo Gallery</span></header>
<hr class="invisible compact">
<div class="fs-row iso-grid">
<?php foreach($images as $image): ?>

<div class="fs-cell fs-lg-fourth fs-md-third fs-sm-3 iso-grid__item ">
<?php 
  $height = $image['height'];
  $width =  $image['width']; 
  if($height > $width) {
    $size = "archive__single__gallery--tall";
  } else {
    $size = "archive__single__gallery--wide";
  }
?>
<a href="<?php echo $image['url']; ?>" class="zoomin archive__single__gallery-item <?php echo $size ?>" style="background-image:url(<?php echo $image['url']; ?>);"></a>
</div>

<?php endforeach; ?>
</div>

<?php endif; ?>

  <?php # Vimeo ?>
  <?php if(get_field('video_embed')): ?>
  <hr class="divider">
  <header class="text-center"><span class="accent">Video from the Event</span></header>
  <hr class="invisible compact">
  <div class="fs-row">
  <div class="fs-cell fs-lg-10 fs-md-6 fs-sm-3 fs-centered">
  <div class="video-wrapper"><?php the_field('video_embed'); ?></div>
  </div>
  </div>
  <?php endif; ?>

  <?php # Podcast ?>
  <?php if(get_field('podcast')): ?>
  <hr class="divider">
  <header class="text-center"><span class="accent">Podcast from the Event</span></header>
  <hr class="invisible compact">
  <div class="fs-row">
  <div class="fs-cell fs-lg-6 fs-md-6 fs-sm-3 fs-centered">
  <?php include locate_template('partials/media_podcast.php' );?>
  </div>
  </div>
  <?php endif; ?>

<?php include locate_template('partials/media_related.php' ); ?>
</div>