<?php

namespace App\Contracts;

use App\DataTransferObjects\SubmissionDTO;
use GuzzleHttp\Client;
use GuzzleHttp\Promise\PromiseInterface;

class JsonPlaceholderClient implements JsonPlaceholderClientInterface
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function postSubmissionAsync(SubmissionDTO $submissionDto): PromiseInterface
    {
        return $this->client->postAsync('posts', [
            'json' => [
                'assignment_id' => $submissionDto->getAssignmentId(),
                'student_id' => $submissionDto->getStudentId(),
                'submitted_at' => $submissionDto->getSubmittedAt(),
            ],
        ]);
    }
}
