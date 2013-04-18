<?php
return array(
    'di' => array(
        'definition' => array(
            'class' => array(
                'OAuthRequest' => array(
                    'instantiator' => array('OAuthRequest', 'from_request'),
                ),
                'SpiffyOAuthProvider\Provider\Provider' => array(
                    'instantiator' => array('SpiffyOAuthProvider\Provider\Provider', 'getConsumer'),
                    'methods' => array(
                        'getConsumer' => array(
                            'store'   => array('type' => 'SpiffyOAuthProvider\DataStore\Doctrine', 'required' => true),
                            'request' => array('type' => 'OAuthRequest', 'required' => true),
                            'server'  => array('type' => 'OAuthServer', 'required' => true), 
                            'type'    => array('type' => false, 'required' => true),
                        )
                    )
                ),
            ),
        ),
        'instance' => array(
            'alias' => array(
                'spiffy_oauth_request'  => 'OAuthRequest',
                'spiffy_oauth_server'   => 'OAuthServer',
                'spiffy_oauth_store'    => 'SpiffyOAuthProvider\DataStore\Doctrine',
                'spiffy_oauth_consumer' => 'SpiffyOAuthProvider\Provider\Provider',
            ),
            'spiffy_oauth_server' => array(
                'parameters' => array(
                    'data_store' => 'spiffy_oauth_store',
                )
            ),
            'spiffy_oauth_store' => array(
                'parameters' => array(
                    'em' => 'doctrine_em'
                )
            ),
            'spiffy_oauth_consumer' => array(
                'parameters' => array(
                    'store'   => 'spiffy_oauth_store',
                    'request' => 'spiffy_oauth_request',
                    'server'  => 'spiffy_oauth_server',
                    'type'    => 2
                )
            )
        )
    )
);