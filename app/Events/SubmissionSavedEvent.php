<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Submission;

class SubmissionSavedEvent
{
    use Dispatchable, SerializesModels;

    public $submission;

    /**
     * Create a new event instance.
     */
    public function __construct( Submission $submission )
    {
        $this->submission = $submission;
    }
}
