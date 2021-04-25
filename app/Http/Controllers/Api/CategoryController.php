<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Resources\CategoriesResource;
use App\Http\Resources\CategoryResource;
use App\Traits\GeneralTrait;

use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    use GeneralTrait;
    /**
    * @var $category
    */
    protected $category;
    /**
     * CategoryController constructor.
     */
    public function __construct()
    {
        $this->category=new Category();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $categories=$this->category->where('active',1)->get();
            if(!count($categories))
                return $this->noResultsFound('Categories');
            $additional['response']=$this->checkCountOfItems($categories,__('Categories'));
            return CategoriesResource::collection($categories)->additional($additional);
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
            $category=$this->category->find($id);
            $additional['response']=$this->checkGetItemById($category);
            if($category)
                return (new CategoryResource($category))->additional($additional);
            return $additional['response'];
        }catch(Exception $ex){
            return $this->someThingError($ex->getMessage());
        }
    }

}
