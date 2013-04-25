<?php
namespace MDB\WorkorderBundle\EventListener;

use Doctrine\ODM\MongoDB\Event\PreUpdateEventArgs;
use MDB\WorkorderBundle\Model\WorkorderInterface;

/**
 * Listen to status change on save and add a new comment to the workorder.
 *
 * @author Marco Leong <leong.chou.kin@usj.edu.mo>
 */
class PriorityChangeListener
{
    protected $priorityCommentClass;

    public function __construct($priorityCommentClass)
    {
        $this->priorityCommentClass = $priorityCommentClass;
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $document = $args->getDocument();

        if ($document instanceof WorkorderInterface && $args->hasChangedField('priority')) {
            $dm = $args->getDocumentManager();

            $comment = new $this->priorityCommentClass;
            $comment->setOld($args->getOldValue('priority'));
            $comment->setNew($args->getNewValue('priority'));

            $document->addComment($comment);

            $class = $dm->getClassMetadata(get_class($document));
            $dm->getUnitOfWork()->recomputeSingleDocumentChangeSet($class, $document);
        }
    }
}
