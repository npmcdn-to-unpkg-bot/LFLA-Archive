<?php
function jc_custom_post_status(){
     register_post_status( 'archive', array(
          'label'                     => _x( 'Archive', 'post' ),
          'public'                    => true,
          'show_in_admin_all_list'    => false,
          'show_in_admin_status_list' => true,
          'label_count'               => _n_noop( 'Archive <span class="count">(%s)</span>', 'Archive <span class="count">(%s)</span>' )
     ) );
}
add_action( 'init', 'jc_custom_post_status' );

add_action('admin_footer-post.php', 'jc_append_post_status_list');
function jc_append_post_status_list(){
     global $post;
     $complete = '';
     $label = '';
     if($post->post_type == 'tribe_events'){
          if($post->post_status == 'archive'){
               $complete = ' selected="selected"';
               $label = '<span id="post-status-display"> Archived</span>';
          }
          echo '
          <script>
          jQuery(document).ready(function($){
               $("select#post_status").append("<option value="archive" '.$complete.'>Archive</option>");
               $(".misc-pub-section label").append("'.$label.'");
          });
          </script>
          ';
     }
}