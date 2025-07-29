<?php

namespace App\Services;

class CourseService
{

    public function __construct()
    {
        //
    }

    public function storeModulesContents($modules, $course)
    {
        // improve version
        foreach ($modules as $mod) {
            $module = $course->modules()->create(['title' => $mod['title']]);

            if (isset($mod['contents'])) {
                foreach ($mod['contents'] as $content) {
                    $module->contents()->create($content);
                }
            }
        }
    }
}
