<?php
namespace MDB\WorkorderBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
* @MongoDB\MappedSuperclass
*/
abstract class StatusComment extends FieldUpdateComment
{
    protected $field = 'status';
}
