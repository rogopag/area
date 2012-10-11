<?php
global $wp_query;
$tags = Mediateca_Init::$types; 
array_push( $tags, 'post' );
query_posts( array( 'post_type' => Mediateca_Init::$types, 'tag' =>  $wp_query->query_vars['tag'] ) );
get_header(); ?>

	<div id="content">
<?php is_tag(); ?>
		<?php if  (have_posts() ) : ?>
		
<?php include('flat_sidebar.php');?>

<div class="main ieFix">
<h2 class="orange"><?php single_tag_title(); ?></h2>
     <?php while ( have_posts() ) : the_post(); ?>
			<h3 id="post-<?php the_ID(); ?>" class="post-title post-title-black no-intro"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>
			<div class="entry">
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
	
<?php get_sidebar(); ?>
	</div>
<?php get_footer(); ?>