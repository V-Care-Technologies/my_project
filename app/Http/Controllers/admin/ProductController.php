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

        $result['category']=Category::where('status','=','0')->get();
        $result['categoryid']='';

        return view('admin.product.product',$result);
    }

    public function product_filter(Request $request)
    {
        $catid=$request->post('category_id');

        $result['product'] = Product::leftJoin('product_attrs', 'products.id', '=', 'product_attrs.products_id')
            ->leftJoin('product_categories', 'products.id', '=', 'product_categories.product_id')
            ->select('products.*', DB::raw('MIN(product_attrs.price) as lowest_price'))
            ->where('product_categories.category_id','=',$catid)
            ->groupBy('products.id')
            ->orderBy('products.id', 'DESC')
            ->get();

        $result['categoryid']=$catid;
        $result['category']=Category::where('status','=','0')->get();

        return view('admin.product.product',$result);
    }

    public function manage_product(Request $request,$id='')
    {

        if($id>0){
            $arr=Product::where(['id'=>$id])->get();

            // $result['category_id']=$arr['0']->category_id;
            $result['title']=$arr['0']->title;
            $result['product_code']=$arr['0']->product_code;
            $result['image']=$arr['0']->image;
            $result['multiple_images']=$arr['0']->multiple_images;
            $result['alias']=$arr['0']->alias;
            $result['meta_title']=$arr['0']->meta_title;
            $result['meta_desc']=$arr['0']->meta_desc;
            $result['desc']=$arr['0']->desc;
            $result['status']=$arr['0']->status;
            $result['specification']=$arr['0']->specification;
            $result['quality']=$arr['0']->quality;
            $result['ved_sheet_size']=$arr['0']->ved_sheet_size;
            $result['pillow_cover_size']=$arr['0']->pillow_cover_size;
            $result['product_packing']=$arr['0']->product_packing;
            $result['usp']=$arr['0']->usp;
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


        }else{
            // $result['category_id']='';
            $result['title']='';
            $result['product_code']='';
            $result['alias']='';
            $result['image']='';
            $result['multiple_images']='';
            $result['meta_title']='';
            $result['meta_desc']='';
            $result['desc']='';
            $result['specification']='';
            $result['quality']='';
            $result['ved_sheet_size']='';
            $result['pillow_cover_size']='';
            $result['product_packing']='';
            $result['usp']='';
            $result['rating']='';
            $result['status']='';
            $result['id']=0;

            $result['productAttrArr'][0]['id']='';
            $result['productAttrArr'][0]['products_id']='';
            $result['productAttrArr'][0]['sku']='';
             $result['productAttrArr'][0]['color_id']='';
            $result['productAttrArr'][0]['color_image']='';
            $result['productAttrArr'][0]['multiple_images']='';
            $result['productAttrArr'][0]['mrp']='';
            $result['productAttrArr'][0]['price']='';
            $result['productAttrArr'][0]['qty']='';
            // $result['productAttrArr'][0]['size_id']='';
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

        }

        $result['category']=Category::where('status','=','1')->get();

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
            'alias'=>'unique:products,alias,'.$request->post('id'),
            'product_code'=>'unique:products,product_code,'.$request->post('id'),

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

        if ($request->hasFile('multiple_image')) {
            if ($request->post('id') > 0) {
                $arrImages = Product::where(['id' => $request->post('id')])->get();
                foreach ($arrImages as $arrImage) {
                    if (Storage::exists('/public/media/' . $arrImage->multiple_images)) {
                        Storage::delete('/public/media/' . $arrImage->multiple_images);
                    }
                }
            }

            $multipleImages = $request->file('multiple_image');
            $images = [];

            foreach ($multipleImages as $image) {
                $ext = $image->getClientOriginalExtension(); // Get original file extension
                $image_name = time() . '_' . uniqid() . '.' . $ext; // Unique image name
                $image->storeAs('/public/media', $image_name);
                $images[] = $image_name;
            }

            // Assuming $model represents your product model
            $model->multiple_images = json_encode($images); // Store the image names as JSON
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
        $model->product_code=$request->post('product_code');
        $model->meta_title=$request->post('meta_title');
        $model->meta_desc=$request->post('meta_desc');
        $model->desc=$request->post('desc');
        $model->specification=$request->post('specification');
        $model->quality=$request->post('quality');
        $model->ved_sheet_size=$request->post('ved_sheet_size');
        $model->pillow_cover_size=$request->post('pillow_cover_size');
        $model->product_packing=$request->post('product_packing');
        $model->usp=$request->post('usp');
        $model->rating=$request->post('rating');
        $model->save();
        $pid=$model->id;

       $productCat=$request->post('category_id');
       if($productCat){
           if($request->post('id')){
                ProductCategory::where('product_id',$request->post('id'))->delete();
           }
            foreach($productCat as $key=>$val){

                $cat=new ProductCategory();
                $cat->product_id=$pid;
                $cat->category_id=$val;
                $cat->created_at=date('Y-m-d H:i:s');
                $cat->save();
            }
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

           if($request->hasFile("color_image.$key")){
                if($paidArr[$key]!=''){
                    $arrImage=DB::table('product_attrs')->where(['id'=>$paidArr[$key]])->get();
                    if(Storage::exists('/public/media/'.$arrImage[0]->color_image)){
                        Storage::delete('/public/media/'.$arrImage[0]->color_image);
                    }
                }

                $rand=rand('111111111','999999999');
                $color_image=$request->file("color_image.$key");
                $ext=$color_image->extension();
                $image_name=$rand.'.'.$ext;
                $request->file("color_image.$key")->storeAs('/public/media',$image_name);
                $productAttrArr['color_image']=$image_name;
            }

		   if (!empty($paidArr[$key])) {
                // Fetch existing images from the database
                $existingImages = DB::table('product_attrs')->where(['id' => $paidArr[$key]])->value('multiple_images');

                // If a previous image exists, add it to the multiple_images array
                $productAttrArr['multiple_images'] = $existingImages ? json_decode($existingImages, true) : [];
            }

            // Check if the request has files for the current key
            if ($request->hasFile("multiple_images.$key")) {
                // Initialize the multiple_images array for the current iteration
                $productAttrArr['multiple_images'] = [];

                // Iterate over each file in the request
                foreach ($request->file("multiple_images.$key") as $index => $attr_image1) {
                    // Check if the current file is a valid uploaded file
                    if ($attr_image1->isValid()) {
                        // Generate a unique name for the image
                        $rand1 = rand(111111111, 999999999);
                        $ext1 = $attr_image1->getClientOriginalExtension();
                        $image_name1 = $rand1 . '.' . $ext1;

                        // Store the image
                        $attr_image1->storeAs('/public/media', $image_name1);

                        // Add the new image to the array
                        $productAttrArr['multiple_images'][] = $image_name1;
                    }
                }
            }


            // Check if 'multiple_images' key is set before encoding to JSON
            if (isset($productAttrArr['multiple_images'])) {
                // Encode the multiple_images array to JSON
                $productAttrArr['multiple_images'] = json_encode($productAttrArr['multiple_images']);
            } else {
                // If 'multiple_images' key is not set, set it to an empty array before encoding
                $productAttrArr['multiple_images'] = json_encode([]);
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
        ProductAttr::where('products_id',$id)->delete();
        ProductLable::where('product_id',$id)->delete();
        ProductCategory::where('product_id',$id)->delete();

        echo json_encode(array('status'=>1,'message'=>'Data'));
    }

    public function product_attr_delete(Request $request,$paid,$pid){
        $arrImage=DB::table('product_attrs')->where(['id'=>$paid])->get();
        if(Storage::exists('/public/media/'.$arrImage[0]->color_image)){
            Storage::delete('/public/media/'.$arrImage[0]->color_image);
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
                $colorsTable = 'colors';
                $productsTable = 'products';

                // Assuming the first row of the Excel sheet contains column names
                $columns = $data[0];

                // Remove the first row (column names)
                array_shift($data);

                foreach ($data as $row) {
                    $rowData = array_combine($columns, $row);
                    if($rowData['product_code']!=null || $rowData['product_code']!=""){
                    $title = $rowData['title'];
                    $slug = Str::slug($rowData['title'], '-');
                    $count = Product::whereRaw("alias RLIKE '^{$slug}(-[0-9]+)?$'")->count();
                    $counts = $count + 1;
                    $alias = $count ? "{$slug}-{$counts}" : $slug;
                    $product_code = $rowData['product_code'];
                    $sku = $rowData['sku'];
                    $rating = $rowData['rating'];
                    $meta_title = $rowData['meta_title'];
                    $meta_desc = $rowData['meta_desc'];
                    $desc = $rowData['desc'];
                    $image = $rowData['image'];
                    $multiple_images = $rowData['multiple_images'];
                    $multiple_images1 = explode(",", $multiple_images);
                    $multiple_images2 = json_encode($multiple_images1);
                    $categorys = explode(",",$rowData['categorys']);
                    $color = $rowData['color'];
                    $qty = $rowData['qty'];
                    $mrp = $rowData['mrp'];
                    $price = $rowData['price'];
                    // $prod_discount = $rowData['prod_discount'];
                    $color_image = $rowData['color_image'];
                    $multiple_attr_images = $rowData['multiple_attr_images'];
                    $multiple_attr_images1 = explode(",", $multiple_attr_images);
                    $multiple_attr_images2 = json_encode($multiple_attr_images1);
                    $specification = $rowData['specifications'];
                    $mst_lables = explode(",",$rowData['labels']);


                    $existingColor = DB::table($colorsTable)
                    ->where('color', $color)
                    ->first();
                    if (!$existingColor) {

                        // If the category doesn't exist, insert it into the 'categories' table and retrieve the ID
                        $colorId = DB::table($colorsTable)->insertGetId(['color' => $color]);
                    } else {
                        // If the category already exists, use the existing ID
                        $colorId = $existingColor->id;
                    }

                    $existingProduct = DB::table($productsTable)
                    ->where('product_code', $product_code)
                    ->first();
                    if (!$existingProduct) {
                        $rowData1['title'] = $title;
                        $rowData1['product_code'] = $product_code;
                        $rowData1['rating'] = $rating;
                        $rowData1['alias'] = $alias;
                        $rowData1['meta_title'] = $meta_title;
                        $rowData1['meta_desc'] = $meta_desc;
                        $rowData1['desc'] = $desc;
                        $rowData1['image'] = $image;
                        $rowData1['multiple_images'] = $multiple_images2;
                        $rowData1['specification'] = $specification;
                        $rowData1['created_at'] = date('Y-m-d H:i:s');
                        // Assuming your table name is 'products'
                        $tableName = 'products';

                        // Insert the row into the 'products' table
                       $pId= DB::table($tableName)->insertGetId($rowData1);

                        if($categorys){
                            foreach($categorys as $category){
                                if(!empty($category)){
                                    $existingCategory = DB::table($categoriesTable)
                                        ->where('category_name', $category)
                                        ->first();

                                    if (!$existingCategory) {
                                        $slug = Str::slug($category, '-');
                                        $count = Category::whereRaw("category_slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
                                        $counts = $count + 1;
                                        $alias1 = $count ? "{$slug}-{$counts}" : $slug;
                                        // If the brand doesn't exist, insert it into the 'brands' table and retrieve the ID
                                        $categoryId = DB::table($categoriesTable)->insertGetId(['category_name' => $category,'category_slug' => $alias1]);
                                    } else {
                                        // If the brand already exists, use the existing ID
                                        $categoryId = $existingCategory->id;
                                    }
                                    $brand=new ProductCategory();
                                    $brand->product_id=$pId;
                                    $brand->category_id=$categoryId;
                                    $brand->created_at=date('Y-m-d H:i:s');
                                    $brand->save();
                                }
                            }
                        }


                        if($mst_lables){
                           foreach($mst_lables as $key=>$val){
                                if(!empty($val)){
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
                    }else{
                        $pId= $existingProduct->id;
                    }

                       $rowData2['products_id'] = $pId;
                       $rowData2['sku'] = $sku;
                       $rowData2['mrp'] = $mrp;
                       $rowData2['price'] = $price;
                       $rowData2['qty'] = $qty;
                       $rowData2['color_id'] = $colorId;
                       $rowData2['color_image'] = $color_image;
                       $rowData2['multiple_images'] = $multiple_attr_images2;
                       $rowData2['created_at'] = date('Y-m-d H:i:s');
                       $tableName2 = 'product_attrs';
                        DB::table($tableName2)->insertGetId($rowData2);



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
