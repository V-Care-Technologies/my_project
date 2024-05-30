<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use App\Models\Colors;
use App\Models\Size;
use App\Models\ProductAttr;
use App\Models\ProductLable;
use App\Models\ProductCategory;
use App\Models\MstLable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Storage;
use DB;
use Validator;
use PhpOffice\PhpSpreadsheet\IOFactory;

use Log;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $result['product']=Product::orderBy('id', 'DESC')->get();
        $result['product'] = Product::leftJoin('product_attrs', 'products.id', '=', 'product_attrs.products_id')
    ->select('products.*', DB::raw('MIN(product_attrs.price) as lowest_price'))
    ->groupBy('products.id')
    ->orderBy('products.id', 'DESC')
    ->get();
    
        return view('admin.product.product',$result);
    }

    
    public function manage_product(Request $request,$id='')
    {
        
        if($id>0){
            $arr=Product::where(['id'=>$id])->get(); 

            // $result['category_id']=$arr['0']->category_id;
            $result['title']=$arr['0']->title;
            $result['image']=$arr['0']->image;
            $result['alias']=$arr['0']->alias;
            $result['meta_title']=$arr['0']->meta_title;
            $result['meta_desc']=$arr['0']->meta_desc;
            $result['desc']=$arr['0']->desc;
            $result['status']=$arr['0']->status;
            $result['specification']=$arr['0']->specification;
            $result['id']=$arr['0']->id;
            $result['rating']=$arr['0']->rating;

            $result['productAttrArr']=ProductAttr::where(['products_id'=>$id])->get();
            $productLableAttrArrs=ProductLable::where(['product_id'=>$id])->get();

            $bAR=[];
            foreach ($productLableAttrArrs as $key => $value) {
                # code...
                $demo=$productLableAttrArrs[$key]->label_id;
                array_push($bAR,$demo);
            }
            
           $result['productLableAttrArr']=$bAR;
           
           $productCatAttrArrs=ProductCategory::where(['product_id'=>$id])->get();

            $cat=[];
            foreach ($productCatAttrArrs as $key => $value) {
                # code...
                $demo=$productCatAttrArrs[$key]->category_id;
                array_push($cat,$demo);
            }
            
           $result['productCatAttrArr']=$cat;
           
            $productImagesArr=DB::table('product_images')->where(['products_id'=>$id])->get();
            
            if(!isset($productImagesArr[0])){
                $result['productImagesArr']['0']['id']='';
                $result['productImagesArr']['0']['images']='';
            }else{
                $result['productImagesArr']=$productImagesArr;
            }

            
            
           
        }else{
            // $result['category_id']='';
            $result['title']='';
            $result['alias']='';
            $result['image']='';
            $result['meta_title']='';
            $result['meta_desc']='';
            $result['desc']='';
            $result['specification']='';
            $result['rating']='';
            $result['status']='';
            $result['id']=0;

            $result['productAttrArr'][0]['id']='';
            $result['productAttrArr'][0]['products_id']='';
            $result['productAttrArr'][0]['sku']='';
            $result['productAttrArr'][0]['attr_image']='';
            $result['productAttrArr'][0]['mrp']='';
            $result['productAttrArr'][0]['price']='';
            $result['productAttrArr'][0]['qty']='';
            // $result['productAttrArr'][0]['size_id']='';
            $result['productAttrArr'][0]['color_id']='';
            $result['productAttrArr'][0]['color_image']='';
            // $result['productAttrArr'][0]['product_dimension']='';
            // $result['productAttrArr'][0]['package_dimension']='';
            // $result['productAttrArr'][0]['weight']='';
            // $result['productAttrArr'][0]['shipping_weight']='';
            // $result['productAttrArr'][0]['cautions']='';
            // $result['productAttrArr'][0]['material']='';
            // $result['productAttrArr'][0]['recommended_age']='';

            $result['productLableAttrArr'][0]['id']='';
            $result['productLableAttrArr'][0]['products_id']='';
            $result['productLableAttrArr'][0]['label_id']='';

            $result['productCatAttrArr'][0]['id']='';
            $result['productCatAttrArr'][0]['products_id']='';
            $result['productCatAttrArr'][0]['category_id']='';
            
              $result['productImagesArr']['0']['id']='';
            $result['productImagesArr']['0']['images']='';

           
           
        }
      
        $result['category']=Category::where('status','=','0')->get();

        $result['sizes']=Size::all();

        $result['colors']=Colors::all();
        $result['product_lable']=MstLable::where('status','=','0')->get();

        
        return view('admin.product.manage_product',$result);
    }

    public function manage_product_process(Request $request)
    {
        // dd($request->all());
        
        if($request->post('id')>0){
            $image_validation="mimes:jpeg,jpg,png";
        }else{
            $image_validation="required|mimes:jpeg,jpg,png";
        }
        $validator = Validator::make($request->all(), [
            'title'=>'required',
            'image'=>$image_validation,
            'alias'=>'required|unique:products,alias,'.$request->post('id'), 
            // 'attr_image.*' =>'mimes:jpg,jpeg,png',
              
        ]);

        if ($validator->fails()) {
            
            session()->flash('error',$validator->errors()->first());
            return redirect()->back(); 
        }
        // $label_idArr=$request->post('label_id');
        $paidArr=$request->post('paid'); 
        
        $skuArr=$request->post('sku'); 
        $mrpArr=$request->post('mrp'); 
        $priceArr=$request->post('price'); 
        $qtyArr=$request->post('qty'); 
        // $size_idArr=$request->post('size_id'); 
        $color_idArr=$request->post('color_id'); 
        // $product_dimensionArr=$request->post('product_dimension'); 
        // $package_dimensionArr=$request->post('package_dimension'); 
        // $weightArr=$request->post('weight'); 
        // $shipping_weightArr=$request->post('shipping_weight'); 
        // $cautionsArr=$request->post('cautions'); 
        // $materialArr=$request->post('material');
        // $recommended_ageArr=$request->post('recommended_age'); 
        foreach($skuArr as $key=>$val){
            $check=ProductAttr::
            where('sku','=',$skuArr[$key])->
            where('id','!=',$paidArr[$key])->
            get();

            if(isset($check[0])){
                $request->session()->flash('sku_error',$skuArr[$key].' SKU already used');
                return redirect(request()->headers->get('referer'));
            }
        }

        if($request->post('id')>0){
            $model=Product::find($request->post('id'));
             $model->updated_at=date('Y-m-d H:i:s');
            $msg="Product updated";
        }else{
            $model=new Product();
            $model->created_at=date('Y-m-d H:i:s');
            $msg="Product inserted";
        }

        $getBrand=ProductLable::where('product_id',$request->post('id'))->get();
        foreach ($getBrand as $list) {
            $deletedRows = ProductLable::where('product_id', $list->product_id)->delete();
        }

        if($request->hasfile('image')){
            if($request->post('id')>0){                
                $arrImage=Product::where(['id'=>$request->post('id')])->get();
                if(Storage::exists('/public/media/'.$arrImage[0]->image)){
                    Storage::delete('/public/media/'.$arrImage[0]->image);
                }
            }
            $image=$request->file('image');
            $ext=$image->extension();
            $image_name=time().'.'.$ext;
            $image->storeAs('/public/media',$image_name);
            $model->image=$image_name;
        }

        // $model->category_id=$request->post('category_id');;
        $model->title=$request->post('title');
        $model->alias=$request->post('alias');
         if(empty($request->post('alias'))){
            $slug = Str::slug($request->post('title'), '-');
            $count = Product::whereRaw("alias RLIKE '^{$slug}(-[0-9]+)?$'")->count();
            $counts = $count + 1;
            $model->alias = $count ? "{$slug}-{$counts}" : $slug;
        }
        $model->meta_title=$request->post('meta_title');
        $model->meta_desc=$request->post('meta_desc');
        $model->desc=$request->post('desc');
        $model->specification=$request->post('specification');
        $model->rating=$request->post('rating');
        $model->save();
        $pid=$model->id;
       
       $productCat=$request->post('category_id');
       
        foreach($productCat as $key=>$val){

            $cat=new ProductCategory();
            $cat->product_id=$pid;
            $cat->category_id=$val;
            $cat->created_at=date('Y-m-d H:i:s');
            $cat->save();
        }
       
       
        // $lable=ProductLable::whereIn('product_id',$pid)->delete();
        $brandArr=$request->label_id;
        // Product  Lable start
        if($brandArr){
        foreach($brandArr as $key=>$val){

            $brand=new ProductLable();
            $brand->product_id=$pid;
            $brand->label_id=$val;
             $brand->created_at=date('Y-m-d H:i:s');
            $brand->save();
        }
        }
        // Product  Lable end

        /*Product Attr Start*/ 
        foreach($skuArr as $key=>$val){
            $productAttrArr=[];
            $productAttrArr['products_id']=$pid;
            $productAttrArr['sku']=$skuArr[$key];
            $productAttrArr['mrp']=(int)$mrpArr[$key];
            $productAttrArr['price']=(int)$priceArr[$key];
            $productAttrArr['qty']=(int)$qtyArr[$key];
            // $productAttrArr['product_dimension']=$product_dimensionArr[$key];
            // $productAttrArr['package_dimension']=$package_dimensionArr[$key];
            // $productAttrArr['weight']=$weightArr[$key];
            // $productAttrArr['shipping_weight']=$shipping_weightArr[$key];
            // $productAttrArr['cautions']=$cautionsArr[$key];
            // $productAttrArr['material']=$materialArr[$key];
            // $productAttrArr['recommended_age']=$recommended_ageArr[$key];
            
            // if($size_idArr[$key]==''){
            //     $productAttrArr['size_id']=0;
            // }else{
            //     $productAttrArr['size_id']=$size_idArr[$key];
            // }

            if($color_idArr[$key]==''){
                $productAttrArr['color_id']=0;
            }else{
                $productAttrArr['color_id']=$color_idArr[$key];
            }
           if ($request->hasFile("attr_image.$key")) {
        $attrImages = $request->file("attr_image.$key");

        foreach ($attrImages as $attrImage) {
            $attrImageName = $this->uploadImage($attrImage);
            $productAttrArr['attr_image'][] = $attrImageName;
        }
    }
            
           if ($request->hasFile("color_image.$key")) {
                if ($paidArr[$key] != '') {
                    $arrImage = DB::table('product_attrs')->where(['id' => $paidArr[$key]])->get();
                    $oldImagePath = public_path('media/' . $arrImage[0]->color_image);
            
                    // Check if the old image exists before deleting
                    if (file_exists($oldImagePath) && is_file($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
            
                $rand = rand('111111111', '999999999');
                $attr_image = $request->file("color_image.$key");
                $ext = $attr_image->extension();
                $image_name = $rand . '.' . $ext;
            
                // Move the uploaded file to the desired directory
                $attr_image->move(public_path('media/'), $image_name);
            
                $productAttrArr['color_image'] = $image_name;
                
            }


			
           	if (!empty($productAttrArr['attr_image'])) {
    $productAttrArr['attr_image'] = json_encode($productAttrArr['attr_image']);
}

             if (!empty($paidArr[$key])) {
    $productAttrArr['updated_at'] = now();
    
    $idsToUpdate = is_array($paidArr[$key]) ? $paidArr[$key] : [$paidArr[$key]];

    DB::table('product_attrs')->whereIn('id', $idsToUpdate)->update($productAttrArr);
} else {
    $productAttrArr['created_at'] = now();
    DB::table('product_attrs')->insert($productAttrArr);
}
                
            }  
		
        /*Product Attr End*/ 
        
            /*Product Images Start*/
       $piidArr = $request->post('piid');

        foreach ($piidArr as $key => $val) {
            $productImageArr['products_id'] = $pid;
    //   dd($piidArr[$key]);
        
            if ($request->hasFile("images.$key")) {
                $rand = rand('111111111', '999999999');
                $images = $request->file("images.$key");
                $ext = $images->extension();
                $image_name = $rand . '.' . $ext;
        
                // Store the image in the public directory
                $images->move(public_path('media'), $image_name);
        
                $productImageArr['images'] = $image_name;
            }
            
            
        
            if ($piidArr[$key] != '') {
                DB::table('product_images')->where(['id' => $piidArr[$key]])->update($productImageArr);
            } else {
                DB::table('product_images')->insert($productImageArr);
            }
        }
        /*Product Images End*/
        
      

        $request->session()->flash('message',$msg);
        return redirect()->route('admin.product');
        
    }
    
    // Separate function to handle image upload
public function uploadImage($image) {
    $rand = rand('111111111', '999999999');
    $ext = $image->extension();
    $imageName = $rand . '.' . $ext;

    // Move the uploaded file to the desired directory
    $image->move(public_path('media'), $imageName);

    return $imageName;
}

    public function delete(Request $request){
         $id = $request->post('id');
        $model=Product::find($id);
        $model->delete();
        echo json_encode(array('status'=>1,'message'=>'Data'));
    }

    public function product_attr_delete(Request $request,$paid,$pid){
        $arrImage=DB::table('product_attrs')->where(['id'=>$paid])->get();
        if(Storage::exists('/public/media/'.$arrImage[0]->attr_image)){
            Storage::delete('/public/media/'.$arrImage[0]->attr_image);
        }
        DB::table('product_attrs')->where(['id'=>$paid])->delete();
        return redirect('admin/product/manage-product/'.$pid);
    }
    
     public function importProduct(Request $request){
       if ($request->hasFile('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
    
            if ($extension === 'xlsx' || $extension === 'xls') {
                $spreadsheet = IOFactory::load($file);
                $sheet = $spreadsheet->getActiveSheet();
    
                $data = [];
                foreach ($sheet->getRowIterator() as $row) {
                    $rowData = [];
                    foreach ($row->getCellIterator() as $cell) {
                        $value = $cell->getValue();
                        $rowData[] = $value;
                    }
                    $data[] = $rowData;
                }
    
                // Assuming your table names are 'brands' and 'categories'
                $lablesTable = 'mst_lables';
                $categoriesTable = 'categories';
                $inchesTable = 'inches';
                $lengthsTable = 'lengths';
                $colorsTable = 'colors';
                $sizesTable = 'sizes';
    
                // Assuming the first row of the Excel sheet contains column names
                $columns = $data[0];
    
                // Remove the first row (column names)
                array_shift($data);
    
                foreach ($data as $row) {
                    $rowData = array_combine($columns, $row);
                    if($rowData['product_code']!=null || $rowData['product_code']!=""){
                    $title = $rowData['title'];
                    $slug = Str::slug($request->post('title'), '-');
                    $count = Product::whereRaw("alias RLIKE '^{$slug}(-[0-9]+)?$'")->count();
                    $counts = $count + 1;
                    $alias = $count ? "{$slug}-{$counts}" : $slug;
                    $product_code = $rowData['product_code'];
                    $rating = $rowData['rating'];
                    $meta_title = $rowData['meta_title'];
                    $meta_desc = $rowData['meta_desc'];
                    $desc = $rowData['desc'];
                    $image = $rowData['image'];
                    $category = $rowData['category_id'];
                    // $length = $rowData['length'];
                    // $inch = $rowData['inch'];
                    $color = $rowData['color'];
                    // $size = $rowData['size'];
                    $qty = $rowData['qty'];
                    $mrp = $rowData['mrp'];
                    $price = $rowData['price'];
                    // $prod_discount = $rowData['prod_discount'];
                    $attr_images = $rowData['attr_images'];
                    $color_image = $rowData['color_image'];
                    $specification = $rowData['Specifications'];
                    $mst_lables = explode(",",$rowData['lable']);

                    
                    $existingCategory = DB::table($colorsTable)
                    ->where('color', $color)
                    ->first();
                    if (!$existingCategory) {
                        // print_r($color);
                                        
                        // If the category doesn't exist, insert it into the 'categories' table and retrieve the ID
                        $colorId = DB::table($colorsTable)->insertGetId(['color' => $color,'color_image' => $color_image]);
                    } else {
                        // If the category already exists, use the existing ID
                        $colorId = $existingCategory->id;
                    }
                    // dd($colorId);

                    // $existingCategory = DB::table($sizesTable)
                    // ->where('size', $size)
                    // ->first();

                    // if (!$existingCategory) {
                    //     // If the category doesn't exist, insert it into the 'categories' table and retrieve the ID
                    //     $sizeId = DB::table($sizesTable)->insertGetId(['size' => $size]);
                    // } else {
                    //     // If the category already exists, use the existing ID
                    //     $sizeId = $existingCategory->id;
                    // }

                    // $existingCategory = DB::table($inchesTable)
                    // ->where('inch', $inch)
                    // ->first();

                    // if (!$existingCategory) {
                    //     // If the category doesn't exist, insert it into the 'categories' table and retrieve the ID
                    //     $inchId = DB::table($inchesTable)->insertGetId(['inch' => $inch]);
                    // } else {
                    //     // If the category already exists, use the existing ID
                    //     $inchId = $existingCategory->id;
                    // }

                    // $existingCategory = DB::table($lengthsTable)
                    // ->where('length', $length)
                    // ->first();

                    // if (!$existingCategory) {
                    //     // If the category doesn't exist, insert it into the 'categories' table and retrieve the ID
                    //     $lengthId = DB::table($lengthsTable)->insertGetId(['length' => $length]);
                    // } else {
                    //     // If the category already exists, use the existing ID
                    //     $lengthId = $existingCategory->id;
                    // }
                   
    
                    // Check if the category already exists in the 'categories' table
                    $existingCategory = DB::table($categoriesTable)
                        ->where('category_name', $category)
                        ->first();
    
                    if (!$existingCategory) {
                        // If the category doesn't exist, insert it into the 'categories' table and retrieve the ID
                        $categoryId = DB::table($categoriesTable)->insertGetId(['category_name' => $category]);
                    } else {
                        // If the category already exists, use the existing ID
                        $categoryId = $existingCategory->id;
                    }
    
                    // Update the row data with the brand and category IDs
                    $rowData1['title'] = $title;
                    $rowData1['product_code'] = $product_code;
                    $rowData1['rating'] = $rating;
                    $rowData['alias'] = $alias;
                    $rowData1['meta_title'] = $meta_title;
                    $rowData1['meta_desc'] = $meta_desc;
                    $rowData1['desc'] = $desc;
                    $rowData1['image'] = $image;
                    $rowData1['category_id'] = $categoryId;
                    $rowData1['specification'] = $specification;
                    $rowData1['created_at'] = date('Y-m-d H:i:s');
                    // Assuming your table name is 'products'
                    $tableName = 'products';
    
                    // Insert the row into the 'products' table
                   $pId= DB::table($tableName)->insertGetId($rowData1);

                   $rowData2['products_id'] = $pId;
                   $rowData2['mrp'] = $mrp;
                   $rowData2['price'] = $price;
                   $rowData2['qty'] = $qty;
                //   $rowData2['size_id'] = $sizeId;
                   $rowData2['color_id'] = $colorId;
                    //    $rowData2['length_id'] = $lengthId;
                    //    $rowData2['inch_id'] = $inchId;
                    //    $rowData2['discount'] = $prod_discount;
                   $rowData2['attr_image'] = $attr_images;   
                    $rowData2['created_at'] = date('Y-m-d H:i:s');
                   $tableName2 = 'product_attrs';
                    DB::table($tableName2)->insertGetId($rowData2);
                    
                    // Check if the brand already exists in the 'brands' table
                    foreach($mst_lables as $key=>$val){
                        
                       
                        $existingBrand = DB::table($lablesTable)
                            ->where('title', $val)
                            ->first();
        
                        if (!$existingBrand) {
                            // If the brand doesn't exist, insert it into the 'brands' table and retrieve the ID
                            $brandId = DB::table($lablesTable)->insertGetId(['title' => $val]);
                        } else {
                            // If the brand already exists, use the existing ID
                            $brandId = $existingBrand->id;
                        }
                        $brand=new ProductLable();
                        $brand->product_id=$pId;
                        $brand->label_id=$brandId;
                        $brand->created_at=date('Y-m-d H:i:s');
                        $brand->save();
                    }
                    }
                }
    
                return redirect()->back();
            } else {
                return response()->json(['message' => 'Unsupported file extension'], 400);
            }
        }
    
        return redirect()->back();
    }
    
    
    public function product_images_delete(Request $request){
        
        $paid=$request->id;
        $pid=$request->anotherId;
    $arrImage = DB::table('product_images')->where(['id' => $paid])->get();
    $imagePath = public_path('media/' . $arrImage[0]->images);

    // Check if the image file exists before deleting
    if (file_exists($imagePath) && is_file($imagePath)) {
        unlink($imagePath);
    }

    DB::table('product_images')->where(['id' => $paid])->delete();
    // return redirect('admin/product/manage-product/' . $pid);
     echo json_encode(array('status'=>1,'message'=>'Data'));
}


    
    
    public function status(Request $request,$status,$id){
        $model=Product::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message','Product status updated');
        return redirect('admin/product');
    }
}
