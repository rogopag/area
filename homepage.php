<?php
/*
Template Name: homepage
*/
//echo $_SERVER['SERVER_ADDR'].' :::: '.ABSPATH;
?>
<?php get_header();?>
<div id="content">
<?php include('sidebar_left.php');?>
<div class="main">

		

			
				<h2 class="orange specialOrangeIE">In evidenza
				
				
				</h2>
				
				
				 

				<div class="entry homeFirst expander">
						<?php	$my_query = new WP_Query("cat=64&showposts=3");
					            while ($my_query->have_posts()) : $my_query->the_post(); 
						       	$title = $post->post_title;
						         $link = $post->guid;
						         $shortContentText = $post->post_content;
						         $shortContentText = strip_tags($shortContentText);
						         $shortContentText = substr($shortContentText ,0, 800);     
						         $lastSpaceOnEarth = strpos($shortContentText, ' ', 90);
						         $shortContentText = substr($shortContentText ,0, $lastSpaceOnEarth+1);
						       //  $shortContentText = str_replace(".", ".", $shortContentText);
						     echo '<span class="collapsableTitle clickTitle">'.$title.'</span>';
						//     echo '<p class="noMargin expand">'./*$shortContentText*/ $post->post_content.' <span>[<a href="'.$link.'">...</a>]</span></p>';
							echo '<p class="noMargin expand" id="id_'.$post->ID.'">'./*$shortContentText*/ $post->post_content.'</p>';

						  //   the_excerpt();
			               		 endwhile;
						?>			
					<!-- <a href="/home/?page_id=2116"> --> 
					<img title="" src="http://dito.areato.org/wp-admin/" alt="" /></a>
					<!-- <p><a href="/home/?page_id=2116"><B>Per sfogliare la mostra clicca qui...</B></p> -->
				</div>

						
		

		
		<?php if (have_posts()) : ?>

			<?php while (have_posts()) : the_post(); ?>
		<div class="secondEntry">
		<h2 class="orange mainSecondLine"><?php the_title(); ?>
			<span class="languages">
			<a href="<?php bloginfo('url');?>/?page_id=204" class="otherLanguage">
			<img src="/wp-content/uploads/uk.jpg" class="flag" alt="gb"/>
			</a>
			<a href="<?php bloginfo('url');?>/?page_id=205" class="otherLanguage">
			<img src="/wp-content/uploads/france.jpg" class="flag" alt="fr"/>
			</a>
			</span>
			</h2>

				<div class="entry entrySecondLine homeEntry">
						<?php the_content('Read the rest of this entry &raquo;'); ?>
				</div>
				
		</div>
<?php endwhile; ?>		
	</div>
		

	<?php else : ?>

		<h2 class="center">Not Found</h2>
		<p class="center">Sorry, but you are looking something that is not here.</p>
		<?php include (TEMPLATEPATH . "/searchform.php"); ?>

	<?php endif; ?>
	<?php 
	get_sidebar(); ?>

	</div>



<?php get_footer(); ?>