<?php
/*
Template name:news
*/
?>


<?php get_header(); 
error_reporting(E_ALL); 
ini_set("display_errors", 0);
?>

	<div id="content">
<?php include('sidebar_left.php');
			
?>

			<div class="main ieFix">
				<h2 class="orange">News </h2>
<?php
$my_query = new WP_Query("cat=9&showposts=3");
    while ($my_query->have_posts()) : $my_query->the_post(); 
    //$do_not_duplicate = $post->ID;
?>
				<div class="entry">
				
				<h3 class="newsTitle"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h3>
					<?php the_excerpt('Read the rest of this entry &raquo;'); ?>
					
				</div>
				
	<?php endwhile; ?>
	<div class="entry"><img title="news" alt="" src="http://dito.areato.org/wp-content/uploads/2008/09/news.jpg"/></div>
				
			</div>

	

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
			<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
		</div>				
				




		
<div id="sidebarRight">
	<?php
	

	
//echo  $do_not_duplicate;
	echo '<div class="boxesBox">';
	echo '<h2 class="blue">Ultime</h2>';
    $my_query = new WP_Query("cat=9&showposts=2");
    while ($my_query->have_posts()) : $my_query->the_post(); 
            $title = $post->post_title;
			$link = get_permalink($post->ID);
			$shortContentText = $post->post_content;
			$shortContentText = strip_tags($shortContentText);
		  $shortContentText = substr($shortContentText ,0, 800);     
		  $lastSpaceOnEarth = strpos($shortContentText, ' ', 120);
		  $shortContentText = substr($shortContentText ,0, $lastSpaceOnEarth+1);
		 // $shortContentText = str_replace(" ", ".<br/>", $shortContentText);
		   echo  '<div class="boxes"><a href="'.$link.'">'.$title.'</a></div>';
		 //  }
	 endwhile; 

	 	echo '<div class="boxesBox boxesBoxSecond boxSecondNews"><h2 class="blue secondLine">Le pi&ugrave; lette</h2>';
 
 popular_posts('limit=2&output_template=<div class="boxesSecondLine">{link}</div>&divider=');
 
	 echo '<br /><p class="segnala2" style="position:relative;top:20px;font-size:12px;left:60px;"><a class="segnala" href="http://dito.areato.org/?cat=9">Tutte le news</a></p>';
	 echo '</div>';
	 
	echo'</div>';
	echo '<p>&nbsp;</p><div class="halfBox bluesmall"><a href="http://dito.areato.org/home/wp-login.php?action=register">Iscriviti alla Newsletter</a>
	</div>';
	echo'</div>';
	
 
	?>
<?php	

?>




<div class="boxesSecondLine">
<!--<p><img src="<?php bloginfo('stylesheet_directory');?>/imgs/map1.jpg" alt="smallmap" /></p>
<form id="mapform" name="mapform" method="get" action="<?php bloginfo('url');?>/map.php">
<input type="text" name="mapsearch" value="Cerca"  id="mapsearch" />
<input type="image" src="http://dito.areato.org/wp-content/themes/area/imgs/search.gif" name="submit"  id="submap" />
</form>-->

</div>

	
	</div>

	<?php //get_sidebar(); ?>

	</div>



<?php get_footer(); ?>