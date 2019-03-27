<?php
/**
 * Created by PhpStorm.
 * User: Himauli
 * Date: 10/06/18
 * Time: 10:16 PM
 */

namespace helpers;

use Stevenmaguire\Uber\Client;

class Uber extends BaseHelper
{
    public static $client = null ;

    public function getClient(){
        try{
            $client = new Client(array(
                'access_token' => 'KA.eyJ2ZXJzaW9uIjoyLCJpZCI6IlY3MzJITTdPVFJXeVFoMDIvYXJBYlE9PSIsImV4cGlyZXNfYXQiOjE1MzEyMzk2NjksInBpcGVsaW5lX2tleV9pZCI6Ik1RPT0iLCJwaXBlbGluZV9pZCI6MX0.SPlGWRzRkWZ0iksGeOhHvCxm3zdBDCG5eEwIf3I87G8',
                'server_token' => 'lR2yzbT2LONrZ_s2ICrX2rp8hQNusj9XAyxItgTn',
                'use_sandbox'  => true, // optional, default false
                'version'      => 'v1.2', // optional, default 'v1.2'
                'locale'       => 'en_US', // optional, default 'en_US'
            ));

            self::$client = $client;
        }catch ( \Exception $e ){
            $this->printR( $e );
        }
    }

    public function getEstimates( $from_lat , $from_lng , $to_lat , $to_lng ){
        if( empty( self::$client ) ){
            $this->getClient();
        }
        if( !empty( self::$client ) ){
            $estimates = self::$client->getPriceEstimates(array(
                'start_latitude' => $from_lat,
                'start_longitude' => $from_lng,
                'end_latitude' => $to_lat,
                'end_longitude' => $to_lng
            ));
            $estimates = json_encode($estimates);
            $estimates =  $this->parseToArray($estimates);

            $estimates = ArrayHelper::getValue($estimates,"prices");
            return $estimates;
        }else{
            $this->printR( "Not able to connect to Uber APi" );
        }
    }

    public function getUberFirst(){

        $client = new Client(array(
            'access_token' => 'KA.eyJ2ZXJzaW9uIjoyLCJpZCI6IlY3MzJITTdPVFJXeVFoMDIvYXJBYlE9PSIsImV4cGlyZXNfYXQiOjE1MzEyMzk2NjksInBpcGVsaW5lX2tleV9pZCI6Ik1RPT0iLCJwaXBlbGluZV9pZCI6MX0.SPlGWRzRkWZ0iksGeOhHvCxm3zdBDCG5eEwIf3I87G8',
            'server_token' => 'lR2yzbT2LONrZ_s2ICrX2rp8hQNusj9XAyxItgTn',
            'use_sandbox'  => true, // optional, default false
            'version'      => 'v1.2', // optional, default 'v1.2'
            'locale'       => 'en_US', // optional, default 'en_US'
        ));

        $estimates = $client->getPriceEstimates(array(
            'start_latitude' => '43.763486600',
            'start_longitude' => '-79.345983600',
            'end_latitude' => '43.725925100',
            'end_longitude' => '-79.448583200'
        ));

        return $estimates;

    }

}


//https://login.uber.com/oauth/v2/authorize?response_type=code&client_id=Nm3x1q9_EzFHz2N41y1oEFEVoNsj4aat&scope=request%20profile%20history&redirect_uri=<REDIRECT_URI>
//
// https://login.uber.com/oauth/v2/authorize?client_id=Nm3x1q9_EzFHz2N41y1oEFEVoNsj4aat&response_type=code&redirect_uri=http://localhost/taxi/redirect.php
