<?php
namespace SpiffyOAuthProvider\DataStore;
use Doctrine\ORM\EntityManager,
    OAuthDataStore,
    SpiffyOAuthProvider\Consumer\Doctrine as DoctrineConsumer;

class Doctrine extends OAuthDataStore
{
    protected $entityManager;
    protected $consumer;
    
    public function __construct(EntityManager $em)
    {
        $this->entityManager = $em;
    }
    
    public function getConsumer()
    {
        return $this->consumer;
    }
    
    public function lookup_consumer($consumerKey)
    {
        $em = $this->entityManager;
        $er = $em->getRepository('Application\Entity\OAuthConsumer');
        
        if ($entity = $er->findOneBy(array('key' => $consumerKey))) {
            $mdata          = $em->getClassMetadata(get_class($entity));
            $consumerSecret = $mdata->reflFields['secret']->getValue($entity);
             
            $this->consumer = new DoctrineConsumer($entity, $consumerKey, $consumerSecret);
            return $this->consumer;
        }
        
        return null;
    }
}