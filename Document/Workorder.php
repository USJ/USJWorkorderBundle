<?php
namespace MDB\WorkorderBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;

use MDB\WorkorderBundle\Model\WorkorderInterface;
/**
 * @MongoDB\MappedSuperclass
 */
class Workorder implements WorkorderInterface
{
    /**
     * @MongoDB\String
     */
    protected $title;

    /**
     * @MongoDB\String
     */
    protected $description;

    /**
     * @MongoDB\String
     */
    protected $type;

    /**
     * @MongoDB\Int
     */
    protected $priority;

     /**
     * @var timestamp $created
     *
     * @MongoDB\Timestamp
     */
    protected $createdAt;

    /**
     * @var date $updated
     *
     * @MongoDB\Timestamp
     */
    protected $updatedAt;

    /**
     * @MongoDB\String
     */
    protected $createdBy;

    /**
     * @MongoDB\String
     */
    protected $updatedBy;

    /**
     * @MongoDB\Collection
     */
    protected $assignees = array();

    /**
     * @MongoDB\Collection
     */
    protected $tags = array();

    /**
     * @MongoDB\Date
     */
    protected $dueDate;

    /**
     * @MongoDB\String
     */
    protected $status;

    /**
     * @MongoDB\Int
     */
    protected $estimatedDuration;

    public function __construct()
    {
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getAssignees()
    {
        return $this->assignees;
    }

    public function setAssignees($assignees)
    {
        $this->assignees = $assignees;
    }

    public function addAssignee($assignee)
    {
        $this->assignees[] = $assignee;

        return $this;
    }

    public function removeAssignee($assignee)
    {
        unset($this->assignees[array_search($assignee, $this->assignees)]);

        return $this;
    }

    /**
     * Set status
     *
     * @param  string $status
     * @return Order
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string $status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set type
     *
     * @param  string $type
     * @return Order
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string $type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set created
     *
     * @param  timestamp $created
     * @return Order
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return timestamp $created
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param  date  $updated
     * @return Order
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return date $updated
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set createdAt
     *
     * @param  timestamp $createdAt
     * @return Order
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return timestamp $createdAt
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param  date  $updatedAt
     * @return Order
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return date $updatedAt
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set title
     *
     * @param  string $title
     * @return Order
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param  string $description
     * @return Order
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string $description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set priority
     *
     * @param  string     $priority
     * @return \Workorder
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return string $priority
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set createdBy
     *
     * @param  string     $createdBy
     * @return \Workorder
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return string $createdBy
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set updatedBy
     *
     * @param  string     $updatedBy
     * @return \Workorder
     */
    public function setUpdatedBy($updatedBy)
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    /**
     * Get updatedBy
     *
     * @return string $updatedBy
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    /**
     * @Assert\True(message="Is not a request", groups={"workrequest"})
     */
    public function isWorkRequest()
    {
        return $this->status == "REQUEST";
;
    }

    public function getComments()
    {
        return $this->comments;
    }

    public function setComments($comments)
    {
        $this->comments = $comments;

        return $this;
    }

    public function addComment($comment)
    {
        $this->comments->add($comment);

        return $this;
    }

    public function removeComment($comment)
    {
        $this->comments->removeElement($comment);

        return $this;
    }

    public function setDueDate($dueDate)
    {
        $this->dueDate = $dueDate;
    }

    public function getDueDate()
    {
        return $this->dueDate;
    }

    public function getTags()
    {
        return $this->tags;
    }

    public function setTags($tags)
    {
        $this->tags = $tags;

        return $this;
    }

    public function getEstimatedDuration()
    {
        return $this->estimatedDuration;
    }

    public function setEstimatedDuration($duration=0)
    {
        $this->estimatedDuration = $duration;

        return $this;
    }
}
