<?php
include('dbconnect.php');

$address = $_REQUEST['address'];
$latitude = $_REQUEST['latitude'];
$longitude = $_REQUEST['longitude'];
$category = $_REQUEST['category'];

$addressArray =explode(",", $address);

$address = $addressArray[0];
$num = $addressArray[1];
$locAndPc =  $addressArray[2];
$TownReg = $addressArray[3];
$countryTemp = $addressArray[4];

$locAndPc = explode(" ", $locAndPc);
$town = $locAndPc[2];
$postalCode = $locAndPc[1];

$TownReg = explode(" ", $TownReg);
$prov = $TownReg[1];
$region = $TownReg[2];
$region = ltrim($region, "(");
$region = rtrim($region,")");

$countryTemp = explode("(", $countryTemp);
$country = $countryTemp[0];

$controlQuery = "SELECT * FROM locations WHERE latitude='$latitude' AND longitude='$longitude' ";
$control = mysql_query($controlQuery,$local_dbh) or die("error check_duplicate");
    if(mysql_num_rows($control)>0){
        echo "address already present in DB";
    } else {
$insertQuery = "INSERT INTO locations (address, pcode, town, province, region, country, latitude, longitude, mcategory_id) VALUES ('$address,$num', '$postalCode', '$town', '$prov', '$region', '$country', '$latitude', '$longitude')";

$result = mysql_query($insertQuery,$local_dbh);
    if (!$result) {
         die('Invalid query: ' . mysql_error());
    } else {
echo "address and coordinates insert succesfully";
}
}
mysql_close($local_dbh);
?>