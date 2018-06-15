<?php
/**
 * Created by PhpStorm.
 * User: Jaimin
 * Date: 16/06/18
 * Time: 12:47 AM
 */

namespace helpers;


class RequestHandler extends BaseHelper
{
    public static $from = null ;
    public static $to = null ;

    public function handleRequest(){
        $data = [];

        // TTC
        //http://www.ttc.ca/Routes/49/Eastbound.jsp stops list  14720 ==> Kipling Station
        //$data = $baseHelper->getTtc()->getCarsByStopId( 14720 );
        //$baseHelper->printR( $data );

        // LYFT
        //$data = $this->getLyft()->getCost( $start_lat = 43.761539 , $start_lng = ‎-79.411079 , $end_lat = 43.653908 , $end_lng =  ‎-79.384293 );
        //$this->printR( $data );
        //exit;

        // UBER work in progress
        //$data = $baseHelper->getUber();
        //$baseHelper->printR( $data );

        //$data = $baseHelper->getGoogleLocationApi()->getLatAndLongByAddress('Lambton college,Sarnia,ON');
        //$baseHelper->printR( $data );
        
        if( isset( $_POST['Location'] ) ){

            if( !isset( $_POST['Location']['from'] ) ){
                $this->setErrorInErrorArray(ErrorMessageHelper::FROM_NOT_DEFINED );
                return $data;
            }else if( empty( $_POST['Location']['from'] ) ){
                $this->setErrorInErrorArray(ErrorMessageHelper::FROM_IS_EMPTY );
                return $data;
            }
            self::$from =  $_POST['Location']['from'];

            $from_lat_lang = $this->getGoogleLocationApi()->getLatAndLongByAddress( $_POST['Location']['from'] );
            $from_lat = GoogleLocationApi::$lat;
            $from_lng = GoogleLocationApi::$lng ;

            if( empty( $from_lat ) || empty( $from_lng ) ){
                $this->setErrorInErrorArray(ErrorMessageHelper::FROM_IS_EMPTY );
            }

            if( !isset( $_POST['Location']['to'] ) ){
                $this->setErrorInErrorArray(ErrorMessageHelper::TO_NOT_DEFINED );
                return $data;
            }else if( empty( $_POST['Location']['to'] ) ){
                $this->setErrorInErrorArray(ErrorMessageHelper::TO_IS_EMPTY );
                return $data;
            }
            self::$to =  $_POST['Location']['to'];


            $to_lat_lang = $this->getGoogleLocationApi()->getLatAndLongByAddress( $_POST['Location']['to'] );
            $to_lat = GoogleLocationApi::$lat;
            $to_lng = GoogleLocationApi::$lng ;

            if( empty( $to_lat ) || empty( $to_lng ) ){
                $this->setErrorInErrorArray(ErrorMessageHelper::FROM_IS_EMPTY );
            }

            $data = $this->getLyft()->getCost( $from_lat , $from_lng , $to_lat , $to_lng );
            //$this->printR( $data );

        }
    }



}