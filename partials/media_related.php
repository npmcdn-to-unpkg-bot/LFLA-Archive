<?php
$orig_post = $post;
global $post;
$tags = wp_get_post_tags($post->ID);

if ($tags) {
$tag_ids = array();
foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
$args=array(
'tag__in' => $tag_ids,
'post__not_in' => array($post->ID),
'posts_per_page'=>4, // Number of related posts to display.
'caller_get_posts'=>1
);

$my_query = new wp_query( $args );

if ( have_posts() ): ?> 

<hr class="divider">
<header class="text-center"><span class="accent">Related Media</span></header>
<hr class="invisible compact">
<div class="relatedposts fs-row iso-grid">

<?php endif;

while( $my_query->have_posts() ) {
$my_query->the_post();
?>

<?php if(get_field('video_embed')): ?>
<div class="iso-grid__item fs-cell fs-lg-half fs-md-full fs-sm-3">
<div class="video-wrapper"><?php the_field('video_embed'); ?></div>
<div class="text-center"><?php the_title(); ?></div>
<hr class="compact">
</div>     
<?php endif; ?>

<?php if(get_field('podcast')): ?>
<div class="iso-grid__item fs-cell fs-lg-half fs-md-full fs-sm-3 text-center">
<a style="text-decoration: none;" class="title title__xs" href="<?php the_permalink(); ?>">Event: <?php the_title(); ?></a>
<br>
<?php include locate_template('partials/media_podcast.php' );?>
<hr class="compact">
</div>    
<?php endif; ?>

<?php if(get_field('gallery')): ?>
<div class="iso-grid__item fs-cell fs-lg-half fs-md-full fs-sm-3 text-center">
<a style="text-decoration: none;" class="title title__xs" href="<?php the_permalink(); ?>">Event: <?php the_title(); ?></a>
<?php 
    $images = get_field('gallery'); 
    $bgImage = $images[0];
    $imageid = $bgImage['id'];
    $bgImageUrl = $bgImage['sizes']['large']; 
?>
<a style="display:block; margin-top: 12.5px; text-decoration: none;" class="title title__xs" href="<?php the_permalink(); ?>">
<img src="<?php echo $bgImageUrl; ?>" class="img-responsive" />
</a>
<hr class="compact">
</div>
<?php endif; ?>


<? }
    }
    $post = $orig_post;
    wp_reset_query();
    ?>
</div>