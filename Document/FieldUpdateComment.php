<?php
namespace MDB\WorkorderBundle\Document;

abstract class FieldUpdateComment extends Comment
{

    protected $old;

    protected $new;

    /**
     * @var string
     */
    protected $field;

    public function getField()
    {
        return $this->field;
    }

    public function setField($field)
    {
        $this->field = $field;
    }

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

        return $this;
    }

    public function setNew($new)
    {
        $this->new = $new;

        return $this;
    }
}
