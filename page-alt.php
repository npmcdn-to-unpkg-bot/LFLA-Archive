<?php  Themewrangler::setup_page('new_default|not default','new_vendor | new_scripts');get_header('v2'/***Template Name: Alt */);  ?>

<div id="media-archive" class="fs-grid">
<?php if ( !isset($_GET['query'])): ?>
<?php include locate_template('partials/media_slider.php');?>

  <?php if($hello): ?>
  <div class="page__header">
    <div class="fs-row">
      <div class="fs-cell fs-all-full text-center">
        <header>
          <h1 class="title title__xl"><?php the_title(); ?></h1>
        </header>
        <div class="title title__sm"><?php the_post(); the_content(); ?></div>
      </div>
    </div>
  </div>
  <?php endif; ?>

<?php endif; ?>
<?php include locate_template('partials/media_search.php');?>
<?php include locate_template('partials/media_latest.php');?>
</div>

<?php get_footer('v2'); ?>
