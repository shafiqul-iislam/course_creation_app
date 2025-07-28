<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCourseRequest;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('modules')->latest()->get();
        return view('courses.list', compact('courses'));
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(StoreCourseRequest $request)
    {
        $validated = $request->validated();

        $course = Course::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'category' => $validated['category'],
            'price' => $validated['price'],
        ]);

        foreach ($validated['modules'] as $mod) {
            $module = $course->modules()->create(['title' => $mod['title']]);

            if (isset($mod['contents'])) {
                foreach ($mod['contents'] as $content) {
                    $module->contents()->create($content);
                }
            }
        }


        // here also add my versions

        return redirect('/courses')->with('success', 'Course created!');
    }


    // nest step

    // delete, use BD::transactions
}
