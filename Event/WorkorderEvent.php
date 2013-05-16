<?php
namespace MDB\WorkorderBundle\Event;

use Symfony\Component\EventDispatcher\Event;

class WorkorderEvent extends Event
{
    private $workorder;

    public function __construct($workorder)
    {
        $this->workorder = $workorder;
    }

    public function getWorkorder()
    {
        return $this->workorder;
    }
}
