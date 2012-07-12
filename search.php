<?php get_header(); ?>

	<div id="content">
<?php include('sidebar_left.php');?>
<div class="main"
	<?php if (have_posts()) : ?>

		<h2 class="orange">Risultati ricerca</h2>

		


		<?php while (have_posts()) : the_post(); ?>

			<div class="post">
				<h3 id="post-<?php the_ID(); ?>" class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
				<small class="postmetadata"><?php the_time('l, j F, Y') ?></small><br />

				<p class="postmetadata"><?php the_tags('Tags: ', ', ', '<br />'); ?> Pubblicato in <?php the_category(', ') ?> | <?php edit_post_link('Edit', '', ' | '); ?>  <?php comments_popup_link('Nessun Commento &#187;', '1 Commento &#187;', '% Commenti &#187;'); ?></p>
			</div>

		<?php endwhile; ?>

		

	<?php else : ?>

		<h2 class="center">Nessun articolo trovato. Prova un'altra ricerca</h2>
		<?php include (TEMPLATEPATH . '/searchform.php'); ?>

	<?php endif; ?>

	</div>
	<?php get_sidebar(); ?>
	</div>



<?php get_footer(); ?>