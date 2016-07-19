<?php
namespace MDB\WorkorderBundle\Document;


/**
 */
abstract class Comment
{
    /**
     *
     */
    protected $body;

    /**
     */
    protected $type;

    /**
     * Set type
     *
     * @param  string   $type
     * @return \Comment
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string $type
     */
    public function getType()
    {
        return $this->type;
    }
}
