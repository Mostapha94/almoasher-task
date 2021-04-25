<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use App\Models\Course;

class HomeController extends Controller
{
    use GeneralTrait;
    /**
     * Show the application home page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('frontend.index',[
            'categories' => $this->getAllCategories(),
            'courses' => $this->getAllCourses(),
            'levels' => $this->getAllLevels(),
            'ratings' => $this->getAllRatings()
        ]);
    }
    /**
     * get all courses to datatable
     * @return \Illuminate\Http\Response
     */
    public function frontendDatatable(Request $request){
        $query = Course::query();
        $category_id = (!empty($request->category_id)) ? ($request->category_id) : ('');
        if($category_id){
            $query->where('category_id',$category_id);
        }
        $levels = (!empty($request->levels)) ? ($request->levels) : ('');
        if($levels){
            $query->where('levels',$levels);
        }
        $hours = (!empty($request->hours)) ? ($request->hours) : ('');
        if($hours){
            switch($hours){
                case 1 ;
                $query->where('hours','<',4);
                break;

                case 2 ;
                $query->where('hours','<',8);
                break;

                case 3 ;
                $query->where('hours','>',8);
                break;

                default :
            }
        }
        $rating = (!empty($request->rating)) ? ($request->rating) : ('');
        if($rating){
            $query->where('rating',$rating);
        }
        $courses = $query->select('*'); 
        return datatables()->of($courses)
            ->addIndexColumn()
            ->addColumn('course', function($row){
                $dev = '
                <div class="card" style="width:300px">
                    <img class="card-img-top" src="'.MAINUPLOADS.'/courses/'.$row->image .'" alt="Card image">
                    <div class="card-body">
                    <h4 class="card-title">Category : '.$row->category->name.'</h4>
                    <p class="card-text">Level : '.$row->levels.'</p>
                    <p class="card-text">Views : '.$row->views.'</p>
                    </div>
                </div>
                <br>
                ';
               
                return $dev;
            })
            ->rawColumns(['course'])
            ->make(true);
    }
}
