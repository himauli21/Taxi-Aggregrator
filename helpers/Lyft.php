<?php
/**
 * Created by PhpStorm.
 * User: Jaimin
 * Date: 10/06/18
 * Time: 10:16 PM
 */

namespace helpers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Response;
use ReflectionClass;
use Exception;

class Lyft extends BaseHelper
{
    const CLIENT_ID = "Q2mmXf2dEUDs" ;
    const CLIENT_SECRTE = "7W7mdn-R6IR4GcYjVxfsfjwOhv9hGCiB" ;

    public static $protocol = "https://" ;
    public static $host = "api.lyft.com" ;
    public static $token_endpoint = "/oauth/token" ;
    public static $version = "v1" ;
    public static $access_token = null ;

    public static $rides_endpoint = "rides" ;
    public static $cost_endpoint = "cost" ;

    public function getAccessTokenUrl(){
        return self::$protocol.self::$host.self::$token_endpoint;
    }

    public function getApiUrl(){
        return self::$protocol.self::$host."/".self::$version."/";
    }

    public function getRidesUrl(){
        return $this->getApiUrl().self::$rides_endpoint;
    }

    public function getCostUrl( $start_lat , $start_lng , $end_lat , $end_lng ){
        return $this->getApiUrl().self::$cost_endpoint."?start_lat=".$start_lat."&start_lng=".$start_lng."&end_lat=".$end_lat."&end_lng=".$end_lng;
    }

    public function getRidesOptions(){
        $options = $this->getRequestOptionsWithAccessToken();
        $data = [
            'ride_type'=>'lyft',
            'origin'=>['lat'=>37.77663,'lng'=>-122.39227],
            'destination'=>['lat'=>37.77663,'lng'=>-122.39227,'address'=>'Mission Bay Boulevard North']
        ];
        $body = json_encode( $data );
        $options['body'] = $body;
        return $options;
    }

    public function getCostOptions(){
        $options = $this->getRequestOptionsWithAccessToken();
        $data = [];
        $body = json_encode( $data );
        $options['body'] = $body;
        return $options;
    }

    public function getAccessToken(){
        if( self::$access_token != null ){
            return self::$access_token;
        }else{
            $accessTokenUrl = $this->getAccessTokenUrl();
            $client =  $this->getHttpClient();
            $request = $client->request('POST',$accessTokenUrl,
                [
                    'headers'=>['Content-Type'=>'application/json'],
                    'auth'=>[self::CLIENT_ID,self::CLIENT_SECRTE],
                    'body'=>'{"grant_type": "client_credentials", "scope": "rides.request"}'
                ]);

            if( $request->getStatusCode() == 200 ){
                $data = $request->getBody()->getContents();
                $data = $this->parseToArray( $data );
                if( isset($data['access_token']) ){
                    self::$access_token = $data['access_token'];
                    return self::$access_token;
                }else{
                    throw new ClientException( 400 , "Not able to connect to LYFT API." );
                }
            }else{
                throw new ClientException( 400 , "Not able to connect to LYFT API." );
            }
        }
    }

    public function getRequestOptionsWithAccessToken(){
        $accessToken = $this->getAccessToken();
        return [
            'headers'=>[
                'Content-Type'=>'application/json',
                'Authorization'=>'Bearer '.$accessToken
            ]
        ];
    }

    public function getRides(){
        $client = $this->getHttpClient();
        $options = $this->getRidesOptions();
        $url = $this->getRidesUrl();
        $request = $client->request('POST',$url, $options);
        if( $request->getStatusCode() == 200 ){
            $data = $request->getBody()->getContents();
            $data = $this->parseToArray( $data );
            return $data;
        }else{
            throw new ClientException( 400 , "Not able to connect to LYFT API." );
        }
    }

    public function getCost( $start_lat , $start_lng , $end_lat , $end_lng ){
        $client = $this->getHttpClient();
        $options = $this->getCostOptions();
        $url = $this->getCostUrl( $start_lat , $start_lng , $end_lat , $end_lng );
        try{
            $request = $client->request('GET',$url, $options);
            if( $request->getStatusCode() == 200 ){
                $data = $request->getBody()->getContents();
                $data = $this->parseToArray( $data );
                $data = ArrayHelper::getValue( $data , 'cost_estimates' );
                return $data;
            }else{
                throw new ClientException( 400 , "Not able to connect to LYFT API." );
            }
        }catch (ClientException $e){
            $this->printR( $e->getMessage() );
            return false;
        }
    }
}