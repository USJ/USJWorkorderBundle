<?php
namespace MDB\WorkorderBundle\Repository;

use Doctrine\ODM\MongoDB\DocumentRepository;

 /**
*
*/
class WorkorderRepository extends DocumentRepository
{
    public function findByAssignee($username)
    {
        return $this->createQueryBuilder()
            ->field('assignees')->in(array($username))
            ->getQuery()
            ->execute();
    }

    /**
     * Find the workorders associated with that asset
     */
    public function findWorkordersByAsset($asset)
    {
        return $this->createQueryBuilder()
            ->field('assets.$id')->equals(new \MongoId($asset->getId()))
            ->getQuery()
            ->execute();
    }

    public function findWorkordersBySchedule($schedule)
    {
//         $ids = array();

//         foreach ($schedule->getCreatedItems() as $item) {
//             $ids[] = $item;
//         }
// var_dump($ids,$schedule->getCreatedItems());die;
//         return $this->createQueryBuilder()
//             ->fields('_id')->in()
//             ->sort('created_at','desc')
//             ->getQuery()
//             ->execute();
    }

    public function findDistinctTags()
    {
        return $this->createQueryBuilder()
            ->distinct('tags')
            ->hydrate(false)
            ->getQuery()
            ->execute();
    }
}
