<div id="sidebarLeft">
<?php 
include('dbconnect.php');

$currentCategory = isset($_GET['cat'])?$_GET['cat']:null;
if ( is_page(3) ){
	echo '<div class="forums">';
	echo '<h2 class="green">Forum</h2>';
	$dbQuery = "SELECT bb_posts.topic_id, bb_posts.forum_id, bb_posts.poster_id, bb_posts.post_time, bb_posts.post_id, bb_posts.post_text, bb_forums.forum_id, bb_forums.forum_name, bb_forums.posts,bb_topics.topic_title, bb_topics.topic_id, bb_topics.topic_last_poster_name  FROM bb_posts, bb_forums, bb_topics WHERE bb_posts.forum_id = bb_forums.forum_id AND bb_topics.topic_id = bb_posts.topic_id AND post_status = '0' ORDER BY post_time DESC LIMIT 0,2";
	$forumsResult = mysql_query($dbQuery, $local_dbh) or die(mysql_error());
	while ($topics = mysql_fetch_array($forumsResult)){
		$topicContent =  $topics['post_text'];
		$forumName =    $topics['forum_name'];
		//$authorFirst =  $topics['topic_poster_name'];
		$authorID =  $topics['poster_id'];
		$authorLast = $wpdb->get_var("SELECT display_name FROM $wpdb->users WHERE ID = '$authorID'");
		$topicId = $topics['topic_id'];
		$forumId = $topics['forum_id'];
		$title =  $topics['topic_title'];
		$postNum = $topics['posts'];
		$shortContentText =$topicContent;
		$shortContentText = strip_tags($shortContentText);
		$shortContentText = htmlspecialchars($shortContentText);
		if (strlen($shortContentText) > 65) {
			$shortContentText = substr($shortContentText ,0, 70);
			$lastSpaceOnEarth = strrpos($shortContentText, ' ');
			$shortContentText = substr($shortContentText ,0, $lastSpaceOnEarth+1);
		}
		$myURL = 'http://dito.areato.org/home/bbpress';
		$fLength = sizeof($forumId);
		//   echo $topicId;
		// echo $forumId[0];

		echo '<h4><a href="' .$myURL. '/topic.php?id=' . $topicId . '" >'.$title.'</a>';
		echo '<a href="' . $myURL . '/forum.php?id=' . $forumId . '" ><em>'.$forumName.'</em></a></h4>';
		echo '<em>'.$authorLast.'</em>';
		echo '<p>'.$shortContentText.'<a href="' .$myURL. '/topic.php?id=' . $topicId . '" >[...]</a></p>';

	}
	echo '</div>';
	echo '<h2 class="green">Interviste e dintorni</h2>';
	$my_query = new WP_Query("cat=137&showposts=2");
	while ($my_query->have_posts()) : $my_query->the_post();
	$title = $post->post_title;
	$link = $post->guid;
	$author = $post->post_author;
	$autQuery = "SELECT user_nicename FROM wp_users WHERE ID ='$author'";
	$myResultAuth =mysql_query($autQuery, $local_dbh);
	$myRowAuth = mysql_fetch_row($myResultAuth);
	$myAuth= $myRowAuth[0];
	$shortContentText = $post->post_content;
	$shortContentText = strip_tags($shortContentText);
	$shortContentText = htmlspecialchars($shortContentText);
	if (strlen($shortContentText) > 65) {
		$shortContentText = substr($shortContentText ,0, 800);
		$lastSpaceOnEarth = strpos($shortContentText, ' ', 40);
		$shortContentText = substr($shortContentText ,0, $lastSpaceOnEarth+1);
		//$shortContentText = str_replace(" ", "...", $shortContentText);
	}

	echo '<div class="forums">';
	echo '<h4><a href="'.$link.'">'.$title.'</a></h4>';
	echo '<em>'.$myAuth.'</em>';
	echo '<p>'.$shortContentText.'[<a href="'.$link.'">...</a>]</p></div>';
	endwhile;
	echo '<div class="arealog"> <a href="http://www.areato.org/" target="_blank"><img alt="" src="http://dito.areato.org/wp-content/themes/area/imgs/arealog.jpg" class="imgLogo"/></a>
	<!-- <a href="http://www.fondazionecrt.it" target="_blank"><img alt="" src="http://dito.areato.org/wp-content/uploads/crt.gif" class="crtGif"/></a> -->
		
			 <div class="imgDonazioni" style="text-align:center;">	
			 	<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
			<input type="hidden" name="cmd" value="_s-xclick">
			<input type="hidden" name="hosted_button_id" value="3372968">
			<input type="image" src="http://dito.areato.org/wp-content/themes/area/imgs/donazioni.jpg" border="0" name="submit" alt=""></form><span class="donazione"><strong>DONA ORA !</strong></span></div></div> ';
			
}
elseif( is_page_template('links.php') )
{
	echo '<div class="sideLeftInt">';
	if (function_exists('bcn_display'))
	{
		// Display the breadcrumb
		bcn_display();
	} echo"</div>";
	echo '<div class="arealog logfl"><a href="http://www.areato.org/" target="_blank"><img alt="" src="http://dito.areato.org/wp-content/themes/area/imgs/arealog.jpg" class="imgLogo"/></a></div>';
}
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
	echo '<p><a href="'.$post->guid.'">';
	the_title();
	echo '</a></p>';
	endwhile;
	echo '<div class="arealog" style="text-align:left;margin-left:0px;"><a href="http://www.areato.org/" target="_blank"><img alt="" src="http://dito.areato.org/wp-content/themes/area/imgs/arealog.jpg" class="imgLogo"/></a></div>';
	echo '<p>&nbsp;</p><p class="topOfThePage"><a href="#topOfThePage"> Torna a inizio pagina</a></p>';
	echo '</div>';

}
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
	echo '<p><a href="'.$post->guid.'">';
	the_title();
	echo '</a></p>';
	endwhile;
	echo '<div class="arealog" style="text-align:left;margin-left:0px;"><a href="http://www.areato.org/" target="_blank"><img alt="" src="http://dito.areato.org/wp-content/themes/area/imgs/arealog.jpg" class="imgLogo"/></a></div>';
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
	echo '<p><a href="'.$post->guid.'">';
	the_title();
	echo '</a></p>';
	endwhile;
	echo '<div class="arealog" style="text-align:left;margin-left:0px;"><a href="http://www.areato.org/" target="_blank"><img alt="" src="http://dito.areato.org/wp-content/themes/area/imgs/arealog.jpg" class="imgLogo"/></a></div>';
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
	echo '<p><a href="'.$post->guid.'">';
	the_title();
	echo '</a></p>';
	endwhile;
	echo '<div class="arealog" style="text-align:left;margin-left:0px;"><a href="http://www.areato.org/" target="_blank"><img alt="" src="http://dito.areato.org/wp-content/themes/area/imgs/arealog.jpg" class="imgLogo"/></a></div>';
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
			foreach((get_the_category()) as $category) {
				if($category->cat_ID != 64){
				$catName =  $category->cat_ID;
				//  echo $catName;
				}
			}
		}
		if(!is_page(124)) {
		if(is_page(357)){
		$my_query = new WP_Query("cat=$catName&orderby=title&order=asc");
		} else {
		$my_query = new WP_Query("cat=$catName");
		}
		while ($my_query->have_posts()) : $my_query->the_post();
		echo '<p><a href="'.$post->guid.'">';
		the_title();
		echo '</a></p>';
		endwhile;

		}
		echo '<div class="arealog" style="text-align:left;margin-left:0px;"><a href="http://www.areato.org/" target="_blank"><img alt="" src="http://dito.areato.org/wp-content/themes/area/imgs/arealog.jpg" class="imgLogo"/></a></div>';
		echo '<p>&nbsp;</p><p class="topOfThePage"><a href="#topOfThePage"> Torna a inizio pagina</a></p>';
		echo '</div>';
	} else {
		echo '<div class="arealog logfl" style="text-align:left;margin-left:0px;"><a href="http://www.areato.org/" target="_blank"><img alt="" src="http://dito.areato.org/wp-content/themes/area/imgs/arealog.jpg" class="imgLogo" /></a></div>';
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
	echo '<div class="arealog logfl" style="text-align:left;"><a href="http://www.areato.org/" target="_blank"><img alt="" src="http://dito.areato.org/wp-content/themes/area/imgs/arealog.jpg" class="imgLogo" /></a></div>';
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
		echo '<div class="arealog logfl" style="text-align:left;"><a href="http://www.areato.org/" target="_blank"><img alt="" src="http://dito.areato.org/wp-content/themes/area/imgs/arealog.jpg" class="imgLogo" /></a></div>';
	} else {
		echo '<div class="arealog logfl"><a href="http://www.areato.org/" target="_blank"><img alt="" src="http://dito.areato.org/wp-content/themes/area/imgs/arealog.jpg" class="imgLogo"/></a></div>';
	}
} elseif (in_category(4) || in_category(47)){
	echo '<div class="sideLeftInt">';
	if (function_exists('bcn_display'))
	{
		// Display the breadcrumb
		bcn_display();
	} echo"</div>";
	echo '<div class="questions">';
	$my_query = new WP_Query("cat=4");
	while ($my_query->have_posts()) : $my_query->the_post();
	echo '<p><a href="'.$post->guid.'">';
	the_title();
	echo '</a></p>';
	endwhile;

	echo '<div class="arealog" style="text-align:left;margin-left:0px;"><a href="http://www.areato.org/" target="_blank"><img alt="" src="http://dito.areato.org/wp-content/themes/area/imgs/arealog.jpg" class="imgLogo"/></a></div>';
	echo '<p>&nbsp;</p><p class="topOfThePage"><a href="#topOfThePage"> Torna a inizio pagina</a></p>';
	echo '</div>';

}
?>
</div>