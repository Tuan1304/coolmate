<?php

namespace App\Http\Controllers;

use App\Mail\FHMail;
use App\Models\Category;
use App\Models\Children;
use App\Models\Collection;
use App\Models\Man;
use App\Models\order;
use App\Models\Product;
use App\Models\Statistic;
use App\Models\Women;
use App\Notifications\EmailNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

use function PHPUnit\Framework\isNull;

class IndexController extends Controller
{
    public function login(){

        return route('login');
    }
    public function timkiem(){
        if (isset($_GET['search'])) {
            $search = $_GET['search'];
            $category = Category::orderBy('id','DESC')->where('status',1)->get();
            $children = Children::orderBy('id','DESC')->get();
            $man = Man::orderBy('id','DESC')->get();
            $women = Women::orderBy('id','DESC')->get();
            $product = Product::where('title','like','%'.$search.'%')->orderBy('ngaycapnhat','DESC')->paginate(40);
            $products = Product::orderBy('ngaycapnhat','DESC')->get();
            $total_products = $product->count(); // Đếm số lượng sản phẩm

            return view('pages.search',compact('category','children','man','women','product','products','search','total_products'));
        } else {
            return redirect()->to('/');
        }
        
    }
    public function home(){
        $hot_product = Product::where('hot_product',1)->where('status',1)->orderBy('ngaycapnhat','DESC')->get();
        $category = Category::orderBy('id','DESC')->where('status',1)->get();
        $children = Children::orderBy('id','DESC')->get();
        $man = Man::orderBy('id','DESC')->get();
        $women = Women::orderBy('id','DESC')->get();
        $collection = Collection::orderBy('id','DESC')->where('status',1)->get();
        $category_home = Category::with('product')->orderBy('id','ASC')->where('status',1)->get();
        $products = Product::orderBy('ngaycapnhat','DESC')->get();

        return view('pages.home',compact('hot_product','products','category','children','man','women','category_home','collection'));
    }
    public function category($slug){
        $category = Category::orderBy('id','DESC')->where('status',1)->get();
        $children = Children::orderBy('id','DESC')->get();
        $man = Man::orderBy('id','DESC')->get();
        $women = Women::orderBy('id','DESC')->get();
        $collection = Collection::orderBy('id','DESC')->where('status',1)->get();
        $cate_slug = Category::where('slug',$slug)->first();
        $all_products = Product::orderBy('ngaycapnhat', 'DESC')->paginate(25);
        $products = Product::orderBy('ngaycapnhat','DESC')->get();

        if (isset($_GET['order']) || isset($_GET['man']) || isset($_GET['women']) || isset($_GET['color']) || isset($_GET['material'])) {
            // Các biến đã được truyền từ URL và tồn tại
            $product = Product::where('category_id',$cate_slug->id);

            if(isset($_GET['man'])) {
                $man_get = $_GET['man'];
                $product = $product->where('man_id','=',$man_get);
            } 
            if(isset($_GET['women'])) {
                $women_get = $_GET['women'];
                $product = $product->orWhere('women_id','=',$women_get);
            } 
            if(isset($_GET['color'])) {
                $color = $_GET['color'];
                $product = $product->Where('color','=',$color);
            } 
            if(isset($_GET['material'])) {
                $material = $_GET['material'];
                $product = $product->Where('material','=',$material);
            } 
            if(isset($_GET['order'])) {
                $sapxep = $_GET['order'];
                if(isset($_GET['order'])) {
                    $order = $_GET['order'];
                    
                    switch ($order) {
                        case 'name_a_z':
                            $product = $product->orderBy('title','ASC');
                            break;
                        case 'date':
                            $product = $product->orderBy('ngaytao','DESC');
                            break;
                        case 'watch_views':
                            $product = $product->orderBy('title','ASC');  
                            break;
                        default:
                            // Xử lý mặc định nếu giá trị order không hợp lệ
                            break;
                    }
                }
                
            }
            $product = $product->orderBy('ngaycapnhat','DESC')->paginate(25);
            $total_products = $product->count(); // Đếm số lượng sản phẩm
                
            return view('pages.category',compact('category','children','man','women','cate_slug','product','products','total_products','collection','all_products'))->with('i', (request()->input('page',1) -1) *5); 
    
        } else {
            $product = Product::where('category_id',$cate_slug->id)->orderBy('ngaycapnhat','DESC')->paginate(25);
            $total_products = $product->count(); // Đếm số lượng sản phẩm

            return view('pages.category',compact('category','children','man','women','cate_slug','product','products','total_products','collection','all_products'))->with('i', (request()->input('page',1) -1) *5); 
        }
        
    }
    public function collection($slug){
        $category = Category::orderBy('id','DESC')->where('status',1)->get();
        $children = Children::orderBy('id','DESC')->get();
        $man = Man::orderBy('id','DESC')->get();
        $women = Women::orderBy('id','DESC')->get();
        $collection = Collection::orderBy('id','DESC')->where('status',1)->get();
        $coll_slug = Collection::where('slug',$slug)->first();
        $product = Product::where('collection_id',$coll_slug->id)->orderBy('ngaycapnhat','DESC')->paginate(25);
        $products = Product::orderBy('ngaycapnhat','DESC')->get();
        $all_products = Product::orderBy('ngaycapnhat', 'DESC')->paginate(25);

        if (isset($_GET['order']) || isset($_GET['man']) || isset($_GET['women']) || isset($_GET['color']) || isset($_GET['material'])) {
            // Các biến đã được truyền từ URL và tồn tại
            $product = Product::where('category_id',$coll_slug->id);

            if(isset($_GET['man'])) {
                $man_get = $_GET['man'];
                $product = $product->where('man_id','=',$man_get);
            } 
            if(isset($_GET['women'])) {
                $women_get = $_GET['women'];
                $product = $product->orWhere('women_id','=',$women_get);
            } 
            if(isset($_GET['color'])) {
                $color = $_GET['color'];
                $product = $product->Where('color','=',$color);
            } 
            if(isset($_GET['material'])) {
                $material = $_GET['material'];
                $product = $product->Where('material','=',$material);
            } 
            if(isset($_GET['order'])) {
                $sapxep = $_GET['order'];
                if(isset($_GET['order'])) {
                    $order = $_GET['order'];
                    
                    switch ($order) {
                        case 'name_a_z':
                            $product = $product->orderBy('title','ASC');
                            break;
                        case 'date':
                            $product = $product->orderBy('ngaytao','DESC');
                            break;
                        case 'watch_views':
                            $product = $product->orderBy('title','ASC');  
                            break;
                        default:
                            // Xử lý mặc định nếu giá trị order không hợp lệ
                            break;
                    }
                }
                
            }
            $product = $product->orderBy('ngaycapnhat','DESC')->paginate(25);
            $total_products = $product->count(); // Đếm số lượng sản phẩm
            return view('pages.collection',compact('category','children','man','women','coll_slug','product','products','total_products','collection','all_products'))->with('i', (request()->input('page',1) -1) *5); 
    
        } else {
            $product = Product::where('collection_id',$coll_slug->id)->orderBy('ngaycapnhat','DESC')->paginate(25);
            $total_products = $product->count(); // Đếm số lượng sản phẩm

            return view('pages.collection',compact('category','children','man','women','coll_slug','product','products','total_products','collection','all_products'))->with('i', (request()->input('page',1) -1) *5); 
        }
        
    }
    public function allcollection(){
        $category = Category::orderBy('id','DESC')->where('status',1)->get();
        $children = Children::orderBy('id','DESC')->get();
        $man = Man::orderBy('id','DESC')->get();
        $women = Women::orderBy('id','DESC')->get();
        $collection = Collection::orderBy('id','DESC')->where('status',1)->get();
        $products = Product::orderBy('ngaycapnhat','DESC')->get();

        return view('pages.include.allcollection',compact('category','products','children','man','women','collection'));
    }
    public function man($slug){
        $hot_product = Product::where('hot_product',1)->where('status',1)->orderBy('ngaycapnhat','DESC')->get();
        $category = Category::orderBy('id','DESC')->where('status',1)->get();
        $children = Children::orderBy('id','DESC')->get();
        $man = Man::orderBy('id','ASC')->get();
        $women = Women::orderBy('id','DESC')->get();
        $collection = Collection::orderBy('id','DESC')->where('status',1)->get();
        $man_slug = Man::where('slug',$slug)->first();
        $product = Product::where('man_id',$man_slug->id)->orderBy('ngaycapnhat','DESC')->paginate(40);
        $products = Product::orderBy('ngaycapnhat','DESC')->get();
        $total_products = $product->count(); // Đếm số lượng sản phẩm
        // $total_products = $product->total(); // Số lượng sản phẩm trong trang

        return view('pages.man',compact('hot_product','category','children','man','women','man_slug','product','products','total_products','collection'));
    }
    public function allman(){
        $hot_product = Product::where('hot_product',1)->where('status',1)->orderBy('ngaycapnhat','DESC')->get();
        $category = Category::orderBy('id','DESC')->where('status',1)->get();
        $children = Children::orderBy('id','DESC')->get();
        $man = Man::orderBy('id','ASC')->get();
        $women = Women::orderBy('id','DESC')->get();
        $collection = Collection::orderBy('id','DESC')->where('status',1)->get();
        $product = Product::where('man_id', '!=', 0)->orderBy('ngaycapnhat','DESC')->paginate(25);
        $products = Product::orderBy('ngaycapnhat','DESC')->get();
        $total_products = $product->count(); // Đếm số lượng sản phẩm
        // $total_products = $product->total(); // Số lượng sản phẩm trong trang

        return view('pages.include.allman',compact('hot_product','category','children','man','women','product','products','total_products','collection'));
    }
    public function women($slug){
        $hot_product = Product::where('hot_product',1)->where('status',1)->orderBy('ngaycapnhat','DESC')->get();
        $category = Category::orderBy('id','DESC')->where('status',1)->get();
        $children = Children::orderBy('id','DESC')->get();
        $man = Man::orderBy('id','DESC')->get();
        $women = Women::orderBy('id','DESC')->get();
        $collection = Collection::orderBy('id','DESC')->where('status',1)->get();
        $women_slug = Women::where('slug',$slug)->first(); 
        $product = Product::where('women_id',$women_slug->id)->orderBy('ngaycapnhat','DESC')->paginate(40);
        $products = Product::orderBy('ngaycapnhat','DESC')->get();
        $total_products = $product->count(); // Đếm số lượng sản phẩm
        // $total_products = $product->total(); // Số lượng sản phẩm trong trang

        return view('pages.women',compact('hot_product','category','children','man','women','women_slug','product','products','total_products','collection'));
    }
    public function allwomen(){
        $hot_product = Product::where('hot_product',1)->where('status',1)->orderBy('ngaycapnhat','DESC')->get();
        $category = Category::orderBy('id','DESC')->where('status',1)->get();
        $children = Children::orderBy('id','DESC')->get();
        $man = Man::orderBy('id','ASC')->get();
        $women = Women::orderBy('id','ASC')->get();
        $collection = Collection::orderBy('id','DESC')->where('status',1)->get();
        $product = Product::where('women_id', '!=', 0)->orderBy('ngaycapnhat','DESC')->paginate(25);
        $products = Product::orderBy('ngaycapnhat','DESC')->get();
        $total_products = $product->count(); // Đếm số lượng sản phẩm
        // $total_products = $product->total(); // Số lượng sản phẩm trong trang

        return view('pages.include.allwomen',compact('hot_product','category','children','man','women','product','products','total_products','collection'));
    }
    public function children($slug){
        $hot_product = Product::where('hot_product',1)->where('status',1)->orderBy('ngaycapnhat','DESC')->get();
        $category = Category::orderBy('id','DESC')->where('status',1)->get();
        $children = Children::orderBy('id','DESC')->get();
        $man = Man::orderBy('id','DESC')->get();
        $women = Women::orderBy('id','DESC')->get();
        $collection = Collection::orderBy('id','DESC')->where('status',1)->get();
        $chil_slug = Children::where('slug',$slug)->first();
        $product = Product::where('children_id',$chil_slug->id)->orderBy('ngaycapnhat','DESC')->paginate(40);
        $products = Product::orderBy('ngaycapnhat','DESC')->get();
        $total_products = $product->count(); // Đếm số lượng sản phẩm
        // $total_products = $product->total(); // Số lượng sản phẩm trong trang

        return view('pages.children',compact('hot_product','category','children','man','women','chil_slug','product','products','total_products','collection'));
    }
    public function allChild(){
        $hot_product = Product::where('hot_product',1)->where('status',1)->orderBy('ngaycapnhat','DESC')->get();
        $category = Category::orderBy('id','DESC')->where('status',1)->get();
        $children = Children::orderBy('id','DESC')->get();
        $man = Man::orderBy('id','DESC')->get();
        $women = Women::orderBy('id','DESC')->get();
        $collection = Collection::orderBy('id','DESC')->where('status',1)->get();
        $product = Product::where('children_id', '!=', 0)->orderBy('ngaycapnhat','DESC')->paginate(3);
        $products = Product::orderBy('ngaycapnhat','DESC')->get();
        $total_products = $product->count(); // Đếm số lượng sản phẩm
        // $total_products = $product->total(); // Số lượng sản phẩm trong trang

        return view('pages.include.allchild',compact('hot_product','category','children','man','women','product','products','total_products','collection'));
    }
    public function product($slug){
        $category = Category::orderBy('id','DESC')->where('status',1)->get();
        $children = Children::orderBy('id','DESC')->get();
        $man = Man::orderBy('id','DESC')->get();
        $women = Women::orderBy('id','DESC')->get();
        $collection = Collection::orderBy('id','DESC')->where('status',1)->get();

        $product = Product::with('category','children','man','women')->where('slug',$slug)->where('status',1)->first();
        $products = Product::orderBy('ngaycapnhat','DESC')->get();
        $related = Product::with('category','children','man','women')->where('category_id',$product->category->id)->where('status',1)->orderby(DB::raw('RAND()'))->whereNotIn('slug',[$slug])->get();

        return view('pages.product',compact('category','children','man','women','product','products','related','collection'));
    }
    public function cart(){
        $category = Category::orderBy('id','DESC')->where('status',1)->get();
        $children = Children::orderBy('id','DESC')->get();
        $man = Man::orderBy('id','DESC')->get();
        $women = Women::orderBy('id','DESC')->get();
        $collection = Collection::orderBy('id','DESC')->where('status',1)->get();
        $products = Product::orderBy('ngaycapnhat','DESC')->get();
        $related = Product::where('status',1)->orderby(DB::raw('RAND()'))->get();
        $cart = Session::get('cart');

        if ($cart == null) {
            return view('pages.cart',compact('category','children','man','women','related','products','cart','collection'));
        } else {
            $product_id = array_keys($cart);
            $product = Product::whereIn('id',$product_id)->get();
            return view('pages.cart',compact('category','children','man','women','product','products','related','cart','collection'));
        }
        
    }

