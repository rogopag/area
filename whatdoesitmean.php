<?php
/*
Template name: Cosa vuol dire
*/

	$my_query = new WP_Query("cat=45&orderby=title");
	while ($my_query->have_posts()) : $my_query->the_post();
	the_title().'<br />';
	the_content();
	endwhile;
?>