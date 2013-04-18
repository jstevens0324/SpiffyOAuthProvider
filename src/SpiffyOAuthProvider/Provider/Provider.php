<?php
namespace SpiffyOAuthProvider\Provider;
use SpiffyOAuthProvider\DataStore\Doctrine as DoctrineStore,
    OAuthRequest,
    OAuthServer,
    OAuthSignatureMethod_HMAC_SHA1;

class Provider
{
    const TYPE_NORMAL      = 1;
    const TYPE_TWO_LEGGED  = 2;
    
    public static function getConsumer(DoctrineStore $store, OAuthRequest $request, OAuthServer $server, $type) 
    {
        $server->add_signature_method(new OAuthSignatureMethod_HMAC_SHA1);

        switch($type) {
            case self::TYPE_TWO_LEGGED:
                $server->verify_two_legged($request);
                return $store->getConsumer();
                break;
        }
    }
}
