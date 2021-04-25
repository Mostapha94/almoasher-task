<?php

namespace App\Traits;
use App\Models\Category;
use App\Models\Course;

trait GeneralTrait
{
    /**
    * get all categories
    * @return mixed
    */
    public function getAllCategories(){
        return Category::orderBy('id', 'desc')->where('active',1)->get();
    }
    /**
    * get all courses
    * @return mixed
    */
    public function getAllCourses(){
        return Course::orderBy('id', 'desc')->where('active',1)->get();
    }
    /**
    * get all levels
    * @return mixed
    */
    public function getAllLevels(){
        return ['beginner','immediat','high'];
    }
    /**
    * get all ratings
    * @return mixed
    */
    public function getAllRatings(){
        return ['5','4','3','2','1'];
    }
    /**
     * Check count of items
     * @param $obj
     * @return response
     */
    public function checkCountOfItems($items,$message){
        return (count($items)?
        $this->responseFormat( true , 200 , $message ,''):
        $this->responseFormat( true , 204 , __('Sorry , no results found') ,''));
    }
     /**
     * Check count of items
     * @param $obj
     * @return response
     */
    public function checkGetItemById($obj){
        return ($obj)?
        $this->responseFormat( true , 200 , $obj['name_'.app()->getLocale()] ,''):
        response()->json(['response'=>['status' => false ,'code' => 404 ,'message'=>  __('Item not found') ]], 404 );
    }
    /**
     * return response for no results found
     * @return response
     */
    public function noResultsFound($key){
        return response()->json([$key=>[],'response'=>['status' => true ,'code' => 204 ,'message'=>  __('Sorry , no results found') ]]);
    }
    /**
     * return response for item not found
     * @return response
     */
    public function itemNotFound(){
        return response()->json(['response'=>['status' => false ,'code' => 404 ,'message'=>  __('Item not found') ]]);
    }
    /**
     * return response for some thing go wrong
     * @return response
     */
    public function someThingError(){
        return response()->json(['response'=>['status' => false ,'code' => 500 ,'message'=>  __('Some thing went wrongs !') ]], 500 );
    }
    /**
     * return response format
     * @param $status
     * @param $code
     * @param $message
     * @param $errors
     * @return response
     */
    public function responseFormat($status,$code,$message,$errors){
        if($errors != '')

            return ['response'=>['status' => $status ,'code' => $code ,'message'=> $message , 'errors'=> $errors]];
        return ['status' => $status ,'code' => $code ,'message'=> $message ];
    }
    /**
     * Get All cars by search
     * @param $request
     * @return mixed
     */
    public function coursesSearch($request){
        $query = Course::select("*");
        if($request->search_text)
            $query->where('name','LIKE',"%{$request->search_text}%")
                  ->orWhere('description','LIKE',"%{$request->search_text}%");

        if($request->category_id)
            $query->where('category_id',$request->category_id);

        if($request->rating)
            $query->where('rating',$request->rating);

        if($request->levels)
            $query->where('levels',$request->levels);

        if($request->city_id)
            $query->where('hours',$request->hours);

        return $query->paginate(9);
    }
}
