<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\LoopRepository;

class AdminController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
   /**
     * Delete Item to any table.
     *
     * @return \Illuminate\Contracts\Support\Renderable
    */ 
    public function delete(Request $request)
    {
        $request->validate([
           'table' => 'required',
           'id' => 'required'
        ]);  
        DB::table($request->table)->where('id', $request->id)->update(['deleted_at' => now()]);

        return response()->json(['status' => true]);
    }
  

}
