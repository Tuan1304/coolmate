<?php

namespace App\Http\Controllers;

use App\Models\Man;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ManController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Man::orderBy('id','ASC')->get();
        return view('admincp.man.index',compact('list')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admincp.man.form'); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { 
        $data = $request->all();
        $man = new Man(); 
        $man->title = $data['title'];
        $man->slug = $data['slug'];
        $man->description = $data['description'];
        $man->status = $data['status'];
        // $man->image = $data['image'];

        //them hinh anh
        $get_image = $request->file('image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,9999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('uploads/man/',$new_image);
            $man->image = $new_image;
        }

        $man->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $man = Man::find($id);
        $list = Man::orderBy('id','ASC')->get();
        return view('admincp.man.form',compact('list','man'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $man = Man::find($id);
        $man->title = $data['title'];
        $man->slug = $data['slug'];
        $man->description = $data['description'];
        $man->status = $data['status'];

        //them hinh anh
        $get_image = $request->file('image');
        if($get_image){
            if(file_exists('uploads/man/'.$man->image)){
                unlink('uploads/man/'.$man->image);
            }
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,9999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('uploads/man/',$new_image);
            $man->image = $new_image;
        }

        $man->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $man = Man::find($id)->delete();
        if(file_exists('uploads/man/'.$man->image)){
            unlink('uploads/man/'.$man->image);
        }
        $man->delete();
        return redirect()->back();
    }
    public function resorting(Request $request){
        $data = $request->all();

        foreach($data['array_id'] as $key => $value){
            $man = Man::find($value);
            $man->position = $key;
            $man->save();
        }
    }
}
