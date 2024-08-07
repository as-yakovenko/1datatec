<?php

namespace App\DTO;

class SubmissionData
{
    public function __construct(
        public string $name,
        public string $email,
        public string $message
    )
    {
    }
}
