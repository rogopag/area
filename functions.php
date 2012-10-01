<?php
error_reporting(E_ALL); 
ini_set("display_errors", 0);

//define pages in this array to add them and add a template to them

remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wp_generator');

function dito_frontEndStylesAndScripts()
{
	wp_enqueue_style( 'dito-front', get_bloginfo('stylesheet_directory') . '/general-overrides.css', '', '0.1', 'screen' );
}
add_action('get_header', 'dito_frontEndStylesAndScripts');
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
      echo '<style>
      html.wp-toolbar{padding-top:0;}
      body.admin-bar #wpcontent, body.admin-bar #adminmenu { padding-top: 0px !important; }
      </style>';
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
function dito_printObjectTermsInNiceFormat( $ID, $taxonomies = array(), $excludes = array(), $args = array() )
{
	( empty($taxonomies) ) ? $taxonomies = get_object_taxonomies( get_post_type( $ID ) ) : $taxonomies;
	
	
	if( $excludes && in_array($excludes, $taxonomies) ) 
	{
		foreach( $excludes as $exclude )
		{
			$key = array_search( $exclude, $taxonomies );
			unset( $taxonomies[$key] );
		}
	}
	
	$terms = wp_get_object_terms( $ID, $taxonomies, $args );
	
	$str = '';
	
	if( $terms )
	{
		foreach( $terms as $term )
		{
			//if( $term->name != 'Altro' )
			$str .= '<a href="'.get_bloginfo('url').'/'.$term->taxonomy.'/'.$term->slug.'">'.$term->name.'</a>, ';
		}
	}
	return rtrim($str, ', ');
}
if ( ! function_exists( 'twentyeleven_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 */
function twentyeleven_content_nav( $nav_id ) {
	global $wp_query;

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $nav_id; ?>">
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Vecchi', 'twentyeleven' ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( __( 'Nuovi <span class="meta-nav">&rarr;</span>', 'twentyeleven' ) ); ?></div>
		</nav><!-- #nav-above -->
	<?php endif;
}
endif; // twentyeleven_content_nav
add_theme_support( 'post-thumbnails' );

// for debug purposes only
if( !function_exists('show_template') )
{
	add_action('wp_head', 'show_template');
	function show_template() {
	    global $template;
	    echo basename($template);
	}
}
function ditoDoExerpt()
{
	//make sure add this plugin shit doesn't bother
	if (function_exists ( 'addthis_init' )) {
		remove_filter ( 'the_content', 'addthis_display_social_widget', 15 );
		remove_filter ( 'get_the_excerpt', 'addthis_display_social_widget_excerpt', 11 );
	}
	if( function_exists('the_advanced_excerpt') )
		the_advanced_excerpt('length=150&use_words=0&no_custom=1&ellipsis=%26hellip;&exclude_tags=img&read_more=[Leggi tutto]&add_link=1&finish_sentence=0&finish_word=1&no_shortcode=1');
}
//removes empty tags from the_content
if( !function_exists('remove_empty_p') )
{
	add_filter('the_content', 'remove_empty_p', 20, 1);
	function remove_empty_p($content){
		$content = force_balance_tags($content);
		return preg_replace('#<p>\s*+(<br\s*/*>)?\s*</p>#i', '', $content);
	}
}
if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'mediateca-thumb', 100, 75, true ); //(cropped)
}
if( !function_exists('dito_create_pages') )
{
	function dito_create_pages()
	{
		global $current_user, $dito_pages;
		
		//Push a page slug to add a page dynamically
		$dito_pages = array('laboratori-e-progetti', 'interviste-e-ricerche', 'diario-di-di-to' );
		
		get_currentuserinfo();
		
		$user = $current_user;
		
		foreach( $dito_pages as $slug )
		{
			if( !get_page_by_title( ucfirst( str_replace('-', ' ', $slug) ) ) )
			{
				$name = ucfirst( str_replace('-', ' ', $slug) );
				
				$postdata = array(
				'post_title' => __($name, MEDIATECA_TD),
				'post_content' => __('This is your '.$name.' page!', MEDIATECA_TD),
				'post_status' => 'publish',
				'post_type' => 'page',
				'post_author' => $user->ID,
				'ping_status' => get_option('default_ping_status'), 
				'post_name' => $slug,
				//'post_parent' => $parent,
				'menu_order' => 0,
				'to_ping' =>  '',
				'pinged' => '',
				'post_password' => '',
				'guid' => '',
				'post_content_filtered' => '',
				'post_excerpt' => '',
				'import_id' => 0
				);
				wp_insert_post( $postdata, true );
			}
		}
		add_filter ( 'page_template', 'dito_loadTemplates' );
	}
	add_action('init', 'dito_create_pages', 95);
}
function dito_loadTemplates( $page_template )
{
	global $dito_pages, $post;
	
	foreach( $dito_pages as $page )
	{
		if ( $post->post_name == $page && file_exists ( TEMPLATEPATH . '/'.$page.'-page.php' ))
		{	
			$page_template = TEMPLATEPATH . '/'.$page.'-page.php';
		}
	}
	return $page_template;
}
function dito_doDiarioSidebar()
{
	global $post;
	echo '<div class="boxesBox"><h2 class="blue">Ultime dal Diario</h2>';
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
	rewind_posts();
	if( !is_category() )
	echo '<div class="boxesSecondLine segnalaRight"> <p class="segnala2"><a href="'.get_bloginfo('url').'/category/dito-in-missione" class="segnala">Tutto il Diario</a></p></div></div>';
}
add_action('do_diario_sidebar', 'dito_doDiarioSidebar');
function ditoLargeClass()
{
	if( is_category('rassegna') || in_category('rassegna') )
	{
		echo 'main-large';
	}
	else {
		echo '';
	}
}
?>