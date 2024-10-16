<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssignmentRequest;
use App\Services\Assignment\AssignmentService;

class AssignmentController extends Controller
{
    protected $assignmentService;

    public function __construct(AssignmentService $assignmentService)
    {
        $this->assignmentService = $assignmentService;
    }

    public function index()
    {
        $assignments = $this->assignmentService->getAllAssignments();
        return response()->success(compact('assignments'), 'Assignments retrieved successfully');
    }

    public function show($id)
    {
        $assignment = $this->assignmentService->getAssignmentById($id);
        return response()->success(compact('assignment'), 'Assignment retrieved successfully');
    }

    public function store(AssignmentRequest $request)
    {
        $assignment = $this->assignmentService->createAssignment($request->validated());
        return response()->success(compact('assignment'), 'Assignment created successfully', 201);
    }

    public function update(AssignmentRequest $request, $id)
    {
        $assignment = $this->assignmentService->updateAssignment($id, $request->validated());
        return response()->success(compact('assignment'), 'Assignment updated successfully');
    }

    public function destroy($id)
    {
        $this->assignmentService->deleteAssignment($id);
        return response()->success([], 'Assignment deleted successfully');
    }
}
