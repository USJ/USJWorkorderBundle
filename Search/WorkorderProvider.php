<?php

namespace MDB\WorkorderBundle\Search;

use FOS\ElasticaBundle\Provider\ProviderInterface;
use Elastica_Document;

class WorkorderProvider implements ProviderInterface
{
    protected $workorerType;
    protected $managerRegistry;
    protected $objectClass;

    public function __construct($workorderType, $objectClass, $managerRegistry)
    {
        $this->workorderType = $workorderType;
        $this->managerRegistry = $managerRegistry;
        $this->objectClass = $objectClass;
    }

    public function populate(\Closure $loggerClosure = null)
    {
        $queryBuilder = $this->createQueryBuilder();
        $nbObjects = $this->countObjects($queryBuilder);

        for ($offset = 0; $offset < $nbObjects; $offset += 100) {
            if ($loggerClosure) {
                $stepStartTime = microtime(true);
            }
            $objects = $this->fetchSlice($queryBuilder, 100 , $offset);

            $this->workorderType->addDocuments($objects);

            if ($loggerClosure) {
                $stepNbObjects = count($objects);
                $stepCount = $stepNbObjects + $offset;
                $percentComplete = 100 * $stepCount / $nbObjects;
                $objectsPerSecond = $stepNbObjects / (microtime(true) - $stepStartTime);
                $loggerClosure(sprintf('%0.1f%% (%d/%d), %d objects/s', $percentComplete, $stepCount, $nbObjects, $objectsPerSecond));
            }
        }
    }

    protected function countObjects($queryBuilder)
    {
        return $queryBuilder->getQuery()->execute()->count();
    }

    protected function fetchSlice($queryBuilder, $limit, $offset)
    {
        $workorders = $queryBuilder
            ->skip($offset)
            ->limit($limit)
            ->getQuery()->execute();

        $objects = array();

        foreach ($workorders as $workorder) {

            $document = new Elastica_Document(
                $workorder->getId(),
                array(
                    "title" => $workorder->getName(),
                    "description" => $workorder->getDescription()
                ),
                "workorder",
                "mdb_workorder"
             );

            $objects[] = $document;
       }

       return $objects;
    }

    protected function createQueryBuilder()
    {
        return $this->managerRegistry
            ->getRepository($this->objectClass)
            ->createQueryBuilder($this->objectClass);
    }

}
