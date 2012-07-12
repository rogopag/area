<?php
$update = isset($_REQUEST['update'])?$_REQUEST['update']:false;
?>


<?php get_header(); ?>

	<div id="content">
<?php include('sidebar_left.php');	
?>

			<div class="main ieFix">
				<h2 class="orange"><?php the_title();?></h2>
				
				<div class="entry intro">
				<?php
				$intro = $wpdb->get_row("SELECT * FROM $wpdb->posts WHERE post_title = 'Redazione Intro'");
				echo $intro->post_content;
				?>
				
                </div>
                <div class="goRead">
				Leggi l'ultima recensione
				</div>

				<div class="entry story" style="display:none">
				<h3>Recensione in focus</h3>
				<h4><em><?php
				$my_query = new WP_Query("cat=44&showposts=1");
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


	echo '<h2 class="blue goaway">Chi siamo</h2>';
	echo '<div class="boxes goaway">
		<p class="about"><strong>Direzione</strong></p>';
	    $my_query = new WP_Query("cat=110&showposts=10");
	    while ($my_query->have_posts()) : $my_query->the_post(); 
	            $title = $post->post_title;
				$link = $post->guid;
				$shortContentText = $post->post_content;
				$shortContentText = strip_tags($shortContentText);
			  $shortContentText = substr($shortContentText ,0, 800);     
			  $lastSpaceOnEarth = strpos($shortContentText, '.', 50);
			  $shortContentText = substr($shortContentText ,0, $lastSpaceOnEarth+1);
			  $shortContentText = str_replace(".", ".<br/>", $shortContentText);

			   echo '<a href="'.$link.'">'.$title.'</a><br/>';
		 endwhile; 
		 echo '<br/>
	
	<p class="about"><strong>Redazione Di.To</strong></p>';
	$my_query = new WP_Query("cat=52&showposts=10");
	while ($my_query->have_posts()) : $my_query->the_post();
	$title = $post->post_title;
	$link = $post->guid;


	echo '<a href="'.$link.'">'.$title.'</a><br/>';
	endwhile;
	
	
	echo '<br/><p class="about"><strong>Equipe Che Fare</strong></p>';
    $my_query = new WP_Query("cat=53&showposts=10");
    while ($my_query->have_posts()) : $my_query->the_post(); 
            $title = $post->post_title;
			$link = $post->guid;
			$shortContentText = $post->post_content;
			$shortContentText = strip_tags($shortContentText);
		  $shortContentText = substr($shortContentText ,0, 800);     
		//  $lastSpaceOnEarth = strpos($shortContentText, '.', 50);
		  $shortContentText = substr($shortContentText ,0, $lastSpaceOnEarth+1);
		  $shortContentText = str_replace(".", ".<br/>", $shortContentText);
		   
		   echo '<a href="'.$link.'">'.$title.'</a><br/>';
	 endwhile;
	echo '</div>';
?>
<div class="boxes goaway">
<p class="about"><strong>Dove siamo</strong></p>
<p class="about">Associazione Area Onlus<br />Corso Regina Margherita, 55<br/>10124 - Torino</p>
<p class="about"><a href="<?php bloginfo('url');?>/map.php?mapsearch=area">trova sulla mappa</a></p>
<br/><p class="about"><strong>Contatti</strong></p>
<p class="about">&Egrave; possibile contattare la redazione il luned&igrave;<br />e il mercolerd&igrave;<br />dalle ore 14.30 alle 18.30</p>
<p class="about">Tel: 011 837642</p>
<p class="about">Email:<a href="mailto:info@dito.areato.org"> info@dito.areato.org</a></p>

</div>

		
<?php
//echo  $do_not_duplicate;
echo '<div class="boxesBox boxesBoxSecond changeMe"><h2 class="blue secondLine change">Recensioni</h2>';
//echo '<h2 class="blue">Recensioni</h2>';
if ($update){
	$show = 3;
} else {
	$show = 2;
}


$my_query = new WP_Query('cat=44&showposts='.$show.'');

while ($my_query->have_posts()) : $my_query->the_post();
if($update){
	if ($post->ID == $do_not_duplicate) {
		continue;
		update_post_caches($posts);
	}
	else {
		update_post_caches($posts);
		$title = $post->post_title;
		$link = $post->guid;
		$shortContentText = $post->post_content;
		$shortContentText = strip_tags($shortContentText);
		$shortContentText = substr($shortContentText ,0, 800);
		$lastSpaceOnEarth = strpos($shortContentText, '.', 50);
		$shortContentText = substr($shortContentText ,0, $lastSpaceOnEarth+1);
		$shortContentText = str_replace(".", ".<br/>", $shortContentText);
		echo  '<div class="boxesSecondLine  changeDiv"><a href="'.$link.'">'.$title.'</a><br/>'.$shortContentText.'</div>';
	}
} else{
	$title = $post->post_title;
	$link = $post->guid;
	$shortContentText = $post->post_content;
	$shortContentText = strip_tags($shortContentText);
	$shortContentText = substr($shortContentText ,0, 800);
	$lastSpaceOnEarth = strpos($shortContentText, '.', 50);
	$shortContentText = substr($shortContentText ,0, $lastSpaceOnEarth+1);
	$shortContentText = str_replace(".", ".<br/>", $shortContentText);
	echo  '<div class="boxesSecondLine  changeDiv"><a href="'.$link.'">'.$title.'</a><br/>'.$shortContentText.'</div>';

}
endwhile;

echo '<div class="boxes segnalaRight"> <p class="segnala2"><a href="http://dito.areato.org/?cat=44" class="segnala">Tutte le recensioni</a></p></div>';
echo '</div>';

echo '<div class="boxesBox boxesBoxSecond"><h2 class="blue secondLine">Pubblicazioni Area</h2>';
$my_query = new WP_Query("cat=55&showposts=2");
while ($my_query->have_posts()) : $my_query->the_post();
update_post_caches($posts);
$title = $post->post_title;
$link = $post->guid;
$shortContentText = $post->post_content;
$shortContentText = strip_tags($shortContentText);
$shortContentText = substr($shortContentText ,0, 800);
$lastSpaceOnEarth = strpos($shortContentText, '.', 10);
$shortContentText = substr($shortContentText ,0, $lastSpaceOnEarth+1);
$shortContentText = str_replace(".", ".<br/>", $shortContentText);
echo  '<div class="boxesSecondLine"><a href="'.$link.'">'.$title.'</a><br/>'.$shortContentText.'</div>';

endwhile;
echo '<div class="boxesSecondLine segnalaRight"> <p class="segnala2"><a href="http://dito.areato.org/?cat=55" class="segnala">Tutte le pubblicazioni</a></p></div></div>';
	?>	
	</div>

	<?php //get_sidebar(); ?>

	</div>



<?php get_footer(); ?>
