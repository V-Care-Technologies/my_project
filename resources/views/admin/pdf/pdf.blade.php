



        <table style="width:100%;margin-bottom:20px">
            <tbody>
                <tr>
                    <td colspan="2" style="text-align:center;padding-bottom:20px"><img src="{{asset('public/front/images/'.$settings[0]->logo)}}"></td>                
                </tr> 
                <tr>
                    <td>
                        <h3 class="main-heading" style="font-size: 22px;line-height:16px;font-weight: 600;color: #1F4339;">Details Address</h3>
                    </td>
                    <td>
                        <h3 class="main-heading" style="font-size: 22px;line-height:16px;font-weight: 600;color: #1F4339;">Order Details({{$orders_details[0]->order_number}})</h3>
                    </td>
                </tr>
                <tr>
                    <td style="width:50%;"><span class="mini_heaing" style="color:#000;margin-bottom:2px;">{{$orders_details[0]->name}}({{$orders_details[0]->mobile}}) <br/>{{$orders_details[0]->address}}<br/>{{$orders_details[0]->area}}</br>{{$orders_details[0]->city}}</br>{{$orders_details[0]->country}}</span></td>
                    <td style="width:50%;">
                        <span class="mini_heaing" style="color:#000;margin-bottom:2px;font-weight:400"><span style="font-weight:500;color:#1F4339;padding-right:5px">Order Status:</span>{{$orders_details[0]->orders_status}}</span> <br/>
                        <span class="mini_heaing" style="color:#000;margin-bottom:2px;"><span style="font-weight:500;color:#1F4339;padding-right:5px">Payment Status:</span> {{$orders_details[0]->payment_status}}</span> <br/>
                        <span class="mini_heaing" style="color:#000;margin-bottom:2px;"><span style="font-weight:500;color:#1F4339;padding-right:5px">Payment Type:</span> {{$orders_details[0]->payment_type}}</span> <br/>
                            <?php
                        if($orders_details[0]->payment_id!=''){
                            echo 'Payment ID: '.$orders_details[0]->payment_id;
                        }
                        ?>    
                    </td>
                </tr> 
            </tbody>
        </table> 
        <table class="table order_detail" style="border-collapse: collapse;width: 100%;max-width: 100%;margin-bottom:50px;background-color: transparent;">
            <thead>
              <tr>
                <th style="background-color:#1F4339;color:#fff;padding:8px 15px;border:2px solid #EDEDED;font-weight:500;text-align:left">Product</th>
                <th style="background-color:#1F4339;color:#fff;padding:8px 15px;border:2px solid #EDEDED;font-weight:500;text-align:left">Image</th>
                
                <th style="background-color:#1F4339;color:#fff;padding:8px 15px;border:2px solid #EDEDED;font-weight:500;text-align:left">Color</th>
                <th style="background-color:#1F4339;color:#fff;padding:8px 15px;border:2px solid #EDEDED;font-weight:500;text-align:right;">Price</th>
                <th style="background-color:#1F4339;color:#fff;padding:8px 15px;border:2px solid #EDEDED;font-weight:500;text-align:left">Qty</th>
                <th style="background-color:#1F4339;color:#fff;padding:8px 15px;border:2px solid #EDEDED;font-weight:500;text-align:right">Total</th>
              </tr>
            </thead>
            <tbody>
                 @php 
                 $totalAmt=0;
                 @endphp
                 @foreach($orders_details as $list)
                 @php 
                 $totalAmt=$totalAmt+($list->price*$list->qty);
                 @endphp
                 <tr>
                    <td style="border:2px solid #c9c9c9;padding:8px;text-align:center">{{$list->pname}}</td>
                    <td style="border:2px solid #c9c9c9;padding:8px;text-align:center"><div style="height: 100px;width: 80px;position: relative;"><img src='{{asset('storage/app/public/media/'.$list->color_image)}}' style="position: absolute;top: 0;bottom: 0;left: 0;right: 0;margin: auto;max-width: 100%;max-height: 100%;"/></div></td>
                    
                    <td style="border:2px solid #c9c9c9;padding:8px;text-align:center">{{$list->color}}</td>
                    <td style="border:2px solid #c9c9c9;padding:8px;text-align:right">{{$list->price}}</td>
                    <td style="border:2px solid #c9c9c9;padding:8px;text-align:center">{{$list->qty}}</td>
                    <td style="border:2px solid #c9c9c9;padding:8px;text-align:right">{{$list->price*$list->qty}}</td>
                    <!--<td style="border:2px solid #c9c9c9;padding:8px;text-align:center">{{$totalAmt}}</td>-->
                  </tr>
                  <tr>
                      <td colspan="5"  style="border:2px solid #c9c9c9;padding:8px;text-align:right">Total</td>
                      <td style="border:2px solid #c9c9c9;padding:8px;text-align:right">{{$totalAmt}}</td>
                    </tr>
                 @endforeach
                 <!--<tr>-->
                 <!--   <td colspan="5">&nbsp;</td>-->
                 <!--   <td><b>Total</b></td>-->
                 <!--   <td><b>{{$totalAmt}}</b></td>-->
                 <!-- </tr>-->
                  <?php
                  if($orders_details[0]->coupon_value>0){
                    echo '<tr>
                      <td colspan="5">&nbsp;</td>
                      <td><b>Coupon <span class="coupon_apply_txt">('.$orders_details[0]->coupon_code.')</span></b></td>
                      <td>'.$orders_details[0]->coupon_value.'</td>
                    </tr>';
                    $totalAmt=$totalAmt-$orders_details[0]->coupon_value;
                    echo '<tr>
                      <td colspan="5">&nbsp;</td>
                      <td><b>Final Total</b></td>
                      <td>'.$totalAmt.'</td>
                    </tr>';
                  }
                  
                  
                  ?>
            </tbody>
        </table> 
        <table style="width:100%">
            <tr>
                <td style="text-align:center"><p>CopyRight Text</p></td>
            </tr>
        </table>
