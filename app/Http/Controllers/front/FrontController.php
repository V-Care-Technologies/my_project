<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeBanner;
use App\Models\Product;
use App\Models\Testimonial;
use App\Models\Blog;
use App\Models\SiteSettings;
use App\Models\Partners;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\OrderDetail;
use App\Models\CustomerReviews;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Stripe;
use PDF;
use App\Models\User;
use Mail;
use App\Mail\SubscribeMail;
use App\Mail\ContactMail;
use App\Mail\OrderMail;


class FrontController extends Controller
{
    public function index(Request $request)
    {
        $result['home_categories'] = DB::table('categories')
            ->where('status','=','0')
            ->where('is_home','=','1')
            ->get();



        foreach ($result['home_categories'] as $list) {

            $result['home_categories_product'][$list->id] =Product::where('status','=','0')->where(['category_id' => $list->id])->get();


            foreach ($result['home_categories_product'][$list->id] as $list1) {;
                $result['home_product_attr'][$list1->id] =
                    DB::table('product_attrs')
                        ->leftJoin('sizes', 'sizes.id', '=', 'product_attrs.size_id')
                        ->leftJoin('colors', 'colors.id', '=', 'product_attrs.color_id')
                        ->where(['product_attrs.products_id' => $list1->id])
                        ->get();
                        // dd($result['home_product_attr'][$list1->id]);



            }
        }
        // dd("sd");
        $result['home_banner'] = HomeBanner::where(['status' => 1])->get();
        DB::enableQueryLog();

        $result['home_featured_product'] = Product::rightJoin('product_lables', 'product_lables.product_id', '=', 'products.id')->rightJoin('product_attrs', 'product_attrs.products_id', '=', 'products.id')->select('products.*', 'product_lables.label_id', 'product_attrs.mrp as mrp', 'product_attrs.price as price', 'product_attrs.size_id as size_id', 'product_attrs.color_id as color_id')->where('product_lables.label_id', '=', '1')->where('products.status','=', '0')
            ->groupBy('product_attrs.products_id')->get();
         //dd(DB::getQueryLog());


        $result['top_offers_product'] = Product::rightJoin('product_lables', 'product_lables.product_id', '=', 'products.id')->rightJoin('product_attrs', 'product_attrs.products_id', '=', 'products.id')->select('products.*', 'product_lables.label_id', 'product_attrs.mrp as mrp', 'product_attrs.price as price', 'product_attrs.size_id as size_id', 'product_attrs.color_id as color_id')->where('product_lables.label_id', '=', '2')->where('products.status','=', '0')
            ->groupBy('product_attrs.products_id')->get();

        $result['new_arrivals_product'] = Product::rightJoin('product_lables', 'product_lables.product_id', '=', 'products.id')->rightJoin('product_attrs', 'product_attrs.products_id', '=', 'products.id')->select('products.*', 'product_lables.label_id', 'product_attrs.mrp as mrp', 'product_attrs.price as price', 'product_attrs.size_id as size_id', 'product_attrs.color_id as color_id')->where('product_lables.label_id', '=', '3')->where('products.status','=', '0')
            ->groupBy('product_attrs.products_id')->get();

        $result['testimonials'] = Testimonial::where('status', '=', '0')->get();

        $result['blog'] = Blog::where('status', '=', '0')->get();

        // $result['home_cat'] = DB::table('categories')
        //     ->where('status','=','0')
        // ->where('is_home','=','1')
        //     ->get();


         $result['home_cate'] = DB::table('categories')
            ->where('status','=','0')
            ->where('is_home','=','1')
            ->where('parent_category_id','=','0')
            ->get();

       $result['settings'] = SiteSettings::where('id', '=', '1')->get();
       $result['partners'] = Partners::all();

        return view('front.index', $result);
    }

    public function loginRegister(Request $request)
    {
        if ($request->session()->has('FRONT_USER_LOGIN') != null) {
            return redirect('/');
        }

        $result = [];
        return view('front.login_register', $result);
    }

    public function registration_process(Request $request)
    {

        $valid = Validator::make($request->all(), [
            "name" => 'required',
            "email" => 'required|email|unique:users,email',
            "password" => 'required|min:6',
        ]);

        if (!$valid->passes()) {
            return response()->json(['status' => 'error', 'error' => $valid->errors()->toArray(),'message'=>$valid->errors()->first()]);
        } else {
            $rand_id = rand(111111111, 999999999);
            $arr = [
                "name" => $request->name,
                "last_name" => $request->last_name,
                "email" => $request->email,
                "password" => Hash::make($request->password),
                "mobile" => $request->mobile,
                "status" => 1,
                "is_verify" => 0,
                "rand_id" => $rand_id,
                "created_at" => date('Y-m-d h:i:s'),
                "updated_at" => date('Y-m-d h:i:s')
            ];
            $query = DB::table('users')->insert($arr);

            // $request->session()->put('FRONT_USER_LOGIN', true);
            // $request->session()->put('FRONT_USER_ID',$query->id);
            if ($query) {

                // $data=['name'=>$request->name,'rand_id'=>$rand_id];
                // $user['to']=$request->email;
                // Mail::send('front/email_verification',$data,function($messages) use ($user){
                //     $messages->to($user['to']);
                //     $messages->subject('Email Id Verification');
                // });

                return response()->json(['status' => 'success', 'msg' => "Registration successfully. Please check your email id for verification"]);
            }

        }
    }

