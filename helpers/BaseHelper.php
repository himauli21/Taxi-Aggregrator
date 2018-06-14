<?php
/**
 * Created by PhpStorm.
 * User: Jaimin
 * Date: 10/06/18
 * Time: 10:13 PM
 */

namespace helpers;

use Stevenmaguire\Uber\Client;

class BaseHelper
{
    public function getArrayHelper(){
        return new ArrayHelper();
    }

    public function getStringHelper(){
        return new StringHelper();
    }

    public function getTtc(){
        return new Ttc();
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