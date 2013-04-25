<?php
namespace MDB\WorkorderBundle\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use MDB\WorkorderBundle\Events;

/**
* 
*/
class WorkorderTimestampListener implements EventSubscriberInterface
{
    protected $manager;

    public function __construct($manager)
    {
        $this->manager = $manager;
    }

    public function setTimestamp($event)
    {
        $workorder = $event->getWorkorder();

        if($this->manager->isNewWorkorder($workorder)) {
            $workorder->setCreatedAt(time());
        }else{
            $workorder->setUpdatedAt(time());
        }
    }

    public static function getSubscribedEvents()
    {
        return array(Events::WORKORDER_PRE_PERSIST => 'setTimestamp');
    }

}