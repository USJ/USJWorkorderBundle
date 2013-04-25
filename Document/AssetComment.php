<?php
namespace MDB\WorkorderBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @MongoDB\MappedSuperclass
 */
abstract class AssetComment extends Comment
{
    const ADD = 0;
    const REMOVE = 1;
    const CHANGE = 2;

    protected $asset;
    protected $changeTo;

    /**
     * @MongoDB\Int
     */
    protected $changeType;

    public function getAsset()
    {
        return $this->asset;
    }

    public function getChangeTo()
    {
        return $this->changeTo;
    }

    public function getChangeFrom()
    {
        return $this->asset;
    }

    public function getChangeType()
    {
        return $this->changeType;
    }

    public function isAdd()
    {
        return $this->changeType == self::ADD;
    }

    public function isRemove()
    {
        return $this->changeType == self::REMOVE;
    }

    public function isChange()
    {
        return $this->changeType == self::CHANGE;
    }

    public function associate($asset)
    {
        $this->asset = $asset;
        $this->changeType = self::ADD;
    }

    public function disassociate($asset)
    {
        $this->asset = $asset;
        $this->changeType = self::REMOVE;
    }

    public function changeAsset($fromAsset, $toAsset)
    {
        $this->asset = $fromAsset;
        $this->changeTo = $toAsset;
        $this->changeType = self::CHANGE;
    }
}
