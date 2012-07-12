<?php
/*
Template name:rassegna
*/
?>


<?php get_header(); 
error_reporting(E_ALL); 
ini_set("display_errors", 0);
?>

	<div id="content">
<?php include('sidebar_left.php');
			
?>

			<div class="main ieFix">
				<h2 class="orange">Rassegna Stampae</h2>
<?php
$my_query = new WP_Query("cat=170&showposts=3");
    while ($my_query->have_posts()) : $my_query->the_post(); 
    $do_not_duplicate = $post->ID;
?>
				<div class="entry">
				
				<h3 class="newsTitle"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h3>
					<?php the_excerpt('Read the rest of this entry &raquo;'); ?>
					
				</div>
				
	<?php endwhile; ?>
	
				
			</div>

	

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
			<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
		</div>				
				




		

	
<?php get_footer(); ?>