
<div id="sidebarRight">

<?php 
include('dbconnect.php');
$forumControl = isset($_REQUEST['forum'])?$_REQUEST['forum']:null;
if (is_search() || is_page_template('homepage.php') || is_page("124") || is_page_template('videos.php')){
	echo '<div class="boxesBox"><h2 class="blue">News</h2>';
	$my_query = new WP_Query("cat=9&showposts=2");
	while ($my_query->have_posts()) : $my_query->the_post();
	$title = $post->post_title;
	//$link = $post->guid;
	$shortContentText = $post->post_content;
	$shortContentText = strip_tags($shortContentText);
	$shortContentText = substr($shortContentText ,0, 800);
	$lastSpaceOnEarth = strpos($shortContentText, '.', 30);
	$shortContentText = substr($shortContentText ,0, $lastSpaceOnEarth+1);
	$shortContentText = str_replace(".", ".<br/>", $shortContentText);
	$link = get_permalink($post->ID);
	echo  '<div class="boxes"><a href="'.$link.'">'.$title.'</a><br/>'.$shortContentText.'<p style="visibility:hidden;"><a href="'.$link.'">Link al sito competente</a></p> </div>';
	endwhile;
	echo '<div class="divClear"></div>';
	echo '<div class="newsLetterText"><strong>Ricevi la Newsletter di Area:</strong></div>';
	newsLetterForm();
	//ajaxNewsletter::newsletterForm();
	echo '</div>';

	echo '<div class="boxesBox"><h2 class="blue secondLine">Eventi</h2>';
	echo '<div id="cWrap">';
	sidebarEventsCalendar();
	echo '</div>';

	echo '<div class="boxesSecondLine">';

	$dbQuery = "SELECT eventTitle, eventLocation, eventDescription, eventStartDate, postID FROM wp_eventscalendar_main WHERE accessLevel='public' ORDER BY eventStartDate DESC LIMIT 0,3";
	$eventsResult = mysql_query($dbQuery, $local_dbh);
	while ($events = mysql_fetch_array($eventsResult)){
		$eventTitle = stripslashes($events['eventTitle']);
		$eventLocation = stripslashes($events['eventLocation']);
		$eventDescription = $events['eventDescription'];
		$eventStartDate = $events['eventStartDate'];
		$postID = $events['postID'];
		$shortContentText = stripslashes($eventDescription);
		$shortContentText = strip_tags($shortContentText);
		if(strlen($shortContentText) > 20){
			$shortContentText = substr($shortContentText ,0, 800);
			$lastSpaceOnEarth = strpos($shortContentText, ' ', 20);
			$shortContentText = substr($shortContentText ,0, $lastSpaceOnEarth+1);
			$shortContentText = str_replace(" ", " ", $shortContentText);
		}
		$eventLink = $wpdb->get_row("SELECT * FROM $wpdb->posts WHERE ID = '$postID'");
		$linkEvent = $eventLink->guid;
		$eventStartDate = explode("-",$eventStartDate);
		$eventStartDate =  date('d-m-Y',strtotime($eventStartDate[0].''.$eventStartDate[1].''.$eventStartDate[2]));
		echo '<p><span class="smallD">'.$eventStartDate.'</span><br/>';
		echo '<a href="'.$linkEvent.'">'.$eventTitle.'</a><br/>';
		echo '<span class="small">'.stripslashes($eventLocation).'</span></p>';


	}
	echo '</div></div>';

	echo '<div class="boxesBox"><h2 class="blue secondLine">Sogni, segni, disegni</h2>';


	$my_query = new WP_Query("cat=47=&showposts=2");
	while ($my_query->have_posts()) : $my_query->the_post();

	$title = $post->post_title;
	$link = $post->guid;
	$shortContentText = $post->post_content;
	$shortContentText = strip_tags($shortContentText);
	$shortContentText = substr($shortContentText ,0, 800);
	$lastSpaceOnEarth = strpos($shortContentText, '.', 50);
	$shortContentText = substr($shortContentText ,0, $lastSpaceOnEarth+1);
	$shortContentText = str_replace(".", ".<br/>", $shortContentText);
	echo  '<div class="boxesSecondLine"><a href="'.$link.'">'.$title.'</a><br/>'.$shortContentText.'</div>';

	endwhile;
	echo '</div>';



}elseif (is_category(45) || (in_category(45)) || is_page(357)) {
	echo '<div class="boxesBox"><h2 class="blue">News</h2>';
	$my_query = new WP_Query("cat=9&showposts=2");
	while ($my_query->have_posts()) : $my_query->the_post();
	$title = $post->post_title;
	$link = $post->guid;
	$shortContentText = $post->post_content;
	$shortContentText = strip_tags($shortContentText);
	$shortContentText = substr($shortContentText ,0, 800);
	$lastSpaceOnEarth = strpos($shortContentText, '.', 30);
	$shortContentText = substr($shortContentText ,0, $lastSpaceOnEarth+1);
	$shortContentText = str_replace(".", ".<br/>", $shortContentText);
	$link = get_post_meta($post->ID, 'link', $single = true);
	echo  '<div class="boxes"><a href="'.$link.'">'.$title.'</a><br/>'.$shortContentText.'<p><a href="'.$link.'">Link al sito competente</a></p> </div>';
	endwhile;
	echo '</div>';

	echo '<div class="boxesBox"><h2 class="blue secondLine">Eventi</h2>';
	echo '<div id="cWrap">';
	sidebarEventsCalendar();
	echo '</div>';

	echo '<div class="boxesSecondLine">';

	$dbQuery = "SELECT eventTitle, eventLocation, eventDescription, eventStartDate, postID FROM wp_eventscalendar_main WHERE accessLevel='public' ORDER BY eventStartDate DESC LIMIT 0,3";
	$eventsResult = mysql_query($dbQuery, $local_dbh);
	while ($events = mysql_fetch_array($eventsResult)){
		$eventTitle = $events['eventTitle'];
		$eventLocation = $events['eventLocation'];
		$eventDescription = $events['eventDescription'];
		$eventStartDate = $events['eventStartDate'];
		$postID = $events['postID'];
		$shortContentText = $eventDescription;
		$shortContentText = strip_tags($shortContentText);
		$shortContentText = substr($shortContentText ,0, 800);
		$lastSpaceOnEarth = strpos($shortContentText, ' ', 20);
		$shortContentText = substr($shortContentText ,0, $lastSpaceOnEarth+1);
		$shortContentText = str_replace(" ", " ", $shortContentText);
		$eventLink = $wpdb->get_row("SELECT * FROM $wpdb->posts WHERE ID = '$postID'");
		$linkEvent = $eventLink->guid;
		$eventStartDate = explode("-",$eventStartDate);
		$eventStartDate =  date('d-m-Y',strtotime($eventStartDate[0].''.$eventStartDate[1].''.$eventStartDate[2]));
		echo '<p><span class="smallD">'.$eventStartDate.'</span><br/>';
		echo '<a href="'.$linkEvent.'">'.$eventTitle.'</a><br/>';
		echo $shortContentText.'<br/><span class="small">'.stripslashes($eventLocation).'</span></p>';


	}
	echo '</div></div>';
	if(!is_category(45) && !is_page(357)){
		echo '<div class="boxLarge"><div class="halfBox"><h2 class="blue secondLineHalf">Cosa vuol dire</h2>';
		echo '<div class="boxes halfBoxesSecond"><em>Trova qui</em><br/><ul>';
		foreach((get_the_category()) as $category) {
			if($category->cat_ID != 64){
				$myCat =  $category->cat_ID;
			}
		}
		//echo $myCat;
		$gloassarioQuery = "SELECT * FROM wp_postmeta WHERE meta_key = 'glossario' AND meta_value = '$myCat'";
		$glossIDs = $wpdb->get_results($gloassarioQuery);
		foreach($glossIDs as $glossID){
			$IDS = $glossID->post_id;
			$myPostsQuery = "SELECT * FROM $wpdb->posts WHERE ID = '$IDS' AND post_status = 'publish' ORDER BY post_title";
			$glossPosts = $wpdb->get_results($myPostsQuery);
			foreach($glossPosts as $glossPost){
				$title = $glossPost->post_title;
				$link = $glossPost->guid;
				echo '<li><a href="'.$link.'">'.$title.'</a></li>';
			}
		}


		echo '</ul>';

		echo '<p class="segnala2"><a href="http://dito.areato.org/home/?page_id=357" class="segnala">Tutti i cosa vuol dire</a></p></div></div>';



		echo '<div class="halfBox"><h2 class="blue secondLineHalf secondLineHalfLong">Links</h2>';
		echo '<div class="boxes halfBoxesSecond halfBoxesSecondBrowserFix"><em>Serie di link utili</em><br/>';
		echo '<ul>';
		wp_list_bookmarks('title_li=0&categorize=0&category='.$myCat.'&orderby=id&order=DESC&limit=5');
		echo '</ul>';
		echo '<p class="segnala2"><a href="http://dito.areato.org/home/?page_id=124" class="segnala">Tutti i link</a></p>';
		echo '</div></div></div>';
	}
} elseif(in_category(51) || in_category(51) || in_category(53) ){


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
	<p class="about"><strong>Redazione dito.areato.org</strong></p>';
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
	echo '<br/><p class="about"><strong>Equipe Che fare?</strong></p>';
	$my_query = new WP_Query("cat=53&showposts=10");
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
	echo '</div>';
?>
<div class="boxes goaway">
<p class="about"><strong>Dove siamo</strong></p>
<p class="about">Associazione Area Onlus<br />Corso Regina Margherita, 55<br/>10124 - Torino</p>
<p class="about"><a href="<?php bloginfo('url');?>/map.php?mapsearch=area">trova sulla mappa</a></p>
<br/><p class="about"><strong>Contatti</strong></p>
<p class="about">E' possibile contattarci<br />il luned&igrave; e il venerd&igrave;<br />dalle ore 14.30 alle 18.30</p>
<p class="about">Tel: 011 837642</p>
<p class="about">Email:<a href="mailto:info@dito.areato.org"> info@dito.areato.org</a></p>

</div>


<?php
}
elseif (in_category('9')){
	$do_not_duplicate = $post->ID;
	echo '<h2 class="blue">Ultime</h2>';
	$my_query = new WP_Query("cat=9&showposts=3");
	while ($my_query->have_posts()) : $my_query->the_post();
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
		echo  '<div class="boxes"><a href="'.$link.'">'.$title.'</a><br/>'.$shortContentText.'</div>';
	}
	endwhile;

	echo '<h2 class="blue secondLine">Le pi&ugrave; lette</h2>';
	/*$my_query = new WP_Query("cat=9&showposts=2");
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

	endwhile;*/
	popular_posts('limit=2&output_template=<div class="boxesSecondLine">{link}</div>&divider=');
}

