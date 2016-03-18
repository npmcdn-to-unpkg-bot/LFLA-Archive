<?php  Themewrangler::setup_page('new_default|not default','new_vendor | new_scripts');get_header('v2');  ?>
<div class="fs-grid">
<div class="hero"></div>
<div class="fs-row">
<div class="fs-cell fs-full-all">
<?php the_post(); the_content(); ?>
</div>
</div>
</div>
<?php get_footer('v2'); ?>