    public function cart_add(Request $request)
    {
        // Lấy thông tin sản phẩm từ request
        $product_id = $request->product_id;
        $product_qty = $request->product_qty;
        $product_size = $request->product_size;

        // Lấy giỏ hàng từ session hoặc khởi tạo một mảng trống nếu chưa có
        $cart = session()->get('cart', []);

        // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
        if (isset($cart[$product_id])) {
            // Nếu tồn tại, cập nhật số lượng sản phẩm
            $cart[$product_id]['quantity'] += $product_qty;
        } else {
            // Nếu chưa tồn tại, thêm sản phẩm mới vào giỏ hàng
            $cart[$product_id] = [
                'quantity' => $product_qty,
                'size' => $product_size
            ];
        }

        // Lưu giỏ hàng vào session
        session()->put('cart', $cart);

        // Chuyển hướng về trang giỏ hàng
        return redirect()->route('cart');
    }


    
    public function cart_delete(Request $request){
        $cart = Session::get('cart');
        $product_id = $request->id;
        unset($cart[$product_id]);
        Session::put('cart',$cart);
        return redirect()->route('cart');
    }
    // public function cart_update(Request $request){
    //     $cart = $request -> product_id;
    //     Session::put('cart',$cart);
    //     return redirect()->route('cart');
    // }
    public function cart_update(Request $request)
    {
        $cart = Session::get('cart', []);

        foreach ($request->product_id as $product_id => $quantity) {
            $size = $request->product_size[$product_id];
            if (isset($cart[$product_id])) {
                // Kiểm tra nếu số lượng mới lớn hơn 0 thì cập nhật lại số lượng
                if ($quantity > 0) {
                    $cart[$product_id]['quantity'] = $quantity;
                    // Cập nhật size
                    $cart[$product_id]['size'] = $size;
                } else {
                    // Nếu số lượng mới là 0 hoặc âm, loại bỏ sản phẩm khỏi giỏ hàng
                    unset($cart[$product_id]);
                }
            }
        }

        Session::put('cart', $cart);

        return redirect()->route('cart');
    }


