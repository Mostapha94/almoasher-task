<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Http\Resources\CoursesResource;
use App\Http\Resources\CourseResource;
use App\Traits\GeneralTrait;
use Exception;

use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    use GeneralTrait;
    /**
    * @var $course
    */
    protected $course;
    /**
     * CourseController constructor.
     */
    public function __construct()
    {
        $this->course=new Course();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $courses=$this->course->where('active',1)->paginate(9);
            if(!count($courses))
                return $this->noResultsFound('Courses');
            $additional['response']=$this->checkCountOfItems($courses,__('Courses'));
            return CoursesResource::collection($courses)->additional($additional);
        }catch(Exception $ex){
            return $this->someThingError($ex->getMessage());
        }
    }
    /**
     * Display the specified course resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $course=$this->course->find($id);
            $additional['response']=$this->checkGetItemById($course);
            if($course)
                return (new CourseResource($course))->additional($additional);
            return $additional['response'];
        }catch(Exception $ex){
            return $this->someThingError($ex->getMessage());
        }
    }

}
