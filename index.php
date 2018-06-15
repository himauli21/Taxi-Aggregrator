<?php

require 'base.php';

use helpers\BaseHelper;

$baseHelper = new BaseHelper();
$data = [];
$msg = null;
try{
    $data = $baseHelper->getRequestHandler()->handleRequest();
}catch (Exception $e){
    $msg = $e->getTraceAsString();
}

$from = \helpers\RequestHandler::$from;
$to = \helpers\RequestHandler::$to;


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Ride Share</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
    <link rel="stylesheet" href="assets/boxmodel.css">
    <link rel="stylesheet" href="assets/font.css">
    <link rel="stylesheet" href="assets/media.css">
    <link rel="stylesheet" href="assets/style.css">

</head>
<body>


<nav class="navbar navbar-default navbar-fixed-top app">
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


<div class="container mt100 ">
    <section class="jumbotron text-center app">
        <div class="container">

            <h1 class="jumbotron-heading">
                Find Your Ride
                <span class="icon is-small is-left" style="padding-left: 20px;">
					<i class="fas fa-car"></i>
				</span>
            </h1>

            <form method="post" action="<?= $_SERVER['PHP_SELF'] ?>" >
                <div class="row mt50">
                    <div class="col-xs-12 col-sm-6 text-center">
                        <!--                    <input class="form-control" id="ex1" type="text" placeholder="From">-->
                        <div class="input-group input-group-lg">
                          <span class="input-group-addon" id="sizing-addon1">
                              <i class="fas fa-map-marker">

                              </i>
                          </span>
                            <input value="<?= $from; ?>" id="Location_from" name="Location[from]" type="text" class="form-control ac-input" placeholder="From" aria-describedby="sizing-addon1">
                        </div>

                    </div>

                    <div class="col-xs-12 col-sm-6 text-center">

                        <div class="input-group input-group-lg">
                              <span class="input-group-addon" id="sizing-addon1">
                                  <i class="fas fa-map-marker">

                                  </i>
                              </span>
                            <input value="<?= $to; ?>" id="Location_to" name="Location[to]" type="text" class="form-control ac-input" placeholder="To" aria-describedby="sizing-addon1">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 text-center mt50">
                        <button type="submit" class="find-rides pl50 pr50"><i class="fas fa-location-arrow" ></i>&nbsp;&nbsp;Search Ride</button>
                    </div>
                </div>
            </form>

        </div>

</div>

<!-- GOOD PRACTICE PUT JS AT END -->
<script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
<script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-backstretch/2.0.4/jquery.backstretch.min.js" ></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
<script type="application/javascript" src="assets/app.js" ></script>

<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAVqXVxAvzzlgPKw7JA3_bMyTQZo0SAFQQ&libraries=places&callback=initMap">
</script>

</body>
</html>

