<?php 
namespace MDB\WorkorderBundle\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use MDB\WorkorderBundle\Events;
/**
* 
*/
class WorkorderBlamerListener implements EventSubscriberInterface
{
    protected $manager;
    protected $securityContext;

    public function __construct($manager, $securityContext )
    {
        $this->manager = $manager;
        $this->securityContext = $securityContext;
    }

    public function setBlamer($event)
    {
        $workorder = $event->getWorkorder();
        $username = $this->securityContext->getToken()->getUser()->getUsername();

        if($this->manager->isNewWorkorder($workorder)) {
            $workorder->setCreatedBy($username);
        }else{
            $workorder->setUpdatedBy($username);
        }
    }

    public static function getSubscribedEvents()
    {
        return array(Events::WORKORDER_PRE_PERSIST => 'setBlamer');
    }
}