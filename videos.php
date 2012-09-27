<?php 
/*
Template name: videogallery
*/
get_header(); 
?>

<div id="content" class="contentVideo">

<?php 
//include('sidebar_left.php');
?>
<div class="videos videosForIE">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<h2 class="orangeVideos"><?php the_title(); ?></h2>
		<div class="entry intro">
			<?php the_content(); ?>
		</div>
	<?php endwhile; endif; ?>
</div>

<?php get_sidebar(); ?>

<?php 
// edit_post_link('Edit this entry.', '<p>', '</p>'); 
?>

	<p class="segnala2"><a href="http://dito.areato.org/home/?page_id=1706" class="segnala">Tutti i podcast</a></p>

</div>

<?php get_footer(); ?>