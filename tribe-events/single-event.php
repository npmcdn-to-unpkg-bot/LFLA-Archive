<?php

if ( get_field('archived') ) {

include locate_template('partials/archived-event.php' );

} else {

include locate_template('partials/archived-event.php' );
#include locate_template('tribe-events/single-event-default.php' );

}

?>