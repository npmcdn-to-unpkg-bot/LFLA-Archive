<?php
//
// Helpers
//

// Get page permalink by slug
function getPageBySlug ( $name ) {
  $link = get_page_by_path( $name );
  return get_permalink( $link->ID );
}

// Check if custom post type
function isPostType ( $type ) {
  global $post;
  if ( $type == get_post_type( ) ) return true;
  return false;
}

// Debug
function debugger ( $obj ) {
  echo "<pre>\n";
  print_r( $obj );
  echo "\n</pre>";
}

// Featured Image
// function theFeaturedImage ( $image_size = 'full', $attr = true ) {
//   $image_id = get_post_thumbnail_id();
//   $image_url = wp_get_attachment_image_src( $image_id, $image_size, true );
//   $dim = ( $attr ) ? ' width="' . $image_url[1] . '" height="' . $image_url[2] . '"' : '';
//   $html = '<img src="' . $image_url[0] . '"' . $dim . ' alt="">';
//   return $html;
// }

// Truncate Text
function truncateWords ( $text, $limit = 15 ) {
  $trimmed_content = wp_trim_words( $text, $limit );
  return $trimmed_content;
}
function truncateWordsByCharacter( $text, $length = 45, $append = '&hellip;' ) {
  // http://bavotasan.com/2012/trim-characters-using-php/
  $length = (int) $length;
  $text = trim( strip_tags( $text ) );
  if ( strlen( $text ) > $length ) {
    $text = substr( $text, 0, $length + 1 );
    $words = preg_split( "/[\s]|&nbsp;/", $text, -1, PREG_SPLIT_NO_EMPTY );
    preg_match( "/[\s]|&nbsp;/", $text, $lastchar, 0, $length );
    if ( empty( $lastchar ) )
      array_pop( $words );
    $text = implode( ' ', $words ) . $append;
  }
  return $text;
}

// Remove http(s) from url
function cleanDisplayURL ( $url ) {
  return preg_replace( "#^[^:/.]*[:/]+#i", "", preg_replace( "{/$}", "", urldecode( $url ) ) );  ;
}

// Format post date
function formatPostDate ( $start, $end = false ) {
  $date = '';

  if ( $end && $start) {
    $end_date = DateTime::createFromFormat( 'Ymd', $end );
    $start_date = DateTime::createFromFormat( 'Ymd', $start );
    $date = $start_date->format( 'F j' ) . ' &ndash; ' . $end_date->format( 'F j, Y' );
  } else if(!$end && $start) {
    $date = $start_date->format( 'F j, Y' );
  }

  return $date;
}

// Get current post
function getCurrentPostID ( $post_type ) {
  $current_args = array(
    'posts_per_page' => 1,
    'post_type'      => $post_type,
    'orderby'        => 'date',
    'order'          => 'DESC'
  );

  $current_post = get_posts( $current_args );

  foreach ( $current_post as $post ) :
    return $post->ID;
  endforeach;
}

// Display related list
function displayRelatedList ( $post_obj ) {
  $i = 0;
  $html = '';
  $total = count( $post_obj );

  foreach ( $post_obj as $post ) :
    // setup_postdata( $post );
    $comma = ( $i != $total-1 ) ? ', ' : '';
    $html .= '<a href="' . get_permalink( $post->ID ) . '">' . get_the_title( $post->ID ) . '</a>' . $comma;
    $i++;
  endforeach;
  wp_reset_postdata();

  return $html;
}

// Pagination
function numericPostsNav () {
  if ( is_singular() ) return;

  global $wp_query;

  // Stop execution if there's only 1 page
  if ( $wp_query->max_num_pages <= 1 )
    return;

  $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
  $max   = intval( $wp_query->max_num_pages );

  /** Add current page to the array */
  if ( $paged >= 1 )
    $links[] = $paged;

  /** Add the pages around the current page to the array */
  if ( $paged >= 3 ) {
    $links[] = $paged - 1;
    $links[] = $paged - 2;
  }

  if ( ( $paged + 2 ) <= $max ) {
    $links[] = $paged + 2;
    $links[] = $paged + 1;
  }

  echo '<hr class="divider">';
  echo '<nav class="page-navigation">' . "\n";

  // Previous Post Link
  if ( get_previous_posts_link() ) {
    printf( '%s' . "\n", get_previous_posts_link( 'Previous' ) );
  }
  // else {
  //   echo '<p class="page-navigation__btn">Previous</p>';
  // }

  echo '<ul class="page-navigation__list">' . "\n";

  // Link to first page, plus ellipses if necessary
  if ( ! in_array( 1, $links ) ) {
    $class = 1 == $paged ? ' class="is-active"' : '';

    printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

    if ( ! in_array( 2, $links ) )
      echo '<li>…</li>';
  }

  // Link to current page, plus 2 pages in either direction if necessary
  sort( $links );
  foreach ( (array) $links as $link ) {
    $class = $paged == $link ? ' class="is-active"' : '';
    printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
  }

  // Link to last page, plus ellipses if necessary
  if ( ! in_array( $max, $links ) ) {
    if ( ! in_array( $max - 1, $links ) )
      echo '<li>...</li>' . "\n";

    $class = $paged == $max ? ' class="is-active"' : '';
    printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
  }

  echo '</ul>' . "\n";

  // Next Post Link
  if ( get_next_posts_link() ) {
    printf( '%s' . "\n", get_next_posts_link( 'Next' ) );
  }
  // else {
  //   echo '<p class="page-navigation__btn">Next</p>';
  // }

  echo '</nav>' . "\n";
  echo '<hr class="divider">';
}

// Subscribe to newsletter
function subscribeToNewsletter () {
  $email = $_GET['email'];
  $subscribe = 0;

  // Validation
  if ( !$email || !vaildEmail( $email ) ) {
    return "Invalid email.";
  }

  // Mailchimp API Key
  $api = '55066ab3d385d6ed7a41bd5442e4e47d-us9';
  $list_id = 'df97fbd6e8';

  // Initialize the $MailChimp object
  $MailChimp = new \Drewm\MailChimp($api);

  // Check if the email is already subscribed
  $member_info = $MailChimp->call('lists/member-info', array(
    'id'     => $list_id,
    'emails' => array( array( 'email' => $email ) )
    )
  );

  $subscribe = $MailChimp->call('lists/subscribe', array(
    'id'                => $list_id,
    'email'             => array( 'email' => $email ),
    'double_optin'      => false,
    'update_existing'   => false,
    'replace_interests' => false,
    'send_welcome'      => true
    )
  );

  $already_subscribed = ( $member_info ) ? $member_info['success_count'] : false;

  // print_r( $subscribe );

  if ( $subscribe && !$already_subscribed ) {
    return 'success';
  }
  else {
    $error = ( is_array( $subscribe ) ) ? 'Email already registered.' : 'Invalid email.';
    return $error;
  }
}

add_action( 'wp_ajax_sendmail', 'subscribeToNewsletter' );
add_action( 'wp_ajax_nopriv_sendmail', 'subscribeToNewsletter' );

if ( isset( $_GET['ajax'] ) ) {
  echo subscribeToNewsletter();
  die();
}


// Validate email
function vaildEmail ( $email ) {
  return filter_var( $email, FILTER_VALIDATE_EMAIL ) ? true : false;
}
