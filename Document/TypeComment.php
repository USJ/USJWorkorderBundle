<?php
namespace MDB\WorkorderBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;

/**
* @MongoDB\MappedSuperclass
*/
abstract class TypeComment extends Comment
{
    /**
     * @MongoDB\String
     */
    protected $old;

    /**
     * @MongoDB\String
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
