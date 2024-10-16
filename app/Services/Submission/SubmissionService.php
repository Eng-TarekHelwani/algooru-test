<?php

namespace App\Services\Submission;

use App\Contracts\JsonPlaceholderClientInterface;
use App\DataTransferObjects\SubmissionDTO;
use App\Models\Submission;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Promise\Utils;
use Illuminate\Support\Facades\DB;

class SubmissionService
{
    protected $jsonPlaceholderClient;
    protected $submissionLogService;

    public function __construct(JsonPlaceholderClientInterface $jsonPlaceholderClient, SubmissionLogService $submissionLogService)
    {
        $this->jsonPlaceholderClient = $jsonPlaceholderClient;
        $this->submissionLogService = $submissionLogService;
    }

    public function getAllSubmissions()
    {
        return Submission::all();
    }

    public function getSubmissionById($id)
    {
        return Submission::findOrFail($id);
    }

    public function createMultipleSubmissions(array $submissions): void
    {
        DB::transaction(function () use ($submissions) {
            $promises = [];

            foreach ($submissions as $submissionData) {
                $submission = $this->createSubmission($submissionData);

                $submissionDTO = new SubmissionDTO($submissionData['assignment_id'], $submissionData['student_id'], $submissionData['submitted_at']);

                $promises[] = $this->postAndLogSubmissionAsync($submission->id, $submissionDTO);
            }

            Utils::all($promises)->wait();
        });
    }

    protected function createSubmission(array $submissionData): Submission
    {
        return Submission::create($submissionData);
    }

    protected function postAndLogSubmissionAsync(int $submissionId, SubmissionDTO $submissionDto): PromiseInterface
    {
        return $this->jsonPlaceholderClient->postSubmissionAsync($submissionDto)
            ->then(function ($response) use ($submissionId) {
                $this->submissionLogService->createSubmissionLog($submissionId, $response->getBody()->getContents(), true);
            })
            ->otherwise(function ($error) use ($submissionId) {
                $this->submissionLogService->createSubmissionLog($submissionId, $error->getMessage(), false);
            });
    }

    public function updateSubmission($id, array $data)
    {
        $submission = Submission::findOrFail($id);
        $submission->update($data);
        return $submission;
    }

    public function deleteSubmission($id)
    {
        $submission = Submission::findOrFail($id);
        $submission->delete();
    }
}