    public function login_process(Request $request)
    {

        $result = DB::table('users')
            ->where(['email' => $request->str_login_email])
            ->get();

        if (isset($result[0])) {
            $db_pwd = Hash::check($request->str_login_password, $result[0]->password);
            $status = $result[0]->status;
            $is_verify = $result[0]->is_verify;

            // if($is_verify==0){
            //     return response()->json(['status'=>"error",'msg'=>'Please verify your email id']);
            // }
            if ($status == 1) {
                return response()->json(['status' => "error", 'msg' => 'Your account has been deactivated']);
            }

            if ($db_pwd == $request->str_login_password) {

                if ($request->rememberme === null) {
                    setcookie('login_email', $request->str_login_email, 100);
                    setcookie('login_pwd', $request->str_login_password, 100);
                } else {
                    setcookie('login_email', $request->str_login_email, time() + 60 * 60 * 24 * 100);
                    setcookie('login_pwd', $request->str_login_password, time() + 60 * 60 * 24 * 100);
                }

                $request->session()->put('FRONT_USER_LOGIN', true);
                $request->session()->put('FRONT_USER_ID', $result[0]->id);
                $request->session()->put('FRONT_USER_NAME', $result[0]->name);
                $status = "success";
                $msg = "";

                $getUserTempId = getUserTempId();
                DB::table('cart')
                    ->where(['user_id' => $getUserTempId, 'user_type' => 'Not-Reg'])
                    ->update(['user_id' => $result[0]->id, 'user_type' => 'Reg']);

                // Check if there is a pending wishlist item
                if ($request->session()->has('PENDING_WISHLIST_PRODUCT')) {
                    // Retrieve the pending wishlist product ID
                    $product_id = $request->session()->get('PENDING_WISHLIST_PRODUCT');

                    // Add the product to the wishlist
                    $uid = $result[0]->id;
                    $result = DB::table('product_attrs')
                        ->select('product_attrs.id')
                        ->where(['products_id' => $product_id])
                        ->get();
                    $product_attr_id = $result[0]->id;

                    $check = DB::table('wish_lists')
                        ->where([
                            'user_id' => $uid,
                            'product_id' => $product_id,
                            'product_attr_id' => $product_attr_id
                        ])
                        ->get();

                    if (!isset($check[0])) {
                        $id = DB::table('wish_lists')->insertGetId([
                            'user_id' => $uid,
                            'product_id' => $product_id,
                            'product_attr_id' => $product_attr_id,
                            'added_on' => date('Y-m-d h:i:s')
                        ]);
                    }

                    // Remove the pending wishlist product from session
                    $request->session()->forget('PENDING_WISHLIST_PRODUCT');
                }

            } else {
                $status = "error";
                $msg = "Please enter valid password";
            }
        } else {
            $status = "error";
            $msg = "Please enter valid email id";
        }
        return response()->json(['status' => $status, 'msg' => $msg]);
        //$request->password
    }

    public function product(Request $request, $slug)
    {
        $result['product'] =
            DB::table('products')
                ->where(['status' => '0'])
                ->where(['alias' => $slug])
                ->get();

        foreach ($result['product'] as $list1) {
            $result['product_attr'][$list1->id] =
                DB::table('product_attrs')
                    ->leftJoin('sizes', 'sizes.id', '=', 'product_attrs.size_id')
                    ->leftJoin('colors', 'colors.id', '=', 'product_attrs.color_id')
                    ->select('product_attrs.*', 'sizes.size as size', 'colors.color as color')
                    ->where(['product_attrs.products_id' => $list1->id])
                    ->get();
        }

        // foreach($result['product'] as $list1){
        //     $result['product_images'][$list1->id]=
        //         DB::table('product_images')
        //         ->where(['product_images.products_id'=>$list1->id])
        //         ->get();
        // }
        $result['related_product'] =
            DB::table('products')
                ->where(['status' => '0'])
                ->where('alias', '!=', $slug)
                ->where(['category_id' => $result['product'][0]->category_id])
                ->inRandomOrder()
                ->get();

        foreach ($result['related_product'] as $list1) {
            $result['related_product_attr'][$list1->id] =
                DB::table('product_attrs')
                    ->leftJoin('sizes', 'sizes.id', '=', 'product_attrs.size_id')
                    ->leftJoin('colors', 'colors.id', '=', 'product_attrs.color_id')
                    ->where(['product_attrs.products_id' => $list1->id])
                    ->get();
        }


        $result['product_review']= CustomerReviews::where(['product_id' => $result['product'][0]->id])->get();
        //prx($result['product_review']);

        return view('front.product', $result);
    }

    public function add_to_cart(Request $request)
    {
        //($request->all());
        if ($request->session()->has('FRONT_USER_LOGIN')) {
            $uid = $request->session()->get('FRONT_USER_ID');

            $user_type = "Reg";
        } else {
            $uid = getUserTempId();
            $user_type = "Not-Reg";
        }

        //$size_id = $request->post('size_id');
        $color_id = $request->post('color_id');
        $pqty = $request->post('pqty');
        $product_id = $request->post('product_id');

        // if ($pqty < 1) {
        //         return response()->json(['msg' => "qty_less_than_one", 'data' => "Please select atleast 1 qty"]);
        //     }

        $result = DB::table('product_attrs')
            ->select('product_attrs.id')
            //->leftJoin('sizes', 'sizes.id', '=', 'product_attrs.size_id')
            ->leftJoin('colors', 'colors.id', '=', 'product_attrs.color_id')
            ->where(['products_id' => $product_id])
            //->where(['sizes.size' => $size_id])
            ->where(['colors.color' => $color_id])
            ->get();
        $product_attr_id = $result[0]->id;

        $resultCheck = DB::table('order_details')
            ->where(['order_details.product_id' => $product_id])
            ->where(['order_details.products_attr_id' => $product_attr_id])
            ->get();

        // dd($resultCheck);



        $getAvaliableQty = getAvaliableQty($product_id, $product_attr_id);
        if (count($getAvaliableQty) > 0) {

            $finalAvaliable = $getAvaliableQty[0]->pqty - $getAvaliableQty[0]->qty;
            if ($pqty > $finalAvaliable) {
                return response()->json(['msg' => "not_avaliable", 'data' => "Only $finalAvaliable left"]);
            }
        }
        else{
            $getqtyprod=DB::table('product_attrs')
            ->where(['products_id'=>$product_id])
            ->where(['id'=>$product_attr_id])
            ->select('qty')
            ->get();

            if(isset($getqtyprod[0])){
                $qty = $getqtyprod[0]->qty;
                if($pqty > $qty){
                    return response()->json(['msg' => "not_avaliable", 'data' => "Only $qty Qty left"]);
                }
            }
        }



        $check = DB::table('cart')
            ->where(['user_id' => $uid])
            ->where(['user_type' => $user_type])
            ->where(['product_id' => $product_id])
            ->where(['product_attr_id' => $product_attr_id])
            ->get();

        if (isset($check[0])) {
            $update_id = $check[0]->id;
            if ($pqty == 0) {
                DB::table('cart')
                    ->where(['id' => $update_id])
                    ->delete();
                $msg = "removed";

            } else {
                DB::table('cart')
                    ->where(['id' => $update_id])
                    ->update(['qty' => $pqty]);
                $msg = "updated";
            }

        } else {

            $id = DB::table('cart')->insertGetId([
                'user_id' => $uid,
                'user_type' => $user_type,
                'product_id' => $product_id,
                'product_attr_id' => $product_attr_id,
                'qty' => $pqty,
                'added_on' => date('Y-m-d h:i:s')
            ]);
            $msg = "added";
        }
        $result = DB::table('cart')
            ->leftJoin('products', 'products.id', '=', 'cart.product_id')
            ->leftJoin('product_attrs', 'product_attrs.id', '=', 'cart.product_attr_id')
            //->leftJoin('sizes', 'sizes.id', '=', 'product_attrs.size_id')
            ->leftJoin('colors', 'colors.id', '=', 'product_attrs.color_id')
            ->where(['user_id' => $uid])
            ->where(['user_type' => $user_type])
            ->select('cart.qty', 'products.title', 'products.image', 'colors.color', 'product_attrs.price', 'products.alias', 'products.id as pid', 'product_attrs.id as attr_id')
            ->get();

        return response()->json(['msg' => $msg, 'data' => $result, 'totalItem' => count($result)]);
    }