    // public function order(Request $request){
    //     $category = Category::orderBy('id','DESC')->where('status',1)->get();
    //     $children = Children::orderBy('id','DESC')->get();
    //     $man = Man::orderBy('id','DESC')->get();
    //     $women = Women::orderBy('id','DESC')->get();
    //     $collection = Collection::orderBy('id','DESC')->where('status',1)->get();
    //     $related = Product::where('status',1)->orderby(DB::raw('RAND()'))->get();
    //     $cart = Session::get('cart');
        
    //     $token = Str::random(12);
    //     $order = new order();
    //     $order -> name = $request -> input('name');
    //     $order -> phone = $request -> input('phone');
    //     $order -> email = $request -> input('email');
    //     $order -> city = $request -> input('city');
    //     $order -> district = $request -> input('district');
    //     $order -> ward = $request -> input('ward');
    //     $order -> address = $request -> input('address');
    //     $order -> note = $request -> input('note');
    //     $order -> order_date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
    //     $order_detail = $request->input('product_id'); // Không cần chuyển đổi thành chuỗi JSON
    //     if (is_string($order_detail)) {
    //         $order_detail = json_decode($order_detail, true);
    //     }
    //     // $order_detail = json_decode($request->input('product_id'), true);
    //     $order->order_detail = json_encode($order_detail);
    //     $order -> token = $token;
    //     $order -> save();

