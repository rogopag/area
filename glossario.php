<?php
/*
Template Name: glossario
*/
?>


<?php 
get_header();
query_posts("cat=45&orderby=title&order=ASC&paged=".get_query_var( 'paged' )); 
?>

	<div id="content">
<?php include('sidebar_left.php');?>
<div class="main">
	
<h2 class="orange specialOrangeIE"> Cosa vuol dire
				
				</h2>
		<?php 
		//$glQuery = new WP_Query("cat=45&orderby=title&order=ASC");
		while (have_posts()) : the_post();
	
		?>
		

			<h3 class="post-title"><?php the_title(); ?></h3>
				

				<div class="entry">
					<?php the_content(); ?>
				</div>

		
<?php endwhile;?>
		
		<?php twentyeleven_content_nav( 'nav-below' ); ?>
		
		</div>
	

	
	<?php get_sidebar(); ?>

	</div>



<?php get_footer(); ?>