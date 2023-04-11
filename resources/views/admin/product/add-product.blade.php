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
        <form action="/admin/product/add" method="POST" onsubmit="return ValidationEvent()">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="card" style="margin-bottom: 0px;">
                        <div class="card-header" style="margin-bottom: -20px;">
                            <h5 class="card-title mb-0">Tên điện thoại</h5>
                        </div>
                        <div class="card-body">
                            <input type="text" class="form-control" placeholder="Tên điện thoại" name="phone_name">
                            <p class="phone_name_alert"
                                style="color:red;margin-top:5px; margin-bottom:-20px; height: 20px;"></p>
                        </div>
                        @if($errors->first('phone_name') != '')
                        <ul style="margin-top:-5px; list-style-type:none;">
                            <li class="text-danger">{{$errors->first('phone_name')}}</li>
                        </ul>
                        @endif
                        <div class="card-header" style="margin-bottom: -20px;">
                            <h5 class="card-title mb-0">Giá bán</h5>
                        </div>
                        <div class="card-body">
                            <input type="text" class="form-control" placeholder="Giá bán" name="price">
                            <p class="price_alert" style="color:red;margin-top:5px; margin-bottom:-20px; height: 20px;">
                            </p>
                        </div>
                        @if($errors->first('price') != '')
                        <ul style="margin-top:-5px;list-style-type:none; ">
                            <li class="text-danger">{{$errors->first('price')}}</li>
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

                        <div class="card-header">
                            <h5 class="card-title mb-0">Mô tả ngắn</h5>
                        </div>
                        <div class="card-body" style="margin-top: -22px;">
                            <textarea id="short_description" class="form-control" name="short_description" rows="2"
                                placeholder="Nhập mô tả ngắn"></textarea>
                            <p class="short_alert" style="color:red;margin-top:5px; margin-bottom:-10px; height: 20px;">
                            </p>
                        </div>
                        @if($errors->first('short_description') != '')
                        <ul style="margin-top:-5px;list-style-type:none; ">
                            <li class="text-danger">{{$errors->first('short_description')}}</li>
                        </ul>
                        @endif
                        <div class="card-header">
                            <h5 class="card-title mb-0">Mô tả chi tiết</h5>
                        </div>
                        <div class="card-body" style="margin-top: -10px;">
                            <textarea id="description" class="form-control ckeditor" name="description" rows="2"
                                placeholder="mô tả chi tiết"></textarea>
                            <p class="description_alert"
                                style="color:red;margin-top:5px; margin-bottom:-10px; height: 20px;"></p>
                        </div>
                        @if($errors->first('description') != '')
                        <ul style="margin-top:-5px;list-style-type:none; ">
                            <li class="text-danger">{{$errors->first('description')}}</li>
                        </ul>
                        @endif

                        <div class="card-header">
                            <h5 class="card-title mb-0">Hình ảnh</h5>
                        </div>
                        <div class="card-body" style="margin-top: -12px;">
                            <label class="form-label">Cover</label>
                            <input type="file" name="file" class="form-control" id="upload">
                            <p class="file_alert" style="color:red;margin-top:5px; margin-bottom:-10px; height: 20px;">
                            </p>
                            <div id="image_show" style="margin-top: 5px;height: 80px;"></div>
                            <input type="hidden" name="thumb" id="thumb">
                        </div>

                        <div class="card-body" style="margin-top: -22px;">
                            <label class="form-label">Gallery</label>
                            <input type="file" name="files[]" class="form-control" id="uploads" multiple>
                            <p class="files_alert" style="color:red;margin-top:5px; margin-bottom:-10px; height: 20px;">
                            </p>
                            <div id="image_shows" style="margin-top: 10px;height: 50px;"> </div>
                            <input type="hidden" name="thumbs" id="thumbs">
                        </div>
                    </div>


                    <div class="card">

                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Kích hoạt</h5>
                        </div>
                        <div class="card-body" style="margin-top: -22px;">
                            <div>
                                <input class="custom-control-input" value="1" type="radio" id="active" name="active"
                                    checked="true">
                                <label for="active" class="custom-control-label">Có</label>
                            </div>
                            <div>
                                <input class="custom-control-input" value="0" type="radio" id="no_active" name="active">
                                <label for="no_active" class="custom-control-label">Không</label>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Khuyến mãi</h5>
                        </div>
                        <div class="card-body" style="margin-top: -22px;">
                            <input type="text" name="discount" class="form-control"
                                placeholder="Số tiền giảm giá - VNĐ">
                            <p class="discount_alert"
                                style="color:red;margin-top:5px; margin-bottom:-20px; height: 20px;"></p>
                        </div>
                        @if($errors->first('discount') != '')
                        <ul style="margin-top:-5px;list-style-type:none; ">
                            <li class="text-danger">{{$errors->first('discount')}}</li>
                        </ul>
                        @endif
                        <div class="card-header" style="margin-bottom: -15px;">
                            <h5 class="card-title mb-0">Năm sản xuất</h5>
                        </div>
                        <div class="card-body">
                            <select class="form-select mb-1" name="year">
                                <option value="2023" selected>2023</option>
                                <option value="2020">2022</option>
                                <option value="2021">2021</option>
                                <option value="2022">Cũ hơn</option>
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
                        {{-- <div class="card-header" style="margin-bottom: -20px;">
                            <h5 class="card-title mb-0">Nhà cung cấp</h5>
                        </div>
                        <div class="card-body">
                            <select class="form-select mb-1" name="vendor">
                                @foreach ($vendors as $vendor)
                                <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                                @endforeach
                            </select>
                        </div> --}}



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
                        <div class="card-header" style="margin-top:10px;margin-bottom: -20px;">
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
                        <div class="card-header" style="margin-top:15px;margin-bottom: -20px;">
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

                            <p class="size_alert" style="color:red;margin-top:5px; margin-bottom:-10px; height: 20px;">
                            </p>

                        </div>
                        @if($errors->first('size') != '')
                        <ul style="margin-top:-5px;list-style-type:none; ">
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
                        <div class="card-header" style="margin-top:10px;margin-bottom: -25px;">
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
                            <p class="features_alert"
                                style="color:red;margin-top:5px; margin-bottom:-20px; height: 20px;"></p>
                        </div>
                        @if($errors->first('features') != '')
                        <ul style="margin-top:-5px;list-style-type:none; ">
                            <li class="text-danger">{{$errors->first('features')}}</li>
                        </ul>
                        @endif
                        <div class="card-header" style="margin-top:15px;margin-bottom: -20px;">
                            <h5 class="card-title mb-0">Bộ xử lý</h5>
                        </div>
                        <div class="card-body">
                            <input type="text" name="chip" class="form-control" placeholder="Vi xử lý">
                            <p class="chip_alert" style="color:red;margin-top:5px; margin-bottom:-10px; height: 20px;">
                            </p>
                        </div>

                        @if($errors->first('chip') != '')
                        <ul style="margin-top:-5px;list-style-type:none; ">
                            <li class="text-danger">{{$errors->first('chip')}}</li>
                        </ul>
                        @endif
                        <div class="card-header" style="margin-bottom: -20px;">
                            <h5 class="card-title mb-0">Màu</h5>
                        </div>

                        <div class="card-body">
                            <input type="text" name="color" class="form-control" placeholder="Màu sắc điện thoại">
                            <p class="color_alert" style="color:red;margin-top:5px; margin-bottom:-10px; height: 20px;">
                            </p>
                        </div>

                        @if($errors->first('color') != '')
                        <ul style="margin-top:-5px;list-style-type:none; ">
                            <li class="text-danger">{{$errors->first('color')}}</li>
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
                                <option value="32 GB" selected>32 GB</option>
                                <option value="64 GB">64 GB</option>
                                <option value="128 GB">128 GB</option>
                                <option value="256 GB">256 GB</option>
                                <option value="512 GB">512 GB</option>
                                <option value="1 TB">1 TB</option>
                            </select>
                        </div>
                        <div class="card-header" style="margin-bottom: -20px;">
                            <h5 class="card-title mb-0">Dung lượng pin</h5>
                        </div>
                        <div class="card-body">
                            <input type="text" name="battery" class="form-control"
                                placeholder="Dung lượng pin tối đa - mAh">
                            <p class="battery_alert"
                                style="color:red;margin-top:5px; margin-bottom:-10px; height: 20px;"></p>
                        </div>
                        @if($errors->first('battery') != '')
                        <ul style="margin-top:-5px;list-style-type:none; ">
                            <li class="text-danger">{{$errors->first('battery')}}</li>
                        </ul>
                        @endif
                        <div class="card-header" style="margin-bottom: -20px;">
                            <h5 class="card-title mb-0">Camera</h5>
                        </div>
                        <div class="card-body" style="margin-bottom: -10px;">
                            <label class="form-label">Camera trước</label>
                            <input type="text" class="form-control" name="front"
                                placeholder="Độ phân giải camera trước - MP">
                            <p class="front_alert" style="color:red;margin-top:5px; margin-bottom:-10px; height: 20px;">
                            </p>
                        </div>
                        @if($errors->first('front') != '')
                        <ul style="margin-top: 15px;list-style-type:none; ">
                            <li class="text-danger">{{$errors->first('front')}}</li>
                        </ul>
                        @endif
                        <div class="card-body">
                            <label class="form-label">Camera sau</label>
                            <input type="text" class="form-control" name="rear"
                                placeholder="Độ phân giải camera sau - MP">
                            <p class="rear_alert" style="color:red;margin-top:5px; margin-bottom:-10px; height: 20px;">
                            </p>
                        </div>
                        @if($errors->first('rear') != '')
                        <ul style="margin-top:-5px;list-style-type:none; ">
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

