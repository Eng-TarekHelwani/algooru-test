<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubmissionRequest;
use App\Services\Submission\SubmissionService;

class SubmissionController extends Controller
{
    protected $submissionService;

    public function __construct(SubmissionService $submissionService)
    {
        $this->submissionService = $submissionService;
    }

    public function index()
    {
        $submissions = $this->submissionService->getAllSubmissions();
        return response()->success(compact('submissions'), 'Submissions retrieved successfully');
    }

    public function show($id)
    {
        $submission = $this->submissionService->getSubmissionById($id);
        return response()->success(compact('submission'), 'Submission retrieved successfully');
    }

    public function store(SubmissionRequest $request)
    {
        $submissions = $request->input('submissions');
        
        $this->submissionService->createMultipleSubmissions($submissions);

        return response()->success([], 'Submissions created and logged successfully', 201);
    }

    public function update(SubmissionRequest $request, $id)
    {
        $submission = $this->submissionService->updateSubmission($id, $request->validated());
        return response()->success(compact('submission'), 'Submission updated successfully');
    }

    public function destroy($id)
    {
        $this->submissionService->deleteSubmission($id);
        return response()->success([], 'Submission deleted successfully');
    }
}
