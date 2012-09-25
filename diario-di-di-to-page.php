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
//echo  $do_not_duplicate;
/*echo '<div class="boxesBox ">
<h2 class="blue">Interviste</h2>';
//echo '<h2 class="blue">Recensioni</h2>';
if ($update){
	$show = 3;
} else {
	$show = 2;
}


$my_query = new WP_Query(array('category__in' => array(141), 'showposts'=>$show));

while ($my_query->have_posts()) : $my_query->the_post();
if($update){
	if ($post->ID == $do_not_duplicate) {
		continue;
		update_post_caches($posts);
	}
	else {
		update_post_caches($posts);
		$title = $post->post_title;
		$link = get_permalink($post->ID);
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
	$link = get_permalink($post->ID);
	$shortContentText = $post->post_content;
	$shortContentText = strip_tags($shortContentText);
	$shortContentText = substr($shortContentText ,0, 800);
	$lastSpaceOnEarth = strpos($shortContentText, '.', 50);
	$shortContentText = substr($shortContentText ,0, $lastSpaceOnEarth+1);
	$shortContentText = str_replace(".", ".<br/>", $shortContentText);
	echo  '<div class="boxesSecondLine  changeDiv"><a href="'.$link.'">'.$title.'</a><br/>'.$shortContentText.'</div>';

}
endwhile;

echo '<div class="boxes segnalaRight"> <p class="segnala2"><a href="http://dito.areato.org/home/?cat=141" class="segnala">Tutte le interviste</a></p></div>';
echo '</div>';*/


/*///////////////////////////////////////////////////////////////////////////*/
/*echo '<div class="boxesBox boxesBoxSecond">
<h2 class="blue secondLine">Recensioni</h2>';
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
		$link = get_permalink($post->ID);
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
	$link = get_permalink($post->ID);
	$shortContentText = $post->post_content;
	$shortContentText = strip_tags($shortContentText);
	$shortContentText = substr($shortContentText ,0, 800);
	$lastSpaceOnEarth = strpos($shortContentText, '.', 50);
	$shortContentText = substr($shortContentText ,0, $lastSpaceOnEarth+1);
	$shortContentText = str_replace(".", ".<br/>", $shortContentText);
	echo  '<div class="boxesSecondLine  changeDiv"><a href="'.$link.'">'.$title.'</a><br/>'.$shortContentText.'</div>';

}
endwhile;

echo '<div class="boxes segnalaRight"> <p class="segnala2"><a href="http://dito.areato.org/home/?cat=44" class="segnala">Tutte le recensioni</a></p></div>';
echo '</div>';*/

/*echo '<div class="boxesBox boxesBoxSecond"><h2 class="blue secondLine">Studi e ricerche</h2>';
$my_query = new WP_Query("cat=55&showposts=2");
while ($my_query->have_posts()) : $my_query->the_post();
update_post_caches($posts);
$title = $post->post_title;
$link = get_permalink($post->ID);
$shortContentText = $post->post_content;
$shortContentText = strip_tags($shortContentText);
$shortContentText = substr($shortContentText ,0, 800);
$lastSpaceOnEarth = strpos($shortContentText, '.', 10);
$shortContentText = substr($shortContentText ,0, $lastSpaceOnEarth+1);
$shortContentText = str_replace(".", ".<br/>", $shortContentText);
echo  '<div class="boxesSecondLine"><a href="'.$link.'">'.$title.'</a><br/>'.$shortContentText.'</div>';

endwhile;
echo '<div class="boxesSecondLine segnalaRight"> <p class="segnala2"><a href="http://dito.areato.org/home/?cat=55" class="segnala">Tutte le pubblicazioni</a></p></div></div>';*/


echo '<div class="boxesBox"><h2 class="blue">Diario di Di.To</h2>';
$my_query = new WP_Query("cat=138&showposts=2");
while ($my_query->have_posts()) : $my_query->the_post();
update_post_caches($posts);
$title = $post->post_title;
$link = get_permalink($post->ID);
$shortContentText = $post->post_content;
$shortContentText = strip_tags($shortContentText);
$shortContentText = substr($shortContentText ,0, 800);
$lastSpaceOnEarth = strpos($shortContentText, '.', 10);
$shortContentText = substr($shortContentText ,0, $lastSpaceOnEarth+1);
$shortContentText = str_replace(".", ".<br/>", $shortContentText);
echo  '<div class="boxesSecondLine"><a href="'.$link.'">'.$title.'</a><br/>'.$shortContentText.'</div>';

endwhile;
echo '<div class="boxesSecondLine segnalaRight"> <p class="segnala2"><a href="http://dito.areato.org/home/?cat=138" class="segnala">Tutto il Diario</a></p></div></div>';
	?>	
	</div>

	<?php //get_sidebar(); ?>

	</div>



<?php get_footer(); ?>
