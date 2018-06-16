<?php
/**
 * Created by PhpStorm.
 * User: Jaimin
 * Date: 10/06/18
 * Time: 10:13 PM
 */

namespace helpers;

use GuzzleHttp\Client;

class BaseHelper
{
    public static $errorArray = [] ;

    public function printErrorArray(){
        return $this->printR(self::$errorArray);
    }

    public function getErrorArray(){
        return self::$errorArray;
    }

    public function setErrorArray( $errorArray ){
        self::$errorArray = $errorArray;
    }

    public function setErrorInErrorArray( $error ){
        $errorArray = $this->getErrorArray();
        $errorArray[] = $error;
        $this->setErrorArray( $errorArray );
    }

    public function getArrayHelper(){
        return new ArrayHelper();
    }

    public function getStringHelper(){
        return new StringHelper();
    }

    public function getTtc(){
        return new Ttc();
    }

    public function getRequestHandler(){
        return new RequestHandler();
    }

    public function getFindRidesModel(){
        return new FindRidesModel();
    }

    /**
     * @return Client
     */
    public function getHttpClient(){
        return  new Client(['defaults' => [
            'verify' => false
        ]]);
    }

    /**
     * @return Uber
     */
    public function getUber(){
        return new Uber();
    }

    public function getLyft(){
        return new Lyft();
    }

    public function getGoogleLocationApi(){
        return new GoogleLocationApi();
    }

    public function printR( $data , $exit = 1 ){
        echo "<pre>";
        print_r( $data );
        echo "</pre>";

        if( $exit ){
            $exit;
        }
    }

    public function parseToArray( $data ){
        $data = json_decode($data,true);
        return $data;
    }
}