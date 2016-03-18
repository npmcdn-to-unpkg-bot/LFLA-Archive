<?php  Themewrangler::setup_page('new_default|not default','new_vendor | new_scripts');get_header('v2');  ?>

<div id="media-archive" class="fs-grid">
  <div id="media-archive__single"class="page__header">
    <div class="fs-row">
      <div class="fs-cell fs-lg-4 fs-md-full fs-sm-full hero hero--md relative">
        <div class="centered centered--full">
          <header>
            <span class="accent accent__sm"><?php the_field('event_date'); ?></span> | 
            <span class="accent accent__sm"><?php the_field('event_speaker'); ?></span>
            <h1 class="title"><?php the_title(); ?></h1>
            <hr class="divider compact">
            <span class="title title__xs"><?php the_field('event_subtitle'); ?></span>
          </header>
          <hr class="divider compact">
          <div><?php the_post(); the_content(); ?></div>
        </div>
      </div>
      <div class="fs-cell fs-lg-8 fs-md-full fs-sm-full hero hero--md relative">
        <?php $images = get_field('gallery'); ?>
        <div class="fs__carousel centered" data-carousel-options='{"autoHeight":true}'>
        <?php foreach($images as $image): ?>
        <div><img src="<?php echo $image['url']; ?>" class="img-responsive img-responsive--centered"></div>
        <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php get_footer('v2'); ?>