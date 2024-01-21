<?php
$serverHost = "replica_php_server";
$serverPortsArray = array(1100, 2077, 1300, 4100, 5500);
$userDefinedStats = date("Y-m-d");
$publicDom = "dom-port-0001";
$serverStarter = date("Y-m-d");
$dominer = 'port-23-domain';
echo json_encode(array('serverhost' => $serverHost, 'serverport' => $serverPortsArray, 'userstats' => $userDefinedStats, 'dominor' => $dominer));
