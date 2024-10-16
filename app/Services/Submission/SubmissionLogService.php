<?php

namespace App\Services\Submission;

use App\Models\SubmissionLog;

class SubmissionLogService
{
    public function createSubmissionLog(int $submissionId, string $apiResponse, bool $success): SubmissionLog
    {
        return SubmissionLog::create([
            'submission_id' => $submissionId,
            'api_response' => $apiResponse,
            'success' => $success,
        ]);
    }
}
