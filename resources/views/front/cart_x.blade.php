  
                                
                                
                                <table class="">
                                <thead>
                                    <tr>
                                        <th>Product</th> 
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach ($list as $data)
                                        <tr id="cart_box{{$data->attr_id}}">
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <span class="product_box mb-0"><img
                                                            src="{{ asset('storage/app/public/media/' . $data->image) }}"
                                                            class="cart_product" /></span>
                                                    <div class="price_name">
                                                        <span>{{ $data->title }}</span>
                                                       {{-- @if ($data->size != '')
                                                            <p class="mb-1 text-start mt-2">SIZE: {{ $data->size }}</p>
                                                        @endif --}}
                                                        @if ($data->color != '')
                                                            <!--<p class="mb-0 text-start">COLOR: {{ $data->color }}</p>-->
                                                        @endif
                                                    </div>

                                                </div>
                                            </td> 
                                            <td class="p-0">
                                                <span class="price">{{ $data->price }} <span class="aed_text">AED</span></span>
                                                <span class="price deleted_price"><del>{{ $data->mrp }} <span class="aed_text">AED</span></del></span>
                                            </td>
                                            <!--<td>-->
                                            <!--    <div class="qty-container">-->
                                            <!--        {{-- <i class="fa fa-minus qty-btn-minus"></i> --}}-->
                                            <!--        <input type="number" id="qty{{ $data->attr_id }}" name="qty"-->
                                            <!--            value="{{ $data->qty }}" class="input-qty"-->
                                            <!--            oninput="validateQty(this)"-->
                                            <!--            onchange="updateQty('{{ $data->pid }}','{{ $data->size }}','{{ $data->color }}','{{ $data->attr_id }}','{{ $data->price }}')" />-->
                                            <!--        {{-- <i class="fa fa-plus qty-btn-plus"></i> --}}-->
                                            <!--    </div>-->
                                            <!--</td>-->
                                            <td>
                                                <div class="qty-container">
                                                    {{-- <i class="fa fa-minus qty-btn-minus"></i> --}}
                                                    <input type="number" id="qty{{ $data->attr_id }}" name="qty"
                                                        value="{{ $data->qty }}" class="input-qty qty{{ $data->attr_id }}"
                                                        oninput="validateQty(this)"
                                                        onchange="updateQty('{{ $data->pid }}','{{ $data->color }}','{{ $data->attr_id }}','{{ $data->price }}')" />
                                                    {{-- <i class="fa fa-plus qty-btn-plus"></i> --}}
                                                </div>
                                            </td>
                                            <td>

                                                <span id="total_price_{{ $data->attr_id }}"  class="price total_price_{{ $data->attr_id }}">
                                                    {{ $data->price * $data->qty }}<span class="aed_text">AED</span>
                                                </span>

                                            </td>
                                            <!--<td><a class="remove" href="javascript:void(0)"-->
                                            <!--        onclick="deleteCartProduct('{{ $data->pid }}','{{ $data->size }}','{{ $data->color }}','{{ $data->attr_id }}')">-->
                                            <!--        <img src="{{ asset('public/front/images/delete_icon.svg') }}" class="pe-3" />-->
                                                    
                                            <!--    </a></td>-->
                                             <td><a class="remove" href="javascript:void(0)"
                                                    onclick="deleteCartProduct('{{ $data->pid }}','{{ $data->color }}','{{ $data->attr_id }}')">
                                                    <img src="{{ asset('public/front/images/delete_icon.svg') }}" class="pe-3" />
                                                    
                                                </a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            </div>
                            <div class="mobile_cart d-lg-none d-md-none d-block">
                                @if (isset($list[0]))
                                 @foreach ($list as $data)
                                <div class="main_cart_row" id="cart_boxx{{$data->attr_id}}">
                                    <div class="img_box">
                                        <span class="product_box mb-0"><img src="{{ asset('storage/app/public/media/' . $data->image) }}" class="cart_product" /></span>
                                    </div>
                                    <div class="name_box">
                                        <span class="product_name">{{ $data->title }}</span>
                                        @if ($data->color != '')
                                        <!--<span  class="color_text">COLOR: {{ $data->color }}</span>-->
                                        @endif
                                        <!--<div class="price_rows">-->
                                        <!--    <div class="price_box"> -->
                                        <!--        <span class="normal_text">MRP</span>-->
                                        <!--    </div>-->
                                        <!--    <div class="price_box">-->
                                        <!--        <span class="normal_text"><del>{{ $data->price }}</del><span class="aed_text">AED</span></span>-->
                                        <!--    </div>-->
                                        <!--</div>-->
                                        <div class="price_rows">
                                            <div class="price_box"> 
                                                <span class="normal_text">Price</span>
                                            </div>
                                            <div class="price_box">
                                                <span class="normal_text price"><del class="pe-2"><span class="aed_text">AED</span> {{ $data->mrp }}</del><span class="aed_text">AED</span> {{ $data->price }}</span>
                                            </div>
                                        </div>
                                        <div class="price_rows">
                                            <div class="price_box"> 
                                                <span class="normal_text">Quantity</span>
                                            </div>
                                            <div class="price_box">
                                                <span class="normal_text"><input type="number" id="qty{{ $data->attr_id }}" name="qty"
                                                        value="{{ $data->qty }}" class="input-qty qtyy{{ $data->attr_id }}"
                                                        oninput="validateQty(this)"
                                                        onchange="updateQtyy('{{ $data->pid }}','{{ $data->color }}','{{ $data->attr_id }}','{{ $data->price }}')" /></span>
                                            </div>
                                        </div>
                                        <div class="price_rows">
                                            <div class="price_box"> 
                                                <span class="normal_text">Subtotal</span>
                                            </div>
                                            <div class="price_box">
                                                <span class="normal_text">
                                                    <span id="total_price_{{ $data->attr_id }}"  class="price total_price_{{ $data->attr_id }}">
                                                        <span class="aed_text">AED</span>
                                                    {{ $data->price * $data->qty }}
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                        <a class="remove mobile_remove" href="javascript:void(0)" onclick="deleteCartProduct('{{ $data->pid }}','{{ $data->color }}','{{ $data->attr_id }}')"> <img src="{{ asset('public/front/images/delete_icon.svg') }}" class="pe-3" /></a>
                                    </div>
                                </div>
                                @endforeach
                                @else
                                    <h3>Your Cart is empty</h3>
                                @endif
                            </div>
                            <div class="footer_btn mt-5 text-center aa-cartbox-summary1">
                                <a href="{{ url('/checkout') }}" class="main-btn"><img
                                        src="{{ asset('public/front/images/checkout.svg') }}" class="pe-3" />Checkout</a>
                            </div>
                        </div>