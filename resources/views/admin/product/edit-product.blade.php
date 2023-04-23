@extends('admin.main')
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <div class="mb-3">
                <h1 class="h3 d-inline align-middle">Cập nhật điện thoại <span
                        style="font-weight:bold;">{{ $product->name }} </span></h1>
            </div>
            <form action="/admin/product/edit/{{ $product->id }}" method="POST" onsubmit="return ValidationEvent()">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="card" style="margin-bottom: 0px;">
                            <div class="card-header" style="margin-bottom: -20px;">
                                <h5 class="card-title mb-0">Tên điện thoại</h5>
                            </div>
                            <div class="card-body">
                                <input type="text" class="form-control" placeholder="Tên điện thoại" name="phone_name"
                                    value="{{ $product->name }}">
                                <p class="phone_name_alert" style="color:red;margin-top:5px; margin-bottom:-20px; height: 20px;"></p>
                            </div>
                            <div class="card-header" style="margin-top: 10px;margin-bottom: -20px;">
                                <h5 class="card-title mb-0">Giá bán</h5>
                            </div>
                            <div class="card-body">
                                <input type="text" class="form-control" placeholder="Giá bán" name="price"
                                    value="{{ $product->price }}">
                                <p class="price_alert" style="color:red;margin-top:5px; margin-bottom:-20px; height: 20px;">
                                </p>
                            </div>
                            <div class="card-header" style="margin-top:10px;margin-bottom: -20px;">
                                <h5 class="card-title mb-0">Số lượng</h5>
                            </div>
                            <div class="card-body">
                                <input type="text" class="form-control" placeholder="Số lượng" name="quantity" disabled value="{{ $product->quantity}}">
                            </div>
                            <div class="card-header" style="margin-top: 20px;margin-bottom: -20px;">
                                <h5 class="card-title mb-0">Hãng</h5>
                            </div>
                            <div class="card-body">
                                <select class="form-select mb-1" name="brands">
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}"
                                            {{ $product->brand_id == $brand->id ? 'selected' : '' }}>{{ $brand->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="card-header" style="margin-top: 20px;">
                                    <h5 class="card-title mb-0">Mô tả ngắn</h5>
                                </div>
                                <div class="card-body">
                                    <textarea id="short_description" class="form-control" name="short_description" rows="4"
                                        placeholder="Nhập mô tả ngắn">{{ $product->short_description }}</textarea>
                                    <p class="short_alert" style="color:red;margin-top:5px; margin-bottom:-10px; height: 20px;">
                             </div>

                             <div class="card-header">
                                <h5 class="card-title mb-0">Mô tả chi tiết</h5>
                            </div>
                            <div class="card-body">
                                <textarea id="description" class="form-control ckeditor" name="description" rows="2"
                                    placeholder="mô tả chi tiết">{{ $product->description }}</textarea>
                                <p class="description_alert" style="color:red;margin-top:5px; margin-bottom:-10px; height: 20px;"></p>
                            </div>

                            <div class="card-header">
                                <h5 class="card-title mb-0">Hình ảnh</h5>
                            </div>
                            <div class="card-body">
                                <label class="form-label">Cover</label>
                                <input type="file" name="file" class="form-control" id="upload">
                                <p class="file_alert" style="color:red;margin-top:5px; margin-bottom:-10px; height: 20px;">
                                <div id="image_show" style="margin-top: 15px;">
                                    <img src="{{ $product->images->where('type', 'cover')->first()['url'] }}" width="100px" alt="">
                                </div>
                                <input type="hidden" name="thumb" id="thumb" value="{{ $product->images->where('type', 'cover')->first()['url'] }}">
                            </div>
                            <?php $pathCompletely = []; ?>
                            @foreach ($product->images->where('type', 'gallery') as $gallery)
                            <?php
                                                            array_push($pathCompletely, $gallery->url);
                                                            ?>
                            @endforeach

                            <?php $arrayPath = json_encode($pathCompletely); ?>

                            <div class="card-body">
                                <label class="form-label">Gallery</label>
                                <input type="file" name="files[]" class="form-control" id="uploads" multiple>
                                <p class="files_alert" style="color:red;margin-top:5px; margin-bottom:-10px; height: 20px;">
                                <div id="image_shows" style="margin-top: 15px;">
                                    @foreach ($product->images->where('type', 'gallery') as $image )
                                    <img src="{{$image->url}}" width="100px" alt="" style="margin-right: 5px;">
                                    @endforeach
                                </div>
                                {{-- {{ dd(json_decode($arrayPath))}} --}}

                                <input type="hidden" name="thumbs" id="thumbs" value="{{ $arrayPath }}">
                            </div>

                            <div class="card-header">
                                <h5 class="card-title mb-0">Kích hoạt</h5>
                            </div>
                            <div class="card-body">
                                <div>
                                    <input class="custom-control-input" value="1" type="radio" id="active" name="active" {{ $product->active === 1 ?
                                    'checked="true"' : '' }}>
                                    <label for="active" class="custom-control-label">Có</label>
                                </div>
                                <div>
                                    <input class="custom-control-input" value="0" type="radio" id="no_active" name="active" {{ $product->active ===
                                    0 ? 'checked="true"' : '' }}>
                                    <label for="no_active" class="custom-control-label">Không</label>
                                </div>
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
                                        <option value="{{ $category->id }}"
                                            {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="card-header" style="margin-bottom: -20px;">
                                <h5 class="card-title mb-0">Hệ điều hành</h5>
                            </div>
                            <div class="card-body">
                                <select class="form-select mb-1" name="os">
                                    <option value="Android" {{ $product->os == 'Android' ? 'selected' : '' }}>Android
                                    </option>
                                    <option value="IOS" {{ $product->os == 'IOS' ? 'selected' : '' }}>IOS</option>
                                    <option value="Normal" {{ $product->os == 'Normal' ? 'selected' : '' }}>Điện thoại
                                        phổ thông</option>
                                </select>
                            </div>
                            <div class="card-header" style="margin-bottom: -20px;">
                                <h5 class="card-title mb-0">Độ phân giải màn hình</h5>
                            </div>
                            <div class="card-body">
                                <select class="form-select mb-1" name="resolution">
                                    <option value="4K+" {{ $product->resolution == '4K+' ? 'selected' : '' }}>4K+
                                    </option>
                                    <option value="Quad HD+" {{ $product->resolution == 'Quad HD+' ? 'selected' : '' }}>
                                        Quad HD+</option>
                                    <option value="Full HD+" {{ $product->resolution == 'Full HD+' ? 'selected' : '' }}>
                                        Full HD+</option>
                                    <option value="HD+" {{ $product->resolution == 'HD+' ? 'selected' : '' }}>HD+
                                    </option>
                                </select>
                            </div>
                            <div class="card-header" style="margin-bottom: -20px;">
                                <h5 class="card-title mb-0">Tấm nền</h5>
                            </div>
                            <div class="card-body">
                                <select class="form-select mb-1" name="screen">
                                    <option value="Dynamic AMOLED"
                                        {{ $product->display_tech == 'Dynamic AMOLED' ? 'selected' : '' }}>Dynamic AMOLED</option>
                                    <option value="Super AMOLED" {{ $product->display_tech == 'AMOLED' ? 'selected' : '' }}>Super AMOLED</option>
                                    <option value="IPS LCD" {{ $product->display_tech == 'IPS LCD' ? 'selected' : '' }}>
                                        IPS LCD</option>
                                    <option value="OLED" {{ $product->display_tech == 'OLED' ? 'selected' : '' }}>OLED
                                    </option>
                                    <option value="TFT" {{ $product->display_tech == 'TFT' ? 'selected' : '' }}>TFT
                                    </option>
                                    <option value="N/A" {{ $product->display_tech == 'N/A' ? 'selected' : '' }}>N/A
                                    </option>
                                </select>
                            </div>
                            <div class="card-header" style="margin-bottom: -20px;">
                                <h5 class="card-title mb-0">Kích thước màn hình</h5>
                            </div>
                            <div class="card-body">
                                <input type="text" name="size" class="form-control" value="{{ $product->size }}"
                                    placeholder="Kích cỡ màn hình - Inch">
                                    <p class="size_alert" style="color:red;margin-top:5px; margin-bottom:-10px; height: 20px;">
                                    </p>
                            </div>
                            <div class="card-header" style="margin-bottom: -20px;">
                                <h5 class="card-title mb-0">Tần số quét màn hình</h5>
                            </div>
                            <div class="card-body">
                                <select class="form-select mb-1" name="rate">
                                    <option value="N/A" {{ $product->screen_rate == 'N/A' ? 'selected' : '' }}>N/A
                                    </option>
                                    <option value="60 Hz" {{ $product->screen_rate == '60 Hz' ? 'selected' : '' }}>60 Hz
                                    </option>
                                    <option value="120 Hz" {{ $product->screen_rate == '120 Hz' ? 'selected' : '' }}>120
                                        Hz</option>
                                    <option value="144 Hz" {{ $product->screen_rate == '144 Hz' ? 'selected' : '' }}>144
                                        Hz</option>
                                    <option value="165 Hz" {{ $product->screen_rate == '165 Hz' ? 'selected' : '' }}>165
                                        Hz</option>
                                </select>
                            </div>
                            <div class="card-header" style="margin-bottom: -25px;">
                                <h5 class="card-title mb-0">Tính năng</h5>
                            </div>
                            <div class="card-body">
                                @foreach ($features as $feature)
                                    <label class="form-check form-check-inline">

                                        <input class="form-check-input" name="features[]" type="checkbox"
                                            value="{{ $feature->id }}"
                                            @foreach ($product->features as $productFeature)
                                                {{ $productFeature->id == $feature->id ? 'checked' : '' }} @endforeach>
                                        <span class="form-check-label">
                                            {{ $feature->name }}
                                        </span>
                                    </label>
                                @endforeach
                                <p class="features_alert" style="color:red;margin-top:5px; margin-bottom:-20px; height: 20px;"></p>
                            </div>
                            <div class="card-header" style="margin-bottom: -20px;">
                                <h5 class="card-title mb-0">Bộ xử lý</h5>
                            </div>
                            <div class="card-body">
                                <input type="text" name="chip" value="{{ $product->cpu }}" class="form-control"
                                    placeholder="Vi xử lý">
                                <p class="chip_alert" style="color:red;margin-top:5px; margin-bottom:-10px; height: 20px;">
                            </div>
                            <div class="card-header" style="margin-bottom: -20px;">
                                <h5 class="card-title mb-0">Màu</h5>
                            </div>
                            <div class="card-body" style="margin-bottom: -20px;">

                                <input type="text" value="{{ $product->color }}" name="color" class="form-control"
                                    placeholder="Màu sắc điện thoại">
                                <p class="color_alert" style="color:red;margin-top:5px; margin-bottom:-10px; height: 20px;">
                                </p>
                            </div>
                            <div class="card-header" style="margin-bottom: -20px; margin-top:15px;">
                                <h5 class="card-title mb-0">Bộ Nhớ</h5>
                            </div>
                            <div class="card-body" style="margin-bottom: -20px;">
                                <label class="form-label">Ram</label>
                                <select class="form-select mb-1" name="ram">
                                    <option value="N/A" {{ $product->ram == 'N/A' ? 'selected' : '' }}>N/A</option>
                                    <option value="2 GB" {{ $product->ram == '2 GB' ? 'selected' : '' }}>2 GB</option>
                                    <option value="4 GB" {{ $product->ram == '4 GB' ? 'selected' : '' }}>4 GB</option>
                                    <option value="6 GB" {{ $product->ram == '6 GB' ? 'selected' : '' }}>6 GB</option>
                                    <option value="8 GB" {{ $product->ram == '8 GB' ? 'selected' : '' }}>8 GB</option>
                                    <option value="12 GB" {{ $product->ram == '12 GB' ? 'selected' : '' }}>12 GB</option>
                                    <option value="16 GB" {{ $product->ram == '16 GB' ? 'selected' : '' }}>16 GB</option>
                                    <option value="32 GB" {{ $product->ram == '32 GB' ? 'selected' : '' }}>32 GB</option>
                                </select>
                            </div>
                            <div class="card-body">
                                <label class="form-label">Rom</label>
                                <select class="form-select mb-1" name="rom">
                                    <option value="N/A" {{ $product->rom == 'N/A' ? 'selected' : '' }}>N/A</option>
                                    <option value="1 GB" {{ $product->rom == '1 GB' ? 'selected' : '' }}>1 GB</option>
                                    <option value="2 GB" {{ $product->rom == '2 GB' ? 'selected' : '' }}>2 GB</option>
                                    <option value="4 GB" {{ $product->rom == '4 GB' ? 'selected' : '' }}>4 GB</option>
                                    <option value="8 GB" {{ $product->rom == '8 GB' ? 'selected' : '' }}>8 GB</option>
                                    <option value="16 GB" {{ $product->rom == '16 GB' ? 'selected' : '' }}>16 GB</option>
                                    <option value="32 GB" {{ $product->rom == '32 GB' ? 'selected' : '' }}>32 GB</option>
                                    <option value="64 GB" {{ $product->rom == '64 GB' ? 'selected' : '' }}>64 GB</option>
                                    <option value="128 GB" {{ $product->rom == '128 GB' ? 'selected' : '' }}>128 GB
                                    </option>
                                    <option value="256 GB" {{ $product->rom == '256 GB' ? 'selected' : '' }}>256 GB
                                    </option>
                                    <option value="512 GB" {{ $product->rom == '512 GB' ? 'selected' : '' }}>512 GB
                                    </option>
                                    <option value="1 TB" {{ $product->rom == '1 TB' ? 'selected' : '' }}>1 TB</option>
                                </select>
                            </div>
                            <div class="card-header" style="margin-bottom: -20px;">
                                <h5 class="card-title mb-0">Dung lượng pin</h5>
                            </div>
                            <div class="card-body">
                                <input type="text" name="battery" class="form-control"
                                    placeholder="Dung lượng pin tối đa - mAh" value="{{ $product->battery }}">

                                <p class="battery_alert" style="color:red;margin-top:5px; margin-bottom:-10px; height: 20px;"></p>
                            </div>
                            <div class="card-header" style="margin-bottom: -20px;">
                                <h5 class="card-title mb-0">Camera</h5>
                            </div>
                            <div class="card-body" style="margin-bottom: -20px;">
                                <label class="form-label">Camera trước</label>
                                <input type="text" class="form-control" name="front"
                                    placeholder="Độ phân giải camera trước - MP" value="{{ $product->font_cam }}">
                                <p class="front_alert" style="color:red;margin-top:5px; margin-bottom:-10px; height: 20px;">
                                </p>
                            </div>
                            <div class="card-body">
                                <label class="form-label">Camera sau</label>
                                <input type="text" class="form-control" name="rear"
                                    placeholder="Độ phân giải camera sau - MP" value="{{ $product->rear_cam }}">
                                <p class="rear_alert" style="color:red;margin-top:5px; margin-bottom:-10px; height: 20px;">
                                </p>
                            </div>

                            <div class="card-header">
                                <h5 class="card-title mb-0">Khuyến mãi</h5>
                            </div>
                            <div class="card-body">
                                <input type="text" name="discount" value="{{ $product->discount }}" class="form-control"
                                    placeholder="Số tiền giảm giá - VNĐ">
                                <p class="discount_alert" style="color:red;margin-top:5px; margin-bottom:-20px; height: 20px;"></p>
                            </div>
                            <div class="card-header" style="margin-bottom: -20px;">
                                <h5 class="card-title mb-0">Năm sản xuất</h5>
                            </div>
                            <div class="card-body">
                                <select class="form-select mb-1" name="year">
                                    <option value="0" {{ $product->year == 0 ? 'selected' : '' }}>Cũ hơn</option>
                                    <option value="2020" {{ $product->year == 2020 ? 'selected' : '' }}>2020</option>
                                    <option value="2021" {{ $product->year == 2021 ? 'selected' : '' }}>2021</option>
                                    <option value="2022" {{ $product->year == 2022 ? 'selected' : '' }}>2022</option>
                                    <option value="2023" {{ $product->year == 2023 ? 'selected' : '' }}>2023</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer" style="text-align: center; margin-top: 25px;">
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
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
        // //get file path from thumb id
        // var thumb = document.getElementById("thumb").value;
        // //get file path from thumbs id
        // var thumbs = document.getElementById("thumbs").value;

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

        // if (!thumb) {
        //   document.getElementsByClassName("thumb_alert")[0].innerHTML="Hình ảnh đại diện không được để trống" ;
        //   check=false;
        // } else {
        //     document.getElementsByClassName("thumb_alert")[0].innerHTML="" ;
        // }

        // //validate files must be exist
        // if (!thumbs) {
        //   document.getElementsByClassName("thumbs_alert")[0].innerHTML="Hình ảnh chi tiết không được để trống" ;
        //   check=false;
        // } else {
        //     document.getElementsByClassName("thumbs_alert")[0].innerHTML="" ;
        // }


        //validate discount must be less than price
        if (parseInt(discount.value) > parseInt(price.value)) {
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
