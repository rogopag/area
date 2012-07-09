<?php 
/*
Template name: eventi
*/
setlocale(LC_TIME, 'it_IT');  
get_header(); ?>

	<div id="content" class="narrowcolumn">
	
<?php include('sidebar_left.php');?>
<div class="main innerContent">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<h2 class="orange"><?php the_title(); ?></h2>
		<div class="post" id="post-<?php the_ID(); ?>">
		
			<div class="entry">
				<?php the_content(); ?>

				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
	</div>
				</div><?php endwhile; endif; ?>
				<?php 

        $postID = $wpdb->get_var("SELECT post_id FROM $wpdb->postmeta WHERE meta_key = 'inFocus' AND meta_value = '1' ORDER BY meta_id DESC LIMIT 0,1");
      //  echo $postID;
$event = $wpdb->get_row("SELECT * FROM $wpdb->posts WHERE ID = '$postID' AND post_status='publish' ORDER BY post_date DESC LIMIT 0,1");
         $output = '';
         $output .= '<div class="post eventPost" id="post-'.$event->ID.'"><div class="entry">';
         $output .= '<h3 style="margin-top:10px;margin-bottom:5px;">In focus</h3>';
         $output .= $event->post_content;
         $output .= '</div></div>';
         $output = stripslashes($output);
        //echo stripslashes($output);
        echo $output;
    ?>
		</div>
		<?php get_sidebar(); ?>
	<?php //edit_post_link('Edit this entry.', '<p>', '</p>'); 
	?>
	  </div>



<?php get_footer(); ?>