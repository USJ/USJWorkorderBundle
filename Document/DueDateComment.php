<?php
namespace MDB\WorkorderBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\MappedSuperclass
 */
abstract class DueDateComment extends Comment
{
    const SET = 0;
    const CHANGE = 1;
    const REMOVE = 2;

    /**
     * @MongoDB\Date
     */
    protected $fromDueDate;

    /**
     * @MongoDB\Date
     */
    protected $toDueDate;

    /**
     * @MongoDB\Int
     */
    protected $changeType;

    public function getFrom()
    {
        return $this->fromDueDate;
    }

    public function getTo()
    {
        return $this->toDueDate;
    }

    public function isRemove()
    {
        return $this->changeType == self::REMOVE;
    }

    public function isSetting()
    {
        return $this->changeType == self::SET;
    }

    public function isChange()
    {
        return $this->changeType == self::CHANGE;
    }

    public function changeDueDate($from, $to)
    {
        $this->fromDueDate = $from;
        $this->toDueDate = $to;
        $this->changeType = self::CHANGE;
    }

    public function setDueDate($to)
    {
        $this->toDueDate = $to;
        $this->changeType = self::SET;
    }

    public function removeDueDate($from)
    {
        $this->fromDueDate = $from;
        $this->changeType = self::REMOVE;
    }
}
