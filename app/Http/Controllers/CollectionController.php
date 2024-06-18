<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Collection::orderBy('id','ASC')->get();
        return view('admincp.collection.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admincp.collection.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $collection = new Collection();
        $collection->title = $data['title'];
        $collection->slug = $data['slug'];
        $collection->status = $data['status'];

        //them hinh anh
        $get_image = $request->file('image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,9999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('uploads/collection/image/',$new_image);
            $collection->image = $new_image;
        }

         //them hinh anh
         $get_image = $request->file('icon');
         if($get_image){
             $get_name_image = $get_image->getClientOriginalName();
             $name_image = current(explode('.',$get_name_image));
             $new_image = $name_image.rand(0,9999).'.'.$get_image->getClientOriginalExtension();
             $get_image->move('uploads/collection/icon/',$new_image);
             $collection->icon = $new_image;
         }

         //them hinh anh
         $get_image = $request->file('banner');
         if($get_image){
             $get_name_image = $get_image->getClientOriginalName();
             $name_image = current(explode('.',$get_name_image));
             $new_image = $name_image.rand(0,9999).'.'.$get_image->getClientOriginalExtension();
             $get_image->move('uploads/collection/banner/',$new_image);
             $collection->banner = $new_image;
         }

        $collection->save();
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
        $collection = Collection::find($id);
        $list = Collection::orderBy('id','ASC')->get();
        return view('admincp.collection.form',compact('list','collection'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $collection = Collection::find($id);
        $collection->title = $data['title'];
        $collection->slug = $data['slug'];
        $collection->status = $data['status'];

        //them hinh anh
        $get_image = $request->file('image');
        if($get_image){
            if(file_exists('uploads/collection/image/'.$collection->image)){
                unlink('uploads/collection/image/'.$collection->image);
            }
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,9999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('uploads/collection/image/',$new_image);
            $collection->image = $new_image;
        }

        //them hinh anh
        $get_image = $request->file('icon');
        if($get_image){
            if(file_exists('uploads/collection/icon/'.$collection->icon)){
                unlink('uploads/collection/icon/'.$collection->icon);
            }
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,9999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('uploads/collection/icon/',$new_image);
            $collection->icon = $new_image;
        }

        //them hinh anh
        $get_image = $request->file('banner');
        if($get_image){
            if(file_exists('uploads/collection/banner/'.$collection->banner)){
                unlink('uploads/collection/banner/'.$collection->banner);
            }
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,9999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('uploads/collection/banner/',$new_image);
            $collection->banner = $new_image;
        }

        $collection->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $collection = Collection::find($id)->delete();
        if(file_exists('uploads/collection/icon/'.$collection->icon)){
            unlink('uploads/collection/icon/'.$collection->icon);
        }
        if(file_exists('uploads/collection/image/'.$collection->image)){
            unlink('uploads/collection/image/'.$collection->image);
        }

        $collection->delete();
        return redirect()->back();
    }
}
