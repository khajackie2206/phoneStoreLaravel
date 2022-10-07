 @extends('admin.main')
 @section('content')
     <main class="content">
         <div class="container-fluid p-0">
             <div class="mb-3">
                 <h1 class="h3 d-inline align-middle">Thêm điện thoại</h1>
                 <a class="badge bg-dark text-white ms-2" href="upgrade-to-pro.html">
                     +
                 </a>
             </div>
             <form action="/admin/product/add" method="POST">
                 <div class="row">
                     <div class="col-12 col-lg-6">
                         <div class="card" style="margin-bottom: 0px;">
                             <div class="card-header" style="margin-bottom: -20px;">
                                 <h5 class="card-title mb-0">Tên điện thoại</h5>
                             </div>
                             <div class="card-body">
                                 <input type="text" class="form-control" placeholder="Tên điện thoại"
                                     name="phone_name">

                             </div>
                             @if($errors->first('phone_name') != '')
                             <ul style="margin-top:5px; list-style-type:none;">
                                <li class="text-danger">{{$errors->first('phone_name')}}</li>
                            </ul>
                            @endif
                             <div class="card-header" style="margin-bottom: -20px;">
                                 <h5 class="card-title mb-0">Giá bán</h5>
                             </div>
                             <div class="card-body">
                                 <input type="text" class="form-control" placeholder="Giá bán" name="price">
                                </div>
                                @if($errors->first('price') != '')
                                <ul style="margin-top:5px;list-style-type:none; ">
                                   <li class="text-danger">{{$errors->first('price')}}</li>
                               </ul>
                               @endif
                             <div class="card-header" style="margin-bottom: -20px;">
                                 <h5 class="card-title mb-0">Số lượng</h5>
                             </div>
                             <div class="card-body">
                                 <input type="text" class="form-control" placeholder="Số lượng" name="quantity">
                             </div>
                             @if($errors->first('quantity') != '')
                             <ul style="margin-top:5px;list-style-type:none; ">
                                <li class="text-danger">{{$errors->first('quantity')}}</li>
                            </ul>
                            @endif
                             <div class="card-header" style="margin-bottom: -20px;">
                                 <h5 class="card-title mb-0">Hãng</h5>
                             </div>
                             <div class="card-body">
                                 <select class="form-select mb-1" name="brands">
                                     @foreach ($brands as $brand)
                                         <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                     @endforeach
                                 </select>
                             </div>
                         </div>
                         <div class="card">

                         </div>
                         <div class="card">
                             <div class="card-header">
                                 <h5 class="card-title mb-0">Mô tả ngắn</h5>
                             </div>
                             <div class="card-body">
                                 <textarea class="form-control" name="short_description" rows="2" placeholder="Nhập mô tả ngắn"></textarea>
                             </div>
                             @if($errors->first('short_description') != '')
                             <ul style="margin-top:5px;list-style-type:none; ">
                                <li class="text-danger">{{$errors->first('short_description')}}</li>
                            </ul>
                            @endif
                         </div>

                         <div class="card">
                             <div class="card-header">
                                 <h5 class="card-title mb-0">Mô tả chi tiết</h5>
                             </div>
                             <div class="card-body">
                                 <textarea class="form-control" id="content" name="description" rows="2" placeholder="mô tả chi tiết"></textarea>
                             </div>
                             @if($errors->first('description') != '')
                             <ul style="margin-top:5px;list-style-type:none; ">
                                <li class="text-danger">{{$errors->first('description')}}</li>
                            </ul>
                            @endif
                         </div>

                         <div class="card">
                             <div class="card-header">
                                 <h5 class="card-title mb-0">Hình ảnh</h5>
                             </div>
                             <div class="card-body">
                                 <label class="form-label">Cover</label>
                                 <input type="file" name="file" class="form-control" id="upload">
                                 <div id="image_show" style="margin-top: 15px;"></div>
                                 <input type="hidden" name="thumb" id="thumb">
                             </div>

                             <div class="card-body">
                                 <label class="form-label">Gallery</label>
                                 <input type="file" name="files[]" class="form-control" id="uploads" multiple>
                                 <div id="images_shows"> </div>
                                 <input type="hidden" name="thumbs" id="thumbs">
                             </div>
                         </div>

                         <div class="card">
                             <div class="card-header">
                                 <h5 class="card-title mb-0">Kích hoạt</h5>
                             </div>
                             <div class="card-body">
                                 <div>
                                     <input class="custom-control-input" value="1" type="radio" id="active"
                                         name="active" checked="true">
                                     <label for="active" class="custom-control-label">Có</label>
                                 </div>
                                 <div>
                                     <input class="custom-control-input" value="0" type="radio" id="no_active"
                                         name="active">
                                     <label for="no_active" class="custom-control-label">Không</label>
                                 </div>
                             </div>
                         </div>

                         <div class="card">
                             <div class="card-header">
                                 <h5 class="card-title mb-0">Khuyến mãi</h5>
                             </div>
                             <div class="card-body">
                                 <input type="text" name="discount" class="form-control"
                                     placeholder="Số tiền giảm giá - VNĐ">
                             </div>
                              @if($errors->first('discount') != '')
                             <ul style="margin-top:5px;list-style-type:none; ">
                                <li class="text-danger">{{$errors->first('discount')}}</li>
                            </ul>
                            @endif
                             <div class="card-header" style="margin-bottom: -20px;">
                                 <h5 class="card-title mb-0">Năm sản xuất</h5>
                             </div>
                             <div class="card-body">
                                 <select class="form-select mb-1" name="year">
                                     <option value="0" selected>Cũ hơn</option>
                                     <option value="2020">2020</option>
                                     <option value="2021">2021</option>
                                     <option value="2022">2022</option>
                                 </select>
                             </div>
                         </div>
                     </div>

                     <div class="col-12 col-lg-6">
                         <div class="card">

                             <div class="card-header" style="margin-bottom: -20px;">
                                 <h5 class="card-title mb-0">Danh mục</h5>
                             </div>
                             <div class="card-body">
                                 <select class="form-select mb-1" name="category">
                                     @foreach ($categories as $category)
                                         <option value="{{ $category->id }}">{{ $category->name }}</option>
                                     @endforeach
                                 </select>
                             </div>
                             <div class="card-header" style="margin-bottom: -20px;">
                                 <h5 class="card-title mb-0">Nhà cung cấp</h5>
                             </div>
                             <div class="card-body">
                                 <select class="form-select mb-1" name="vendor">
                                     @foreach ($vendors as $vendor)
                                         <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                                     @endforeach
                                 </select>
                             </div>
                         </div>

                         <div class="card">
                             <div class="card-header" style="margin-bottom: -20px;">
                                 <h5 class="card-title mb-0">Hệ điều hành</h5>
                             </div>
                             <div class="card-body">
                                 <select class="form-select mb-1" name="os">
                                     <option value="Android" selected>Android</option>
                                     <option value="IOS">IOS</option>
                                     <option value="Normal">Điện thoại phổ thông</option>
                                 </select>
                             </div>
                             <div class="card-header" style="margin-bottom: -20px;">
                                 <h5 class="card-title mb-0">Độ phân giải màn hình</h5>
                             </div>
                             <div class="card-body">
                                 <select class="form-select mb-1" name="resolution">
                                     <option value="4K+" selected>4K+</option>
                                     <option value="Quand HD+">Quad HD+</option>
                                     <option value="Full HD+">Full HD+</option>
                                     <option value="HD+">HD+</option>
                                 </select>
                             </div>
                             <div class="card-header" style="margin-bottom: -20px;">
                                 <h5 class="card-title mb-0">Tấm nền</h5>
                             </div>
                             <div class="card-body">
                                 <select class="form-select mb-1" name="screen">
                                     <option value="Dynamic AMOLED 2X" selected>Dynamic AMOLED 2X</option>
                                     <option value="IPS LCD">IPS LCD</option>
                                     <option value="OLED">OLED</option>
                                 </select>
                             </div>
                             <div class="card-header" style="margin-bottom: -20px;">
                                 <h5 class="card-title mb-0">Kích thước màn hình</h5>
                             </div>
                             <div class="card-body">
                                 <input type="text" name="size" class="form-control"
                                     placeholder="Kích cỡ màn hình - Inch">
                             </div>
                             @if($errors->first('size') != '')
                             <ul style="margin-top:5px;list-style-type:none; ">
                                <li class="text-danger">{{$errors->first('size')}}</li>
                            </ul>
                            @endif
                             <div class="card-header" style="margin-bottom: -20px;">
                                 <h5 class="card-title mb-0">Tần số quét màn hình</h5>
                             </div>
                             <div class="card-body">
                                 <select class="form-select mb-1" name="rate">
                                     <option value="60 Hz" selected>60 Hz</option>
                                     <option value="120 Hz">120 Hz</option>
                                     <option value="144 Hz">144 Hz</option>
                                 </select>
                             </div>
                             <div class="card-header" style="margin-bottom: -25px;">
                                 <h5 class="card-title mb-0">Tính năng</h5>
                             </div>
                             <div class="card-body">
                                 @foreach ($features as $feature)
                                     <label class="form-check form-check-inline">
                                         <input class="form-check-input" name="features[]" type="checkbox"
                                             value="{{ $feature->id }}">
                                         <span class="form-check-label">
                                             {{ $feature->name }}
                                         </span>
                                     </label>
                                 @endforeach
                             </div>
                             @if($errors->first('features') != '')
                             <ul style="margin-top:5px;list-style-type:none; ">
                                <li class="text-danger">{{$errors->first('features')}}</li>
                            </ul>
                            @endif
                             <div class="card-header" style="margin-bottom: -20px;">
                                 <h5 class="card-title mb-0">Bộ xử lý</h5>
                             </div>
                             <div class="card-body">
                                 <input type="text" name="chip" class="form-control" placeholder="Vi xử lý">
                             </div>
                             @if($errors->first('chip') != '')
                             <ul style="margin-top:5px;list-style-type:none; ">
                                <li class="text-danger">{{$errors->first('chip')}}</li>
                            </ul>
                            @endif
                             <div class="card-header" style="margin-bottom: -20px;">
                                 <h5 class="card-title mb-0">Màu</h5>
                             </div>
                             <div class="card-body" style="margin-bottom: -20px;">
                                 <select class="form-select mb-1" name="colors[]" multiple>
                                     @foreach ($colors as $color)
                                         <option value="{{ $color->id }}">{{ $color->name }}</option>
                                     @endforeach
                                 </select>
                             </div>
                             @if($errors->first('colors') != '')
                             <ul style="margin-top:5px;list-style-type:none; ">
                                <li class="text-danger">{{$errors->first('colors')}}</li>
                            </ul>
                            @endif
                             <div class="card-header" style="margin-bottom: -20px; margin-top:15px;">
                                 <h5 class="card-title mb-0">Bộ Nhớ</h5>
                             </div>
                             <div class="card-body" style="margin-bottom: -20px;">
                                 <label class="form-label">Ram</label>
                                 <select class="form-select mb-1" name="ram">
                                     <option value="2" selected>2 GB</option>
                                     <option value="4">4 GB</option>
                                     <option value="6">6 GB</option>
                                     <option value="8">8 GB</option>
                                     <option value="12">12 GB</option>
                                     <option value="16">16 GB</option>
                                 </select>
                             </div>
                             <div class="card-body">
                                 <label class="form-label">Rom</label>
                                 <select class="form-select mb-1" name="rom">
                                     @foreach ($memories as $memory)
                                         <option value="{{ $memory->id }}">{{ $memory->rom }} GB</option>
                                     @endforeach
                                 </select>
                             </div>
                             <div class="card-header" style="margin-bottom: -20px;">
                                 <h5 class="card-title mb-0">Dung lượng pin</h5>
                             </div>
                             <div class="card-body">
                                 <input type="text" name="battery" class="form-control"
                                     placeholder="Dung lượng pin tối đa - mAh">
                             </div>
                             @if($errors->first('battery') != '')
                             <ul style="margin-top:5px;list-style-type:none; ">
                                <li class="text-danger">{{$errors->first('battery')}}</li>
                            </ul>
                            @endif
                             <div class="card-header" style="margin-bottom: -20px;">
                                 <h5 class="card-title mb-0">Camera</h5>
                             </div>
                             <div class="card-body" style="margin-bottom: -20px;">
                                 <label class="form-label">Camera trước</label>
                                 <input type="text" class="form-control" name="front"
                                     placeholder="Độ phân giải camera trước - MP">
                             </div>
                             @if($errors->first('front') != '')
                             <ul style="margin-top:5px;list-style-type:none; ">
                                <li class="text-danger">{{$errors->first('front')}}</li>
                            </ul>
                            @endif
                             <div class="card-body">
                                 <label class="form-label">Camera sau</label>
                                 <input type="text" class="form-control" name="rear"
                                     placeholder="Độ phân giải camera sau - MP">
                             </div>
                             @if($errors->first('rear') != '')
                             <ul style="margin-top:5px;list-style-type:none; ">
                                <li class="text-danger">{{$errors->first('rear')}}</li>
                            </ul>
                            @endif
                         </div>
                     </div>
                 </div>
                 <div class="card-footer" style="text-align: center;">
                     <button type="submit" class="btn btn-primary">Thêm Sản Phẩm</button>
                 </div>
                 @csrf
             </form>
         </div>
     </main>
 @endsection

 @section('footer')
     <script>
         CKEDITOR.replace('content');
     </script>
 @endsection
