<div id="media-archive__search">
  <div class="fs-row">
    <div class="fs-cell fs-lg-10 fs-md-6 fs-sm-3 fs-centered text-center">
      <span class="archive__search-title title title--xl">Dig through the LFLA archives to find lorem ipsum.</span>
      <span class="archive__search-title title title--xl">We've got content from 2005-2016</span>
      <div class="archive__search-menu">
        <form class="archive__search-form" method="get" action="<?php echo home_url( '/' ); ?>">
          <input type="text" name="query" class="archive__search-form__search-input" placeholder="Search by Keyword, Speaker, Location or Program">
        </form>
      </div>
      <div class="archive__search-suggested text-center hidden" style="display:none;">
        <span>Search by:</span>
        <a href="/?query=aloud">Series</a>
        <a href="/?query=la orpheum">Year</a>
        <a href="/?query=Gregory Peck">Location</a>
      </div>
    </div>
  </div>
</div>

<?php if(!$hello): ?>
<div id="media-archive__filters" class="archive__filters">
  <div class="fs-row">
    <div class="fs-cell fs-lg-10 fs-md-6 fs-sm-3 fs-centered">
      <form role="search" method="get" action="<?php echo home_url( '/' ); ?>" class="fs-row">
        <div class="fs-cell fs-lg-3 fs-md-2 fs-sm-3">
          <select name="program" class="bg--bgGray">
            <option value="" class="text-center">Select Program</option>
            <?php 
              $args = array(
                'name' => 'tribe_events_cat',
              );
              $terms = get_terms($args); 
              foreach($terms as $term):
            ?>
            <option value="<?php echo $term->slug; ?>" ><?php echo $term->name; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="fs-cell fs-lg-3 fs-md-2 fs-sm-3">
          <select name="eventdate" class="bg--bgGray">
            <option value="" class="text-center">Select Year</option>
            <?php 
              $starting_year  = 1995;
              $ending_year    = date("Y");
              for( $starting_year; $starting_year <= $ending_year; $starting_year++ ) {
                $years[] = '<option value="'.$starting_year.'">'.$starting_year.'</option>';
              }
            ?>
            <?php echo implode("\n\r", array_reverse($years));  ?>
          </select>
        </div>
        <div class="fs-cell fs-lg-3 fs-md-2 fs-sm-3">
          <select name="venue" class="bg--bgGray">
            <option value="" class="text-center">Select Venue</option>
            <?php 
              $venues = tribe_get_venues();
              foreach($venues as $post): setup_postdata($post);
            ?>
            <option value="<?php the_title(); ?>" ><?php the_title(); ?></option>
            <?php endforeach; wp_reset_postdata(); ?>
          </select>
          </div>
          <div class="fs-cell fs-lg-3 fs-md-2 fs-sm-3"><input type='submit' value="Search" class="bg--blue"></div>
        </form>

    </div>
  </div>
</div>
<?php endif; ?>