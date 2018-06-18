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
                        $from_lat = GoogleLocationApi::$lat;
                        $from_lng = GoogleLocationApi::$lng ;
                        if( $this->processToAttribute() ){
                            $to_lat = GoogleLocationApi::$lat;
                            $to_lng = GoogleLocationApi::$lng ;

                            $data = [];
                            // LYFT
                            $lyft = $this->getLyft()->getCost( $from_lat , $from_lng , $to_lat , $to_lng );
                            $data['lyft'] = $lyft;

                            // call uber
                            $uber = $this->getUber()->getEstimates();
                            $data['uber'] = $uber;
                            //$this->printR( $data );

                            // call ttc
                            // whatever from is selected
                            // db will have table name stops
                            // there will be stopId for API and stopName , Lat and longitude from google Api
                            //
                            // TTC is not allwoing from and to based API for lat and long
                            //
                            //$ttc = $this->getTtc()->getCarsByStopId( 8456 );
                            // $data['ttc'] = $ttc;

                            // merge data of all
                            // contentagregattor which provides facility of filter and sort data

                            return $data;

                        }
                    }
                }
            }
        }
        return false;
    }

    /**
     * @return bool
     */
    public function validateFromAttribute(){
        if( !isset( $_POST[$this->modelName ]['from'] ) ){
            $this->setErrorInErrorArray(ErrorMessageHelper::FROM_NOT_DEFINED.__CLASS__.">".__LINE__ );
            return false;
        }else if( empty( $_POST[$this->modelName ]['from'] ) ){
            $this->setErrorInErrorArray(ErrorMessageHelper::FROM_IS_EMPTY.__CLASS__.">".__LINE__ );
            return false;
        }
        self::$from =  $_POST[$this->modelName ]['from'];
        return true;
    }

    /**
     * @return bool
     */
    public function validateToAttribute(){
        if( !isset( $_POST[$this->modelName ]['to'] ) ){
            $this->setErrorInErrorArray(ErrorMessageHelper::TO_NOT_DEFINED.__CLASS__.">".__LINE__ );
            return false;
        }else if( empty( $_POST[$this->modelName ]['to'] ) ){
            $this->setErrorInErrorArray(ErrorMessageHelper::TO_IS_EMPTY.__CLASS__.">".__LINE__ );
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
            $this->setErrorInErrorArray(ErrorMessageHelper::FROM_IS_EMPTY.__CLASS__.">".__LINE__ );
            return false;
        }
        return true;
    }

    public function processToAttribute(){
        $to_lat_lang = $this->getGoogleLocationApi()->getLatAndLongByAddress(  self::$to  );
        $to_lat = GoogleLocationApi::$lat;
        $to_lng = GoogleLocationApi::$lng ;
        if( empty( $to_lat ) || empty( $to_lng ) ){
            $this->setErrorInErrorArray(ErrorMessageHelper::TO_IS_EMPTY.__CLASS__.">".__LINE__ );
            return false;
        }
        return true;
    }

}