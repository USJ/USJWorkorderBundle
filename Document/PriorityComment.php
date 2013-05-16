<?php
namespace MDB\WorkorderBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
* @MongoDB\MappedSuperclass
*/
abstract class PriorityComment extends Comment
{
    /**
     * @MongoDB\Int
     */
    protected $old;

    /**
     * @MongoDB\Int
     */
    protected $new;

    public function getOld()
    {
        return $this->old;
    }

    public function getNew()
    {
        return $this->new;
    }

    public function setOld($old)
    {
        $this->old = $old;
    }

    public function setNew($new)
    {
        $this->new = $new;
    }
}
