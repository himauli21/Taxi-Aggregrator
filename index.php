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

$from = \helpers\FindRidesModel::$from;
$to = \helpers\FindRidesModel::$to;

$baseHelper->printErrorArray();


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
    <link rel="stylesheet" href="assets/font.css">x
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
                <li><a href="#" class="latoLight" >Login</a></li>
                <li><a href="#" class=" latoLight ">Sign Up</a></li>
            </ul>
        </div>
    </div>
</nav>


<div class="container mt100 ">
    <div class="jumbotron text-center app">

        <div class="circle-box-grand-parent">
            <div class="circle-box-parent">
                <div class="cricle-box">
                    <i class="fas fa-car size50 mt20"></i>
                </div>
            </div>
        </div>

        <div class="container">

            <h1 class="jumbotron-heading latoLight">
                Find Your Ride
            </h1>

            <form method="post" action="<?= $_SERVER['PHP_SELF'] ?>" >
                <div class="row mt50">
                    <div class="col-xs-12 col-sm-6 text-center">
                        <!--                    <input class="form-control" id="ex1" type="text" placeholder="From">-->
                        <div class="input-group input-group-lg app">
                          <span class="input-group-addon" id="sizing-addon1">
                              <i class="fas fa-map-marker">

                              </i>
                          </span>
                            <input value="<?= $from; ?>" id="Location_from" name="Location[from]" type="text" class="form-control ac-input" placeholder="From" aria-describedby="sizing-addon1">
                        </div>

                    </div>

                    <div class="col-xs-12 col-sm-6 text-center">

                        <div class="input-group input-group-lg app">
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
                        <button type="submit" class="find-rides pl50 pr50">
                            <i class="fas fa-location-arrow" ></i>&nbsp;&nbsp;
                            Search Ride
                        </button>
                    </div>
                </div>
            </form>

        </div>

        <?php if( $data !== false && is_array( $data ) && !empty( $data ) ){ ?>
            <hr>
            <?php

            if(isset( $data['lyft'] ) && !empty( $data['lyft'] ) ){
                $lyfts = $data['lyft'];

                for( $i = 0 ; $i < sizeof( $lyfts ); $i++ ){
                    $value = $lyfts[$i];
                    if( $i%2 == 0 ){
                        ?>
                        <div class="row">
                        <?php
                    }
                    ?>
                    <div class="col-xs-12 col-sm-6 mb10 item-box-parent <?= $value['ride_type']; ?> " >
                        <div class=" item-box ">
                            <div class="row">
                                <div class="col-xs-12 col-sm-5 text-center">
                                    <i class="fab fa-lyft " style="font-size:150px;color: white;" ></i>
                                </div>
                                <div class="col-xs-12 col-sm-7 text-left">
                                    <h4><?= $value['display_name']; ?></h4>
                                    <p><i class="fas fa-dollar-sign"></i>&nbsp;<?= $value['estimated_cost_cents_min']/100; ?>-<?= $value['estimated_cost_cents_max']/100; ?>&nbsp;<?= $value['currency']; ?></p>
                                    <p>Distance:&nbsp;<?= $value['estimated_distance_miles']; ?>&nbsp;Miles</p>
                                    <p><i class="fas fa-clock"></i>&nbsp;<?= gmdate("H:i:s",$value['estimated_duration_seconds']); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    if( $i%2 == 1  || $i == sizeof( $lyfts )-1 ){
                        ?>
                        </div>
                        <?php
                    }
                }

            }

            if(isset( $data['uber'] ) && !empty( $data['uber'] ) ){
                $ubers = $data['uber'];

                for( $i = 0 ; $i < sizeof( $ubers ); $i++ ){
                    $value = $ubers[$i];
                    if( $i%2 == 0 ){
                        ?>
                        <div class="row">
                        <?php
                    }
                    ?>
                    <div class="col-xs-12 col-sm-6 mb10 item-box-parent <?= $value['ride_type']; ?> " >
                        <div class=" item-box ">
                            <div class="row">
                                <div class="col-xs-12 col-sm-5 text-center">
                                    <i class="fab fa-lyft " style="font-size:150px;color: white;" ></i>
                                </div>
                                <div class="col-xs-12 col-sm-7 text-left">
                                    <h4><?= $value['display_name']; ?></h4>
                                    <p><i class="fas fa-dollar-sign"></i>&nbsp;<?= $value['estimated_cost_cents_min']/100; ?>-<?= $value['estimated_cost_cents_max']/100; ?>&nbsp;<?= $value['currency']; ?></p>
                                    <p>Distance:&nbsp;<?= $value['estimated_distance_miles']; ?>&nbsp;Miles</p>
                                    <p><i class="fas fa-clock"></i>&nbsp;<?= gmdate("H:i:s",$value['estimated_duration_seconds']); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    if( $i%2 == 1  || $i == sizeof( $ubers )-1 ){
                        ?>
                        </div>
                        <?php
                    }
                }

            }

            ?>
        <?php } ?>

    </section>
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

