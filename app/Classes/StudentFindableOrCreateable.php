<?php

namespace App\Classes;

use App\Interfaces\FindableOrCreateableInterface;
use App\Models\Student;

class StudentFindableOrCreateable implements FindableOrCreateableInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Insert student if it doesn't exist
     */
     public function findOrCreate(object $sms): int {
        $student = Student::where('std_id', $sms->extra->student_id)->first();
        if (!$student) {
            $student = Student::create([
                'std_id' => $sms->extra->student_id,
            ]);
        }
        return $student->id;
     }
}
