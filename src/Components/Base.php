<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Omnipay\EvoSnap\Components;

/**
 * Description of Base
 *
 */
abstract class Base {

    protected $request;
    protected $response;
    protected $args;

    /**
     * 
     * @param type $request
     * @param type $response
     * @param type $args
     */
    public function __construct($request, $response, $args) {
        $this->request = $request;
        $this->response = $response;
        $this->args = $args;
    }

    public static function validateParams() {
        
    }

    /**
     * 
     * @param array $data
     * @return array
     */
    public static function sucess($data) {
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