elseif (in_category('49') || (in_category('47')) || (in_category('50'))){


	//echo  $do_not_duplicate;
	$do_not_duplicate = $post->ID;
	echo '<h2 class="blue">Sullo scaffale</h2>';
	$my_query = new WP_Query("cat=47=&showposts=2");
	while ($my_query->have_posts()) : $my_query->the_post();
	if ($post->ID ==  $do_not_duplicate){
		continue;
		update_post_caches($posts);
	} else {

		$title = $post->post_title;
		$link = $post->guid;
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
	echo '<div class="boxes" style="padding-top:15px;text-align:right;float:right;"> <p class="segnala2"><a href="http://dito.areato.org/home/?cat=47" class="segnala">Tutti i racconti</a></p></div>';
	echo '<h2 class="blue secondLine">In cornice</h2>';
	$my_query = new WP_Query("cat=50&showposts=2");
	while ($my_query->have_posts()) : $my_query->the_post();
	$title = $post->post_title;
	if (explode("-", $title)){
		$title = explode("-", $title);
		$title = $title[0];
	}
	$link = $post->guid;
	$shortContentText = $post->post_content;
	echo  '<div class="boxesSecondLine"><a href="'.$link.'">'.$title.'<br/>Illustrazioni</a></div>';

	endwhile;
	echo '<div class="boxes" style="padding-top:15px;text-align:right;float:right;"> <p class="segnala2"><a href="http://dito.areato.org/home/?cat=50" class="segnala">Tutte le illustrazioni</a></p></div>';

}
elseif ((in_category("44")) || (in_category("55")) || (is_category("44")) || (is_category("55"))){
	echo '<h2 class="blue">Recensioni</h2>';
	$my_query = new WP_Query("cat=44&showposts=2");
	while ($my_query->have_posts()) : $my_query->the_post();
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
		echo  '<div class="boxes"><a href="'.$link.'">'.$title.'</a><br/>'.$shortContentText.'</div>';
	}
	endwhile;
	echo '<div class="boxes" style="padding-top:15px;text-align:right;float:right;"> <p class="segnala2"><a href="http://dito.areato.org/home/?cat=44" class="segnala">Tutti le recensioni</a></p></div>';
	echo '<h2 class="blue secondLine">Pubblicazioni Area</h2>';
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

	echo '<div class="boxes" style="padding-top:15px;text-align:right;float:right;"> <p class="segnala2"><a href="http://dito.areato.org/home/?cat=55" class="segnala">Tutte le recensioni</a></p></div>';

}/////////PERCORSI AND GENERIC SINGLE POST OR CAT//////////////////////////////////////////////

