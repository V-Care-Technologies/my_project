<div class="row">
<div class="col-lg-2 col-12 order_1">
                    <div class="image_box">
                        <div class="changable_image_row nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <div class="mini_img_box nav-item" role="presentation">
                                <img src="{{ asset('storage/app/public/media/' . $productData->color_image) }}" class="active" id="green_first-tab" data-bs-toggle="pill" data-bs-target="#green_first" type="button" role="tab" aria-controls="green_first" aria-selected="true" onclick="changeImage('green_first')"/>
                            </div>
                            @if($productData->multiple_images !== null)
                                @php
                                    $i=1;
                                    $multiple_imagesArray = json_decode($productData->multiple_images);
                                @endphp
                        
                                @if(is_array($multiple_imagesArray))
                                    @foreach($multiple_imagesArray as $image1)
                                    <div class="mini_img_box nav-item" role="presentation">
                                    
                                        <img src="{{ asset('storage/app/public/media/'.$image1) }}" class="" id="{{ $i }}-tab" data-bs-toggle="pill" data-bs-target="#{{ $i }}" type="button" role="tab" aria-controls="{{ $i }}" aria-selected="true" onclick="changeImage('{{ $i }}')"/>
                                    </div>
                                    @php $i++; @endphp
                                     @endforeach
                                @endif
                            @endif
                           
                        </div>
                    </div>
                </div>
                <div class="col-lg-10 col-12 order_0">
                    <div class="green_section">
                        <div class="image_box">
                            <div class="tab-content" id="pills-tabContent">
                                <div class="inner_box_image">
                                      <!--<div class="discount_text">-->
                                        <!--<img src="{{ asset('public/front/images/offer_bg.svg') }}" class="offer_bg"> -->
                                      <!--  <div class="main_span">25%<span class="off_text">off</span></div>                            -->
                                      <!--</div>-->
                                    <img src="{{ asset('storage/app/public/media/' . $productData->color_image) }}" class="tab-pane fade show active image-tab" id="green_first" role="tabpanel" />
                               
                                    @if($productData->multiple_images !== null)
                                        @php
                                            $i=1;
                                            $multiple_imagesArray = json_decode($productData->multiple_images);
                                        @endphp
                                
                                        @if(is_array($multiple_imagesArray))
                                            @foreach($multiple_imagesArray as $image1)
                                           
                                                    <img src="{{ asset('storage/app/public/media/'.$image1) }}" class="tab-pane fade image-tab" id="{{ $i }}" role="tabpanel"/>
                                           
                                            @php $i++; @endphp
                                            @endforeach
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                 </div>