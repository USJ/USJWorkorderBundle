<?php 
namespace MDB\WorkorderBundle\EventListener;

use Doctrine\ODM\MongoDB\Event\PreUpdateEventArgs;
use MDB\WorkorderBundle\Model\WorkorderInterface;

/**
* This class detect the changes in assignees field
*/
class AssigneesChangeListener
{
    protected $assignCommentClass;

    public function __construct($assignCommentClass)
    {
        $this->assignCommentClass = $assignCommentClass;
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $document = $args->getDocument();

        if ($document instanceof WorkorderInterface && $args->hasChangedField('assignees')) {
            $dm = $args->getDocumentManager();

            $args->getOldValue('assignees');

            $oldAssignees = $args->getOldValue('assignees');
            $newAssignees = $args->getNewValue('assignees');

            $assignComments = array();
            // if number of assignees before is more than after
            if(count($oldAssignees) > count($newAssignees)) {
                // then it is removed action
                // there less new assignees, find out the assignees that has removed.
                $removedAssignees = array_diff($oldAssignees, $newAssignees);

                foreach ($removedAssignees as $removedAssignee) {
                    $assignComment = new $this->assignCommentClass;
                    $assignComment->deassign($removedAssignee);
                    $assignComments[] = $assignComment;
                }
            }elseif(count($oldAssignees) < count($newAssignees)){
                $oldAssignees = is_array($oldAssignees) ? $oldAssignees:array();
                $addedAssignees = array_diff($newAssignees, $oldAssignees);

                foreach ($addedAssignees as $addedAssignee) {
                    $assignComment = new $this->assignCommentClass;
                    $assignComment->assign($addedAssignee);
                    $assignComments[] = $assignComment;
                }
            }

            foreach ($assignComments as $assignComment) {
                $document->addComment($assignComment);
            }

            $class = $dm->getClassMetadata(get_class($document));
            $dm->getUnitOfWork()->recomputeSingleDocumentChangeSet($class, $document);
        }
    }
}