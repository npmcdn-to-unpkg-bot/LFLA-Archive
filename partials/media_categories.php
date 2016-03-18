<div class="fs-row">

<?php 
  $categories = get_terms( 'event_archive', 'orderby=count&hide_empty=1' );
  foreach($categories as $cat):
  $name = $cat->name;
  $slug = $cat->slug;
?>

<div class="fs-cell fs-all-fourth">
<a href="/category/<?php echo $slug; ?>"><?php echo $name;  ?></a>
</div>

<?php endforeach; ?>

</div>