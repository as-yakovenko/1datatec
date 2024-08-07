<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;
use App\Jobs\SubmitJob;
use App\DTO\SubmissionData;

class SubmissionController extends Controller
{
    public function submit( Request $request ): JsonResponse
    {
        $validator = Validator::make( $request->toArray(), [
            'name'      => 'required|string|max:6',
            'email'     => 'required|string|email|max:20',
            'message'   => 'required|string|max:1000',
        ]);

        if ( $validator->fails() ) {

            throw new ValidationException( $validator );

        }

        $submissionData = new SubmissionData(
            $request->name,
            $request->email,
            $request->message
        );

        SubmitJob::dispatch( $submissionData );

        return response()->json( ['message' => 'Submission received and is being processed'], 202 );
    }
}
