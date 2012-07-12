<?php
/*
Template name:chi siamo
*/

?>


<?php get_header(); ?>

	<div id="content">
		<?php include('sidebar_left.php');	
		?>

			<div class="main ieFix">
				
				
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
		<h2 class="orange">Di.To
		<span class="languages">
				<!-- <a href="<?php bloginfo('url');?>/?page_id=1482" class="otherLanguage"> -->
				<a href="<?php bloginfo('url');?>/?page_id=2429" class="otherLanguage"> 
				<img src="/wp-content/uploads/uk.jpg" class="flag" />
				</a>
				<a href="<?php bloginfo('url');?>/?page_id=419" class="otherLanguage">
				<img src="/wp-content/uploads/france.jpg" class="flag" />
				</a>
				</span>
		</h2>
	
		
			<div class="intro">
				<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>

				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
	</div>
			<?php endwhile; endif; ?>
		
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
			$shortContentText = $post->post_content;
			$shortContentText = strip_tags($shortContentText);
		  $shortContentText = substr($shortContentText ,0, 800);     
		  $lastSpaceOnEarth = strpos($shortContentText, '.', 50);
		  $shortContentText = substr($shortContentText ,0, $lastSpaceOnEarth+1);
		  $shortContentText = str_replace(".", ".<br/>", $shortContentText);
		   
		   echo '<a href="'.$link.'">'.$title.'</a><br/>';
	 endwhile; 
	 
	 /* 
	 //AGGIUNTA ALTRO DIPARTRIMENTO CON  POST
	 //echo '<br/><p class="about"><strong>Equipe Che Fare</strong></p>';
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
	 endwhile; */
	 
	 
		echo '</div>';
?>
<div class="boxes goaway">
<p class="about"><strong>Dove siamo</strong></p>
<p class="about">Associazione Area Onlus<br />Corso Regina Margherita, 55<br/>10124 - Torino</p>
<p class="about"><a href="<?php bloginfo('url');?>/map.php?mapsearch=area">trova sulla mappa</a></p>
<br/><p class="about"><strong>Contatti</strong></p>
<p class="about">E' possibile contattare <br />la redazione<br />il luned&igrave; e il mercoled&igrave;<br />dalle ore 10.00 alle 17.00</p>
<p class="about">Tel: 011 837642</p>
<p class="about">Email:<a href="mailto:info@dito.areato.org"> info@dito.areato.org</a></p>
</div>
<h2 class="blue secondLine" style="top:-8px">Consiglio Direttivo Area Onlus </h2>
<div class="boxesSecondLine" style="margin-top:-8px">
	<p class="about"><strong>Presidenti d'Onore</strong></p>
		<span>Marella Agnelli, Marida Recchi</span>
		<p class="about"><strong>Presidente</strong></p>
			<span>Giovanna Recchi</span>
		<p class="about" style="margin-top:10px;"><strong>Vice Presidenti</strong></p>
		<span>Gianluigi Gabetti, Antonio Maria Marocco</span>
		<p class="about" style="margin-top:10px;"><strong>Consiglieri Delegati</strong></p>
		<span>Rossella Bo, Diana Boyl</span>
		<p class="about" style="margin-top:10px;"><strong>Revisori dei conti</strong></p>
			<span>Luciano Marchisio, Carlo Re, Claudio Saracco</span>		
</div>
<div class="boxesSecondLine" style="margin-top:-8px">
	
	<p class="about"><strong>Consiglieri</strong></p>
		<span>
		Alberto Bolaffi<br />	 		
		Clara Cantarella<br />	 		
		Maria Cattaneo<br />	 		
		Ernesto Cionini Ciardi<br />
		Guido Cravetto<br />	 		
		Ginevra Elkann<br />	 		
		Gabriele Galateri di Genola<br />	 		
		Marinella Lessona<br /> 			
		Lucetta Morino	<br /> 			 		
		Giorgia Pininfarina	<br />
		Alessandro Riccio 
		
		</span>
		
</div>
	<?php //get_sidebar(); ?>

	</div>



<?php get_footer(); ?>