<?php
/*
Template name:sogni
*/
?>


<?php get_header(); ?>

	<div id="content">
	
<?php include('sidebar_left.php');?>

			<div class="main ieFix">
				<h2 class="orange">Sogni, segni, disegni</h2>
				<div class="entry intro">
				<?php
				$intro = $wpdb->get_row("SELECT * FROM $wpdb->posts WHERE post_title = 'Sogni Intro' AND post_status = 'publish'");
				echo $intro->post_content;
				?>
				
                </div>
             <!--   <div class="goRead">
				Leggi l'ultimo racconto
				</div>-->
                
				<div class="entry story" style="display:none">
				<h3>Sullo scaffale</h3>
				<?php 
				$my_query = new WP_Query("cat=47=&showposts=1");
                while ($my_query->have_posts()) : $my_query->the_post(); 
                $do_not_duplicate = $post->ID;
				$author = get_post_meta($post->ID, "Author Name", $single=true);
                $taleAuthor = $wpdb->get_row("SELECT * FROM $wpdb->posts WHERE post_title = '$author' AND post_status = 'publish'");
				?>
				
				<h3><em><?php the_title(); ?></em><br /><a href="<?php echo get_permalink($taleAuthor->ID);?>" class="authorLink"> <?php echo $author;?> </a></h3>
				
				
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
//echo  $do_not_duplicate;
	echo '<h2 class="blue">Sullo scaffale</h2>';
	$my_query = new WP_Query("cat=47=&showposts=3");
    while ($my_query->have_posts()) : $my_query->the_post(); 
    if ($post->ID ==  $do_not_duplicate){
        continue;
        update_post_caches($posts);
        } else {

            $title = $post->post_title;
			$link = get_permalink($post->ID);
			$shortContentText = $post->post_content;
			$shortContentText = strip_tags($shortContentText);
		  $shortContentText = substr($shortContentText ,0, 800);     
		  $lastSpaceOnEarth = strpos($shortContentText, '.', 50);
		  $shortContentText = substr($shortContentText ,0, $lastSpaceOnEarth+1);
		  $shortContentText = str_replace(".", ".<br/>", $shortContentText);
		   echo  '<div class="boxes"><a href="'.$link.'">'.$title.'</a><br/>'.$shortContentText.'</div>';
		   }
		   endwhile;
	//}
	echo '<div class="boxes" style="padding-top:15px;text-align:right;float:right;"> <p class="segnala2"><a href="'.get_bloginfo('url').'/?cat=47" class="segnala">Tutti i racconti</a></p></div>';
	 	echo '<h2 class="blue secondLine">In cornice</h2>';
    $my_query = new WP_Query("cat=50&showposts=2");
    while ($my_query->have_posts()) : $my_query->the_post(); 
        update_post_caches($posts);
            $title = $post->post_title;
            if (explode("-", $title)){
            $title = explode("-", $title);
            $title = $title[0];
            }
			$link = get_permalink($post->ID);
			$shortContentText = $post->post_content;
		//	$shortContentText = strip_tags($shortContentText);
		//  $shortContentText = substr($shortContentText ,0, 800);     
		//  $lastSpaceOnEarth = strpos($shortContentText, '.', 10);
		//  $shortContentText = substr($shortContentText ,0, $lastSpaceOnEarth+1);
		//  $shortContentText = str_replace(".", ".<br/>", $shortContentText);
		   echo  '<div class="boxesSecondLine"><a href="'.$link.'">'.$title.'<br/>Illustrazioni</a></div>';
		
	 endwhile; 
	 echo '<div class="boxes" style="padding-top:15px;text-align:right;float:right;"> <p class="segnala2"><a href="'.get_bloginfo('url').'/?cat=50" class="segnala">Tutte le illustrazioni</a></p></div>';		
	$my_query = new WP_Query("cat=142&showposts=2");
//	if($my_query->have_posts()):
	echo '<h2 class="blue secondLine">Le vostre pagine</h2>';
	while ($my_query->have_posts()) : $my_query->the_post(); 
	update_post_caches($posts);
	$title = $post->post_title;
	if (explode("-", $title)){
		$title = explode("-", $title);
		$title = $title[0];
	}
	$link = get_permalink($post->ID);
	$shortContentText = $post->post_content;
	$shortContentText = strip_tags($shortContentText);
  	$shortContentText = substr($shortContentText ,0, 800);     
  	$lastSpaceOnEarth = strpos($shortContentText, '.', 50);
  	$shortContentText = substr($shortContentText ,0, $lastSpaceOnEarth+1);
  	$shortContentText = str_replace(".", ".<br/>", $shortContentText);
   echo  '<div class="boxes"><a href="'.$link.'">'.$title.'</a><br/>'.$shortContentText.'</div>';
	endwhile;
	echo '<div class="boxes" style="padding-top:15px;text-align:right;float:right;"> <p class="segnala2"><a href="'.get_bloginfo('url').'/?cat=142" class="segnala">Tutte le vostre pagine</a><br />
	<a href="'.get_bloginfo('url').'/?page_id=998" class="segnala">Inviaci la tua pagina</a>
	</p></div>';
//	endif;
	?>
	</div>

	<?php //get_sidebar(); ?>

	</div>



<?php get_footer(); ?>