<script>
    function ValidationEvent() {
        let check = true;
        var name = document.getElementsByName("phone_name")[0];
        var price = document.getElementsByName("price")[0];
        var short_description = document.getElementById("short_description").value;
        var description = CKEDITOR.instances['description'].getData();
        var discount = document.getElementsByName("discount")[0] ?? 0;
        var size = document.getElementsByName("size")[0];
        var features = document.getElementsByName("features[]");
        var chip = document.getElementsByName("chip")[0];
        var color = document.getElementsByName("color")[0];
        var battery = document.getElementsByName("battery")[0];
        var front = document.getElementsByName("front")[0];
        var rear = document.getElementsByName("rear")[0];
        //get file from upload id
        var file = document.getElementById("upload").files[0];

        //get files from uploads id
        var files = document.getElementById("uploads").files;


        if (name.value == "" || name.value.length < 10) { //innerHTML for getElementsByTagName for note
          document.getElementsByClassName("phone_name_alert")[0].innerHTML="Tên không được để trống và phải lớn hơn 10 ký tự" ;
          check=false;
        } else {
            document.getElementsByClassName("phone_name_alert")[0].innerHTML="" ;
        }

        //validate price must be number and greater than 0
        if (isNaN(price.value) || price.value <= 0) {
          document.getElementsByClassName("price_alert")[0].innerHTML="Giá không hợp lệ" ;
          check=false;
        } else {
            document.getElementsByClassName("price_alert")[0].innerHTML="" ;
        }

        //validate short description
        if (short_description == "" || short_description.length < 10) {

          document.getElementsByClassName("short_alert")[0].innerHTML="Mô tả ngắn không được để trống và phải lớn hơn 10 ký tự" ;
          check=false;
        } else {
            document.getElementsByClassName("short_alert")[0].innerHTML="" ;
        }

        //validate description
        if (description == "" || description.length < 10) {
            console.log('description: ', description);
          document.getElementsByClassName("description_alert")[0].innerHTML="Mô tả không được để trống và phải lớn hơn 10 ký tự" ;
          check=false;
        } else {
            document.getElementsByClassName("description_alert")[0].innerHTML="" ;
        }

        if (file == null) {
          document.getElementsByClassName("file_alert")[0].innerHTML="Hình ảnh cover không được để trống" ;
          check=false;
        } else {
            document.getElementsByClassName("file_alert")[0].innerHTML="" ;
        }

        //validate files must be exist at least 1 files
        if (files.length == 0) {
          document.getElementsByClassName("files_alert")[0].innerHTML="Hình ảnh gallery không được để trống" ;
          check=false;
        } else {
            document.getElementsByClassName("files_alert")[0].innerHTML="" ;
        }


        //validate discount must be less than price
        if (discount.value > price.value) {
            console.log('discount: ', discount.value);
            console.log('price: ', price.value);
          document.getElementsByClassName("discount_alert")[0].innerHTML="Giảm giá không được lớn hơn giá" ;
          check=false;
        } else {
            document.getElementsByClassName("discount_alert")[0].innerHTML="" ;
        }


        //validate size
        if (isNaN(size.value) || size.value <= 0) {
          document.getElementsByClassName("size_alert")[0].innerHTML="Kích thước màn hình không hợp lệ" ;
          check=false;
        } else {
            document.getElementsByClassName("size_alert")[0].innerHTML="" ;
        }


        //validate features must be checked at least 1
        var count = 0;
        for (var i = 0; i < features.length; i++) {
            if (features[i].checked) {
                count++;
            }
        }
        if (count == 0) {
          document.getElementsByClassName("features_alert")[0].innerHTML="Vui lòng chọn ít nhất 1 tính năng" ;
          check=false;
        } else {
            document.getElementsByClassName("features_alert")[0].innerHTML="" ;
        }

        //validate chip
        if (chip.value == "") {
          document.getElementsByClassName("chip_alert")[0].innerHTML="Chip xử lý không được để trống" ;
          check=false;
        } else {
            document.getElementsByClassName("chip_alert")[0].innerHTML="" ;
        }

        //validate color
        if (color.value == "") {
          document.getElementsByClassName("color_alert")[0].innerHTML="Màu sắc không được để trống" ;
          check=false;
        } else {
            document.getElementsByClassName("color_alert")[0].innerHTML="" ;
        }

        //validate battery
        if (isNaN(battery.value) || battery.value <= 0) {
          document.getElementsByClassName("battery_alert")[0].innerHTML="Dung lượng pin không hợp lệ" ;
          check=false;
        } else {
            document.getElementsByClassName("battery_alert")[0].innerHTML="" ;
        }

        //validate front must not be null
        if (front.value == "") {
          document.getElementsByClassName("front_alert")[0].innerHTML="Độ phân giải camera trước không được để trống" ;
          check=false;
        } else {
            document.getElementsByClassName("front_alert")[0].innerHTML="" ;
        }

        //validate rear must not be null
        if (rear.value == "") {
          document.getElementsByClassName("rear_alert")[0].innerHTML="Độ phân giải camera sau không được để trống" ;
          check=false;
        } else {
            document.getElementsByClassName("rear_alert")[0].innerHTML="" ;
        }


        return check;
    }
</script>
@endsection
