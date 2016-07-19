<?php
namespace MDB\WorkorderBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 *
 */
abstract class PriorityComment extends FieldUpdateComment
{
    protected $field = 'priority';
}
