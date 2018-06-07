<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UpdateProfile
 *
 */

namespace Omnipay\EvoSnap\Components\CustomerManagement;

use Omnipay\EvoSnap\Components\CustomerManagement;
use Omnipay\EvoSnap\Components\Action;

class UpdateProfile extends CustomerManagement implements Action {

    /**
     * @tutorial [auto executable function]
     * @return array
     * @throws \Exception
     */
    public function process() {
        try{
            //throw new \Exception(json_encode('we'), 401);
            
            return \Omnipay\EvoSnap\Helpers\Response::success(['ol']);
            
        }catch(\Exception $ex){
            return \Omnipay\EvoSnap\Helpers\Response::error(['ol'], $ex->getCode(), $ex->getLine(), $ex->getFile());
        }
    }

}
