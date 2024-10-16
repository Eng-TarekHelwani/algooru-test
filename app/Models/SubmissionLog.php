<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmissionLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'submission_id',
        'api_response',
        'success',
    ];

    protected $casts = [
        'api_response' => 'json',
    ];

    public function submission()
    {
        return $this->belongsTo(Submission::class);
    }
}
