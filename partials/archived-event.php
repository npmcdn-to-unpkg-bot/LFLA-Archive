<div class="fs-grid archive__single">

<?php $images = get_field('gallery'); ?>
<?php 
  $bgImage = $images[0];
  $imageid = $bgImage['id'];
//  $bgImageUrl = $bgImage['sizes']['large']; 
//  if($images){
//    $bgImageUrl = $bgImage['sizes']['large']; 
//  } else {
//    $thumb_id = get_post_thumbnail_id();
//    $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'large', true);
//    $bgImageUrl = $thumb_url_array[0];
//  }
  $thumb_id = get_post_thumbnail_id();
  $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'large', true);
  $bgImageUrl = $thumb_url_array[0];
?>

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

<div class="wrappers">
  <div class="hero relative">
    <div class='centered centered--bottom centered--full' style="z-index: 60">
      <div class="fs-row">
        <div class="fs-cell fs-lg-12 fs-md-6 fs-sm-3">
          <div class="relative">
            <?php echo media_category(); ?>
            <br>
            <span class="archive__single-title title title__md color--white"><?php the_title(); ?></span><br><br>
            <em><span class="title title__sm color--white"><?php the_field('event_subtitle'); ?></span></em>
            <span class="accent color--white"><?php if(get_field('event_speaker')): ?><?php the_field('event_speaker'); ?> | <?php endif; ?><?php echo tribe_get_start_date( $post, false, 'M d, Y' ); ?></span>
          </div>
        </div>
      </div>
    </div>
    <div class="covered archive__single-bg--wrapper" style="background: #000">
      <div class="archive__single-bg covered" style="background-image:url(<?php echo $thumb; ?>);"></div>
    </div>
  </div>
</div>

<div class="archive__single-content">
  <div class="fs-row">
    <div class="fs-cell fs-all-full">
      <div class="">
        <hr class="invisible">
        <div class="title title__sm fs-cell fs-lg-7 fs-md-5 fs-sm-3"><?php echo strip_tags(get_the_content()); ?></div>

        <?php # Podcast ?>
        <?php if(get_field('podcast')): ?>
        <div class="fs-cell fs-lg-4 fs-lg-push-1 fs-md-5 fs-md-push-1 fs-sm-3 fs-right">
        <?php include locate_template('partials/media_podcast.php' );?>
        </div>
        <?php endif; ?>

        <br>
      </div>
    </div>
  </div>
</div>

<?php # Vimeo ?>
<?php if(get_field('video_embed')): ?>
<hr class="divider">
<header class="text-center"><span class="accent">Video from the Event</span></header>
<hr class="invisible compact">
<div class="fs-row">
<div class="fs-cell fs-lg-12 fs-md-6 fs-sm-3 fs-centered">
<div class="video-wrapper"><?php the_field('video_embed'); ?></div>
</div>
</div>
<?php endif; ?>

<?php if($images): ?>

<hr class="divider">
<header class="text-center"><span class="accent">Photo Gallery</span></header>
<hr class="invisible compact">
<div class="fs-row iso-grid">
<?php foreach($images as $image): ?>

<div class="fs-cell fs-lg-fourth fs-md-third fs-sm-3 iso-grid__item zoomin-gallery">
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

<?php include locate_template('partials/media_related.php' ); ?>
</div>