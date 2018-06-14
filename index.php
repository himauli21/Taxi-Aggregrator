<?php

require 'base.php';

use helpers\BaseHelper;

$baseHelper = new BaseHelper();

// TTC
//http://www.ttc.ca/Routes/49/Eastbound.jsp stops list  14720 ==> Kipling Station
//$data = $baseHelper->getTtc()->getCarsByStopId( 14720 );
//$baseHelper->printR( $data );

// LYFT
$data = $baseHelper->getLyft()->getCost( $start_lat = 43.761539 , $start_lng = ‎-79.411079 , $end_lat = 43.653908 , $end_lng =  ‎-79.384293 );
$baseHelper->printR( $data );

// UBER work in progress
//$data = $baseHelper->getUber();
//$baseHelper->printR( $data );
