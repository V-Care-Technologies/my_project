<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeBanner;
use App\Models\Category;
use App\Models\Product;
use App\Models\Video;
use App\Models\Order;
use App\Models\OrderDetail;
use Validator;
use DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $home_banner = HomeBanner::where(['status' => 1])->where('type','=','1')->get();

        $home_banner->each(function ($banner) {
            // Append the full image path to each banner object
            $banner->image1 = asset('storage/app/public/media/banner/'.$banner->image1); // Assuming the image path is relative to your public directory
        });

        $home_banner->each(function ($banner) {
            // Append the full image path to each banner object
            $banner->image = asset('storage/app/public/media/banner/'.$banner->image); // Assuming the image path is relative to your public directory
        });

        $category=Category::where('parent_category_id','=','0')->where(['status' => 1])->where(['is_deleted' => 0])->get();

        $category->each(function ($cat) {
            // Append the full image path to each banner object
            $cat->category_image = asset('storage/app/public/media/category/'.$cat->category_image); // Assuming the image path is relative to your public directory
        });


        $mid_banner = HomeBanner::where(['status' => 1])->where('type','=','2')->get();

        $mid_banner->each(function ($banner) {
            // Append the full image path to each banner object
            $banner->image1 = asset('storage/app/public/media/banner/'.$banner->image1); // Assuming the image path is relative to your public directory
        });

        $mid_banner->each(function ($banner) {
            // Append the full image path to each banner object
            $banner->image = asset('storage/app/public/media/banner/'.$banner->image); // Assuming the image path is relative to your public directory
        });

        $new_arrivals_product = Product::rightJoin('product_lables', 'product_lables.product_id', '=', 'products.id')->rightJoin('product_attrs', 'product_attrs.products_id', '=', 'products.id')->select('products.*', 'product_lables.label_id', 'product_attrs.mrp as mrp', 'product_attrs.price as price', 'product_attrs.size_id as size_id', 'product_attrs.color_id as color_id')->where('product_lables.label_id', '=', '3')->where('products.status','=', '1')
        ->groupBy('product_attrs.products_id')->get();

        $new_arrivals_product->each(function ($product) {
            // Append the full image path to each banner object
            $product->image = asset('storage/app/public/media/'.$product->image); // Assuming the image path is relative to your public directory
            $product->stock = ($product->stock == 1) ? 'In Stock' : 'Out of Stock';
        });

        $video=Video::where('status','=','1')->where('is_deleted','=','0')->get();


        $data =[
            'top_banner'=>$home_banner,
            'category'=>$category,
            'mid_banner'=>$mid_banner,
            'new_arrivals_product' =>$new_arrivals_product,
            'video'=>$video
        ];

        return response()->json([
            'status' => 'success',
            'message' => 'Home Details',
            'home' => $data
        ],200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function getAllCategory()
    {
        $category=Category::where('parent_category_id','=','0')->where(['status' => 1])->where(['is_deleted' => 0])->get();

        $category->each(function ($cat) {
            // Append the full image path to each banner object
            $cat->category_image = asset('storage/app/public/media/category/'.$cat->category_image); // Assuming the image path is relative to your public directory
        });


        return response()->json([
            'status' => 'success',
            'message' => 'All Category',
            'category' => $category
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function getSubCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->first()], 400);
        }

        $categories = Category::where('parent_category_id', $request->category_id)
            ->where('status', 1)
            ->where('is_deleted', 0)
            ->get();

        $subcategoryData = [];

        foreach ($categories as $category) {
            $category->category_image = asset('storage/app/public/media/category/' . $category->category_image);

            $query = DB::table('products');
            $query->select('products.*', 'product_attrs.color_image as color_image');
            $query->leftJoin('product_categories', 'products.id', '=', 'product_categories.product_id');
            $query->leftJoin('categories', 'categories.id', '=', 'product_categories.category_id');
            $query->leftJoin('product_attrs', 'products.id', '=', 'product_attrs.products_id');
            $query->where('products.status', '1');
            $query->where('categories.category_slug', $category->category_slug);

            $query->distinct()->select('products.*');
            $products = $query->get();
            $productCount = $products->count();

            $subcategoryData[] = [
                'id' => $category->id,
                'category_name' => $category->category_name,
                'category_slug' => $category->category_slug,
                'parent_category_id' => $category->parent_category_id,
                'category_image' => $category->category_image,
                'bg_color' => $category->bg_color,
                'is_home' => $category->is_home,
                'is_deleted' => $category->is_deleted,
                'status' => $category->status,
                'created_at' => $category->created_at,
                'updated_at' => $category->updated_at,
                'total_products' => $productCount
            ];
        }

        return response()->json([
            'status' => 'success',
            'message' => 'All Sub Category',
            'subcategory' => $subcategoryData
        ], 200);
    }


    /**
     * Display the specified resource.
     */
    public function getCategoryProductList(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->first()], 400);
        }

        $categories = Category::where('id', $request->category_id)
            ->where('status', 1)
            ->where('is_deleted', 0)
            ->get();

        $products = [];

        foreach ($categories as $category) {
            $query = DB::table('products');
            $query->select('products.*', 'product_attrs.color_image as color_image');
            $query->leftJoin('product_categories', 'products.id', '=', 'product_categories.product_id');
            $query->leftJoin('categories', 'categories.id', '=', 'product_categories.category_id');
            $query->leftJoin('product_attrs', 'products.id', '=', 'product_attrs.products_id');
            $query->where('products.status', '1');
            $query->where('categories.category_slug', $category->category_slug);

            $query->distinct()->select('products.*');
            $productsInCategory = $query->get();

            foreach ($productsInCategory as $product) {
                // Assuming the image path is stored in the 'image_path' attribute of the product model
                $product->image = asset('storage/app/public/media/' . $product->image);
                $products[] = $product;
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => 'product',
            'productlist' => $products
        ], 200);
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function getProductDetails(Request $request)
{
    $validator = Validator::make($request->all(), [
        'product_id' => 'required|numeric',
    ]);

    if ($validator->fails()) {
        return response()->json(['status' => 'error', 'message' => $validator->errors()->first()], 400);
    }

    $product = DB::table('products')
        ->where('status', '1')
        ->where('id', $request->product_id)
        ->first();

    if (!$product) {
        return response()->json(['status' => 'error', 'message' => 'Product not found'], 404);
    }

    // Extracting and parsing multiple images from the JSON array
    $imageUrls = [];
    $imagesJson = json_decode($product->multiple_images, true);
    if ($imagesJson) {
        foreach ($imagesJson as $image) {
            // Assuming your image path is relative to the public directory
            $imageUrls[] = asset('storage/app/public/media/category/' . $image);
        }
    }

    // Fetch product attributes from product_attrs table
    $productAttrs = DB::table('product_attrs')
        ->where('products_id', $request->product_id)
        ->get();

    $attrUrls = [];
    foreach ($productAttrs as $attr) {
        // Assuming your attribute path is relative to the public directory
        $attrUrls[] = ['color_image' => asset('storage/app/public/media/color/' . $attr->color_image)];
    }

    $product->multiple_images = $imageUrls;
    $product->product_attr = $attrUrls;
    $product->stock = ($product->stock == 1) ? 'In Stock' : 'Out of Stock';

    return response()->json([
        'status' => 'success',
        'message' => 'Product details',
        'productdetails' => $product
    ], 200);
}


    /**
     * Update the specified resource in storage.
     */
    public function addToEnquery(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|numeric',
            'user_id' => 'required|numeric',
            'qty' => 'required|numeric',

        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->first()], 400);
        }


        $result = DB::table('product_attrs')
            ->select('product_attrs.id')
            //->leftJoin('sizes', 'sizes.id', '=', 'product_attrs.size_id')
            ->leftJoin('colors', 'colors.id', '=', 'product_attrs.color_id')
            ->where(['products_id' => $request->product_id])
            //->where(['sizes.size' => $size_id])
            // ->where(['colors.color' => $color_id])
            ->get();
        $product_attr_id = $result[0]->id;
        $id = DB::table('cart')->insertGetId([
            'user_id' => $request->user_id,
            'product_id' => $request->product_id,
            'product_attr_id' => $product_attr_id,
            'qty' => $request->qty,
            'added_on' => date('Y-m-d h:i:s')
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'product added successfully',
            // 'productdetails' => $product
        ], 200);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function getCartData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',

        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->first()], 400);
        }

        $cart = DB::table('cart')
        ->leftJoin('products', 'products.id', '=', 'cart.product_id')
        ->leftJoin('product_attrs', 'product_attrs.id', '=', 'cart.product_attr_id')
        ->leftJoin('sizes', 'sizes.id', '=', 'product_attrs.size_id')
        ->leftJoin('colors', 'colors.id', '=', 'product_attrs.color_id')
        ->where(['user_id' => $request->user_id])
        // ->where(['user_type' => $user_type])
        ->select('cart.id','cart.qty', 'products.title','products.quality','products.ved_sheet_size','products.pillow_cover_size','products.product_packing', 'product_attrs.color_image as image', 'sizes.size', 'colors.color', 'product_attrs.price', 'product_attrs.mrp', 'products.alias', 'products.id as pid', 'product_attrs.id as attr_id')
        ->get();

        $totalItems = $cart->count();

        foreach ($cart as $item) {
            $item->image = asset('storage/app/public/media/' . $item->image);
        }


        return response()->json([
            'status' => 'success',
            'message' => 'Cart Details',
            'total_items' => $totalItems,
            'Cart' => $cart
        ], 200);
    }


    public function cartItemDelete(Request $request)
{
    $validator = Validator::make($request->all(), [
        'cart_id' => 'required|numeric',
    ]);

    if ($validator->fails()) {
        return response()->json(['status' => 'error', 'message' => $validator->errors()->first()], 400);
    }

    // Delete the cart item
    $deleted = DB::table('cart')->where('id', $request->cart_id)->delete();

    if ($deleted) {
        return response()->json([
            'status' => 'success',
            'message' => 'Cart Item Deleted',
        ], 200);
    } else {
        return response()->json([
            'status' => 'error',
            'message' => 'Failed to delete cart item',
        ], 500);
    }
}

