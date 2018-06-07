<?php

namespace Omnipay\EvoSnap;

use Omnipay\EvoSnap\Base as EvoSnapBase;

class Gateway extends EvoSnapBase {

    /**
     *
     * @var object 
     */
    protected $request;

    /**
     *
     * @var object 
     */
    protected $response;

    /**
     *
     * @var object 
     */
    protected $args;

    /**
     *
     * @var objects (array) 
     */
    protected $properties = [];
    protected $gateway;
    protected $mode;
    protected $action;
    protected static $_instance;

    /**
     * 
     * @param type $request
     * @param type $response
     * @param type $args
     */
    public function __construct() {
        
    }

    /**
     * 
     * @param object array $options
     * @return $this
     */
    public function setProperties($options) {
        foreach ($options as $key => $option) {
            $this->properties[$key] = $option;
        }

        return $this;
    }

    public static function factory() {
        if (!isset(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * 
     * @param type $request
     * @param type $response
     * @param type $args
     * @return $this
     */
    public function setCallbackParams($request, $response, $args) {
        $this->request = $request;
        $this->response = $response;
        $route = $request->getAttribute('route');
        $this->gateway = $route->getArgument('gatewayName');
        $this->mode = $route->getArgument('mode');
        $this->action = $route->getArgument('action');

        return $this;
    }

    /**
     * @description [Main function to map class objects and functions to execute.]
     * @throws \Exception
     */
    public function callAction() {
        try {
            
            $component = $this->mode;
            $action = $this->action;
            
            $classObject = '\\Omnipay\EvoSnap\Components\\' . ucfirst($component);

            if (!class_exists($classObject))
                self::setException('No Payment Mode Found!', 400);

            $actionClass = $classObject.'\\'.ucfirst($action);
            
            if (!class_exists( $actionClass ))
                self::setException('No payment action found for this!',500);
            
            $obj = new $actionClass($this->request, $this->response, $this->args);
            $report = $obj->process();
            
            // on success.
            if ($report['status'] === true) {
                return $this->response->withStatus(200)
                                ->withHeader('Content-Type', 'application/json')
                                ->write(json_encode(
                                array_merge([
                                    'hasErrors' => false,
                                    'success' => true
                                ], $report['data']))
                );
            }
            
            // on failure.
            if( $report['status'] === false ){
                return $this->response->withStatus( $report['code'] )
                            ->withHeader('Content-Type', 'application/json')
                            ->write(json_encode([
                                'hasErrors' => true,
                                'success' => false,
                                'code' => $report['code'], 
                                'line' => $report['line'],
                                'file' => $report['file'],
                                'errors' => $report['data']
                ]));
            }
            
            
        } catch (\Exception $ex) {
            return $this->response->withStatus( $ex->getCode() != 0 ? $ex->getCode() : 500 )
                            ->withHeader('Content-Type', 'application/json')
                            ->write(json_encode([
                                'hasErrors' => true,
                                'success' => false,
                                'line' => $ex->getLine(),
                                'file' => $ex->getFile(),
                                'errors' => self::getExeption($ex->getMessage())
            ]));
        }
    }
}
