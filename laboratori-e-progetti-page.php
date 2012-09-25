<?php get_header(); ?>

<div id="content">
	<?php get_template_part('sidebar_left');?>
	<div class="wrap-center-content">
<div class="main forIE main-large">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<h2 class="orange main-large"><?php /*the_title();*/ echo "This page is under construction";?></h2>


<div class="entry intro main-large">
				<?php //the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>
				<small class="float-right">
					<?php  
				if (is_user_logged_in())
				{
					edit_post_link();
				}
				?>
			</small></div>

<?php endwhile; else: ?>

	<p>Sorry, no posts matched your criteria.</p>

<?php endif; ?>
</div>
<?php
do_action('render_search_results');
?>
</div>
</div>
<?php get_footer(); ?>
