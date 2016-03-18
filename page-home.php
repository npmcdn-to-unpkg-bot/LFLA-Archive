<?php 
Themewrangler::setup_page('new_default|not default','new_vendor | new_scripts');get_header('v2'/***Template Name: Home */); 
$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;


$current_args = array(
  'posts_per_page' => 24,
  'order'          => 'ASC',
  'orderby'        => 'title',
  'paged'          => $paged,
  's'              => 'byrne'
);

$current_posts = get_posts( $current_args );
$current_id = $current_posts[0]->ID;

$query = new WP_Query( $past_args );
$past_posts = $query->get_posts();

?>

<div class="hero hero--sm"></div>

<?php echo $event_speaker; ?>

<div class="fs-grid">
<div class="fs-row">
<div class="fs-cell fs-all-full">

<?php foreach ( $current_posts as $post ) : setup_postdata( $post ); ?>
<?php include locate_template('partials/media-thumb.php' );?>
<?php endforeach; wp_reset_postdata(); ?>

<?php echo do_shortcode('[ajax_load_more offset="10" posts_per_page="12" meta_key="_thumbnail_id" meta_compare="EXISTS" button_label="Load More" button_loading_label="Loading" post_type="post" pause="true" scroll="true" transition="fade"]' );?>

</div>
</div>
</div>

<?php get_footer('v2'); ?>
