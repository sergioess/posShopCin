@extends('layouts.app')

@section('content')

<div class="container">
    <br>
    <br>

    <div id="content-wrapper">
   
        <section id="main" itemscope="" itemtype="https://schema.org/Product">
            <meta itemprop="url" content="http://localhost:81/prestashop/es/art/5-19-today-is-a-good-day-framed-poster.html#/19-dimension-40x60cm">

            <div class="row product-container">
            <div class="col-md-6">
                
                <section class="page-content" id="content">
                    
{{--                      
                        <ul class="product-flags">
                            <li class="product-flag new">Nuevo</li>
                        </ul>  --}}

                    
                        <div class="images-container">
        
                            <div class="producto-covertura">
                                <img class="rounded shadow border border-dark"  src="{{ URL::asset("/storage/img/articulos/$articulo->imagen") }}" alt="{{ $articulo->imagen }}" 
                                    title="{{ $articulo->imagen }}" style="width:100%;" itemprop="image">

                            </div>
                        </div>
                </section>
                
                </div>
                <div class="col-md-6">
                    <p><h3 class="text-center">{{ $articulo->descripcion }}</h3></p>
                    <hr>
                    <div class="product-prices">
                        <div class="h4 ">
                                <span ><strong >Precio Unidad: </strong >  $ {{ number_format($articulo->precio, 0) }}</span>
                        </div>
                        Impuestos incluidos

                    </div>

                    
                    
                        <div id="product-description-short-5" itemprop="description">
                            <p>
                                <span style="font-size:10pt;font-weight:normal;font-style:normal;">
                                    {{--  Descripcion corta  --}}
                                </span>
                            </p>
                        </div>

                        <div >
                
                            <form action="{{ url('/in_shopping_carts') }}" method="POST">
                                
                                {{ csrf_field() }}
                                <input type="hidden" value="{{ $articulo->id }}" id="id" name="articulo_id">
                                <input type="hidden" value="{{ $articulo->referencia }}" id="name" name="name">
                                <input type="hidden" value="{{ $articulo->precio }}" id="price" name="price">
                                <input type="hidden" value="{{ $articulo->medida }}" id="img" name="img">
                                <input type="hidden" value="{{ $articulo->departamento }}" id="slug" name="slug">
                                <input type="hidden" value="1" id="quantity" name="quantity">
                                
                                <input type="hidden" value="0" id="quantity" name="shopp">
                                
                                <section class="product-discounts">
                                </section>

                                <div class="d-inline product-quantity clearfix">
                                    <span class="d-inline"><strong >Cantidad : </strong ></span>

        
                                        
                                            <div class="col-md-auto d-inline">
                                                <select class="form-control-sm "  name="cantidad" id="exampleFormControlSelect1" data-artidcan="{{ $articulo->innshop_id }}">
                                                    @for ($i = 1; $i < 11; $i++)
                                                            <option value="{{$i}}">{{$i}}</option>
                                                    @endfor

                                                </select>
                                            </div> 
                                        
                                        <div class="d-inline">


                                            <button class="btn btn-primary white-text capitalize work" class="tooltip-test" title="Agregar al Carrito">
                                                <h5><i class="fas fa-shopping-cart "></i> Agregar al Carrito</h5>
                                            </button>
                                        </div>
                                                                    

                                    <span id="product-availability">
                                    </span>
        

                                    
                                    <p class="product-minimal-quantity">
                                    </p>
                                    



                                </div>
                
                            </form>
                

                        </div>
            
                        <div class="tabs">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active border border-danger rounded" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">
                                        <strong>Descripción</strong> 
                                    </a>
                                </li>
                                {{--  <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#product-details" role="tab" aria-controls="product-details">Detalles del producto</a>
                                </li>  --}}
                            </ul>

                            <div class="tab-content" id="tab-content">
                            <div class="tab-pane in active" id="description" role="tabpanel">
                            
                                <div class="product-description border border-danger rounded shadow  bg-white">
                                    <p class="mt-2 p-1">
                                        <span  style="font-size:12pt;font-style:normal;">
                                            {{ $articulo->descripcion2 }}
                                        </span>
                                    </p>
                                </div>
                            
                            </div>

 {{--                   
                            <div class="tab-pane fade" id="product-details" data-product="{&quot;id_shop_default&quot;:&quot;1&quot;,&quot;id_manufacturer&quot;:&quot;2&quot;,&quot;id_supplier&quot;:&quot;0&quot;,&quot;reference&quot;:&quot;demo_7&quot;,&quot;is_virtual&quot;:&quot;0&quot;,&quot;delivery_in_stock&quot;:&quot;&quot;,&quot;delivery_out_stock&quot;:&quot;&quot;,&quot;id_category_default&quot;:&quot;9&quot;,&quot;on_sale&quot;:&quot;0&quot;,&quot;online_only&quot;:&quot;0&quot;,&quot;ecotax&quot;:0,&quot;minimal_quantity&quot;:&quot;1&quot;,&quot;low_stock_threshold&quot;:null,&quot;low_stock_alert&quot;:&quot;0&quot;,&quot;price&quot;:&quot;35\u00a0$&quot;,&quot;unity&quot;:&quot;&quot;,&quot;unit_price_ratio&quot;:&quot;0.000000&quot;,&quot;additional_shipping_cost&quot;:&quot;0.00&quot;,&quot;customizable&quot;:&quot;0&quot;,&quot;text_fields&quot;:&quot;0&quot;,&quot;uploadable_files&quot;:&quot;0&quot;,&quot;redirect_type&quot;:&quot;301-category&quot;,&quot;id_type_redirected&quot;:&quot;0&quot;,&quot;available_for_order&quot;:&quot;1&quot;,&quot;available_date&quot;:null,&quot;show_condition&quot;:&quot;0&quot;,&quot;condition&quot;:&quot;new&quot;,&quot;show_price&quot;:&quot;1&quot;,&quot;indexed&quot;:&quot;1&quot;,&quot;visibility&quot;:&quot;both&quot;,&quot;cache_default_attribute&quot;:&quot;19&quot;,&quot;advanced_stock_management&quot;:&quot;0&quot;,&quot;date_add&quot;:&quot;2020-08-31 17:54:39&quot;,&quot;date_upd&quot;:&quot;2020-08-31 17:54:39&quot;,&quot;pack_stock_type&quot;:&quot;3&quot;,&quot;meta_description&quot;:&quot;&quot;,&quot;meta_keywords&quot;:&quot;&quot;,&quot;meta_title&quot;:&quot;&quot;,&quot;link_rewrite&quot;:&quot;today-is-a-good-day-framed-poster&quot;,&quot;name&quot;:&quot;Today is a good day Framed poster&quot;,&quot;description&quot;:&quot;<p><span style=\&quot;font-size:10pt;font-style:normal;\&quot;>The best is yet to come! Give your walls a voice with a framed poster. This aesthethic, optimistic poster will look great in your desk or in an open-space office. Painted wooden frame with passe-partout for more depth.<\/span><\/p>&quot;,&quot;description_short&quot;:&quot;<p><span style=\&quot;font-size:10pt;font-weight:normal;font-style:normal;\&quot;>Printed on rigid paper with matt finish and smooth surface.<\/span><\/p>&quot;,&quot;available_now&quot;:&quot;&quot;,&quot;available_later&quot;:&quot;&quot;,&quot;id&quot;:5,&quot;id_product&quot;:5,&quot;out_of_stock&quot;:2,&quot;new&quot;:1,&quot;id_product_attribute&quot;:19,&quot;quantity_wanted&quot;:4,&quot;extraContent&quot;:[],&quot;allow_oosp&quot;:0,&quot;category&quot;:&quot;art&quot;,&quot;category_name&quot;:&quot;Art&quot;,&quot;link&quot;:&quot;http:\/\/localhost:81\/prestashop\/es\/art\/5-today-is-a-good-day-framed-poster.html&quot;,&quot;attribute_price&quot;:0,&quot;price_tax_exc&quot;:29,&quot;price_without_reduction&quot;:34.51,&quot;reduction&quot;:0,&quot;specific_prices&quot;:[],&quot;quantity&quot;:300,&quot;quantity_all_versions&quot;:900,&quot;id_image&quot;:&quot;es-default&quot;,&quot;features&quot;:[{&quot;name&quot;:&quot;Composition&quot;,&quot;value&quot;:&quot;Matt paper&quot;,&quot;id_feature&quot;:&quot;1&quot;,&quot;position&quot;:&quot;0&quot;}],&quot;attachments&quot;:[],&quot;virtual&quot;:0,&quot;pack&quot;:0,&quot;packItems&quot;:[],&quot;nopackprice&quot;:0,&quot;customization_required&quot;:false,&quot;attributes&quot;:{&quot;3&quot;:{&quot;id_attribute&quot;:&quot;19&quot;,&quot;id_attribute_group&quot;:&quot;3&quot;,&quot;name&quot;:&quot;40x60cm&quot;,&quot;group&quot;:&quot;Dimension&quot;,&quot;reference&quot;:&quot;demo_7&quot;,&quot;ean13&quot;:&quot;&quot;,&quot;isbn&quot;:&quot;&quot;,&quot;upc&quot;:&quot;&quot;}},&quot;rate&quot;:19,&quot;tax_name&quot;:&quot;IVA CO 19%&quot;,&quot;ecotax_rate&quot;:0,&quot;unit_price&quot;:&quot;&quot;,&quot;customizations&quot;:{&quot;fields&quot;:[]},&quot;id_customization&quot;:0,&quot;is_customizable&quot;:false,&quot;show_quantities&quot;:true,&quot;quantity_label&quot;:&quot;Art\u00edculos&quot;,&quot;quantity_discounts&quot;:[],&quot;customer_group_discount&quot;:0,&quot;images&quot;:[{&quot;bySize&quot;:{&quot;small_default&quot;:{&quot;url&quot;:&quot;http:\/\/localhost:81\/prestashop\/5-small_default\/today-is-a-good-day-framed-poster.jpg&quot;,&quot;width&quot;:98,&quot;height&quot;:98},&quot;cart_default&quot;:{&quot;url&quot;:&quot;http:\/\/localhost:81\/prestashop\/5-cart_default\/today-is-a-good-day-framed-poster.jpg&quot;,&quot;width&quot;:125,&quot;height&quot;:125},&quot;home_default&quot;:{&quot;url&quot;:&quot;http:\/\/localhost:81\/prestashop\/5-home_default\/today-is-a-good-day-framed-poster.jpg&quot;,&quot;width&quot;:250,&quot;height&quot;:250},&quot;medium_default&quot;:{&quot;url&quot;:&quot;http:\/\/localhost:81\/prestashop\/5-medium_default\/today-is-a-good-day-framed-poster.jpg&quot;,&quot;width&quot;:452,&quot;height&quot;:452},&quot;large_default&quot;:{&quot;url&quot;:&quot;http:\/\/localhost:81\/prestashop\/5-large_default\/today-is-a-good-day-framed-poster.jpg&quot;,&quot;width&quot;:800,&quot;height&quot;:800}},&quot;small&quot;:{&quot;url&quot;:&quot;http:\/\/localhost:81\/prestashop\/5-small_default\/today-is-a-good-day-framed-poster.jpg&quot;,&quot;width&quot;:98,&quot;height&quot;:98},&quot;medium&quot;:{&quot;url&quot;:&quot;http:\/\/localhost:81\/prestashop\/5-home_default\/today-is-a-good-day-framed-poster.jpg&quot;,&quot;width&quot;:250,&quot;height&quot;:250},&quot;large&quot;:{&quot;url&quot;:&quot;http:\/\/localhost:81\/prestashop\/5-large_default\/today-is-a-good-day-framed-poster.jpg&quot;,&quot;width&quot;:800,&quot;height&quot;:800},&quot;legend&quot;:&quot;Today is a good day Framed poster&quot;,&quot;cover&quot;:&quot;1&quot;,&quot;id_image&quot;:&quot;5&quot;,&quot;position&quot;:&quot;1&quot;,&quot;associatedVariants&quot;:[&quot;19&quot;,&quot;21&quot;,&quot;20&quot;]}],&quot;cover&quot;:{&quot;bySize&quot;:{&quot;small_default&quot;:{&quot;url&quot;:&quot;http:\/\/localhost:81\/prestashop\/5-small_default\/today-is-a-good-day-framed-poster.jpg&quot;,&quot;width&quot;:98,&quot;height&quot;:98},&quot;cart_default&quot;:{&quot;url&quot;:&quot;http:\/\/localhost:81\/prestashop\/5-cart_default\/today-is-a-good-day-framed-poster.jpg&quot;,&quot;width&quot;:125,&quot;height&quot;:125},&quot;home_default&quot;:{&quot;url&quot;:&quot;http:\/\/localhost:81\/prestashop\/5-home_default\/today-is-a-good-day-framed-poster.jpg&quot;,&quot;width&quot;:250,&quot;height&quot;:250},&quot;medium_default&quot;:{&quot;url&quot;:&quot;http:\/\/localhost:81\/prestashop\/5-medium_default\/today-is-a-good-day-framed-poster.jpg&quot;,&quot;width&quot;:452,&quot;height&quot;:452},&quot;large_default&quot;:{&quot;url&quot;:&quot;http:\/\/localhost:81\/prestashop\/5-large_default\/today-is-a-good-day-framed-poster.jpg&quot;,&quot;width&quot;:800,&quot;height&quot;:800}},&quot;small&quot;:{&quot;url&quot;:&quot;http:\/\/localhost:81\/prestashop\/5-small_default\/today-is-a-good-day-framed-poster.jpg&quot;,&quot;width&quot;:98,&quot;height&quot;:98},&quot;medium&quot;:{&quot;url&quot;:&quot;http:\/\/localhost:81\/prestashop\/5-home_default\/today-is-a-good-day-framed-poster.jpg&quot;,&quot;width&quot;:250,&quot;height&quot;:250},&quot;large&quot;:{&quot;url&quot;:&quot;http:\/\/localhost:81\/prestashop\/5-large_default\/today-is-a-good-day-framed-poster.jpg&quot;,&quot;width&quot;:800,&quot;height&quot;:800},&quot;legend&quot;:&quot;Today is a good day Framed poster&quot;,&quot;cover&quot;:&quot;1&quot;,&quot;id_image&quot;:&quot;5&quot;,&quot;position&quot;:&quot;1&quot;,&quot;associatedVariants&quot;:[&quot;19&quot;,&quot;21&quot;,&quot;20&quot;]},&quot;has_discount&quot;:false,&quot;discount_type&quot;:null,&quot;discount_percentage&quot;:null,&quot;discount_percentage_absolute&quot;:null,&quot;discount_amount&quot;:null,&quot;discount_amount_to_display&quot;:null,&quot;price_amount&quot;:34.51,&quot;unit_price_full&quot;:&quot;&quot;,&quot;show_availability&quot;:true,&quot;availability_date&quot;:null,&quot;availability_message&quot;:&quot;&quot;,&quot;availability&quot;:&quot;available&quot;}" role="tabpanel">
  
                                <div class="product-manufacturer">
                                        <a href="http://localhost:81/prestashop/es/brand/2-graphic-corner">
                                    <img src="http://localhost:81/prestashop/img/m/2.jpg" class="img img-thumbnail manufacturer-logo" alt="Graphic Corner">
                                    </a>
                                </div>

                                <div class="product-reference">
                                    <label class="label">Referencia </label>
                                    <span itemprop="sku">demo_7</span>
                                </div>

                                <div class="product-quantities">
                                    <label class="label">En stock</label>
                                    <span data-stock="300" data-allow-oosp="0">300 Artículos</span>
                                </div>

                                <div class="product-out-of-stock">
                                
                                </div>



                                <section class="product-features">
                                    <p class="h6">Ficha técnica</p>
                                    <dl class="data-sheet">
                                            <dt class="name">Composition</dt>
                                    <dd class="value">Matt paper</dd>
                                        </dl>
                                </section>  

                            </div>
--}}
                

                        </div>  

                        {{-- {{ dd($favorito) }} --}}
                        <div class="form-group text-center">
                            <br>
                            <a class="btn btn-outline-primary  btn-block  white-dark"  class="tooltip-test" title="Pedido" href={{ route('categorias.show', $favorito->id) }}">
                                <h5><i class="fas fa-arrow-left "></i> <span class="capitalize">  {{ $favorito->descripcion }} </span></h5>
                            </a>
                        </div>


                        <div  >
                                        
                                            
                            <a class="btn btn-outline-primary  btn-block  white-text capitalize mt-3"  class="tooltip-test" title="Categorias" href="{{ route('categorias.index') }}">
                                <h5><i class="fas fa-arrow-left"></i> Categorias</h5>
                            </a>
                        

                        </div>
                        
                        <div >
                            @if( $articulosCount>0)
        
        
                                <div class="form-group text-center ">
                                    <br>
                                    <a class="btn btn-secondary btn-block  white-dark"  class="tooltip-test" title="Pedido" href="{{url('/carrito')}}">
                                        <h5><i class="fas fa-shopping-cart "></i> <span class="capitalize"> Ver Carrito</span></h5>
                                    </a>
                                </div>
        
                            
                            @endif
                        </div>


                    </div>
                
                    
                </div>
            </div>
                 
        </section>

    </div>

</div>







<br>
<br>
<br>

@endsection