     public function search(Request $request,$searchh='')
    {
        $sort = "";
        $sort_txt = "";
        $filter_price_start = "";
        $filter_price_end = "";
        $color_filter = "";
        $colorFilterArr = [];
        $filter_price_start = $request->input('filter_price_start', '');
        $filter_price_end = $request->input('filter_price_end', '');

        if ($request->get('sort') !== null) {
            $sort = $request->get('sort');
        }

        $search = $request['search'] ?? "";
        if(empty($search)){
            $search = $searchh;
        }

        $query = DB::table('products');
            $query = $query->leftJoin('categories', 'categories.id', '=', 'products.category_id');
            $query = $query->leftJoin('product_attrs', 'products.id', '=', 'product_attrs.products_id');
            $query = $query->where(['products.status' => '0']);
            $query = $query->where('categories.category_name','LIKE',"%$search%");
            $query = $query->orWhere('products.title','LIKE',"%$search%");

        if ($sort == 'name') {
            $query = $query->orderBy('products.title', 'asc');
            $sort_txt = "Product Name";
        }
        if ($sort == 'date') {
            $query = $query->orderBy('products.id', 'desc');
            $sort_txt = "Date";
        }
        if ($sort == 'price_desc') {
            $query = $query->orderBy('product_attrs.price', 'desc');
            $sort_txt = "Price - DESC";
        }
        if ($sort == 'price_asc') {
            $query = $query->orderBy('product_attrs.price', 'asc');
            $sort_txt = "Price - ASC";
        }

        if ($request->get('filter_price_start') !== null && $request->get('filter_price_end') !== null) {
            $filter_price_start = $request->get('filter_price_start');
            $filter_price_end = $request->get('filter_price_end');

            if ($filter_price_start > 0 && $filter_price_end > 0) {
                $query = $query->whereBetween('product_attrs.price', [$filter_price_start, $filter_price_end]);
            }
        }

        if ($request->get('color_filter') !== null) {
            $color_filter = $request->get('color_filter');
            $colorFilterArr = explode(":", $color_filter);
            $colorFilterArr = array_filter($colorFilterArr);

            $query = $query->where(['product_attrs.color_id' => $request->get('color_filter')]);

        }

        if ($filter_price_start != '' && $filter_price_end != '') {
            // Apply the price filter if both min and max values are provided
            $query = $query->whereBetween('product_attrs.price', [$filter_price_start, $filter_price_end]);
        }

        $query = $query->distinct()->select('products.*');
        $query = $query->get();
        $result['product'] = $query;

        foreach ($result['product'] as $list1) {

            $query1 = DB::table('product_attrs');
            $query1 = $query1->leftJoin('sizes', 'sizes.id', '=', 'product_attrs.size_id');
            $query1 = $query1->leftJoin('colors', 'colors.id', '=', 'product_attrs.color_id');
            $query1 = $query1->where(['product_attrs.products_id' => $list1->id]);
            $query1 = $query1->get();
            $result['product_attr'][$list1->id] = $query1;
        }

        $result['colors'] = DB::table('colors')
            ->where(['status' => 1])
            ->get();


        $result['categories_left'] = DB::table('categories')
            ->where(['status' => 1])
            ->get();

        $result['related_product'] =
            DB::table('products')
                ->where(['status' => '0'])
                ->where(['category_id' => @$result['product'][0]->category_id])
                ->inRandomOrder()
                ->limit('3')
                ->get();
        foreach ($result['related_product'] as $list1) {
            $result['related_product_attr'][$list1->id] =
                DB::table('product_attrs')
                    ->leftJoin('sizes', 'sizes.id', '=', 'product_attrs.size_id')
                    ->leftJoin('colors', 'colors.id', '=', 'product_attrs.color_id')
                    ->where(['product_attrs.products_id' => $list1->id])
                    ->get();
        }

        $result['search'] = $search;
        $result['slug'] = '';
        $result['sort'] = $sort;
        $result['sort_txt'] = $sort_txt;
        $result['filter_price_start'] = $filter_price_start;
        $result['filter_price_end'] = $filter_price_end;
        $result['color_filter'] = $color_filter;
        $result['colorFilterArr'] = $colorFilterArr;
        return view('front.search', $result);
    }