elseif ((is_category()) && (!is_category('43')) && (!is_category('47')) && (!is_category('50')) && (!is_category('44')) && (!is_category('54')) && (!is_category('55')) && (!is_category('56')) && (!is_category('57')) && (!is_category('45')) && (!is_category('58')) && (!is_category('59')) && (!is_category('60')) && (!is_category('61'))|| (is_single()) && (!in_category('42')) && (!in_category('43'))  && (!in_category('34')) && (!in_category('35')) && (!in_category('54')) &&(!in_category('9')) && (!in_category('49')) && (!in_category('44')) && (!in_category('48')) &&(!in_category('47')) && (!in_category('50')) && (!in_category('55')) && (!in_category('56')) && (!in_category('57')) && (!in_category('58')) && (!in_category('59')) && (!in_category('60')) && (!in_category('61')) && (!in_category('12')) && (!in_category('62')) && (!in_category('51')) && (!in_category('51')) && (!in_category('53')) && (!in_category('45')) && (!in_category('63'))|| (is_page_template('map.php')) && (!is_page(357))){
	
	if (($forumControl != 'not') || is_category(45) || in_category(45) || is_page(357)){
		echo '<h2 class="blue">Forum</h2>';
	}
	foreach((get_the_category()) as $category) {
		if($category->cat_name != "Percorsi in evidenza"){
			$catName =  $category->cat_name;
		}
	}
	$dbQuery = "SELECT bb_posts.topic_id, bb_posts.forum_id, bb_posts.post_time, bb_posts.post_id, bb_posts.post_text, bb_forums.forum_id, bb_forums.forum_name, bb_forums.posts,bb_topics.topic_title, bb_topics.topic_id, bb_topics.topic_last_poster_name  FROM bb_posts, bb_forums, bb_topics WHERE bb_posts.forum_id = bb_forums.forum_id AND bb_topics.topic_id = bb_posts.topic_id  AND bb_forums.forum_name = '$catName' AND post_status = '0' ORDER BY post_time DESC LIMIT 0,2";
	$forumsResult = mysql_query($dbQuery, $local_dbh) or die(mysql_error());
	while ($topics = mysql_fetch_array($forumsResult)){
		$topicContent =  $topics['post_text'];
		$forumName =    $topics['forum_name'];
		//$authorFirst =  $topics['topic_poster_name'];
		$authorLast =  $topics['topic_last_poster_name'];
		$topicId = $topics['topic_id'];
		$forumId = $topics['forum_id'];
		$title =  $topics['topic_title'];
		$postNum = $topics['posts'];
		$shortContentText =$topicContent;
		$shortContentText = strip_tags($shortContentText);
		$shortContentText = htmlspecialchars($shortContentText);
		$shortContentText = substr($shortContentText ,0, 50);
		$lastSpaceOnEarth = strrpos($shortContentText, ' ');
		$shortContentText = substr($shortContentText ,0, $lastSpaceOnEarth+1);
		$myURL = 'http://dito.areato.org/home/bbpress';
		$fLength = sizeof($forumId);
		if ($forumControl != 'not'){
			echo '<div class="boxes"><a href="' .$myURL. '/topic.php?id=' . $topicId . '" >'.$title.'</a>,';
			echo ' <a href="' . $myURL . '/forum.php?id=' . $forumId . '" >'.$forumName.'</a><br />';
			echo '<em>'.$authorLast.'</em>';
			echo '<p>"'.$shortContentText.'<a href="' .$myURL. '/topic.php?id=' . $topicId . '" >[...]</a></p></div>';
		}
	}
	if(!is_page_template('map.php')){
		if ($forumControl == 'not'){
			echo '<h2 class="blue">Trova servizio</h2>';
		} else {
			echo '<h2 class="blue secondLine">Trova servizio</h2>';
		}
		if ($forumControl == 'not'){
?>
<div class="boxes">
<?php } else {?>
<div class="boxesSecondLine">
<?php } ?>
<p><img src="<?php bloginfo('stylesheet_directory');?>/imgs/map1.jpg" alt="smallmap" /></p>
<form id="mapform" name="mapform" method="get" action="<?php bloginfo('url');?>/map.php">
<input type="text" name="mapsearch" value="Cerca"  id="mapsearch" />
<input type="image" src="http://dito.areato.org/home/wp-content/themes/area/imgs/search.gif" name="submit"  id="submap" />
</form>
</div>
<div class="boxesSecondLine">
<p>
<?php 
foreach((get_the_category()) as $category) {
	if($category->cat_ID != 64){
		$catName =  $category->cat_ID;
	}
}
$mapsLinksQuery = "SELECT * FROM g_maps WHERE mcategory_id = '$catName' ORDER BY map_id DESC LIMIT 0,5";
$mapsLinks = $wpdb->get_results($mapsLinksQuery);
foreach ($mapsLinks as $mapsLink){
	$sname = $mapsLink->service;
	echo '<a href="http://dito.areato.org/home/map.php?mapsearch='.$sname.'">'.$sname.'</a><br />';
}
?>
</p>
</div>
<?php
	}

	echo '<div class="boxLarge"><div class="halfBox"><h2 class="blue secondLineHalf">Cosa vuol dire</h2>';
	echo '<div class="boxes halfBoxesSecond"><em>Trova qui</em><br/><ul>';
	foreach((get_the_category()) as $category) {
		if($category->cat_ID != 64){
			$myCat =  $category->cat_ID;
		}
	}
	//echo $myCat;
	$gloassarioQuery = "SELECT * FROM wp_postmeta WHERE meta_key = 'glossario' AND meta_value = '$myCat'";
	$glossIDs = $wpdb->get_results($gloassarioQuery);
	foreach($glossIDs as $glossID){
		$IDS = $glossID->post_id;
		$myPostsQuery = "SELECT * FROM $wpdb->posts WHERE ID = '$IDS' AND post_status = 'publish' ORDER BY post_title DESC";
		$glossPosts = $wpdb->get_results($myPostsQuery);
		foreach($glossPosts as $glossPost){
			$title = $glossPost->post_title;
			$link = $glossPost->guid;
			echo '<li><a href="'.$link.'">'.$title.'</a></li>';
		}
	}


	echo '</ul>';
	echo '<p class="segnala1"><a href="http://dito.areato.org/home/?page_id=357" class="segnala">Tutti i cosa vuol dire</a></p></div></div>';



	echo '<div class="halfBox"><h2 class="blue secondLineHalf secondLineHalfLong">Links</h2>';
	echo '<div class="boxes halfBoxesSecond halfBoxesSecondBrowserFix"><em>Serie di link utili</em><br/>';
	echo '<ul>';
	wp_list_bookmarks('title_li=0&categorize=0&category='.$myCat.'&orderby=id&order=DESC&limit=5');
	echo '</ul>';
	echo '<p class="segnala2"><a href="http://dito.areato.org/home/?page_id=124" class="segnala">Tutti i link</a></p>';
	echo '</div></div></div>';
}

