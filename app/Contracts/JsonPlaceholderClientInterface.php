<?php

namespace App\Contracts;

use App\DataTransferObjects\SubmissionDTO;
use GuzzleHttp\Promise\PromiseInterface;

interface JsonPlaceholderClientInterface
{
    public function postSubmissionAsync(SubmissionDTO $submissionDto): PromiseInterface;
}
