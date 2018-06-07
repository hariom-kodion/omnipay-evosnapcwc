<?php

/**
 * @tutorial [For EvoSnap payment module]
 */
$app->group('/gateways/{gatewayName:evoCws}', function() {

    // @description : customer management.
    $this->group('/{mode:customerManagement}', function() {
        $this->get('/{action:updateProfile}/{id}', function($request, $response, $args) {
            
            return \Omnipay\EvoSnap\Gateway::factory()
                    ->setCallbackParams($request, $response, $args)
                    ->callAction();
        });
        
        $this->post('/{action:updateProfile}/{id}', function($request, $response, $args) {
            $response->getBody()->write(' Hello 2');
        });
    });
    
});




/**
 * @tutorial [For EvoSnap payment module]
 */
$app->post('/gateways/{gatewayName:EvoSnap_CreditCard}/{action:void|refund|voidOrRefund|transactions|swipe|encryptedSwipe|updateRecurring|createRecurring|deleteRecurring|' .
        'createCard|updateCard|deleteCard|createCheck|updateCheck|deleteCheck|purchase|encryptedPurchase|' .
        'createAccount|modifyAccount|deleteAccount|createMerchant|authorize|exportCard|transaction}', function ($request, $response, $args) {
    $gateway = $request->getAttribute('gatewayName');
    $gatewayType = $request->getAttribute('getActionName');

    $route = $request->getAttribute('route');
    $gatewayName = $route->getArgument('gatewayName');
    $action = $route->getArgument('action');

    $properties = explode('_', $gatewayName);

    if (!class_exists('\Omnipay\EvoSnap\Gateway')) {
        /**
         * @todo [throw exception]
         */
    }

    $evosnap = new \Omnipay\EvoSnap\Gateway($request, $response, $args);

    return $evosnap->setProperties([
                'route' => $route,
                'action' => $action,
                'gateWayProperty' => $properties[1],
                'gateWayname' => $gatewayName
            ])->callAction();

    exit;
});
//->add($validationChecker->validateParameters())
   //->add($validationChecker->validateGateway());
