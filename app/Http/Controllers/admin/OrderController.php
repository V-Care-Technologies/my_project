<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\OrderDetail;
use App\Models\SiteSettings;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use PDF;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result['orders']=Order::select('orders.*','order_statuses.orders_status')
        ->leftJoin('order_statuses','order_statuses.id','=','orders.order_status')
        ->get();   
        return view('admin.order.order',$result);
    }    

    public function order_detail(Request $request,$id)
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
        return view('admin.order.order_detail',$result);
    } 

    public function update_payemnt_status(Request $request,$status,$id)
    {
        Order::where(['id'=>$id])
        ->update(['payment_status'=>$status]);
        return redirect('/admin/order-detail/'.$id);
    } 

    public function update_order_status(Request $request,$status,$id)
    {
        Order::where(['id'=>$id])
        ->update(['order_status'=>$status]);
        return redirect('/admin/order-detail/'.$id);
    } 

    public function update_track_detail(Request $request,$id)
    {
        $track_details=$request->post('track_details');
        Order::where(['id'=>$id])
        ->update(['track_details'=>$track_details]);
        return redirect('/admin/order-detail/'.$id);
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
          
        $pdf = PDF::loadView('admin/pdf/pdf', $result);
        return $pdf->download('order.pdf');
    }
    
    public function order_return()
    {
        $result['orders']=DB::table('order_return')->select('order_return.*','orders.order_number','orders.name')
        ->leftJoin('orders','orders.id','=','order_return.order_id')
        ->get();   
        return view('admin.order.order_return',$result);
    }  
    
    public function delete(Request $request){
         $id = $request->post('id');
      
        DB::table('order_return')->where('id', $id)->delete();
        
        echo json_encode(array('status'=>1,'message'=>'Data'));
    }
    
}
