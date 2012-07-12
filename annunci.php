<?php
/*
Template Name: Piccoli annunci
*/
?>


<?php get_header(); ?>

	<div id="content">

	<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>
		<?php include('sidebar_left.php');?>

			<div class="main forIE" id="annunci">
				<h2 class="orange"><?php the_title(); ?></h2>
				<div id="annIntro">
				<?php the_content();?>
				</div>
<?php endwhile; ?>
				<div class="entry" id="app">
								<!--<option value="34">cerco</option>-->
				
					<?php//the_content('Read the rest of this entry &raquo;');?>
    <div class="pform">
        <h3>Ricerche</h3>
				<form id="picccoli" name="mapform" method="get">
                    <input type="text" name="pannunci" value="Cerca"  id="pannunci" />
                    <select id="kind" name="kind">
				        <option value="35" class="allOptions">tutte le offerte</option>
					    <option value="65">offro ausili</option>
					    <option value="67">offro giocattoli</option>
					    <option value="68">offro libri</option>
					    <option value="66">offro software</option>
					    <option value="34" class="allOptions">tutte le ricerche</option>
					    <option value="36">cerco ausili</option>
					    <option value="38">cerco giocattoli</option>
					    <option value="40">cerco libri</option>
					    <option value="39">cerco software</option>
					</select>
                    <input  type="image" src="http://dito.areato.org/wp-content/themes/area/imgs/search.gif" name="submit"  id="subaanunci" />
                </form>
             </div>
    </div>
                  <div class="formText">  
                  <h3 class="headOfferte">Offerte</h3>
                    <?php tdomf_the_form(1); ?>
                    </div>
                    
                    <div class="formRicerche">  
                  <h3 class="headOfferte">Ricerche</h3>
                    <?php tdomf_the_form(2); ?>
                    </div>
                    
                    
			</div>

		

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
			<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
		</div>

	<?php else : ?>

		<h2 class="center">Not Found</h2>
		<p class="center">Sorry, but you are looking for something that isn't here.</p>
		<?php include (TEMPLATEPATH . "/searchform.php"); ?>

	<?php endif; ?>
	<?php get_sidebar(); ?>

	</div>



<?php get_footer(); ?>
