<?php
/**
 * Created by PhpStorm.
 * User: Jaimin
 * Date: 16/06/18
 * Time: 1:02 PM
 */

namespace helpers;


class FindRidesModel extends FormModel
{
    public $modelName = "Location" ;

    public static $from = null;
    public static $to = null ;

    public function handleFormPost(  ){
        if( !empty( $_POST[ $this->modelName ] ) ){
            if( $this->validateFromAttribute() ){
                if( $this->validateToAttribute() ){
                    if( $this->processFromAttribute() ){
                        if( $this->processToAttribute() ){

                            $from_lat = GoogleLocationApi::$lat;
                            $from_lng = GoogleLocationApi::$lng ;
                            $to_lat = GoogleLocationApi::$lat;
                            $to_lng = GoogleLocationApi::$lng ;
                            $data = $this->getLyft()->getCost( $from_lat , $from_lng , $to_lat , $to_lng );
                            return $data;

                        }
                    }
                }
            }
        }
        return false;
    }

    public function validateFromAttribute(){
        if( !isset( $_POST[$this->modelName ]['from'] ) ){
            $this->setErrorInErrorArray(ErrorMessageHelper::FROM_NOT_DEFINED );
            return false;
        }else if( empty( $_POST[$this->modelName ]['from'] ) ){
            $this->setErrorInErrorArray(ErrorMessageHelper::FROM_IS_EMPTY );
            return false;
        }
        self::$from =  $_POST[$this->modelName ]['from'];
        return true;
    }

    public function validateToAttribute(){
        if( !isset( $_POST[$this->modelName ]['to'] ) ){
            $this->setErrorInErrorArray(ErrorMessageHelper::TO_NOT_DEFINED );
            return false;
        }else if( empty( $_POST[$this->modelName ]['to'] ) ){
            $this->setErrorInErrorArray(ErrorMessageHelper::TO_IS_EMPTY );
            return false;
        }
        self::$to =  $_POST[$this->modelName ]['to'];
        return true;
    }

    public function processFromAttribute(){
        $from_lat_lang = $this->getGoogleLocationApi()->getLatAndLongByAddress(  self::$from  );
        $from_lat = GoogleLocationApi::$lat;
        $from_lng = GoogleLocationApi::$lng ;
        if( empty( $from_lat ) || empty( $from_lng ) ){
            $this->setErrorInErrorArray(ErrorMessageHelper::FROM_IS_EMPTY );
            return false;
        }
        return true;
    }

    public function processToAttribute(){
        $to_lat_lang = $this->getGoogleLocationApi()->getLatAndLongByAddress(  self::$to  );
        $to_lat = GoogleLocationApi::$lat;
        $to_lng = GoogleLocationApi::$lng ;
        if( empty( $to_lat ) || empty( $to_lng ) ){
            $this->setErrorInErrorArray(ErrorMessageHelper::TO_IS_EMPTY );
            return false;
        }
        return true;
    }

}