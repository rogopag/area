<?php 
get_header();
if(!$wp_query) global $wp_query;
if( is_category( array('servizi') ) )
query_posts( array_merge( array( 'posts_per_page' => 50 ) , $wp_query->query ) ); 
?>

	<div id="content">
<?php is_tag(); ?>
		<?php if (have_posts()) : ?>
		
<?php include('sidebar_left.php');?>

<div class="main ieFix <?php ditoLargeClass();?>">
 	  <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
 	  <?php /* If this is a category archive */ if (is_category()) { ?>
<h2 class="orange <?php ditoLargeClass();?>"><?php 
if (is_category('54') ||  is_category('56')  ||  is_category('57')  ||  is_category('58')  ||  is_category('59')  ||  is_category('60') ||  is_category('61')){
echo 'Come ho fatto a...';
} elseif (is_category('47') || is_category('50')){
echo 'Sogni, segni, disegni';
}
else{
single_cat_title(); 
}
?></h2>
 	  <?php /* If this is a tag archive */  
 	      foreach((get_the_category()) as $category) {
 	      	if($category->cat_name != 'Percorsi in evidenza'){
                $catName =  $category->cat_name; 
                // echo $catName;
           //      echo '<h2 class="orange">'.$catName.'</h2>';
 	      	}
          } 
        $pageId = $wpdb->get_var ("SELECT post_id FROM $wpdb->postmeta WHERE meta_value = '$catName'");
        $pageContent = $wpdb->get_var ("SELECT post_content FROM $wpdb->posts WHERE ID = '$pageId' AND post_status = 'publish'");
        if (!empty($pageContent)) {
 	      echo '<div class="intro">'.$pageContent.'</div>';
 	       }
 	  }  	  elseif( is_tag() ) { ?>
		<h2 class="orange">Cosa vuol dire<?php //single_tag_title(); ?></h2>
 	  <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
		<h2 class="pagetitle">Archive for <?php the_time('F jS, Y'); ?></h2>
 	  <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		<h2 class="pagetitle">Archive for <?php the_time('F, Y'); ?></h2>
 	  <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
		<h2 class="pagetitle">Archive for <?php the_time('Y'); ?></h2>
	  <?php /* If this is an author archive */ } elseif (is_author()) { ?>
		<h2 class="pagetitle">Author Archive</h2>
 	  <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<h2 class="pagetitle">Blog Archives</h2>
 	  <?php } ?>
                
				<?php while (have_posts()) : the_post(); 
				
if (is_category('47') || is_category('50')){
    $author = get_post_meta($post->ID, "Author Name", $single=true);
    $taleAuthor = $wpdb->get_row("SELECT * FROM $wpdb->posts WHERE post_title = '$author' AND post_status = 'publish'");
	}

				
		if (!empty($pageContent)) { ?>
       <?php if(!in_category(4) || !in_category(141) || !in_category(44) || !in_category(55) || !in_category(138)){?>     
		<div class="post <?php ditoLargeClass();?>">
		<a name="a_<?php the_ID(); ?>" />
		<h3 id="post-<?php the_ID(); ?>" class="post-title yes-intro"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>
		<?php } else {?>
			<a name="a_<?php the_ID(); ?>"></a>
		<h3 id="post-<?php the_ID(); ?>" class="post-title services"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>
		<?php 
			}
		} else  {?>
		<a name="a_<?php the_ID(); ?>" />
		
			
			<?php if (is_category('47')){?>
			<h3 id="post-<?php the_ID(); ?>" class="post-title no-intro"><a href="<?php the_permalink() ?>" rel="bookmark">
			<em><?php the_title(); ?></em></a></h3>	<a href="<?php echo $taleAuthor->guid;?>" class="authorLink authorArchive"> <?php echo $author;?></a>
			     
				
				
				<?php } elseif(is_category('50')) {?>
				<h3 id="post-<?php the_ID(); ?>" class="post-title no-intro marginBottom"><a href="<?php echo $taleAuthor->guid;?>"> <?php echo $author;?></a></h3>
			
			<?php }else{ ?>
			<h3 id="post-<?php the_ID(); ?>" class="post-title no-intro"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>
        <?php 
        	}
        } ?>
				<!--<small><?php the_time('l, F jS, Y') ?></small>-->
<?php if (!empty($pageContent)) { ?>
				<div class="entry <?php ditoLargeClass();?>">
					<?php }elseif (is_category('47')){?>
						<div class="entry entryWithMarginTop">			
				
					<?php 
					} else{?>
					<div class="entry no-intro <?php ditoLargeClass();?>">
					<?php } 
					if(is_category(50)){
					displayPictures();
					the_content();
					}
                    elseif (is_category('54') ||  is_category('56')  ||  is_category('57')  ||  is_category('58')  ||  is_category('59')  ||  is_category('60') ||  is_category('61') || is_category('47') || is_category(141) || is_category(55) || is_category(44) || is_category(138))	{
                    the_excerpt();
                    } elseif(is_category('4')) {
                    
                    } else {
                    the_content(); 
                    }
                    ?>
              <?php if(!in_category(4) || !in_category(141) || !in_category(44) || !in_category(55) || !in_category(138)){?>  
				</div>
				
				<?php }?>
				
<?php if (!empty($pageContent)) { ?>
			</div>
<?php }?>

		<?php endwhile; ?>
		<?php do_action('dito_printAdditionalContent'); ?>
		<?php twentyeleven_content_nav( 'nav-below' ); ?>
</div>


	<?php else : ?>

		

	<?php endif; ?>
<?php 
if( !is_category( array('rassegna', 'gli-eventi', 'arte-spettacoli-appuntamenti', 'convegni-e-seminari') ) )
	get_sidebar(); 
?>
	</div>
        


<?php get_footer(); ?>