    //     $mailInfor = $order -> email;
    //     $idInfor = $order -> id;
    //     $tokenInfor = $order -> token;
    //     $nameInfor = $order -> name;
    //     $phoneInfor =  $order -> phone;
    //     $addressInfor = $order -> address;
    //     $noteInfor = $order -> note;
    //     $detailInfor = $order->order_detail;
    //     // $ortailInfor = $order->order_detail;
    //     // $order_detail = json_decode($request->order_detail ,true);
    //     $product_id = array_keys($order_detail);
    //     $product = Product::whereIn('id',$product_id)->get();
       
    //     $Mail = Mail::to($mailInfor)->send(new FHMail($nameInfor,$phoneInfor,$mailInfor,$addressInfor,$noteInfor,$detailInfor,$product,$idInfor,$tokenInfor));

    //     Notification::send($order, new EmailNotification($order));
    //     //Xóa giỏ hàng cũ

    //     $product_ids = array_keys($cart);
    //     if ($cart) {
    //         $product_ids = array_keys($cart);
            
    //         // Xóa các sản phẩm khỏi session giỏ hàng 
    //         foreach ($product_ids as $product_id) {
    //             unset($cart[$product_id]);
    //         }

    //         // Lưu session giỏ hàng mới sau khi xóa
    //         Session::put('cart', $cart);
    //     }

