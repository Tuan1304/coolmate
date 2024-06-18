<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Children;
use App\Models\Collection;
use App\Models\Man;
use App\Models\Product;
use App\Models\Women;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Product::with('category','children','man','women')->orderBy('id','DESC')->get();

        $path = public_path()."/json_file/";

        if(!is_dir($path)) {
            mkdir($path,0777,true);
        }
        File::put($path.'product.json',json_encode($list));

        return view('admincp.product.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $list = Product::orderBy('id','ASC')->get();
        $category = Category::pluck('title','id');
        $children = Children::pluck('title','id');
        $collection = Collection::pluck('title','id');
        $man = Man::pluck('title','id'); 
        $women = Women::pluck('title','id');
       
        return view('admincp.product.form',compact('list','category','children','man','women','collection'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $product = new Product();
        $product->title = $data['title'];
        // $product->trailer = $data['trailer'];
        // $product->tags = $data['tags'];
        $product->slug = $data['slug'];
        $product->price = $data['price'];
        $product->cost = $data['cost'];
        $product->material = $data['material'];
        $product->color = $data['color'];
        $product->description = $data['description'];
        $product->compare = $data['compare'];
        $product->status = $data['status'];
        $product->hot_product = $data['hot_product'];
        $product->category_id = $data['category_id'];
        $product->collection_id = $data['collection_id'];
        $product->children_id = $data['children_id'];
        $product->man_id = $data['man_id'];
        $product->women_id = $data['women_id'];
        $product->ngaytao = Carbon::now('Asia/Ho_Chi_Minh');
        $product->ngaycapnhat = Carbon::now('Asia/Ho_Chi_Minh'); 

        //them hinh anh
        $get_image = $request->file('image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,9999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('uploads/product/',$new_image);
            $product->image = $new_image;
        }

        // Thêm nhiều ảnh
        if ($request->hasFile('images')) {
            $imageNames = []; // Khởi tạo mảng để lưu tên ảnh
        
            foreach ($request->file('images') as $image) {
                $imageName = $image->getClientOriginalName(); // Lấy tên gốc của ảnh
                $name = pathinfo($imageName, PATHINFO_FILENAME);
                $extension = $image->getClientOriginalExtension();
                $newName = $name.'_'.time().'.'.$extension; // Tạo tên duy nhất cho ảnh
                // Lưu ảnh vào thư mục public/uploads/images
                $image->move('uploads/images', $newName);
                // Thêm tên ảnh vào mảng
                $imageNames[] = $newName;
            }
        
            // Convert mảng tên ảnh thành chuỗi
            $imageString = implode(',', $imageNames);
        
            // Lưu chuỗi tên ảnh vào trường 'images' của sản phẩm
            $product->images = $imageString;
        }        

        $product->save();
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
        $category = Category::pluck('title','id');
        $children = Children::pluck('title','id');
        $collection = Collection::pluck('title','id');
        $man = Man::pluck('title','id'); 
        $women = Women::pluck('title','id');
       
        $product = Product::find($id);
        return view('admincp.product.form',compact('category','children','man','women','product','collection'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $product = Product::find($id);
        $product->title = $data['title'];
        // $product->trailer = $data['trailer'];
        // $product->tags = $data['tags'];
        $product->slug = $data['slug'];
        $product->price = $data['price'];
        $product->cost = $data['cost'];
        $product->material = $data['material'];
        $product->color = $data['color'];
        $product->description = $data['description'];
        $product->compare = $data['compare'];
        $product->status = $data['status'];
        $product->hot_product = $data['hot_product'];
        $product->category_id = $data['category_id'];
        $product->collection_id = $data['collection_id'];
        $product->children_id = $data['children_id'];
        $product->man_id = $data['man_id'];
        $product->women_id = $data['women_id'];
        $product->ngaycapnhat = Carbon::now('Asia/Ho_Chi_Minh');
        
        //them hinh anh
        $get_image = $request->file('image');
        if($get_image){
            if(file_exists('uploads/product/'.$product->image)){
                unlink('uploads/product/'.$product->image);
            }
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,9999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('uploads/product/',$new_image);
            $product->image = $new_image;
        }

        if ($request->hasFile('images')) {
            // Xóa ảnh cũ nếu tồn tại
            if (!empty($product->images)) {
                $oldImages = explode(',', $product->images);
                foreach ($oldImages as $oldImage) {
                    $oldImagePath = public_path('uploads/images/' . $oldImage);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
            }
    
            // Lưu ảnh mới
            $imageNames = [];
            foreach ($request->file('images') as $image) {
                $imageName = $image->getClientOriginalName();
                $name = pathinfo($imageName, PATHINFO_FILENAME);
                $extension = $image->getClientOriginalExtension();
                $newName = $name . '_' . time() . '.' . $extension;
                $image->move('uploads/images', $newName);
                $imageNames[] = $newName;
            }
            $imageString = implode(',', $imageNames);
            $product->images = $imageString;
        }

        $product->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        if(file_exists('uploads/product/'.$product->image)){
            unlink('uploads/product/'.$product->image);
        }
        if (!empty($product->images)) {
            $oldImages = explode(',', $product->images);
            foreach ($oldImages as $oldImage) {
                $oldImagePath = public_path('uploads/images/' . $oldImage);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
        }
        $product->delete();
        return redirect()->back();
    }   
}
