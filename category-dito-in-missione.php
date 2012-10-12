<?php
$cat = get_queried_object_id();
query_posts( 'cat='.$cat.'&posts_per_page=10' );
get_header(); ?>

	<div id="content">
<?php is_tag(); ?>
		<?php if (have_posts()) : ?>
		
<?php include('sidebar_left.php');?>

<div class="main ieFix main-large">
<h2 class="orange main-large"><?php single_tag_title(); ?></h2>
     <?php while (have_posts()) : the_post(); ?>
			<h3 id="post-<?php the_ID(); ?>" class="post-title post-title-black no-intro"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>
			<div class="entry main-large padding-bottom-doubled">
				<?php 
				if( function_exists('the_advanced_excerpt') ):
					ditoDoExerpt();
				else:
					the_content();
				endif;
			?>	
			</div>	
	<?php	endwhile; ?>
				<?php twentyeleven_content_nav( 'nav-below' ); ?>

	<?php else : ?>
		<div class="entry">
		<h4 class="center padding-top">Nessun articolo trovato.</h4>
		</div>
	<?php endif; ?>
</div>
	
<?php //get_sidebar(); ?>
	</div>
<?php get_footer(); ?>