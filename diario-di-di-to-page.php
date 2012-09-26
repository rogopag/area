<?php
/*
Template name:Diario di dito
*/
$update = isset($_REQUEST['update'])?$_REQUEST['update']:false;
?>


<?php get_header(); ?>

	<div id="content">
<?php include('sidebar_left.php');	
?>

			<div class="main ieFix">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<h2 class="orange"><?php the_title();?></h2>
				
				<div class="entry intro">
				<?php
				the_content();
				?>
				
                </div>
<?php endwhile; endif; ?>
          <!--      <div class="goRead">
				Leggi l'ultima recensione
				</div>-->

				<div class="entry story" style="display:none">
				<h3>In focus</h3>
				<h4><em><?php
				$my_query = new WP_Query("cat=137&showposts=1");
				while ($my_query->have_posts()) : $my_query->the_post();
				$do_not_duplicate = $post->ID;
				 the_title(); ?></em></h4>
					<?php the_content('Read the rest of this entry &raquo;'); ?>
				</div>

			</div>

		<?php endwhile; ?>

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
			<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
		</div>
		
<div id="sidebarRight">
		
<?php
do_action('do_diario_sidebar');
?>	
	</div>

	<?php //get_sidebar(); ?>

	</div>



<?php get_footer(); ?>
