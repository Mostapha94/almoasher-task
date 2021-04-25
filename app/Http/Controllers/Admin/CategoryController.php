<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * @var $category
     */
    protected $category;
    /**
     * CategoryController constructor.
     */
    public function __construct()
    {
        $this->category = new Category();
    }
    /**
     * Display a listing of the categories.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.categories.index');
    }

    /**
     * Show the form for creating a new category.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.categories.form');
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
            'name'=>'required|max:100',
        ]);
        $this->category->fill($request->all())->save();    
        $request->session()->flash('success', __('Category saved successfully'));
        return redirect()->route('category.index');
    }
    /**
     * Show the form for editing the specified category.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = $this->category->find($id);
        return view('backend.categories.form',['category'=>$category]);
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
            'name'=>'required|max:100',
           
        ]);
        $category=$this->category->find($id);
        $category->fill($request->all())->save(); 
        $request->session()->flash('success', __('Category updated successfully'));
        return redirect()->route('category.index');
    }
    /**
     * get all categories to datatable
     * @return \Illuminate\Http\Response
     */
    public function datatable(){
        $query = $this->category->query();
        $categories = $query->select('*'); 
        return datatables()->of($categories)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href="'.route('category.edit', $row->id).'" class="btn info">'.__('view-edit').'</a>  ';
                $btn .= '<button type="button" class="btn danger delete-element" data-table="categories" data-id="'.$row->id.'">
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