public function allCartItemDelete(Request $request)
{
    $validator = Validator::make($request->all(), [
        'user_id' => 'required|numeric',
    ]);

    if ($validator->fails()) {
        return response()->json(['status' => 'error', 'message' => $validator->errors()->first()], 400);
    }

    // Delete all cart items for the specified user ID
    $deleted = DB::table('cart')->where('user_id', $request->user_id)->delete();

    if ($deleted) {
        return response()->json([
            'status' => 'success',
            'message' => 'All Cart Items Deleted',
        ], 200);
    } else {
        return response()->json([
            'status' => 'error',
            'message' => 'Failed to delete cart items',
        ], 500);
    }
}

public function updateQty(Request $request)
{
    $validator = Validator::make($request->all(), [
        'item_id' => 'required|numeric',
        'qty' => 'required|numeric',
    ]);

    if ($validator->fails()) {
        return response()->json(['status' => 'error', 'message' => $validator->errors()->first()], 400);
    }

    // Update the cart item quantity
    $updated = DB::table('cart')
        ->where('id', $request->item_id)
        ->update(['qty' => $request->qty]);

    if ($updated) {
        return response()->json([
            'status' => 'success',
            'message' => 'Cart Item Quantity Updated',
        ], 200);
    } else {
        return response()->json([
            'status' => 'error',
            'message' => 'Failed to update cart item quantity',
        ], 500);
    }
}

