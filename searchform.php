<?php 
global $current_user;
get_currentuserinfo();
$user = new WP_User($current_user->ID);
?>
<div id="login">
	       <span><a href="<?php bloginfo('url')?>/?page_id=123">Chi siamo</a></span><span style="visibility:hidden;">|</span>
	       <?php if (!is_user_logged_in()){?>
	       <span><a href="<?php bloginfo('url')?>/wp-login.php">Login</a></span>
	       <?php } elseif(is_user_logged_in()) {
	       if ($user->has_cap('edit_posts')){
	       ?>
	       <span><a href="<?php bloginfo('url')?>/wp-admin/">Amministra</a></span><span style="visibility:hidden;">|</span>
	       <?php }else{?>
	        <span><a href="<?php bloginfo('url')?>/wp-admin/profile.php">Il tuo Profilo</a></span><span style="visibility:hidden;">|</span>
	        <?php }?>
	        <span><a href="<?php bloginfo('url')?>/wp-login?action=logout">Esci</a></span>
	       <?php }?>
	       <!-- o <a href="http://dito.areato.org/wp-login.php?action=register">Registrati</a></span>-->
	       </div>

<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
<div><input type="text" value="cerca" name="s" id="s" />
<input type="image" id="searchsubmit" src="http://dito.areato.org/wp-content/themes/area/imgs/search.gif" name="submit" />
</div>
</form>


