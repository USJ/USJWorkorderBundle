<?php
namespace MDB\WorkorderBundle\EventListener;

use Doctrine\ODM\MongoDB\Event\PreUpdateEventArgs;
use MDB\WorkorderBundle\Model\WorkorderInterface;

/**
 * Listen to status change on save and add a new comment to the workorder.
 *
 * @author Marco Leong <leong.chou.kin@usj.edu.mo>
 */
class StatusChangeListener
{
    protected $statusCommentClass;

    public function __construct($statusCommentClass)
    {
        $this->statusCommentClass = $statusCommentClass;
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $document = $args->getDocument();

        if ($document instanceof WorkorderInterface && $args->hasChangedField('status')) {
            $dm = $args->getDocumentManager();

            $comment = new $this->statusCommentClass;
            $comment->setOld($args->getOldValue('status'));
            $comment->setNew($args->getNewValue('status'));

            $document->addComment($comment);

            $class = $dm->getClassMetadata(get_class($document));
            $dm->getUnitOfWork()->recomputeSingleDocumentChangeSet($class, $document);
        }
    }
}
