<?php

namespace App\Http\Controllers;

use App\Models\Women;
use Illuminate\Http\Request;

class WomenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Women::orderBy('id','ASC')->get();
        return view('admincp.women.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admincp.women.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $women = new Women();
        $women->title = $data['title'];
        $women->slug = $data['slug'];
        $women->description = $data['description'];
        $women->status = $data['status'];

        //them hinh anh
        $get_image = $request->file('image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,9999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('uploads/women/',$new_image);
            $women->image = $new_image;
        }

        $women->save();
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
        $women = Women::find($id);
        $list = Women::orderBy('id','ASC')->get();
        return view('admincp.women.form',compact('list','women'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $women = Women::find($id);
        $women->title = $data['title'];
        $women->slug = $data['slug'];
        $women->description = $data['description'];
        $women->status = $data['status'];

        //them hinh anh
        $get_image = $request->file('image');
        if($get_image){
            if(file_exists('uploads/women/'.$women->image)){
                unlink('uploads/women/'.$women->image);
            }
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,9999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('uploads/women/',$new_image);
            $women->image = $new_image;
        }

        $women->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $women = Women::find($id)->delete();
        if(file_exists('uploads/women/'.$women->image)){
            unlink('uploads/women/'.$women->image);
        }
        $women->delete();
        return redirect()->back();
    }
    public function resorting(Request $request){
        $data = $request->all();

        foreach($data['array_id'] as $key => $value){
            $women = Women::find($value);
            $women->position = $key;
            $women->save();
        }
    }
}
