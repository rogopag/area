<?php 
/*
Template name: gmaps edit
*/
include 'dbconnect.php';
get_header();
?>
  <div id="page">
  <div id="content" class="mapEdit">
  			<?php include('sidebar_left.php');?>

			<div class="main">
			<h2 class="orange">Crea nuova location</h2>
  
		<div id="carta"></div>
		  </div>	
<div id="sidebarRight">
<div id="inserisci-dati">
			<form id="form" return false">
			<table>
		<tr>
		  <td width="102" valign="top"><label>Cerca indirizzo</label></td>
		  <td width="236">
		<label></label>
		<input id="search"  name="address" type="text" value="">
		<input id="subMap" type="image" src="http://dito.areato.org/wp-content/themes/area/imgs/search.gif" name="submit" /></td>
		</tr>
			  <tr>
			    <td valign="top">Nome servizio</td>
			    <td>
			  <label></label>	<input id="service"  name="service" type="text" value=""><br/></td></tr>
			  <tr>
			    <td valign="top">Categoria</td>
			    <td>
			<select name="selectcm" id="mapcat">
            <?php	
$dbQueryCat = "SELECT wp_terms.name, wp_terms.term_id, wp_term_taxonomy.term_taxonomy_id, wp_term_taxonomy.taxonomy, wp_term_taxonomy.term_id FROM wp_terms, wp_term_taxonomy WHERE wp_terms.term_id = wp_term_taxonomy.term_id AND wp_term_taxonomy.taxonomy ='category' ORDER BY name DESC"; 
$myResultCat = mysql_query($dbQueryCat, $local_dbh);
//START LOOPING THE ARRAY
while ($myRow = mysql_fetch_array($myResultCat)){
$catName = $myRow['name'];
$catId = $myRow['term_id'];
//echo $catName.' '.$catId;
echo '<option value="'.$catId.'">'.$catName.'</option>';
}
?>	
			</select>			</td></tr></table>
			<div id="message"></div> 
			
			<div class="clear">
			  <label>Latitudine:</label>
			  <input type="text" name="latitudine" id="lat" value=""/>
			</div>
			<br />
<div class="clear"><label>Longitudine:</label> <input type="text" name="longitudine" id="lng" value=""/></div>

</form>
<h2 id="btnSave">Salva</h2>

		</div>

  </div>
  
  <?php
  include TEMPLATEPATH.'/edit_maps.php';
  if($_POST['selectoedit']){
  include TEMPLATEPATH.'/maps_form.php';
  }
  ?>
    
    </div>
    

    
<?php 

get_footer();
?>