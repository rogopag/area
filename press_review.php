<?php 
/*
Template name: Rassegna Stampa
*/
get_header(); 
query_posts( array( 'cat' => 170 ) );
?>

<div id="content">
	
<?php get_template_part('flat_sidebar');?>

<div class="main forIE main-large">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<h2 class="orange main-large"><?php the_title(); ?></h2>
	
		
			<div class="entry intro main-large">
				<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>

				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
	</div>
			<?php endwhile; endif; ?>
		</div><?php //get_sidebar(); ?>
		
	<?php 
	// edit_post_link('Edit this entry.', '<p>', '</p>'); 
	?>
	</div>
<?php get_footer(); ?>