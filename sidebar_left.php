<div id="sidebarLeft">
<?php
global $wp, $post, $wp_query;

$currentCategory = isset($_GET['cat'])?$_GET['cat']:get_queried_object_id();
///FRONT PAGE
if (is_front_page ()) {
	do_action ( "sidebar_left_home_first_box" );
	
	echo '<div class="arealog"> <a href="http://www.areato.org/" target="_blank"><img alt="" src="' . get_bloginfo ( 'url' ) . '/wp-content/themes/area/imgs/arealog.jpg" class="imgLogo"/></a>
			 <div class="imgDonazioni" style="text-align:center;">	
			 	<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
			<input type="hidden" name="cmd" value="_s-xclick">
			<input type="hidden" name="hosted_button_id" value="3372968">
			<input type="image" src="' . get_bloginfo ( 'url' ) . '/wp-content/themes/area/imgs/donazioni.jpg" border="0" name="submit" alt=""></form><span class="donazione"><strong>DONA ORA !</strong></span></div></div> ';

}
///LINK PAGE
elseif( is_page_template('links.php') )
{
	echo '<div class="sideLeftInt">';
	if (function_exists('bcn_display'))
	{
		// Display the breadcrumb
		bcn_display();
	} echo"</div>";
	echo '<div class="arealog logfl"><a href="http://www.areato.org/" target="_blank"><img alt="" src="'.get_bloginfo('url').'/wp-content/themes/area/imgs/arealog.jpg" class="imgLogo"/></a></div>';
}
/////Studi e ricerche
elseif (in_category(55) || is_category(55)){
	echo '<div class="sideLeftInt">';
	if (function_exists('bcn_display'))
	{
		// Display the breadcrumb
		bcn_display();
	} echo"</div>";
	echo '<div class="questions">';
	$my_query = new WP_Query("cat=55");
	while ($my_query->have_posts()) : $my_query->the_post();
	echo '<p><a href="'.get_permalink($post->ID).'">';
	the_title();
	echo '</a></p>';
	endwhile;
	rewind_posts();
	echo '<div class="arealog" style="text-align:left;margin-left:0px;"><a href="http://www.areato.org/" target="_blank"><img alt="" src="'.get_bloginfo('url').'/wp-content/themes/area/imgs/arealog.jpg" class="imgLogo"/></a></div>';
	echo '<p>&nbsp;</p><p class="topOfThePage"><a href="#topOfThePage"> Torna a inizio pagina</a></p>';
	echo '</div>';

}
/////Diario di Di.To
elseif (in_category(138)){
	echo '<div class="sideLeftInt">';
	if (function_exists('bcn_display'))
	{
		// Display the breadcrumb
		bcn_display();
	} echo"</div>";
	echo '<div class="questions">';
	$my_query = new WP_Query("cat=138");
	while ($my_query->have_posts()) : $my_query->the_post();
	echo '<p><a href="'.get_permalink($post->ID).'">';
	the_title();
	echo '</a></p>';
	endwhile;
	rewind_posts();
	echo '<div class="arealog" style="text-align:left;margin-left:0px;"><a href="http://www.areato.org/" target="_blank"><img alt="" src="'.get_bloginfo('url').'/wp-content/themes/area/imgs/arealog.jpg" class="imgLogo"/></a></div>';
	echo '<p>&nbsp;</p><p class="topOfThePage"><a href="#topOfThePage"> Torna a inizio pagina</a></p>';
	echo '</div>';

}
elseif (in_category(44)){
	echo '<div class="sideLeftInt">';
	if (function_exists('bcn_display'))
	{
		// Display the breadcrumb
		bcn_display();
	} echo"</div>";
	echo '<div class="questions">';
	$my_query = new WP_Query("cat=44");
	while ($my_query->have_posts()) : $my_query->the_post();
	echo '<p><a href="'.get_permalink($post->ID).'">';
	the_title();
	echo '</a></p>';
	endwhile;
	echo '<div class="arealog" style="text-align:left;margin-left:0px;"><a href="http://www.areato.org/" target="_blank"><img alt="" src="'.get_bloginfo('url').'/wp-content/themes/area/imgs/arealog.jpg" class="imgLogo"/></a></div>';
	echo '<p>&nbsp;</p><p class="topOfThePage"><a href="#topOfThePage"> Torna a inizio pagina</a></p>';
	echo '</div>';

}
elseif (in_category(141)){
	echo '<div class="sideLeftInt">';
	if (function_exists('bcn_display'))
	{
		// Display the breadcrumb
		bcn_display();
	} echo"</div>";
	echo '<div class="questions">';
	$my_query = new WP_Query("cat=141");
	while ($my_query->have_posts()) : $my_query->the_post();
	echo '<p><a href="'.get_permalink($post->ID).'">';
	the_title();
	echo '</a></p>';
	endwhile;
	rewind_posts();
	echo '<div class="arealog" style="text-align:left;margin-left:0px;"><a href="http://www.areato.org/" target="_blank"><img alt="" src="'.get_bloginfo('url').'/wp-content/themes/area/imgs/arealog.jpg" class="imgLogo"/></a></div>';
	echo '<p>&nbsp;</p><p class="topOfThePage"><a href="#topOfThePage"> Torna a inizio pagina</a></p>';
	echo '</div>';

}
elseif ((is_category()) || (is_page_template('map.php')) || is_page(82) || is_page(124) || is_page(357)){
	echo '<div class="sideLeftInt">';
	if (function_exists('bcn_display'))
	{
		// Display the breadcrumb
		bcn_display();
	}
	echo"</div>";
	if ((!is_category('43')) && (!is_category('42')) && (!is_category('44')) && (!is_category('137')) && (!is_category('141')) && (!is_category('138')) && (!is_category('54')) && (!is_category('55')) ){
		echo '<div class="questions">';
		if(is_page(82)){
			$catName = 9;
		} elseif($currentCategory == 47){
			$catName = $currentCategory;
		} elseif($currentCategory == 50){
			$catName = $currentCategory;
		}elseif(is_page(357)){
			$catName = 45;
		}
		else {
			foreach( (get_the_category() ) as $category) {
				if($category->cat_ID != 64){
				$catName =  $category->cat_ID;
				//  echo $catName;
				}
			}
		}
		if(!is_page(124))
		{
			if(is_page(357))
			{
				$my_query = new WP_Query("cat=$catName&orderby=title&order=asc");
			}
			elseif( is_category(array('servizi') ) )
			{
				$my_query = new WP_Query("cat=$catName&nopaging=true");
			}
			else 
			{
				$page = ( $wp_query->query_vars['paged'] ) ? $wp_query->query_vars['paged'] : 1;
				$my_query = new WP_Query("cat=$catName&paged=$page");
			}
			while ($my_query->have_posts()) : $my_query->the_post();
			echo '<p><a href="'.get_permalink($post->ID).'">';
			the_title();
			echo '</a></p>';
			endwhile;
			rewind_posts();
		}
		echo '<div class="arealog" style="text-align:left;margin-left:0px;"><a href="http://www.areato.org/" target="_blank"><img alt="" src="'.get_bloginfo('url').'/wp-content/themes/area/imgs/arealog.jpg" class="imgLogo"/></a></div>';
		echo '<p>&nbsp;</p><p class="topOfThePage"><a href="#topOfThePage"> Torna a inizio pagina</a></p>';
		echo '</div>';
	} else {
		echo '<div class="arealog logfl" style="text-align:left;margin-left:0px;"><a href="http://www.areato.org/" target="_blank"><img alt="" src="'.get_bloginfo('url').'/wp-content/themes/area/imgs/arealog.jpg" class="imgLogo" /></a></div>';
	}

}
elseif (is_page_template('annunci.php')){
	echo '<div class="sideLeftInt">';
	if (function_exists('bcn_display'))
	{
		// Display the breadcrumb
		bcn_display();
	} echo"</div>";
	echo '<div class="controls">';
	echo '<div class="piccoliIntro">Guida all\'uso</div>';
	echo '<div class="newsearch">Nuova ricerca</div>';
	echo '<div class="cerca">Cerca</div>';
	echo '<div class="inserisciOfferta">Inserisci offerta</div>';
	echo '<div class="inserisciRichiesta">Inserisci Richiesta</div>';
	echo '</div>';
	echo '<div class="arealog logfl" style="text-align:left;"><a href="http://www.areato.org/" target="_blank"><img alt="" src="'.get_bloginfo('url').'/wp-content/themes/area/imgs/arealog.jpg" class="imgLogo" /></a></div>';
}
elseif ((is_single() && !in_category(4)) || (is_page() && !is_page(124)) || (is_tag()) || (is_search())){
	echo '<div class="sideLeftInt">';
	if (function_exists('bcn_display'))
	{
		// Display the breadcrumb
		bcn_display();
	} echo"</div>";
	if (is_page_template('who.php')){

	} elseif(in_category('34') || in_category('35')) {
		echo '<div class="controls">';
		echo '<div class="chiudiRiassunto">Chiudi</div>';
		echo '</div>';
		echo '<div class="arealog logfl" style="text-align:left;"><a href="http://www.areato.org/" target="_blank"><img alt="" src="'.get_bloginfo('url').'/wp-content/themes/area/imgs/arealog.jpg" class="imgLogo" /></a></div>';
	} else {
		echo '<div class="arealog logfl"><a href="http://www.areato.org/" target="_blank"><img alt="" src="'.get_bloginfo('url').'/wp-content/themes/area/imgs/arealog.jpg" class="imgLogo"/></a></div>';
	}
} elseif (in_category(4) || in_category(47)){
	echo '<div class="sideLeftInt">';
	if (function_exists('bcn_display'))
	{
		// Display the breadcrumb
		bcn_display();
	} echo"</div>";
	echo '<div class="questions">';
	$my_query = new WP_Query("cat=4&nopaging=true");
	while ($my_query->have_posts()) : $my_query->the_post();
	echo '<p><a href="'.get_permalink($post->ID).'">';
	the_title();
	echo '</a></p>';
	endwhile;
	rewind_posts();
	echo '<div class="arealog" style="text-align:left;margin-left:0px;"><a href="http://www.areato.org/" target="_blank"><img alt="" src="'.get_bloginfo('url').'/wp-content/themes/area/imgs/arealog.jpg" class="imgLogo"/></a></div>';
	echo '<p>&nbsp;</p><p class="topOfThePage"><a href="#topOfThePage"> Torna a inizio pagina</a></p>';
	echo '</div>';

}
?>
</div>