    //     return view('pages.order.comfirm',compact('category','children','man','women','related','cart','collection','order'));
    // }

    public function order(Request $request) {
        $category = Category::orderBy('id', 'DESC')->where('status', 1)->get();
        $children = Children::orderBy('id', 'DESC')->get();
        $man = Man::orderBy('id', 'DESC')->get();
        $women = Women::orderBy('id', 'DESC')->get();
        $collection = Collection::orderBy('id', 'DESC')->where('status', 1)->get();
        $related = Product::where('status', 1)->orderby(DB::raw('RAND()'))->get();
        $cart = Session::get('cart');
    
        $token = Str::random(12);
        $order = new Order();
        $order->name = $request->input('name');
        $order->phone = $request->input('phone');
        $order->email = $request->input('email');
        $order->city = $request->input('city');
        $order->district = $request->input('district');
        $order->ward = $request->input('ward');
        $order->address = $request->input('address');
        $order->note = $request->input('note');
        $order->order_date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        
        $order_detail = $request->input('product_id');
        if (is_string($order_detail)) {
            $order_detail = json_decode($order_detail, true);
        }
        $order->order_detail = json_encode($order_detail);
        $order->token = $token;
        $order->save();
    
        $mailInfor = $order->email;
        $idInfor = $order->id;
        $tokenInfor = $order->token;
        $nameInfor = $order->name;
        $phoneInfor = $order->phone;
        $addressInfor = $order->address;
        $noteInfor = $order->note;
        $detailInfor = json_decode($order->order_detail, true); // Giải mã JSON
        
        $product_id = array_keys($detailInfor);
        $product = Product::whereIn('id', $product_id)->get();
    
        // Chuyển đổi detailInfor thành JSON và mã hóa URL
        $detailInforJson = json_encode($detailInfor);
        $encodedDetailInfor = urlencode($detailInforJson);
    
        Mail::to($mailInfor)->send(new FHMail($nameInfor, $encodedDetailInfor, $phoneInfor, $mailInfor, $addressInfor, $noteInfor, $detailInfor, $product, $idInfor, $tokenInfor));
    
        Notification::send($order, new EmailNotification($order));
    
        if ($cart) {
            $product_ids = array_keys($cart);
            
            foreach ($product_ids as $product_id) {
                unset($cart[$product_id]);
            }
            
            Session::put('cart', $cart);
        }
    
        return view('pages.order.comfirm', compact('category', 'children', 'man', 'women', 'related', 'cart', 'collection', 'order'));
    }
    
    