    public function category(Request $request, $slug)
    {
        $sort = "";
        $sort_txt = "";
        $filter_price_start = "";
        $filter_price_end = "";
        $color_filter = "";
        $colorFilterArr = [];
        $filter_price_start = $request->input('filter_price_start', '');
        $filter_price_end = $request->input('filter_price_end', '');

        if ($request->get('sort') !== null) {
            $sort = $request->get('sort');
        }
// DB::enableQueryLog();
        $query = DB::table('products');
        $query = $query->select('products.*','product_attrs.color_image as color_image');
         $query = $query->leftJoin('product_categories', 'products.id', '=', 'product_categories.product_id');
        $query = $query->leftJoin('categories', 'categories.id', '=', 'product_categories.category_id');

        $query = $query->leftJoin('product_attrs', 'products.id', '=', 'product_attrs.products_id');
        $query = $query->where(['products.status' => '1']);
        $query = $query->where(['categories.category_slug' => $slug]);

        // if ($sort == 'name') {
        //     $query = $query->orderBy('products.title', 'asc');
        //     $sort_txt = "Product Name";
        // }
        if ($sort == 'name') {
            $query = $query->orderBy('products.id', 'desc');
            $sort_txt = "Product Name";
        }
        if ($sort == 'date') {
            $query = $query->orderBy('products.id', 'desc');
            $sort_txt = "Date";
        }
        if ($sort == 'price_desc') {
            $query = $query->orderBy('product_attrs.price', 'desc');
            $sort_txt = "Price - DESC";
        }
        if ($sort == 'price_asc') {
            $query = $query->orderBy('product_attrs.price', 'asc');
            $sort_txt = "Price - ASC";
        }

        if ($request->get('filter_price_start') !== null && $request->get('filter_price_end') !== null) {
            $filter_price_start = $request->get('filter_price_start');
            $filter_price_end = $request->get('filter_price_end');

            if ($filter_price_start > 0 && $filter_price_end > 0) {
                $query = $query->whereBetween('product_attrs.price', [$filter_price_start, $filter_price_end]);
            }
        }

        if ($request->get('color_filter') !== null) {
            $color_filter = $request->get('color_filter');
            $colorFilterArr = explode(":", $color_filter);
            $colorFilterArr = array_filter($colorFilterArr);

            $query = $query->where(['product_attrs.color_id' => $request->get('color_filter')]);

        }

        if ($filter_price_start != '' && $filter_price_end != '') {
            // Apply the price filter if both min and max values are provided
            $query = $query->whereBetween('product_attrs.price', [$filter_price_start, $filter_price_end]);
        }

        $query = $query->distinct()->select('products.*');
        $query = $query->get();
        $result['product'] = $query;



        foreach ($result['product'] as $list1) {

            $query1 = DB::table('product_attrs');
             $query1 = $query1->select('product_attrs.*');
            $query1 = $query1->leftJoin('sizes', 'sizes.id', '=', 'product_attrs.size_id');
            $query1 = $query1->leftJoin('colors', 'colors.id', '=', 'product_attrs.color_id');
            $query1 = $query1->where(['product_attrs.products_id' => $list1->id]);
            $query1 = $query1->get();
            $result['product_attr'][$list1->id] = $query1;
        }


        $result['colors'] = DB::table('colors')
            ->where(['status' => '0'])
            ->get();


        $result['categories_left'] = DB::table('categories')
            ->where(['status' => '0'])
            ->get();

        $result['pagetitle'] = DB::table('categories')
            ->where(['category_slug' => $slug])
            ->first();

        $result['slug'] = $slug;
        $result['sort'] = $sort;
        $result['sort_txt'] = $sort_txt;
        $result['filter_price_start'] = $filter_price_start;
        $result['filter_price_end'] = $filter_price_end;
        $result['color_filter'] = $color_filter;
        $result['colorFilterArr'] = $colorFilterArr;
        return view('front.category', $result);
    }

    public function cart(Request $request)
    {
        if ($request->session()->has('FRONT_USER_LOGIN')) {
            $uid = $request->session()->get('FRONT_USER_ID');
            $user_type = "Reg";
        } else {
            $uid = getUserTempId();
            $user_type = "Not-Reg";
        }
        $result['list'] = DB::table('cart')
            ->leftJoin('products', 'products.id', '=', 'cart.product_id')
            ->leftJoin('product_attrs', 'product_attrs.id', '=', 'cart.product_attr_id')
            ->leftJoin('sizes', 'sizes.id', '=', 'product_attrs.size_id')
            ->leftJoin('colors', 'colors.id', '=', 'product_attrs.color_id')
            ->where(['user_id' => $uid])
            ->where(['user_type' => $user_type])
            ->select('cart.qty', 'products.title', 'product_attrs.color_image as image', 'sizes.size', 'colors.color', 'product_attrs.price', 'product_attrs.mrp', 'products.alias', 'products.id as pid', 'product_attrs.id as attr_id')
            ->get();
        return view('front.cart', $result);
    }

    public function checkout(Request $request)
    {
        $result['cart_data'] = getAddToCartTotalItem();

        if (isset($result['cart_data'][0])) {

              $result['cities'] = DB::table('cities')
                    ->where('is_deleted','=','0')
                    ->orderby('id','ASC')
                    ->get();

            if ($request->session()->has('FRONT_USER_LOGIN')) {
                $uid = $request->session()->get('FRONT_USER_ID');
                $customer_info = DB::table('users')
                    ->where(['id' => $uid])
                    ->get();

                $result['customers']['name'] = $customer_info[0]->name;
                $result['customers']['last_name'] = $customer_info[0]->last_name;
                $result['customers']['email'] = $customer_info[0]->email;
                $result['customers']['mobile'] = $customer_info[0]->mobile;
                $result['customers']['address'] = $customer_info[0]->address;
                $result['customers']['country'] = 'UAE';
                $result['customers']['state'] = $customer_info[0]->state;
                $result['customers']['city'] = $customer_info[0]->city;
                $result['customers']['area'] = $customer_info[0]->area;
                $result['customers']['zip'] = $customer_info[0]->zip;
            } else {

                $result['customers']['name'] = '';
                $result['customers']['last_name'] = '';
                $result['customers']['email'] = '';
                $result['customers']['mobile'] = '';
                $result['customers']['address'] = '';
                $result['customers']['country'] = 'UAE';
                $result['customers']['state'] = '';
                $result['customers']['city'] = '';
                $result['customers']['area'] = '';
                $result['customers']['zip'] = '';
            }

            return view('front.checkout', $result);
        } else {
            return redirect('/');
        }
    }
    public function apply_coupon_code(Request $request)
    {
        $arr = apply_coupon_code($request->coupon_code);
        $arr = json_decode($arr, true);

        return response()->json(['status' => $arr['status'], 'msg' => $arr['msg'], 'totalPrice' => $arr['totalPrice']]);
    }

    public function remove_coupon_code(Request $request)
    {
        $totalPrice = 0;
        $result = DB::table('coupons')
            ->where(['code' => $request->coupon_code])
            ->get();
        $getAddToCartTotalItem = getAddToCartTotalItem();
        $totalPrice = 0;
        foreach ($getAddToCartTotalItem as $list) {
            $totalPrice = $totalPrice + ($list->qty * $list->price);
        }

        return response()->json(['status' => 'success', 'msg' => 'Coupon code removed', 'totalPrice' => $totalPrice]);
    }

