<?php
$UA = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';

$SF = strstr($UA, 'Safari') ? true : false;

$OP = strstr($UA, 'Opera') ? true : false;
$OPV = $OP ? preg_split('/opera\//i', $UA) : false;
$OPV = $OPV ? floatval($OPV[1]) : false;

$FF = !$OP && strstr($UA, 'Firefox') ? true : false;
$FFV = $FF ? preg_split('/firefox\//i', $UA) : false;
$FFV = $FFV ? floatval($FFV[1]) : false;

$IE = !$OP && !$FF && strstr($UA, 'MSIE') ? true : false;
$IEV = $IE ? preg_split('/msie/i', $UA) : false;
$IEV = $IEV ? floatval($IEV[1]) : false;
?>