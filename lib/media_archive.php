<?php 

// Returns Event Cats

function media_category() {

  $taxonomy = 'tribe_events_cat';
  if(is_single()){
    $terms = get_the_term_list( $post->ID, 'tribe_events_cat', '<ul class="archive__cats"><li><a href="/">Media Archive</a>', ',</li><li>', '</li></ul>' );
  } else {
    $terms = get_the_term_list( $post->ID, 'tribe_events_cat', '<ul class="archive__cats"><li>', ',</li><li>', '</li></ul>' );
  }
  return $terms;

}

function featured_category() {

  $taxonomy = 'tribe_events_cat';
  $terms = get_the_term_list( $post->ID, 'tribe_events_cat', '<ul class="archive__cats featured"><li><span class="bg--blue">Featured in</span> ', ',</li><li>', '</li></ul>' );
  return $terms;

}