<?php

namespace AppKit\Formulate\Tests\Concerns;

use Illuminate\Http\Request;
use Mockery;

trait Mocks
{
    /**
     * Mock that we have passed the following information in the POST request
     *
     * @param array $data
     * @return void
     */
    public function mockPostedValues(array $data = [])
    {
        // create a mock request
        $request = Mockery::mock(Request::class, function ($mock) use ($data) {
            foreach ($data as $field => $value) {
                $mock->shouldReceive('old')->with($field)->andReturn($value);
            }
        });

        // make it partial so all of the other request stuff works
        $request = $request->makePartial();

        // bind it to the container
        $this->instance(Request::class, $request);
        $this->instance('request', $request);
    }

    /**
     * Mock that the given fields have validation errors
     *
     * @param array $fields
     * @return void
     */
    public function withInvalidFields(array $fields = [])
    {
        $errorBag = [];

        foreach ($fields as $field) {
            $errorBag[$field] = [$field . ' Validation Error'];
        }

        $this->withViewErrors($errorBag);
    }
}
