<?php
namespace MDB\WorkorderBundle\EventListener;

use Doctrine\ODM\MongoDB\Event\PreUpdateEventArgs;
use MDB\WorkorderBundle\Model\WorkorderInterface;

/**
*
*/
class AddAssetListener
{
    protected $assetCommentClass;

    public function __construct($assetCommentClass)
    {
        $this->assetCommentClass = $assetCommentClass;
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $document = $args->getDocument();
        if ($document instanceof WorkorderInterface && $args->hasChangedField('assets')) {
            $dm = $args->getDocumentManager();

            $oldAssets = $args->getOldValue('assets')->toArray();
            $newAssets = $args->getNewValue('assets')->toArray();

            $assetComments = array();
            // if number of assignees before is more than after
            if (count($oldAssets) > count($newAssets)) {
                // then it is removed action
                // there less new assignees, find out the assignees that has removed.
                $removedAssets = array_diff($oldAssets, $newAssets);

                foreach ($removedAssets as $removedAsset) {
                    $assetComment = new $this->assetCommentClass;
                    $assetComment->disassociate($removedAsset);
                    $assetComments[] = $assetComment;
                }
            } elseif (count($oldAssets) < count($newAssets)) {
                $oldAssets = is_array($oldAssets) ? $oldAssets:array();
                $addedAssets = array_diff($newAssets, $oldAssets);

                foreach ($addedAssets as $addedAsset) {
                    $assetComment = new $this->assetCommentClass;
                    $assetComment->associate($addedAsset);
                    $assetComments[] = $assetComment;
                }
            } elseif (count($oldAssets) == count($newAssets)) {

                // WARNING: work with single asset only.
                if ($oldAssets[0]->getId() != $newAssets[0]->getId()) {
                    $assetComment = new $this->assetCommentClass;
                    $assetComment->changeAsset($oldAssets[0], $newAssets[0]);
                    $assetComments[] = $assetComment;
                }
            }

            foreach ($assetComments as $assetComment) {
                $document->addComment($assetComment);
            }

            $class = $dm->getClassMetadata(get_class($document));
            $dm->getUnitOfWork()->recomputeSingleDocumentChangeSet($class, $document);
        }
    }

    /**
     * TODO: refactoring
     *
     * @param assetsOne Collection
     * @param assetsTwo Collection
     *
     * @return assets All the assets that have different
     */
    private function assetsDiff($assetsOne, $assetsTwo)
    {
        foreach ($assetsOne as $assetOne) {
            // if($assetOne->getId() != $assets
        }
    }
}
