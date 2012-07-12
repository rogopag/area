<?php
/*
Template Name: Links
*/
?>

<?php get_header(); ?>

<div id="content" class="widecolumn">
<?php include('sidebar_left.php');?>
<div class="main ieFix">
<h2 class="orange">Link utili</h2>
<ul class="linkList">
<?php $links = wp_list_bookmarks('between=<br />&categorize=1&category=6,7,8,42,5,3,4&show_description=1&orderby=name&echo=0'); 

echo $links;
?>
</ul>
<div class="entry">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
<?php 
	the_content();
?>
<?php	endwhile; endif; ?>
</div>
</div>
<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>
