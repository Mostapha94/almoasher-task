<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Traits\GeneralTrait;

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
        $this->course = new Course();
    }
    /**
     * Display a listing of the courses.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.courses.index');
    }

    /**
     * Show the form for creating a new course.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.courses.form',[
            'categories' => $this->getAllCategories(),
            'levels' => $this->getAllLevels(),
            'ratings' => $this->getAllRatings(),
        ]);
    }

    /**
     * Store a newly created category in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|max:150',
            'category_id'=>'required',
            'description'=>'required',
            'image'  =>   'required|mimes:jpeg,png,jpg,bmp|max:2048',
            'rating'=>'required',
            'views'=>'required',
            'levels'=>'required',
            'hours'=>'required',
        ]);
        $this->course->fill($request->all());
        if($file   =   $request->file('image')) {
            $name=   time().time().'.'.$file->getClientOriginalExtension();
            $target_path    =   public_path('/uploads/courses');
            if($file->move($target_path, $name)) {
                $this->course->image=$name;
            }
        }
        $this->course->save();    
        $request->session()->flash('success', __('Course saved successfully'));
        return redirect()->route('course.index');
    }
    /**
     * Show the form for editing the specified course.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = $this->course->find($id);
        return view('backend.courses.form',[
            'course'=>$course,
            'categories' => $this->getAllCategories(),
            'levels' => $this->getAllLevels(),
            'ratings' => $this->getAllRatings(),
        ]);
    }

    /**
     * Update the specified category in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required|max:150',
            'category_id'=>'required',
            'description'=>'required',
            'image'  =>   'required|mimes:jpeg,png,jpg,bmp|max:2048',
            'rating'=>'required',
            'views'=>'required',
            'levels'=>'required',
            'hours'=>'required',
        ]);
        $course=$this->course->find($id);
        $course->fill($request->all());
        if($file   =   $request->file('image')) {
            $name=   time().time().'.'.$file->getClientOriginalExtension();
            $target_path    =   public_path('/uploads/courses');
            if($file->move($target_path, $name)) {
                $course->image=$name;
            }
        }
        $course->save();
        $request->session()->flash('success', __('Course updated successfully'));
        return redirect()->route('course.index');
    }
    /**
     * get all courses to datatable
     * @return \Illuminate\Http\Response
     */
    public function datatable(){
        $query = $this->course->query();
        $courses = $query->select('*'); 
        return datatables()->of($courses)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href="'.route('course.edit', $row->id).'" class="btn info">'.__('view-edit').'</a>  ';
                $btn .= '<button type="button" class="btn danger delete-element" data-table="courses" data-id="'.$row->id.'">
                        '.__('Delete').'
                        </button>';
                    return $btn;
            })
            ->addColumn('active', function($row){
                if($row->active == 1){
                    return '<span>'.__('Active').'  &#10004;<span>';
                }else{
                    return __('Not Active');
                }
            })
            ->rawColumns(['action','active'])
            ->make(true);
    }
    
}
