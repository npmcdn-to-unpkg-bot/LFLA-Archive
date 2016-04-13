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
            <option value="" class="text-center">Select Series</option>
            <?php 
              $args = array(
                'name' => 'tribe_events_cat',
              );
              $terms = get_terms($args); 
              foreach($terms as $term):
            ?>
            <option <?php if( $program == $term->slug): echo 'selected'; endif; ?> value="<?php echo $term->slug; ?>" ><?php echo $term->name; ?></option>
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
                if( $eventdate == $starting_year):
                  $years[] = '<option selected value="'.$starting_year.'">'.$starting_year.'</option>';
                else :
                  $years[] = '<option value="'.$starting_year.'">'.$starting_year.'</option>';
                endif;
              }
            ?>
            <?php echo implode("\n\r", array_reverse($years));  ?>
          </select>
        </div>
        <div class="fs-cell fs-lg-3 fs-md-2 fs-sm-3">
          <select name="venue" class="bg--bgGray">
            <option value="" class="text-center">Select Subject</option>
            <option value="Biography">Biography</option>
            <option value="California/The West">California/The West</option>
            <option value="Current Events">Current Events</option>
            <option value="Essay/Memoir">Essay/Memoir</option>
            <option value="Fiction/Literature">Fiction/Literature</option>
            <option value="History/Bio">History/Bio</option>
            <option value="Poetry">Poetry</option>
            <option value="Religion/Spirituality">Religion/Spirituality</option>
            <option value="Science/Nature">Science/Nature</option>
            <option value="Social Sci/Politics">Social Sci/Politics</option>
            <option value="Technology">Technology</option>
            <option value="Philosophy">Philosophy</option>
            <option value="Music">Music</option>
            <option value="Dance">Dance</option>
            <option value="Visual Art/Graphic Design">Visual Art/Graphic Design</option>
            <option value="Bilingual / Spanish language">Bilingual / Spanish language</option>
            <option value="Food">Food</option>
            <option value="Film">Film</option>
            <option value="Architecture">Architecture</option>
          </select>
          </div>
          <div class="fs-cell fs-lg-3 fs-md-2 fs-sm-3"><input type='submit' value="Search" class="bg--blue"></div>
        </form>

    </div>
  </div>
</div>
<?php endif; ?>