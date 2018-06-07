<?php
namespace Omnipay\EvoSnap;

class Base{
    
    /**
     * 
     * @param array $data
     * @throws Exception
     */
    public static function setException( $data, $code ){
        throw new \Exception(json_encode($data), $code);
    }
    
    /**
     * 
     * @param json $data
     * @return array
     */
    public static function getExeption($data){
        return json_decode($data);
    }
    
}
