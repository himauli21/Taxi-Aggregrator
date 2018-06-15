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

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Ride Share</title>

    <!--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.min.css">-->
    <!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">-->

    <link rel="script" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.js">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
    <link rel="stylesheet" href="assets/boxmodel.css">
    <link rel="stylesheet" href="assets/font.css">
    <link rel="stylesheet" href="assets/media.css">

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>

    <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
</head>
<body>


<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">Login</a></li>
                <li><a href="#">Sign Up</a></li>

            </ul>
        </div>
    </div>
</nav>


<div class="container">
    <section class="jumbotron text-center">
        <div class="container">

            <h1 class="jumbotron-heading">
                Find Your Ride
                <span class="icon is-small is-left" style="padding-left: 20px;">
					<i class="fas fa-car"></i>
				</span>
            </h1>

            <div class="row mt50">
                <div class="col-xs-12 col-sm-6 text-center">
                    <!--                    <input class="form-control" id="ex1" type="text" placeholder="From">-->
                    <div class="input-group input-group-lg">
                          <span class="input-group-addon" id="sizing-addon1">
                              <i class="fas fa-map-marker">

                              </i>
                          </span>
                        <input type="text" class="form-control" placeholder="From" aria-describedby="sizing-addon1">
                    </div>

                </div>

                <div class="col-xs-12 col-sm-6 text-center">

                    <div class="input-group input-group-lg">
                              <span class="input-group-addon" id="sizing-addon1">
                                  <i class="fas fa-map-marker">

                                  </i>
                              </span>
                        <input type="text" class="form-control" placeholder="To" aria-describedby="sizing-addon1">
                    </div>
                </div>
            </div>
            <!--            <nav class="level">-->
            <!---->
            <!--                <div class="form-group row">-->
            <!--                    <div class="col-xs-2">-->
            <!---->
            <!--                    </div>-->
            <!--                    <div class="col-xs-2">-->
            <!--                    </div>-->
            <!--                </div>-->
            <!---->
            <!---->
            <!--            </nav>-->

            <div class="row">
                <div class="col-xs-12 text-center mt50">
                    <button type="button" class="btn btn-primary btn-lg pl50 pr50">Search Ride</button>

                </div>
            </div>

        </div>

</div>

</body>
</html>

