<?php
/**
 * Created by PhpStorm.
 * User: Jaimin
 * Date: 15/06/18
 * Time: 6:38 PM
 */

namespace helpers;


class GoogleLocationApi extends BaseHelper
{
    const API_KEY = "AIzaSyAVqXVxAvzzlgPKw7JA3_bMyTQZo0SAFQQ" ;

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
                return $this->parseToArray($data);
            }
        }catch ( \Exception $e ){
            $this->printR( $e->getTraceAsString() );
        }
    }

}