    public function accept_order(order $order, $token, Request $request){
        if ($order->token === $token) {
            // Lấy dữ liệu từ request
            $data = $request->all();

            $category = Category::orderBy('id','DESC')->where('status',1)->get();
            $children = Children::orderBy('id','DESC')->get();
            $man = Man::orderBy('id','DESC')->get();
            $women = Women::orderBy('id','DESC')->get();
            $collection = Collection::orderBy('id','DESC')->where('status',1)->get();
            $related = Product::where('status',1)->orderby(DB::raw('RAND()'))->get();
            $cart = Session::get('cart');

            // Cập nhật trạng thái đơn hàng
            $order->status = 1;
            $order->save();

            $order_date = $order->order_date;
            // $order_date = Carbon::parse($order->order_date)->toDateString();
            // $statistic = Statistic::firstOrCreate(
            //     ['order_date' => $order_date], // Điều kiện tìm kiếm để xác định bản ghi tồn tại
            //     ['sales' => 0, 'profit' => 0, 'quantity' => 0, 'total_order' => 0] // Giá trị mặc định cho các cột
            // );
            $statistic = Statistic::where('order_date',$order_date)->get();

            if($statistic){
                $statistic_count = $statistic->count();
            } else {
                $statistic_count = 0;
            }
            
            if($order->status == 1){
                // Tính toán thông tin đơn hàng
                $total_order = 0;
                $sales = 0;
                $profit = 0;
                $quantity = 0;

                // Lấy danh sách id sản phẩm từ order_detail
                $order_detail = json_decode($request->order_detail, true);
                $product_ids = array_keys($order_detail);

                $product = Product::whereIn('id',$product_ids)->get();
                // $total_order += 1;
                // $quantity += $order_detail[$product->id];
                // $sales += $product -> price*$order_detail[$product->id];
                // $profit += $sales - 1000;
                foreach($product as $key=>$pro){
                    $total_order += 1;
                    $quantity += $order_detail[$pro->id];
                    $sales += $pro -> price*$order_detail[$pro->id];
                    $profit += $sales - $pro->cost;
                }
            
                if($statistic_count>0){
                    $statistic_update = Statistic::where('order_date',$order_date)->first();
                    $statistic_update->sales = $statistic_update->sales + $sales;
                    $statistic_update->profit = $statistic_update->profit + $profit;
                    $statistic_update->quantity = $statistic_update->quantity + $quantity;
                    $statistic_update->total_order = $statistic_update->total_order + $total_order;
                    $statistic_update->save();
                } else {
                    $statistic_new = new Statistic();
                    $statistic_new->order_date = $order_date;
                    $statistic_new->sales = $sales;
                    $statistic_new->profit = $profit;
                    $statistic_new->quantity = $quantity;
                    $statistic_new->total_order = $total_order;
                    $statistic_new->save();
                }

            }

            // Trả về view thành công với các dữ liệu cần thiết
            return view('pages.order.success', compact('category','children','man','women','related','cart', 'order', 'sales', 'quantity', 'total_order'));
        } else {
            // Trả về thông báo lỗi nếu mã đơn hàng không hợp lệ
            return 'Mã đơn hàng không hợp lệ';
        }
    }


