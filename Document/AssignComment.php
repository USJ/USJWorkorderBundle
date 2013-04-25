<?php 
namespace MDB\WorkorderBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Gedmo\Mapping\Annotation as Gedmo;

/**
* @MongoDB\MappedSuperclass
*/
abstract class AssignComment extends Comment
{
    /**
     * Username of the assignee
     * 
     * @MongoDB\String
     */
    protected $assignee;

    /**
     * @MongoDB\Boolean
     */
    protected $add;

    public function __construct($assignee = null, $add = true)
    {
        $this->assignee = $assignee;
        $this->add = $add;
    }

    public function isAdd()
    {
        return $this->add;
    }

    public function deassign($assignee)
    {
        $this->add = false;
        $this->assignee = $assignee;
        return $this;
    }

    public function assign($assignee)
    {
        $this->add = true;
        $this->assignee = $assignee;
        return $this;
    }

    public function getAssignee()
    {
        return $this->assignee;
    }
}
