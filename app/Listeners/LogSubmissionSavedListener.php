<?php

namespace App\Listeners;

use App\Events\SubmissionSavedEvent;
use Illuminate\Support\Facades\Log;

class LogSubmissionSavedListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle( SubmissionSavedEvent $event )
    {
        Log::info('Submission saved: ' . $event->submission->name . ' (' . $event->submission->email . ')');
    }
}
