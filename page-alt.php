<?php  Themewrangler::setup_page('new_default|not default','new_vendor | new_scripts');get_header('v2'/***Template Name: Alt */);  ?>

<?php 
  $searchQuery = $_GET['query'];
  $program     = $_GET['program'];
  $eventdate   = $_GET['eventdate'];
  $venue       = $_GET['venue'];
  $subject     = $_GET['subject'];
?>

<div id="media-archive" class="fs-grid">
<?php if ( !isset($_GET['query'])): ?>
<?php if ( !isset($_GET['program'])): ?>
<?php include locate_template('partials/media_slider-3.php'); ?>


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
<?php endif; ?>
<?php include locate_template('partials/media_search.php');?>
<?php include locate_template('partials/media_latest.php');?>
</div>

<script>
  $(document).ready(function(){
    $('.archive__slider-slide').hover(
      function() {
        $(".archive__header").addClass('active');
        $(".archive__header .centered").addClass('active');
      },
      function() {
        $(".archive__header").removeClass('active');
        $(".archive__header .centered").removeClass('active');
      }
    );
  });
</script>

<?php get_footer('v2'); ?>
