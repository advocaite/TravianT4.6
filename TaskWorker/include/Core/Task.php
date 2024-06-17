<?php
namespace Core;
class Task
{
    const STATUS_PENDING = 'pending';
    const STATUS_DONE = 'done';
    const STATUS_FAILED = 'failed';
    private $id;
    private $status;
    private $data;
    private $time;
    private $failReason;
    private $type;
    private $description;
    private $db;

    public function __construct(DB $db, array $taskRow)
    {
        $this->db = $db;
        $this->id = $taskRow['id'];
        $this->time = $taskRow['time'];
        $this->type = $taskRow['type'];
        $this->failReason = $taskRow['failReason'];
        $this->description = $taskRow['description'];
        $this->data = json_decode($taskRow['data'], true);
        $this->status = $taskRow['status'];
    }

    public function getData()
    {
        return $this->data;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setAsCompleted()
    {
        $this->db->query("UPDATE taskQueue SET status='done' WHERE id={$this->id}");
    }

    public function setAsFailed($reason)
    {
        $reason = $this->db->real_escape_string($reason);
        $this->db->query("UPDATE taskQueue SET status='failed', failReason='$reason' WHERE id={$this->id}");
    }
}