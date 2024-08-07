<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Queue;
use Illuminate\Validation\ValidationException;
use App\Jobs\SubmitJob;
use App\Http\Controllers\SubmissionController;

class SubmissionControllerUnitTest extends TestCase
{
    public function test_submit_validates_data_and_dispatches_job()
    {
        $controller = new SubmissionController();

        $request = new Request([
            'name'      => 'Tester',
            'email'     => 'test@mydomain.local',
            'message'   => 'Text message, Text message, Text message'
        ]);

        Queue::fake();

        $response = $controller->submit( $request );

        $this->assertEquals( 202, $response->getStatusCode() );
        $this->assertJsonStringEqualsJsonString(
            json_encode( ['message' => 'Submission received and is being processed'] ),
            $response->getContent()
        );

        Queue::assertPushed( SubmitJob::class );
    }

    public function test_submit_fails_validation_with_missing_fields()
    {
        $controller = new SubmissionController();

        $request = new Request([
            'email'   => 'test@mydomain.local',
            'message' => 'Text message, Text message, Text message'
        ]);

        $this->expectException(ValidationException::class);

        $controller->submit( $request );
    }

    public function test_submit_fails_validation_with_invalid_email()
    {
        $controller = new SubmissionController();

        $request = new Request([
            'name'      => 'Tester',
            'email'     => 'mydomain.local',
            'message'   => 'Text message, Text message, Text message'
        ]);

        $this->expectException( ValidationException::class );

        $controller->submit( $request );
    }

    public function test_submit_fails_validation_with_max_size_name()
    {
        $controller = new SubmissionController();

        $request = new Request([
            'name'      => 'Tester1111',
            'email'     => 'mydomain.local',
            'message'   => 'Text message, Text message, Text message'
        ]);

        $this->expectException( ValidationException::class );

        $controller->submit( $request );
    }

    public function test_submit_fails_validation_with_max_size_email()
    {
        $controller = new SubmissionController();

        $request = new Request([
            'name'      => 'Tester',
            'email'     => 'test@mydomainmydomainmydomainmydomain.local',
            'message'   => 'Text message, Text message, Text message'
        ]);

        $this->expectException( ValidationException::class );

        $controller->submit( $request );
    }

    public function test_submit_fails_validation_with_max_size_message()
    {
        $controller = new SubmissionController();

        $request = new Request([
            'name'      => 'Tester',
            'email'     => 'test@mydomain.local',
            'message'   => str_repeat('A', 1001)
        ]);

        $this->expectException( ValidationException::class );

        $controller->submit( $request );
    }
}
