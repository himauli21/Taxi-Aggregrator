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
    public function handleRequest(){
        if( !empty( $_POST ) ){
            $data = $this->handleFormPost();
            return $data;
        }
    }

    public function handleFormPost(  ){
        if( isset( $_POST['Location'] ) ){
            $data = $this->getFindRidesModel()->handleFormPost();
            return $data;
        }
        return false;
    }

}