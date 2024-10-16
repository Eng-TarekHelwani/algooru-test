<?php

namespace App\Services\Assignment;

use App\Models\Assignment;

class AssignmentService
{
    public function getAllAssignments()
    {
        return Assignment::all();
    }

    public function getAssignmentById($id)
    {
        return Assignment::findOrFail($id);
    }

    public function createAssignment(array $data)
    {
        return Assignment::create($data);
    }

    public function updateAssignment($id, array $data)
    {
        $assignment = Assignment::findOrFail($id);
        $assignment->update($data);
        return $assignment;
    }

    public function deleteAssignment($id)
    {
        $assignment = Assignment::findOrFail($id);
        $assignment->delete();
    }
}