/////////////PERCORSI END///////////////////////////////////////////

elseif ((is_page_template('annunci.php')) || (in_category('34')) || (in_category('35'))){
	echo '<div class="boxesBox"><h2 class="blue">Riassunto annunci</h2>';
	echo  '<div class="boxes">';
	echo '<h4 class="resume">Offerte</h4>';
	echo '<span class="offro">ausili<g class="countAnn"></g></span><br />';

	echo '<span class="offro">giocattoli<g class="countAnn"></g></span><br />';
	echo '<span class="offro">software<g class="countAnn"></g></span><br />';
	echo '<span class="offro">libri<g class="countAnn"></g></span><br />';

	echo '</div>';
	echo  '<div class="boxes">';
	echo '<h4 class="resume">Richieste</h4>';
	echo '<span class="cerco">ausili<g class="countAnn"></g></span><br />';

	echo '<span class="cerco">giocattoli<g class="countAnn"></g></span><br />';
	echo '<span class="cerco">software<g class="countAnn"></g></span><br />';
	echo '<span class="cerco">libri<g class="countAnn"></g></span><br />';

	echo '</div></div>';
	echo '<div class="boxesBox boxesBoxSecond"><h2 class="blue secondLine">Ultimi annunci</h2>';
	$my_query = new WP_Query("cat=31&showposts=2");
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
	$shortContentText = substr($shortContentText ,0, 800);
	$lastSpaceOnEarth = strpos($shortContentText, '.', 20);
	$shortContentText = substr($shortContentText ,0, $lastSpaceOnEarth+1);
	$shortContentText = str_replace(".", ".<br/>", $shortContentText);
	echo '<div class="boxesSecondLine">';
	echo '<a href="'.$link.'">'.$title.'</a><br/>';
	echo '<em>'.$myAuth.'</em><br />';
	echo $shortContentText.'</div>';
	endwhile;
	echo '</div>';
} elseif (is_page_template('eventscalendar.php') || in_category('12') || in_category('62') || in_category('63') || is_category("12")){

	echo '<h2 class="blue">Arte, spettacoli, appuntamenti</h2>';
	$catParam = 62;
	$eventIds = $wpdb->get_results("SELECT object_id FROM $wpdb->term_relationships WHERE term_taxonomy_id='$catParam' ORDER BY object_id DESC LIMIT 0,2");
	$postNum = sizeof($eventIds);
	foreach($eventIds as $eventId){
		$eventId = $eventId->object_id;
		$postStatus = $wpdb->get_var("SELECT post_status FROM wp_posts WHERE ID = '$eventId'");
		if($postStatus == 'publish'){
			$eventQuery = "SELECT * FROM wp_eventscalendar_main WHERE postID='$eventId' ORDER BY eventStartDate DESC LIMIT 0,2";
			$events = mysql_query($eventQuery, $local_dbh);
			while($event = mysql_fetch_array($events)){
				$url = $wpdb->get_var("SELECT guid FROM $wpdb->posts WHERE ID='$eventId'");
				$title = $event['eventTitle'];
				$eventLocation = $event['eventLocation'];
				$eventStartDate =  $event['eventStartDate'];
				$eventStartDate = explode("-",$eventStartDate);
				$eventStartDate =  date('d-m-Y',strtotime($eventStartDate[0].''.$eventStartDate[1].''.$eventStartDate[2]));
				$eventStartTime = $event['eventStartTime'];
				$shortContentText = $event['eventDescription'];
				$shortContentText = strip_tags($shortContentText);
				$shortContentText = htmlspecialchars($shortContentText);
				$shortContentText = substr($shortContentText ,0, 50);
				$lastSpaceOnEarth = strrpos($shortContentText, ' ');
				$shortContentText = substr($shortContentText ,0, $lastSpaceOnEarth+1);
				echo '<div class="boxes"><a href="' .$url.'" >'.$title.'</a>,';
				echo '<p><strong>Luogo: </strong>'.$eventLocation.'<br/><strong>Data inizio: </strong>'.$eventStartDate.'<br/><strong>Ora inizio: </strong>'.$eventStartTime.'<br/><strong>Descrizione: </strong>'.stripslashes($shortContentText).'...<a href="' .$url.'">['.$postNum.']</a></p></div>';
			}
		}
	}
	echo '<h2 class="blue secondLine">Convegni e seminari</h2>';
	$catParam = 63;
	$eventIds = $wpdb->get_results("SELECT object_id FROM $wpdb->term_relationships WHERE term_taxonomy_id='$catParam' ORDER BY object_id DESC LIMIT 0,2");
	$postNum = sizeof($eventIds);
	foreach($eventIds as $eventId){
		$eventId = $eventId->object_id;
		$postStatus = $wpdb->get_var("SELECT post_status FROM wp_posts WHERE ID = '$eventId'");
		if($postStatus == 'publish'){
			$eventQuery = "SELECT * FROM wp_eventscalendar_main WHERE postID='$eventId' ORDER BY eventStartDate DESC LIMIT 0,2";
			$events = mysql_query($eventQuery, $local_dbh);
			while($event = mysql_fetch_array($events)){
				$url = $wpdb->get_var("SELECT guid FROM $wpdb->posts WHERE ID='$eventId'");
				$title = $event['eventTitle'];
				$eventLocation = $event['eventLocation'];
				$eventStartDate =  $event['eventStartDate'];
				$eventStartDate = explode("-",$eventStartDate);
				$eventStartDate =  date('d-m-Y',strtotime($eventStartDate[0].''.$eventStartDate[1].''.$eventStartDate[2]));
				$eventStartTime = $event['eventStartTime'];
				$shortContentText = $event['eventDescription'];
				$shortContentText = strip_tags($shortContentText);
				$shortContentText = htmlspecialchars($shortContentText);
				$shortContentText = substr($shortContentText ,0, 50);
				$lastSpaceOnEarth = strrpos($shortContentText, ' ');
				$shortContentText = substr($shortContentText ,0, $lastSpaceOnEarth+1);
				echo '<div class="boxesSecondLine"><a href="' .$url.'" >'.$title.'</a>,';
				echo '<p><strong>Luogo: </strong>'.$eventLocation.'<br/><strong>Data inizio: </strong>'.$eventStartDate.'<br/><strong>Ora inizio: </strong>'.$eventStartTime.'<br/><strong>Descrizione: </strong>'.stripslashes($shortContentText).'...<a href="' .$url.'">['.$postNum.']</a></p></div>';
			}
		}
	}

	echo '<h2 class="blue secondLine">Trova servizio</h2>';
  ?>
<div class="boxes">
<p><img src="<?php bloginfo('stylesheet_directory');?>/imgs/map1.jpg" alt="smallmap" /></p>
<form id="mapform" name="mapform" method="get" action="<?php bloginfo('url');?>/map.php">
<input type="text" name="mapsearch" value="Cerca"  id="mapsearch" />
<input type="image" src="http://dito.areato.org/home/wp-content/themes/area/imgs/search.gif" name="submit"  id="submap" />
</form>
</div>
<div class="boxesSecondLine">
<p>
<?php
$mapsLinksQuery = "SELECT * FROM g_maps WHERE mcategory_id = '12' ORDER BY map_id DESC LIMIT 0,5";
$mapsLinks = $wpdb->get_results($mapsLinksQuery);
foreach ($mapsLinks as $mapsLink){
	$sname = $mapsLink->service;
	echo '<a href="http://dito.areato.org/home/map.php?mapsearch='.$sname.'">'.$sname.'</a><br />';
}

?>
</p>
</div>

<?php } elseif (is_page('88') || is_category('54') ||  is_category('56')  ||  is_category('57')  ||  is_category('58')  ||  is_category('59')  ||  is_category('60') ||  is_category('61') || in_category('54') ||  in_category('56')  ||  in_category('57')  ||  in_category('58')  ||  in_category('59')  ||  in_category('60') ||  in_category('61')){
	echo '<h2 class="blue">Esperienze su...</h2>';
?>
<div class="boxes">
<p>
<a href="<?php bloginfo('url');?>/?cat=57">Servizi</a><br/>
<a href="<?php bloginfo('url');?>/?cat=56">La scuola</a><br/>
<a href="<?php bloginfo('url');?>/?cat=58">Aiuti alla famiglia</a><br/>
<a href="<?php bloginfo('url');?>/?cat=59">Trasporti</a><br/>
<a href="<?php bloginfo('url');?>/?cat=60">Carte in regola</a><br/>
<a href="<?php bloginfo('url');?>/?cat=61">Sport e tempo libero</a>
</p>
</div>
<p class="segnala1"><a class="segnala" href="mailto:info@dito.areato.org">Se vuoi raccontarci la tua esperienza scrivi alla redazione <img src="<?php bloginfo('stylesheet_directory');?>/imgs/mail.gif" alt="" /></a></p>
<?php
echo '<div class="boxesBox boxesBoxSecond"><h2 class="blue secondLine">Le pi&ugrave; lette</h2>';
$my_query = new WP_Query("cat=54&showposts=2");
while ($my_query->have_posts()) : $my_query->the_post();
$title = $post->post_title;
$link = $post->guid;
$shortContentText = $post->post_content;
$shortContentText = strip_tags($shortContentText);
$shortContentText = substr($shortContentText ,0, 800);
$lastSpaceOnEarth = strpos($shortContentText, '.', 50);
$shortContentText = substr($shortContentText ,0, $lastSpaceOnEarth+1);
$shortContentText = str_replace(".", ".<br/>", $shortContentText);
echo '<div class="boxesSecondLine"><p class="about"><a href="' .$link . '" >'.$title.'</a>';
echo '</p><em>'.get_post_meta($post->ID, 'Author Name', $single=true).'</em><br />';
echo $shortContentText.' <a href="' .$link. '" >[...]</a></div>';
endwhile;
echo "</div>";
echo '<div class="boxesBox boxesBoxSecond"><h2 class="blue secondLine">La pi&ugrave; recente</h2>';
$dbQuery = "SELECT bb_posts.topic_id, bb_posts.forum_id, bb_posts.post_time, bb_posts.post_id, bb_posts.post_text, bb_forums.forum_id, bb_forums.forum_name, bb_forums.posts,bb_topics.topic_title, bb_topics.topic_id, bb_topics.topic_last_poster_name  FROM bb_posts, bb_forums, bb_topics WHERE bb_posts.forum_id = bb_forums.forum_id AND bb_topics.topic_id = bb_posts.topic_id ORDER BY post_time DESC LIMIT 0,1";
$forumsResult = mysql_query($dbQuery, $local_dbh) or die(mysql_error());
while ($topics = mysql_fetch_array($forumsResult)){
	$topicContent =  $topics['post_text'];
	$forumName =    $topics['forum_name'];
	//$authorFirst =  $topics['topic_poster_name'];
	$authorLast =  $topics['topic_last_poster_name'];
	$topicId = $topics['topic_id'];
	$forumId = $topics['forum_id'];
	$title =  $topics['topic_title'];
	$postNum = $topics['posts'];
	$shortContentText =$topicContent;
	$shortContentText = strip_tags($shortContentText);
	$shortContentText = htmlspecialchars($shortContentText);
	$shortContentText = substr($shortContentText ,0, 300);
	$lastSpaceOnEarth = strrpos($shortContentText, ' ');
	$shortContentText = substr($shortContentText ,0, $lastSpaceOnEarth+1);
	$myURL = 'http://dito.areato.org/home/bbpress';
	$fLength = sizeof($forumId);

	echo '<div class="boxesSecondLine" style="width:390px;"><p class="about"><a href="' .$myURL. '/topic.php?id=' . $topicId . '" >'.$title.'</a>,';
	echo ' <a href="' . $myURL . '/forum.php?id=' . $forumId . '" >'.$forumName.'</a><br />';
	echo '<em>'.$authorLast.'</em><br />';
	echo $shortContentText.'..." <a href="' .$myURL. '/forum.php?id='.$forumId.'" >['.$postNum.']</a></p></div>';

}
echo "</div>";
}
?>
</div>