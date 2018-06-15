<?php
/**
 * Created by PhpStorm.
 * User: Jaimin
 * Date: 10/06/18
 * Time: 10:00 PM
 */

namespace helpers;

use GuzzleHttp\Psr7\Request;

class Ttc extends BaseHelper
{
    public static $url = "http://webservices.nextbus.com/service/publicJSONFeed?command=predictions&a=ttc&stopId=";

    public function getCarsByStopId( int $stopId ){
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', self::$url.$stopId );
        if( $res->getStatusCode() == 200 ){
            $data = $res->getBody()->getContents();
            return $this->parseToArray($data);
        }
    }
}