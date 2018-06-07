<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Omnipay\EvoSnap\Helpers;

/**
 * Description of Exception
 *
 */
class Exception {

    /**
     * 
     * @param array $data
     * @throws Exception
     */
    public static function setException($data, $code) {
        throw new \Exception(json_encode($data), $code);
    }

    /**
     * 
     * @param json $data
     * @return array
     */
    public static function getExeption($data) {
        return json_decode($data);
    }

}