    public function place_order1(Request $request)
    {
        // dd($request->all());
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $payment_url = '';
        $rand_id = rand(111111111, 999999999);

        if ($request->session()->has('FRONT_USER_LOGIN')) {

        } else {
            $valid = Validator::make($request->all(), [
                "email" => 'required|email|unique:users,email'
            ]);

            if (!$valid->passes()) {
                return response()->json(['status' => 'error', 'msg' => "The email has already been taken"]);

            } else {
                $arr = [
                    "name" => $request->name,
                    "last_name" => $request->last_name,
                    "email" => $request->email,
                    "address" => $request->address,
                    "city" => $request->city,
                    "state" => $request->state,
                    "zip" => $request->zip,
                    "password" => Hash::make($rand_id),
                    "mobile" => $request->mobile,
                    "status" => 1,
                    // "is_verify"=>1,
                    "rand_id" => $rand_id,
                    "created_at" => date('Y-m-d h:i:s'),
                    "updated_at" => date('Y-m-d h:i:s'),
                    "is_forgot_password" => 0
                ];

                $user_id = DB::table('users')->insertGetId($arr);
                $request->session()->put('FRONT_USER_LOGIN', true);
                $request->session()->put('FRONT_USER_ID', $user_id);
                $request->session()->put('FRONT_USER_NAME', $request->name);

                $data = ['name' => $request->name, 'password' => $rand_id];
                $user['to'] = $request->email;
                // Mail::send('front/password_send',$data,function($messages) use ($user){
                //     $messages->to($user['to']);
                //     $messages->subject('New Password');
                // });

                $getUserTempId = getUserTempId();
                DB::table('cart')
                    ->where(['user_id' => $getUserTempId, 'user_type' => 'Not-Reg'])
                    ->update(['user_id' => $user_id, 'user_type' => 'Reg']);
            }
        }
        $coupon_value = 0;
        if ($request->coupon_code != '') {
            $arr = apply_coupon_code($request->coupon_code);
            $arr = json_decode($arr, true);
            if ($arr['status'] == 'success') {
                $coupon_value = $arr['coupon_code_value'];
            } else {
                return response()->json(['status' => 'false', 'msg' => $arr['msg']]);
            }
        }


        $uid = $request->session()->get('FRONT_USER_ID');
        $totalPrice = 0;
        $getAddToCartTotalItem = getAddToCartTotalItem();
        foreach ($getAddToCartTotalItem as $list) {
            $totalPrice = $totalPrice + ($list->qty * $list->price);
        }
        $order_number = 'M'.date('YmdHis');
        $arr = [
            "customers_id" => $uid,
            "order_number" => $order_number,
            "name" => $request->name,
            "email" => $request->email,
            "mobile" => $request->mobile,
            "address" => $request->address,
            "city" => $request->city,
            "state" => $request->state,
            "pincode" => $request->zip,
            "coupon_code" => $request->coupon_code,
            "coupon_value" => $coupon_value,
            "payment_type" => $request->payment_type,
            "payment_status" => "Pending",
            "total_amt" => $totalPrice,
            "order_status" => 1,
            "added_on" => date('Y-m-d h:i:s')
        ];
        $order_id = DB::table('orders')->insertGetId($arr);

        if ($order_id > 0) {
            foreach ($getAddToCartTotalItem as $list) {
                $prductDetailArr['product_id'] = $list->pid;
                $prductDetailArr['products_attr_id'] = $list->attr_id;
                $prductDetailArr['price'] = $list->price;
                $prductDetailArr['qty'] = $list->qty;
                $prductDetailArr['orders_id'] = $order_id;
                DB::table('order_details')->insert($prductDetailArr);
            }

            if ($request->payment_type == 'Gateway') {


                $final_amt = $totalPrice - $coupon_value;

                \Stripe\Stripe::setApiKey('sk_test_51NDOmeSF3KerMIkmrFbDMHzeHWnJkx3mx2tWU275RuGKlruhnjW0PfCvPStrDox7Af3eFDHIj1Uf046pEKSrap0b00mtG6SgQf');

                // Calculate the total price

                // Create an empty array for line items
                $lineItems = [];

                // Add line items to the array
                $lineItems[] = [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => "tesi",
                        ],
                        'unit_amount' => $final_amt * 100,
                    ],
                    'quantity' => 1,
                ];

                try {
                    // Create a Stripe checkout session
                    $session = \Stripe\Checkout\Session::create([
                        'line_items' => $lineItems,
                        'mode' => 'payment',
                        'success_url' => route('paymentCallback') . '?payment_id={CHECKOUT_SESSION_ID}&payment_status=success',
                        'cancel_url' => route('front.index'),
                    ]);

                    // Redirect the user to the Stripe checkout page
                    $payment_url = $session->url;

                    // Update order with transaction ID
                    $txn_id = $session->id;
                    DB::table('orders')
                        ->where(['id' => $order_id])
                        ->update(['txn_id' => $txn_id]);

                    // Return the necessary details to the frontend
                    return response()->json([
                        'status' => 'success',
                        'payment_url' => $payment_url,
                    ]);

                } catch (\Stripe\Exception\PermissionException $e) {
                    $error = $e->getError();
                    $message = $error['message'];
                    // Handle or log the error message
                    echo "PermissionException: $message";
                }



            }

            DB::table('cart')->where(['user_id' => $uid, 'user_type' => 'Reg'])->delete();
            $request->session()->put('ORDER_ID', $order_id);

