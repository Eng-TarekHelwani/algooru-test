<?php

namespace App\Services\Course;

use App\Models\Course;

class CourseService
{
    public function getAllCourses()
    {
        return Course::all();
    }

    public function getCourseById($id)
    {
        return Course::findOrFail($id);
    }

    public function createCourse(array $data)
    {
        return Course::create($data);
    }

    public function updateCourse($id, array $data)
    {
        $course = Course::findOrFail($id);
        $course->update($data);
        return $course;
    }

    public function deleteCourse($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();
    }
}
