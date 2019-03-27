<?php
/**
 * Created by PhpStorm.
 * User: Himauli
 * Date: 15/06/18
 * Time: 6:38 PM
 */

namespace helpers;


class GoogleLocationApi extends BaseHelper
{
    const API_KEY = "AIzaSyAVqXVxAvzzlgPKw7JA3_bMyTQZo0SAFQQ" ;


    public static $lat = null ;
    public static $lng = null ;

    public function getLatAndLongApiUrl( $address ){
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address=".$address."=".self::API_KEY;
        return $url;
    }

    public function getLatAndLongByAddress( $address ){
        $client = $this->getHttpClient();
        $url = $this->getLatAndLongApiUrl( $address );
        try{
            $res = $client->request('GET', $url );
            if( $res->getStatusCode() == 200 ){
                $data = $res->getBody()->getContents();
                $data = $this->parseToArray($data);
                return $this->getLatAndLang( $data );
            }
        }catch ( \Exception $e ){
            $this->printR( $e->getTraceAsString() );
        }
    }

    public function getLatAndLang( $data ){
        $latLangArray = ArrayHelper::getValue( $data , 'results.0.geometry.location' );
        $latLangArray1 = $latLangArray ;
        $latLangArray2 = $latLangArray ;
        self::$lat = ArrayHelper::getValue( $latLangArray1 , 'lat' );
        self::$lng = ArrayHelper::getValue( $latLangArray2 , 'lng' );
        return $latLangArray;
    }


}