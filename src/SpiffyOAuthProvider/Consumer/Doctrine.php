<?php
namespace SpiffyOAuthProvider\Consumer;
use OAuthConsumer;

class Doctrine extends OAuthConsumer
{
    protected $entity;
    
    public function __construct($entity, $key, $secret, $callback_url = null)
    {
        $this->entity = $entity;
        
        parent::__construct($key, $secret, $callback_url);
    }
    
    public function getEntity()
    {
        return $this->entity;
    }
}
