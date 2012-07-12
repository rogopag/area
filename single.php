<?php get_header(); ?>

	<div id="content">
<?php include('sidebar_left.php');?>
	<?php if (have_posts()) : while (have_posts()) : the_post(); 

//////////leave this is a debug code////////////
/*foreach (get_the_category() as $cate){
	echo $cate->cat_ID;
	}*/
	?>
		<div class="main">

<h2 class="orange"><?php 
if (in_category('55')){
echo 'Studi e ricerche';
} elseif (in_category('54') ||  in_category('56')  ||  in_category('57')  ||  in_category('58')  ||  in_category('59')  ||  in_category('60') ||  in_category('61')){
echo 'Come ho fatto a...';
} elseif (in_category('47') || in_category('50') || in_category('49')){
echo 'Sogni, segni, disegni';
} elseif(in_category('34') || in_category('35')) {
echo 'Piccoli annunci';

}elseif((!in_category('55')) && (!in_category('56')) && (!in_category('57')) && (!in_category('58')) && (!in_category('59')) && (!in_category('60')) && (!in_category('61'))) {
$cate = get_the_category();
$size = sizeof($cate);
$cate = $cate[$size-1]->cat_name;	
//$cate = $cate[$size-1]->cat_neme;	
echo $cate;

}
if (in_category('47') || in_category('50')){
    $author = get_post_meta($post->ID, "Author Name", $single=true);
    $taleAuthor = $wpdb->get_row("SELECT * FROM $wpdb->posts WHERE post_title = '$author' AND post_status = 'publish'");
} elseif (in_category('43') || in_category('49')){
    $taleTextId = $wpdb->get_row("SELECT * FROM $wpdb->postmeta WHERE meta_value = '$post->post_title'");
    $taleText = $wpdb->get_row("SELECT * FROM $wpdb->posts WHERE ID = '$taleTextId->post_id' AND post_status = 'publish'");
}
?></h2>
				

			<div class="entry entryForSingle">
			<h3>
			<?php if(in_category('50')) {?>
				<a href="<?php echo $taleAuthor->guid;?>" class="black"> <?php echo $author;?></a>
			<?php }
			elseif (in_category('44') || in_category('55') || in_category('47')){?>
			<em>
            <?php the_title(); ?>
			</em><br /><a href="<?php echo $taleAuthor->guid;?>" class="authorLink"> <?php echo $author;?></a>
			<?php
			} else {
			the_title();
			}
			?></h3>
			<?php
				if(in_category(50)){
					displayPictures();
					the_content();
				} elseif(in_category(12)) {
				//the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); 
				echo stripslashes($post->post_content);
				}else{
				the_content();
				}
				?>

				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

<small>
				<?php  
	
		if (is_user_logged_in()){
           edit_post_link();
         }
         
?>

</small>
<small class="smallAlignRight">
		<?php if(function_exists('wp_print')) { print_link(); } ?>  	
</small>		
			</div>
		
		
		
		<div class="comments">

	<?php if (!in_category(51) && !in_category(52) && !in_category(53) && !in_category(3) && !in_category(4) && !in_category(5) && !in_category(6) && !in_category(7) && !in_category(8)){
		comments_template();
		} 
		?>
	<?php //if($topic_id = felwptobb( $id ) ) { echo '<a href="' . bbreplylink( $topic_id ) . '">Reply!</a>'; } else { comments_popup_link('&nbsp;comments', '1 comment', '% comments','',''); } ?>
</div>
	<?php endwhile; else: ?>

		<p>Sorry, no posts matched your criteria.</p>

<?php endif; ?>
</div>
<?php get_sidebar(); ?>
	</div>

<?php get_footer(); ?>
