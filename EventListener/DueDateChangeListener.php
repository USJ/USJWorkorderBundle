<?php
namespace MDB\WorkorderBundle\EventListener;

use Doctrine\ODM\MongoDB\Event\PreUpdateEventArgs;
use MDB\WorkorderBundle\Model\WorkorderInterface;

/**
 * Listen to due date change on save and add a new comment to the workorder.
 *
 * @author Marco Leong <leong.chou.kin@usj.edu.mo>
 */
class DueDateChangeListener
{
    protected $dueDateCommentClass;

    public function __construct($dueDateCommentClass)
    {
        $this->dueDateCommentClass = $dueDateCommentClass;
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $document = $args->getDocument();

        if ($document instanceof WorkorderInterface && $args->hasChangedField('dueDate')) {
            $dm = $args->getDocumentManager();

            $comment = new $this->dueDateCommentClass;

            if(is_null($args->getOldValue('dueDate')) && !is_null($args->getNewValue('dueDate'))) {
                $comment->setDueDate($args->getNewValue('dueDate'));
            }elseif($args->getOldValue('dueDate') && $args->getNewValue('dueDate')){
                $comment->changeDueDate($args->getOldValue('dueDate'), $args->getNewValue('dueDate'));
            }elseif($args->getOldValue('dueDate') && is_null($args->getNewValue('dueDate'))) {
                $comment->removeDueDate($args->getOldValue('dueDate'));
            }

            $document->addComment($comment);

            $class = $dm->getClassMetadata(get_class($document));
            $dm->getUnitOfWork()->recomputeSingleDocumentChangeSet($class, $document);
        }
    }
}
