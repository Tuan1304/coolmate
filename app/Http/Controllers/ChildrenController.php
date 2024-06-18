<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Children;

class ChildrenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Children::orderBy('id','ASC')->get();
        return view('admincp.children.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admincp.children.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $children = new Children();
        $children->title = $data['title'];
        $children->slug = $data['slug'];
        $children->description = $data['description'];
        $children->status = $data['status'];

        //them hinh anh
        $get_image = $request->file('image'); 
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,9999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('uploads/children/',$new_image);
            $children->image = $new_image;
        }

        $children->save();
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
        $children = Children::find($id);
        $list = Children::orderBy('id','ASC')->get();
        return view('admincp.children.form',compact('list','children'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $children = Children::find($id);
        $children->title = $data['title'];
        $children->slug = $data['slug'];
        $children->description = $data['description'];
        $children->status = $data['status'];

       //them hinh anh
       $get_image = $request->file('image');
       if($get_image){
           if(file_exists('uploads/children/'.$children->image)){
               unlink('uploads/children/'.$children->image);
           }
           $get_name_image = $get_image->getClientOriginalName();
           $name_image = current(explode('.',$get_name_image));
           $new_image = $name_image.rand(0,9999).'.'.$get_image->getClientOriginalExtension();
           $get_image->move('uploads/children/',$new_image);
           $children->image = $new_image;
       }

        $children->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $children = Children::find($id)->delete();
        if(file_exists('uploads/children/'.$children->image)){
            unlink('uploads/children/'.$children->image);
        }
        $children->delete();
        return redirect()->back();
    }
    public function resorting(Request $request){
        $data = $request->all();

        foreach($data['array_id'] as $key => $value){
            $children = Children::find($value);
            $children->position = $key;
            $children->save();
        }
    }
}
