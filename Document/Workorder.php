<?php
namespace MDB\WorkorderBundle\Document;

use MDB\WorkorderBundle\Model\WorkorderInterface;

/**
 * {@inheritdoc}
 */
class Workorder implements WorkorderInterface
{
    /**
     * {@inheritdoc}
     */
    protected $title;

    /**
     * {@inheritdoc}
     */
    protected $description;

    /**
     * {@inheritdoc}
     */
    protected $type;

    /**
     * {@inheritdoc}
     */
    protected $priority;

    /**
     * {@inheritdoc}
     */
    protected $assignees = array();

    /**
     * {@inheritdoc}
     */
    protected $tags = array();

    /**
     * {@inheritdoc}
     */
    protected $dueDate;

    /**
     * {@inheritdoc}
     */
    protected $status;

    /**
     * {@inheritdoc}
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
        $this->assignees->add($assignee);

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

    public function isWorkRequest()
    {
        return $this->status == "REQUEST";
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
