<?php

namespace App\DataTransferObjects;

class SubmissionDTO
{
    protected $assignmentId;
    protected $studentId;
    protected $submittedAt;

    public function __construct(int $assignmentId, int $studentId, string $submittedAt)
    {
        $this->assignmentId = $assignmentId;
        $this->studentId = $studentId;
        $this->submittedAt = $submittedAt;
    }

    public function getAssignmentId(): int
    {
        return $this->assignmentId;
    }

    public function getStudentId(): int
    {
        return $this->studentId;
    }

    public function getSubmittedAt(): string
    {
        return $this->submittedAt;
    }
}