    public function thong_ke(){
        return view('admincp.statistic.form');
    }

    public function filter_by_date(Request $request){
        $data = $request->all();
        $form_date = $data['form_date'];
        $to_date = $data['to_date'];

        $get = Statistic::whereBetween('order_date',[$form_date,$to_date])->orderBy('order_date','ASC')->get();
        foreach($get as $key => $val){
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity
            );
        }
        echo $data = json_encode($chart_data);
        // return json_encode($chart_data);
    }

    public function dashboard_filter(Request $request){
        $data = $request->all();

        $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $dau_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $cuoi_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();

        $sub7days = Carbon::now('Asia/Ho_Chi_Minh')->subDays(7)->toDateString();
        $sub365days = Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->toDateString();

        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString(); 

        if($data['dashboard_value'] == '7ngay'){
            $get = Statistic::whereBetween('order_date',[$sub7days,$now])->orderBy('order_date','ASC')->get();
        } elseif($data['dashboard_value'] == 'thangtruoc'){
            $get = Statistic::whereBetween('order_date',[$dau_thangtruoc,$cuoi_thangtruoc])->orderBy('order_date','ASC')->get();
        } elseif($data['dashboard_value'] == 'thangnay'){
            $get = Statistic::whereBetween('order_date',[$dauthangnay,$now])->orderBy('order_date','ASC')->get();
        } elseif($data['dashboard_value'] == '365ngayqua'){
            $get = Statistic::whereBetween('order_date',[$sub365days,$now])->orderBy('order_date','ASC')->get();
        }
        
        foreach($get as $key => $val){
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity
            );
        }

        echo $data = json_encode($chart_data);
    }

    public function days_order(){
        $sub30days = Carbon::now('Asia/Ho_Chi_Minh')->subDays(30)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $get = Statistic::whereBetween('order_date',[$sub30days,$now])->orderBy('order_date','ASC')->get();

        foreach($get as $key => $val){
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity
            );
        }

        echo $data = json_encode($chart_data);
    }
}
