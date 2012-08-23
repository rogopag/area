<?php get_header(); ?>

	<div id="content">
	
<?php include_once('sidebar_left.php');?>
<div class="main forIE">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<h2 class="orange"><?php the_title(); ?></h2>
	
		
			<div class="entry intro">
				<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>

				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
	</div>
			<?php endwhile; endif; ?>
		</div><?php get_sidebar(); ?>
		
	<?php 
	// edit_post_link('Edit this entry.', '<p>', '</p>'); 
	?>
	</div>



<?php get_footer(); ?>