            $status = "success";
            $msg = "Order placed";
        } else {
            $status = "false";
            $msg = "Please try after sometime";
        }
        return response()->json(['status' => $status, 'msg' => $msg, 'payment_url' => $payment_url]);
    }

     public function place_order(Request $request)
    {
        // dd($request->all());
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $payment_url = '';
        $rand_id = rand(111111111, 999999999);

        if ($request->session()->has('FRONT_USER_LOGIN')) {
                 $valid = Validator::make($request->all(), [
                    "email" => 'required',
                    //"mobile" => 'max:10|min:10',
                    "area" => 'required',
                    "name" => 'required',
                    "city" => 'required'
                ]);

                if (!$valid->passes()) {
                    return response()->json(['status' => 'error', 'msg' => $valid->errors()->first(), 'payment_url' => $payment_url]);

                }
        } else {
            $valid = Validator::make($request->all(), [
                "email" => 'required|email|unique:users,email',
               //"mobile" => 'max:10|min:10',
                "area" => 'required',
                "name" => 'required',
                "city" => 'required'
            ]);

            if (!$valid->passes()) {
                return response()->json(['status' => 'error', 'msg' => $valid->errors()->first(), 'payment_url' => $payment_url]);

            } else {

                    $arr = [
                        "name" => $request->name,
                        "email" => $request->email,
                        "address" => $request->address,
                        "country" => $request->country,
                        "city" => $request->city,
                        "area" => $request->area,
                        "password" => Hash::make($rand_id),
                        "mobile" => $request->mobile,
                        "status" => 1,
                        // "is_verify"=>1,
                        "rand_id" => $rand_id,
                        "created_at" => date('Y-m-d h:i:s'),
                        "is_forgot_password" => 0
                    ];

                    $user_id = DB::table('users')->insertGetId($arr);

                $request->session()->put('FRONT_USER_LOGIN', true);
                $request->session()->put('FRONT_USER_ID', $user_id);
                $request->session()->put('FRONT_USER_NAME', $request->name);

                $data = ['name' => $request->name, 'password' => $rand_id];
                $user['to'] = $request->email;
                // Mail::send('front/password_send',$data,function($messages) use ($user){
                //     $messages->to($user['to']);
                //     $messages->subject('New Password');
                // });

                $getUserTempId = getUserTempId();
                DB::table('cart')
                    ->where(['user_id' => $getUserTempId, 'user_type' => 'Not-Reg'])
                    ->update(['user_id' => $user_id, 'user_type' => 'Reg']);
            }
        }
        $coupon_value = 0;
        if ($request->coupon_code != '') {
            $arr = apply_coupon_code($request->coupon_code);
            $arr = json_decode($arr, true);
            if ($arr['status'] == 'success') {
                $coupon_value = $arr['coupon_code_value'];
            } else {
                return response()->json(['status' => 'false', 'msg' => $arr['msg']]);
            }
        }


        $uid = $request->session()->get('FRONT_USER_ID');
        $totalPrice = 0;
        $vatAmount = 0;
        $totalVAT = 0;

        $getAddToCartTotalItem = getAddToCartTotalItem();
        foreach ($getAddToCartTotalItem as $list) {
            $totalPrice = $totalPrice + ($list->qty * $list->price);

            $vatAmount = ($list->price * $list->qty) * 0.05;

            $totalVAT = $totalVAT + $vatAmount;
        }
        $subtotal = $totalPrice - $totalVAT;

        $order_number = 'M'.date('YmdHis');
        $arr = [
            "customers_id" => $uid,
            "order_number" => $order_number,
            "name" => $request->name,
            "email" => $request->email,
            "mobile" => $request->mobile,
            "address" => $request->address,
            "city" => $request->city,
            "country" => $request->country,
            "area" => $request->area,
            "coupon_code" => $request->coupon_code,
            "coupon_value" => $coupon_value,
            "payment_type" => $request->payment_type,
            "payment_status" => "Pending",
            "sub_total" => $subtotal,
            "vat_total" => $totalVAT,
            "total_amt" => $totalPrice,
            "order_status" => 1,
            "added_on" => date('Y-m-d h:i:s')
        ];
        $order_id = DB::table('orders')->insertGetId($arr);
        // $details = [
        //     'order_id' => $order_id,
        //     'order_number' => $order_number
        // ];

        // \Mail::to($request->email)->send(new \App\Mail\OrderMail($details));

        if ($order_id > 0) {
            foreach ($getAddToCartTotalItem as $list) {
                $prductDetailArr['product_id'] = $list->pid;
                $prductDetailArr['products_attr_id'] = $list->attr_id;
                $prductDetailArr['price'] = $list->price;
                $prductDetailArr['qty'] = $list->qty;
                $prductDetailArr['orders_id'] = $order_id;
                DB::table('order_details')->insert($prductDetailArr);
            }

            if ($request->payment_type == 'Gateway') {


                $final_amt = $totalPrice - $coupon_value;

                \Stripe\Stripe::setApiKey('sk_test_51NDOmeSF3KerMIkmrFbDMHzeHWnJkx3mx2tWU275RuGKlruhnjW0PfCvPStrDox7Af3eFDHIj1Uf046pEKSrap0b00mtG6SgQf');

                // Calculate the total price

                // Create an empty array for line items
                $lineItems = [];

                // Add line items to the array
                $lineItems[] = [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => "tesi",
                        ],
                        'unit_amount' => $final_amt * 100,
                    ],
                    'quantity' => 1,
                ];

                try {
                    // Create a Stripe checkout session
                    $session = \Stripe\Checkout\Session::create([
                        'line_items' => $lineItems,
                        'mode' => 'payment',
                        'success_url' => route('paymentCallback') . '?payment_id={CHECKOUT_SESSION_ID}&payment_status=success',
                        'cancel_url' => route('front.index'),
                    ]);

                    // Redirect the user to the Stripe checkout page
                    $payment_url = $session->url;

                    // Update order with transaction ID
                    $txn_id = $session->id;
                    DB::table('orders')
                        ->where(['id' => $order_id])
                        ->update(['txn_id' => $txn_id]);

                    // Return the necessary details to the frontend
                    return response()->json([
                        'status' => 'success',
                        'payment_url' => $payment_url,
                    ]);

                } catch (\Stripe\Exception\PermissionException $e) {
                    $error = $e->getError();
                    $message = $error['message'];
                    // Handle or log the error message
                    echo "PermissionException: $message";
                }



            }

            DB::table('cart')->where(['user_id' => $uid, 'user_type' => 'Reg'])->delete();
            $request->session()->put('ORDER_ID', $order_id);

            $status = "success";
            $msg = "Order placed";
        } else {
            $status = "false";
            $msg = "Please try after sometime";
        }
        return response()->json(['status' => $status, 'msg' => $msg, 'payment_url' => $payment_url]);
    }

    public function paymentCallback(Request $request)
    {
        $paymentId = $request->query('payment_id');
        $paymentStatus = $request->query('payment_status');
        $paymentRequestId = $request->query('payment_request_id');
        // dd($paymentId,$paymentStatus);
        if ($paymentId && $paymentStatus) {
            if ($request->input('payment_status') == 'success') {
                // dd('success');
                $status = 'Success';
                $redirect_url = '/order_placed';
            } else {
                dd('Fail');
                $status = 'Fail';
                $redirect_url = '/order_fail';
            }

            $request->session()->put('ORDER_STATUS', $status);

            DB::table('orders')
                ->where('txn_id', $request->input('payment_request_id'))
                ->update(['payment_status' => $status, 'payment_id' => $request->input('payment_id')]);

            $order = DB::table('orders')
                ->where('txn_id', $paymentRequestId)
                ->first();


            if ($order) {
                $order_id = $order->id;
                dd($order_id);
                $request->session()->put('ORDER_ID', $order_id);
            } else {
                $request->session()->forget('ORDER_ID');
            }

            $request->session()->save(); // Save the session changes

            return redirect($redirect_url);
        } else {
            die('Something went wrong');
        }
    }

    public function order_placed(Request $request)
    {
        if ($request->session()->has('ORDER_ID')) {
            $order_id = $request->session()->get('ORDER_ID');

            $order = DB::table('orders')->where('id', $order_id)->first();

            if ($order) {
                return view('front.order_placed', ['order' => $order]);
            }
        }

        return redirect('/');
    }

    public function order_fail(Request $request)
    {
        if ($request->session()->has('ORDER_STATUS') && $request->session()->get('ORDER_STATUS') == 'Fail') {
            return view('front.order_fail');
        } else {
            return redirect('/');
        }
    }

    public function order(Request $request)
    {
        $result['orders'] = DB::table('orders')
            ->select('orders.*', 'order_statuses.orders_status')
            ->leftJoin('order_statuses', 'order_statuses.id', '=', 'orders.order_status')
            ->where(['orders.customers_id' => $request->session()->get('FRONT_USER_ID')])
            ->get();
        return view('front.order', $result);
    }

    public function order_detail(Request $request, $id)
    {
        $result['orders_details'] =
            DB::table('order_details')
                ->select('orders.*', 'product_attrs.mrp','order_details.price', 'order_details.qty', 'products.title as pname', 'product_attrs.color_image', 'sizes.size', 'colors.color', 'order_statuses.orders_status')
                ->leftJoin('orders', 'orders.id', '=', 'order_details.orders_id')
                ->leftJoin('product_attrs', 'product_attrs.id', '=', 'order_details.products_attr_id')
                ->leftJoin('products', 'products.id', '=', 'product_attrs.products_id')
                ->leftJoin('sizes', 'sizes.id', '=', 'product_attrs.size_id')
                ->leftJoin('order_statuses', 'order_statuses.id', '=', 'orders.order_status')
                ->leftJoin('colors', 'colors.id', '=', 'product_attrs.color_id')
                ->where(['orders.id' => $id])
                ->where(['orders.customers_id' => $request->session()->get('FRONT_USER_ID')])
                ->get();
        if (!isset($result['orders_details'][0])) {
            return redirect('/');
        }
        return view('front.order_detail', $result);
    }

    public function my_account(Request $request)
    {
        if ($request->session()->has('FRONT_USER_LOGIN')) {
            $uid = $request->session()->get('FRONT_USER_ID');

            $user = User::where(['id' => $uid])->first();

            $result['cities'] = DB::table('cities')
            ->where('is_deleted','=','0')
            ->orderby('id','ASC')
            ->get();

            $result['first_name'] = $user->name;
            $result['last_name'] = $user->last_name;
            $result['email'] = $user->email;
            $result['phone'] = $user->mobile;
            $result['country'] = ($user->country)?$user->country:"UAE";
            $result['area'] = $user->area;
             $result['state'] = $user->state;
             $result['city'] = $user->city;
             $result['zip'] = $user->zip;
            $result['address'] = $user->address;
            $result['id'] = $user->id;

        }
        return view('front.my_account', $result);
    }

    public function myAccountUpdate(Request $request)
    {
        $id = $request->id;

        $user = User::find($id);
        $user->name = $request->name;
        $user->mobile = $request->phone;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->country = $request->country;
        $user->city = $request->city;
        $user->area = $request->area;
        $user->update();

        return redirect()->back();
    }

    public function add_to_wishlist(Request $request)
    {
        // dd($request->session()->has('FRONT_USER_LOGIN'));
        if ($request->session()->has('FRONT_USER_LOGIN')) {
            $uid = $request->session()->get('FRONT_USER_ID');


            $product_id = $request->post('id');


            dd($product_id);
            $result = DB::table('product_attrs')
                ->select('product_attrs.id')

                ->where(['products_id' => $product_id])

                ->get();
            $product_attr_id = $result[0]->id;






            $check = DB::table('wish_lists')
                ->where(['user_id' => $uid])

                ->where(['product_id' => $product_id])
                ->where(['product_attr_id' => $product_attr_id])
                ->get();

            if (isset($check[0])) {
                // dd($check[0]->id);
                DB::table('wish_lists')
                    ->where(['id' => $check[0]->id])
                    ->delete();
                $msg = "removed";
                // if ($pqty == 0) {
                // } else {
                //     DB::table('cart')
                //         ->where(['id' => $update_id])
                //         ->update(['qty' => $pqty]);
                //     $msg = "updated";
                // }

                $msg = "already added added";

            } else {

                $id = DB::table('wish_lists')->insertGetId([
                    'user_id' => $uid,
                    'product_id' => $product_id,
                    'product_attr_id' => $product_attr_id,
                    'added_on' => date('Y-m-d h:i:s')
                ]);
                $msg = "added";
            }
            $result = DB::table('wish_lists')
                ->leftJoin('products', 'products.id', '=', 'wish_lists.product_id')
                ->leftJoin('product_attrs', 'product_attrs.id', '=', 'wish_lists.product_attr_id')

                ->where(['user_id' => $uid])

                ->select('products.title', 'products.image', 'product_attrs.price', 'products.alias', 'products.id as pid', 'product_attrs.id as attr_id')
                ->get();
            return response()->json(['msg' => $msg, 'data' => $result, 'totalItem' => count($result)]);
        } else {
            $product_id = $request->post('id');
            // dd($product_id);
            // return redirect()->route('front.loginRegister');
            $request->session()->put('PENDING_WISHLIST_PRODUCT', $product_id);
            return response()->json(['status' => 'error']);

        }



    }

    public function wishList(Request $request)
    {
        if ($request->session()->has('FRONT_USER_LOGIN')) {
            $uid = $request->session()->get('FRONT_USER_ID');
            $user_type = "Reg";
            $result['list'] = DB::table('wish_lists')
                ->leftJoin('products', 'products.id', '=', 'wish_lists.product_id')
                ->leftJoin('product_attrs', 'product_attrs.id', '=', 'wish_lists.product_attr_id')
                ->leftJoin('sizes', 'sizes.id', '=', 'product_attrs.size_id')
                ->leftJoin('colors', 'colors.id', '=', 'product_attrs.color_id')
                ->where(['user_id' => $uid])
                ->select('products.title', 'products.image', 'sizes.size', 'colors.color', 'product_attrs.price', 'product_attrs.color_id', 'product_attrs.size_id', 'product_attrs.mrp', 'products.alias', 'products.id as pid', 'product_attrs.id as attr_id')
                ->get();

            return view('front.wishlist', $result);
        }
    }

    public function getPriceData(Request $request)
    {
        $color = $request->input('color');
        $id = $request->input('id');

        // Perform your logic to fetch the price based on the selected size and attribute ID
        // Replace the following line with your actual price retrieval logic
        $getColor = DB::table('colors')->where(['color' => $color])->first();

        $getData = DB::table('product_attrs')->where(['color_id' => $getColor->id])->where(['id' => $id])->first();


        // Prepare the response as an array
        $response = [
            'price' => $getData->price,
            'mrp' => $getData->mrp,
            'product_dimension' => $getData->product_dimension,
            'package_dimension' => $getData->package_dimension,
            'weight' => $getData->weight,
            'shipping_weight' => $getData->shipping_weight,
            'cautions' => $getData->cautions,
            'material' => $getData->material,
            'recommended_age' => $getData->recommended_age,
            'color_image' => $getData->color_image,
        ];

        // Return the response as JSON
        return response()->json($response);
    }

    //  public function search(Request $request,$str)
    // {
    //     $result['product']=
    //         $query=DB::table('products');
    //         $query=$query->leftJoin('categories','categories.id','=','products.category_id');
    //         $query=$query->leftJoin('product_attrs','products.id','=','product_attrs.products_id');
    //         $query=$query->where(['products.status'=>1]);
    //         $query=$query->where('title','like',"%$str%");


    //         $query=$query->orwhere('desc','like',"%$str%");

    //         $query=$query->distinct()->select('products.*');
    //         $query=$query->get();
    //         $result['product']=$query;

    //         foreach($result['product'] as $list1){

    //     // dd($list1);
    //             $query1=DB::table('product_attrs');
    //             $query1=$query1->leftJoin('sizes','sizes.id','=','product_attrs.size_id');
    //             $query1=$query1->leftJoin('colors','colors.id','=','product_attrs.color_id');
    //             $query1=$query1->where(['product_attrs.products_id'=>$list1->id]);
    //             $query1=$query1->get();
    //             $result['product_attr'][$list1->id]=$query1;
    //         }

    //     return view('front/search',$result);
    // }

    public function about(Request $request)
    {
        return view('front/about');
    }

    public function termsConditions(Request $request)
    {
        return view('front/terms-conditions');
    }

    public function privacyPolicy(Request $request)
    {
        return view('front/privacy-policy');
    }

    public function termsSales(Request $request)
    {
        return view('front/terms_of_sale');
    }

    public function securityPolicy(Request $request)
    {
        return view('front/security_policy');
    }

    public function returnPolicy(Request $request)
    {
        return view('front/returns_policy');
    }

    public function contact(Request $request)
    {
        $result['settings'] = SiteSettings::where('id', '=', '1')->first();
        return view('front/contact-us',$result);
    }

    public function sendcontact(Request $request)
    {
       $valid = Validator::make($request->all(), [
                "first_name" => 'required',
                "email" => 'required|email',
                "phone" => 'required',
                "message" => 'required',
            ]);

            if (!$valid->passes()) {
                return response()->json(['status' => 'error','msg'=>$valid->errors()->first()]);
            } else {

                $arr = [
                    "first_name"=>$request->first_name,
                    "last_name"=>$request->last_name,
                    "email" => $request->email,
                    "phone" => $request->phone,
                    "message" => $request->message,
                    "created_at" => date('Y-m-d h:i:s'),
                ];



                //  $details = [
                //          'first_name' => $request->first_name,
                            // "last_name"=>$request->last_name,
                            // "phone" => $request->phone,
                            // "message" => $request->message,
                //      ];


                //   \Mail::to($request->email)->send(new \App\Mail\ContactMail($details));

                $id = DB::table('contact')->insertGetId($arr);

                    $status = "success";
                    $msg = "Contact Sent Successfully";

            }

        return response()->json(['status' => $status, 'msg' => $msg]);
    }

    public function subscribe(Request $request)
    {
            $valid = Validator::make($request->all(), [
                "email" => 'required|email|unique:subscribers,email',
            ]);

            if (!$valid->passes()) {
                return response()->json(['status' => 'error','msg'=>$valid->errors()->first()]);
            } else {

                $arr = [
                    "email" => $request->email,
                    "created_at" => date('Y-m-d h:i:s'),
                ];



                //  $details = [
                //          'email' => $request->email
                //      ];

                //     //  dd($details);

                //   \Mail::to($request->email)->send(new \App\Mail\SubscribeMail($details));

                $id = DB::table('subscribers')->insertGetId($arr);

                    $status = "success";
                    $msg = "Subscribed Successfully";

            }

        return response()->json(['status' => $status, 'msg' => $msg]);

    }

    public function order_pdf($id)
    {
        $result['orders_details']=OrderDetail::select('orders.*','order_details.price','order_details.qty','products.title as pname','product_attrs.color_image','sizes.size','colors.color','order_statuses.orders_status')
                ->leftJoin('orders','orders.id','=','order_details.orders_id')
                ->leftJoin('product_attrs','product_attrs.id','=','order_details.products_attr_id')
                ->leftJoin('products','products.id','=','product_attrs.products_id')
                ->leftJoin('sizes','sizes.id','=','product_attrs.size_id')
                ->leftJoin('order_statuses','order_statuses.id','=','orders.order_status')
                ->leftJoin('colors','colors.id','=','product_attrs.color_id')
                ->where(['orders.id'=>$id])
                ->get();


        $result['orders_status']= OrderStatus::all();
        $result['payment_status']=['Pending','Success','Fail'];
        $result['settings'] = SiteSettings::where('id', '=', '1')->get();

        $pdf = PDF::loadView('front/pdf', $result);
        return $pdf->download('order.pdf');
    }

    public function order_return($id)
    {

        $result['orders'] = Order::where('id', '=', $id)->first();

        return view('front.order_return', $result);
    }

     public function sentreturn(Request $request)
    {
       $valid = Validator::make($request->all(), [
                "reason" => 'required',
                "image" => 'required'
            ]);

            if (!$valid->passes()) {
                return response()->json(['status' => 'error','msg'=>$valid->errors()->first()]);
            } else {

                if($request->hasfile('image')){
                    $image=$request->file('image');
                    $ext=$image->extension();
                    $image_name=time().'.'.$ext;
                    $image->storeAs('/public/media/order_return',$image_name);
                }else{
                    $image_name="";
                }

                $arr = [
                    "order_id"=>$request->orders_id,
                    "type"=>$request->type,
                    "reason"=>$request->reason,
                    "phone"=>$request->phone,
                    "photo" => $image_name,
                    "created_by" => session()->get('FRONT_USER_ID'),
                    "created_at" => date('Y-m-d h:i:s'),
                ];

                $id = DB::table('order_return')->insertGetId($arr);

                    $status = "success";
                    $msg = "Order Return Request Sent Successfully";

            }

        return response()->json(['status' => $status, 'msg' => $msg]);
    }

    public function blog(Request $request,$slug)
    {
        // if ($request->session()->has('FRONT_USER_LOGIN') != null) {
        //     return redirect('/');
        // }

        $result['blogs'] = Blog::where('alias', '=', $slug)->get();

        $result['related_blog'] = Blog::where('alias', '!=', $slug)->where(['status' => '0'])->inRandomOrder()->limit('3')->get();

        return view('front.blog_detail', $result);
    }

    public function changeproductimage(Request $request)
    {
      $productData = DB::table('product_attrs')->where(['id' => $request->id])->first();

      $returnHTML = view('front.colorimageajax')->with(['productData'=>$productData])->render();

      echo json_encode(array('status'=>1,'message'=>'Data','html'=>$returnHTML ));

    }

}
