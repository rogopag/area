<?php get_header(); ?>

	<div id="content">
<?php include('sidebar_left.php');?>
<div class="main">
	<?php if (have_posts()) : ?>

		<h2 class="orange">Risultati ricerca</h2>

		<?php while (have_posts()) : the_post(); ?>

			<div class="entry search-results">
				<h4 id="post-<?php the_ID(); ?>" class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
				<!-- <small class="postmetadata"><?php the_time('l, j F, Y') ?></small>-->
				<p class="postmetadata">Pubblicato in <?php echo dito_printObjectTermsInNiceFormat( $post->ID ); ?></p>
					<?php 
				if( function_exists('the_advanced_excerpt') ):
					the_advanced_excerpt('length=150&use_words=0&no_custom=1&ellipsis=%26hellip;&exclude_tags=img');
				else:
					echo "Attivare la plugin Advanced Excerpt";
				endif;
			?>
			<p class="postmetadata"><?php edit_post_link('Edit', '', ' | '); ?>  <?php comments_popup_link('Nessun Commento &#187;', '1 Commento &#187;', '% Commenti &#187;'); ?>	</p>
			</div>

		<?php endwhile; ?>

		<?php twentyeleven_content_nav( 'nav-below' ); ?>

	<?php else : ?>
		<div class="entry">
		<h4 class="center padding-top">Nessun articolo trovato. Prova un'altra ricerca</h4>
		<?php //include (TEMPLATEPATH . '/searchform.php'); ?>
		</div>
	<?php endif; ?>

	</div>
	<?php get_sidebar(); ?>
	</div>



<?php get_footer(); ?>