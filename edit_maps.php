<table>
<tr>
<form name="listmaps" id="listmaps" method="post">
<td>
<label>List Maps</label></td>
<td>
<select name="selectoedit" id="maptoedit">
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
			</select></td>
			<td><input name="amount" id="amount" type="text" value="10" width="10"></input></td>
			<td><input type="submit" value="go" id="searchByCat"/></td>
			</tr>
			</table>
<?php
$catToGrub = isset($_POST['selectoedit']) ? $_POST['selectoedit'] : null;
$amount = isset($_POST['amount']) ? $_POST['amount'] : null;

if($_POST['selectoedit']) {
	$tableQuery = "SELECT * FROM g_maps WHERE mcategory_id = '$catToGrub' ORDER BY map_id DESC LIMIT 0, $amount";
	echo '<table id="toEdit" cellpadding="10" cellspacing="0" border="1">';
	echo '<tr class="labelsToEdit" style="background:#ff6699;font-weight:bold;"><td>Servizio</td><td>Indirizzo</td><td>CAP</td><td>Citt&agrave;</td><td>Provincia</td><td>Paese</td><td>LAT</td><td>LONG</td><td>Categoria</td></tr>';
	$resultToEdit = mysql_query($tableQuery, $local_dbh);
	while($toEdit = mysql_fetch_array($resultToEdit)){
		$editID = $toEdit['map_id'];
		$editService = $toEdit['service'];
		$editAddress =  mb_convert_encoding($toEdit['address'],'UTF-8', 'ISO-8859-1');
		$editCap = $toEdit['pcode'];
		$editTown = $toEdit['town'];
		$editProvince = $toEdit['province'];
		$editCountry = $toEdit['country'];
		$editLatitude = $toEdit['latitude'];
		$editLongitude = $toEdit['longitude'];
		$editCat = $toEdit['mcategory_id'];
		echo '<tr id="edit_'.$editID.'" class="mapEditRow"><td class="service">'.$editService.'</td><td class="address">'.$editAddress.'</td><td class="cap">'.$editCap.'</td><td class="town">'.$editTown.'</td><td class="province">'.$editProvince.'</td><td class="country">'.$editCountry.'</td><td class="editLatitude">'.$editLatitude.'</td><td class="editLongitude">'.$editLongitude.'</td><td class="editCat">'.$editCat.'</td><td class="mapID" style="display:none">'.$editID.'</td></tr>';
	}
	echo '</table>';
}

?>