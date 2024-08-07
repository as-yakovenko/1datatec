<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Submission;
use App\Events\SubmissionSavedEvent;
use App\DTO\SubmissionData;

class SubmitJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $submissionData;

    /**
     * Create a new job instance.
     */
    public function __construct( SubmissionData $submissionData )
    {
        $this->submissionData = $submissionData;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $submission = Submission::create([
            'name'      => $this->submissionData->name,
            'email'     => $this->submissionData->email,
            'message'   => $this->submissionData->message,
        ]);

        event( new SubmissionSavedEvent( $submission ) );
    }
}
