<div class="event-header relative">
  <div class="event-header__content">
    <div class="fs-row">
      <div class="fs-cell fs-all-full">
        <div class="event-header__cats"><?php echo media_category(); ?></div>
        <h1 class="event-header__title"><?php the_title(); ?></h1>
        <div class="evnet-header__details">
          <em><span class="title title__sm color--white"><?php the_field('event_subtitle'); ?></span></em><br>
          <em><span class="title title__sm color--white">
            <?php if(get_field('event_speaker')): ?><?php the_field('event_speaker'); ?> | 
            <?php endif; ?><?php echo tribe_get_start_date( $post, false, 'M d, Y' ); ?>
          </span></em>
        </div>
      </div>
    </div>
  </div>
  <div class="archive__single-bg covered" style="background-image:url(<?php echo $thumb; ?>);"></div>
</div>

<div class="wrappers" style="display:none;">
  <div class="hero relative">
    <div class='centered centered--bottom centered--full' style="z-index: 60">
      <div class="fs-row">
        <div class="fs-cell fs-lg-12 fs-md-6 fs-sm-3">
          <div class="relative">
            <?php echo media_category(); ?>
            <br>
            <span class="archive__single-title title title__md color--white"><?php the_title(); ?></span><br>
            <em><span class="title title__sm color--white"><?php the_field('event_subtitle'); ?></span></em><br>
            <em><span class="title title__sm color--white"><?php if(get_field('event_speaker')): ?><?php the_field('event_speaker'); ?> | <?php endif; ?><?php echo tribe_get_start_date( $post, false, 'M d, Y' ); ?></span></em>
          </div>
        </div>
      </div>
    </div>
    <div class="covered archive__single-bg--wrapper" style="background: #000">
      <div class="archive__single-bg covered" style="background-image:url(<?php echo $thumb; ?>);"></div>
    </div>
  </div>
</div>