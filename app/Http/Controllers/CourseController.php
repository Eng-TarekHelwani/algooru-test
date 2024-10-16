<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Services\Course\CourseService;

class CourseController extends Controller
{
    protected $courseService;

    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }

    public function index()
    {
        $courses = $this->courseService->getAllCourses();
        return response()->success(compact('courses'), 'Courses retrieved successfully');
    }

    public function show($id)
    {
        $course = $this->courseService->getCourseById($id);
        return response()->success(compact('course'), 'Course retrieved successfully');
    }

    public function store(CourseRequest $request)
    {
        $course = $this->courseService->createCourse($request->validated());
        return response()->success(compact('course'), 'Course created successfully', 201);
    }

    public function update(CourseRequest $request, $id)
    {
        $course = $this->courseService->updateCourse($id, $request->validated());
        return response()->success(compact('course'), 'Course updated successfully');
    }

    public function destroy($id)
    {
        $this->courseService->deleteCourse($id);
        return response()->success([], 'Course deleted successfully');
    }
}