public function placeOrder(Request $request)
{
    $validator = Validator::make($request->all(), [
        'user_id' => 'required|numeric',

    ]);

    if ($validator->fails()) {
        return response()->json(['status' => 'error', 'message' => $validator->errors()->first()], 400);
    }

    $result=DB::table('cart')
    ->leftJoin('products','products.id','=','cart.product_id')
    ->leftJoin('product_attrs','product_attrs.id','=','cart.product_attr_id')
    ->leftJoin('sizes','sizes.id','=','product_attrs.size_id')
    ->leftJoin('colors','colors.id','=','product_attrs.color_id')
    ->where(['user_id'=>$request->user_id])

    ->select('cart.qty','products.title','products.image','product_attrs.color_image','sizes.size','colors.color','product_attrs.price','products.alias','products.id as pid','product_attrs.id as attr_id')
    ->get();

    $order_number = 'M'.date('YmdHis');
    $arr = [
        "customers_id" => $request->user_id,
        "order_number" => $order_number,
        "order_status" => 1,
        "added_on" => date('Y-m-d h:i:s')
    ];
    $order_id = DB::table('orders')->insertGetId($arr);

    foreach ($result as $list) {
        $prductDetailArr['product_id'] = $list->pid;
        $prductDetailArr['products_attr_id'] = $list->attr_id;
        $prductDetailArr['price'] = $list->price;
        $prductDetailArr['qty'] = $list->qty;
        $prductDetailArr['orders_id'] = $order_id;
        DB::table('order_details')->insert($prductDetailArr);
    }

    $deleted = DB::table('cart')->where('user_id', $request->user_id)->delete();

    return response()->json([
        'status' => 'success',
        'message' => 'Enquiry successfully',
    ], 200);
}


public function getVideo(Request $request)
{


    $video=Video::where('status','=','1')->where('is_deleted','=','0')->get();

    return response()->json([
        'status' => 'success',
        'message' => 'Enquiry successfully',
        "video" => $video
    ], 200);
}


public function getOrderDetails(Request $request)
{
    $validator = Validator::make($request->all(), [
        'user_id' => 'required|numeric',
    ]);

    if ($validator->fails()) {
        return response()->json(['status' => 'error', 'message' => $validator->errors()->first()], 400);
    }

    // Fetch orders for the specified user ID
    $orders = Order::where('customers_id', $request->user_id)->get();

    // Check if any orders were found
    if ($orders->isEmpty()) {
        return response()->json([
            'status' => 'error',
            'message' => 'No orders found for the specified user',
        ], 404);
    }

    $orderDetails = [];
    foreach ($orders as $order) {
        $items = DB::table('order_details')
            ->select('order_details.qty', 'products.title as product_name', DB::raw("CONCAT('" . asset('storage/app/public/media/') . "', product_attrs.color_image) AS color_image"), 'products.quality', 'products.ved_sheet_size', 'products.pillow_cover_size', 'products.product_packing')
            ->leftJoin('products', 'products.id', '=', 'order_details.product_id')
            ->leftJoin('product_attrs', 'product_attrs.id', '=', 'order_details.products_attr_id')
            ->where('order_details.orders_id', $order->id)
            ->get();

        $orderDetails[] = [
            'id' => $order->id,
            'date' => $order->added_on, // Assuming 'added_on' is the field representing the order date
            'order_number' => $order->order_number,
            'total_item' => count($items),
            'items' => $items,
        ];
    }

    return response()->json([
        'status' => 'success',
        'message' => 'Order Details',
        'orderdetails' => $orderDetails,
    ], 200);
}





}
