<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Omnipay\EvoSnap\Helpers;

class Response {

    /**
     * 
     * @param array $data
     * @return array
     */
    public static function success($data) {
        return ['status' => true, 'data' => $data];
    }

    /**
     * 
     * @param array $data
     * @param int $code
     * @param string $lineNo
     * @param string $file
     * @return array
     */
    public static function error($data, $code, $lineNo, $file) {
        return ['status' => false, 'code' => $code, 'data' => ['ok'], 'line' => $lineNo, 'file' => $file];
    }

}
