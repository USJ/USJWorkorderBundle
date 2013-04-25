<?php
namespace MDB\WorkorderBundle\EventListener;

use Doctrine\ODM\MongoDB\Event\PreUpdateEventArgs;
use MDB\WorkorderBundle\Model\WorkorderInterface;

/**
 * Listen to status change on save and add a new comment to the workorder.
 *
 * @author Marco Leong <leong.chou.kin@usj.edu.mo>
 */
class TypeChangeListener
{
    protected $typeCommentClass;

    public function __construct($typeCommentClass)
    {
        $this->typeCommentClass = $typeCommentClass;
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $document = $args->getDocument();

        if ($document instanceof WorkorderInterface && $args->hasChangedField('type')) {
            $dm = $args->getDocumentManager();

            $comment = new $this->typeCommentClass;
            $comment->setOld($args->getOldValue('type'));
            $comment->setNew($args->getNewValue('type'));

            $document->addComment($comment);

            $class = $dm->getClassMetadata(get_class($document));
            $dm->getUnitOfWork()->recomputeSingleDocumentChangeSet($class, $document);
        }
    }
}
