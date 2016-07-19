<?php
namespace MDB\WorkorderBundle\Model;
/**
*
*/
interface WorkorderManagerInterface
{
    public function saveWorkorder(WorkorderInterface $workorder);
}
