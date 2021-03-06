<?php 

// Returns Event Cats

function media_category() {

  $taxonomy = 'tribe_events_cat';
  //$terms = get_the_term_list( $post->ID, 'tribe_events_cat', '<ul class="archive__cats featured"><li class="'. $term->name .'"><span class="bg--blue">Featured in</span> ', ',</li><li>', '//</li></ul>' );
  //return $terms;
  $terms = get_the_terms( $post->ID , $taxonomy );
  //var_dump($terms);

  echo '<ul class="archive__cats">';

  if($terms): foreach($terms as $term):

    $termName = $term->name;
    
    if( $term->slug == 'aloud' ){ 
      $color = 'pink';
    } else {
      $color = 'blue';
    };

    echo '<li class=" ' . $term->slug . ' bg--' . $color . '">'; 
    if(is_single()){
      echo '<a href="/">Media Archive</a>';
    }
    echo '<span>'; 
    echo $termName;
    echo '</span>'; 
    echo '</li>'; 
  endforeach; endif;

  echo '</ul>';

}

function featured_categories(){
  $taxonomy = 'tribe_events_cat';
  $terms = get_the_terms( $post->ID , $taxonomy );
  foreach($terms as $term):
    echo $term->slug;
    echo ' ';
  endforeach;
}

function featured_category() {

  $taxonomy = 'tribe_events_cat';
  //$terms = get_the_term_list( $post->ID, 'tribe_events_cat', '<ul class="archive__cats featured"><li class="'. $term->name .'"><span class="bg--blue">Featured in</span> ', ',</li><li>', '//</li></ul>' );
  //return $terms;
  $terms = get_the_terms( $post->ID , $taxonomy );
  //var_dump($terms);

  echo '<ul class="archive__cats">';

  foreach($terms as $term):

    $termName = $term->name;
    
    if( $term->slug == 'aloud' ){ 
      $color = 'pink';
    } else {
      $color = 'blue';
    };

    echo '<li class=" ' . $term->slug . ' bg--' . $color . '">'; 
    echo '<span>Featured in '; 
    echo $termName;
    echo '</span>'; 
    echo '</li>'; 
  endforeach; ;

  echo '</ul>';

}