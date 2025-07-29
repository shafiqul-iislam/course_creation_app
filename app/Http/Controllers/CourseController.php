<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Module;
use App\Models\Content;
use Illuminate\Http\Request;
use App\Services\CourseService;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreCourseRequest;

class CourseController extends Controller
{
    public function __construct(
        private CourseService $courseService
    ) {}

    // view courses list page
    public function index()
    {
        $courses = Course::with('modules')->latest()->get();
        return view('courses.list', compact('courses'));
    }

    // view create course page
    public function create()
    {
        return view('courses.create');
    }

    // store courses
    public function store(StoreCourseRequest $request)
    {
        $validated = $request->validated(); // validated the request


        DB::beginTransaction();

        try {
            $course = Course::create([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'category' => $validated['category'],
                'price' => $validated['price'],
            ]);

            // improve version 
            // store modules and contents
            $this->courseService->storeModulesContents($validated['modules'], $course);

            DB::commit();

            return redirect('/courses')->with('success', 'Course created!');
        } catch (\Exception $e) {
            // if an error occurs, rollback the transaction
            DB::rollBack();

            return redirect()->back()->with('error', $e->getMessage());
        }


        // initial version
        // foreach ($validated['modules'] as $mod) {
        //     $module = Module::create([
        //         'title' => $mod['title'],
        //         'course_id' => $course->id
        //     ]);

        //     if (isset($mod['contents'])) {
        //         foreach ($mod['contents'] as $content) {
        //             Content::create([
        //                 'title' => $content['title'],
        //                 'type' => $content['type'],
        //                 'video_url' => $content['video_url'] ?? null,
        //                 'video_length' => $content['video_length'] ?? null,
        //                 'module_id' => $module->id, 
        //             ]);
        //         }
        //     }
        // }
    }
}
