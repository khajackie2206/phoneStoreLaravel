@extends('admin.main')
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <div class="mb-3">
                <h1 class="h3 d-inline align-middle">Cập nhật điện thoại <span
                        style="font-weight:bold;">{{ $product->name }} </span></h1>
            </div>
            <form action="/admin/product/edit/{{ $product->id}}" method="POST">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="card" style="margin-bottom: 0px;">
                            <div class="card-header" style="margin-bottom: -20px;">
                                <h5 class="card-title mb-0">Tên điện thoại</h5>
                            </div>
                            <div class="card-body">
                                <input type="text" class="form-control" placeholder="Tên điện thoại" name="phone_name"
                                    value="{{ $product->name }}">
                            </div>
                            <div class="card-header" style="margin-bottom: -20px;">
                                <h5 class="card-title mb-0">Giá bán</h5>
                            </div>
                            <div class="card-body">
                                <input type="text" class="form-control" placeholder="Giá bán" name="price"
                                    value="{{ $product->price }}">
                            </div>
                            <div class="card-header" style="margin-bottom: -20px;">
                                <h5 class="card-title mb-0">Số lượng</h5>
                            </div>
                            <div class="card-body">
                                <input type="text" class="form-control" placeholder="Số lượng" name="quantity"
                                    value="{{ $product->quantity }}">
                            </div>
                            <div class="card-header" style="margin-bottom: -20px;">
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
                        </div>
                        <div class="card">

                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Mô tả ngắn</h5>
                            </div>
                            <div class="card-body">
                                <textarea class="form-control" name="short_description" rows="4" placeholder="Nhập mô tả ngắn">{{ $product->short_description }}</textarea>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Mô tả chi tiết</h5>
                            </div>
                            <div class="card-body">
                                <textarea class="form-control" id="content" name="description" rows="2" placeholder="mô tả chi tiết">{{ $product->description }}</textarea>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Hình ảnh</h5>
                            </div>
                            <div class="card-body">
                                <label class="form-label">Cover</label>
                                <input type="file" name="file" class="form-control" id="upload">
                                <div id="image_show" style="margin-top: 15px;">
                                    <img src="{{ $product->images->where('type', 'cover')->first()['url'] }}" width="100px"
                                        alt="">
                                </div>
                                <input type="hidden" name="thumb" id="thumb" value="{{ $product->images->where('type', 'cover')->first()['url'] }}">
                            </div>
                             <?php $pathCompletely = [] ?>
                            @foreach ($product->images->where('type', 'gallery') as $gallery)
                                  <?php
                                      array_push($pathCompletely, $gallery->url)
                                  ?>

                            @endforeach

                            <?php  $arrayPath = json_encode($pathCompletely) ?>

                            <div class="card-body">
                                <label class="form-label">Gallery</label>
                                <input type="file" name="files[]" class="form-control" id="uploads" multiple>
                                <div id="images_shows"> </div>
                                <input type="hidden" name="thumbs" id="thumbs" value="{{ $arrayPath}}">
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Kích hoạt</h5>
                            </div>
                            <div class="card-body">
                                <div>
                                    <input class="custom-control-input" value="1" type="radio" id="active"
                                        name="active" {{ $product->active = 1 ? 'checked="true"' : '' }}>
                                    <label for="active" class="custom-control-label">Có</label>
                                </div>
                                <div>
                                    <input class="custom-control-input" value="0" type="radio" id="no_active"
                                        name="active" {{ $product->active = 0 ? 'checked="true"' : '' }}>
                                    <label for="no_active" class="custom-control-label">Không</label>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Khuyến mãi</h5>
                            </div>
                            <div class="card-body">
                                <input type="text" name="discount" value="{{ $product->discount }}"
                                    class="form-control" placeholder="Số tiền giảm giá - VNĐ">
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
                                    <option value="2023" {{ $product->year == 2023 ? 'selected' : '' }}>2022</option>
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
                                        <option value="{{ $category->id }}"
                                            {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="card-header" style="margin-bottom: -20px;">
                                <h5 class="card-title mb-0">Nhà cung cấp</h5>
                            </div>
                            <div class="card-body">
                                <select class="form-select mb-1" name="vendor">
                                    @foreach ($vendors as $vendor)
                                        <option value="{{ $vendor->id }}"
                                            {{ $product->vendor_id == $vendor->id ? 'selected' : '' }}>{{ $vendor->name }}
                                        </option>
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
                                    <option value="Dynamic AMOLED 2X"
                                        {{ $product->display_tech == 'Dynamic AMOLED 2X' ? 'selected' : '' }}>Dynamic
                                        AMOLED 2X</option>
                                    <option value="AMOLED" {{ $product->display_tech == 'AMOLED' ? 'selected' : '' }}>
                                        AMOLED</option>
                                    <option value="IPS LCD" {{ $product->display_tech == 'IPS LCD' ? 'selected' : '' }}>
                                        IPS LCD</option>
                                    <option value="OLED" {{ $product->display_tech == 'OLED' ? 'selected' : '' }}>OLED
                                    </option>
                                    <option value="TFT" {{ $product->display_tech == 'TFT' ? 'selected' : '' }}>TFT
                                    </option>
                                </select>
                            </div>
                            <div class="card-header" style="margin-bottom: -20px;">
                                <h5 class="card-title mb-0">Kích thước màn hình</h5>
                            </div>
                            <div class="card-body">
                                <input type="text" name="size" class="form-control" value="{{ $product->size }}"
                                    placeholder="Kích cỡ màn hình - Inch">
                            </div>
                            <div class="card-header" style="margin-bottom: -20px;">
                                <h5 class="card-title mb-0">Tần số quét màn hình</h5>
                            </div>
                            <div class="card-body">
                                <select class="form-select mb-1" name="rate">
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
                            </div>
                            <div class="card-header" style="margin-bottom: -20px;">
                                <h5 class="card-title mb-0">Bộ xử lý</h5>
                            </div>
                            <div class="card-body">
                                <input type="text" name="chip" value="{{ $product->cpu }}" class="form-control"
                                    placeholder="Vi xử lý">
                            </div>
                            <div class="card-header" style="margin-bottom: -20px;">
                                <h5 class="card-title mb-0">Màu</h5>
                            </div>
                            <div class="card-body" style="margin-bottom: -20px;">

                                 <input type="text" value="{{$product->color}}" name="color" class="form-control"
                                     placeholder="Màu sắc điện thoại">
                            </div>
                            <div class="card-header" style="margin-bottom: -20px; margin-top:15px;">
                                <h5 class="card-title mb-0">Bộ Nhớ</h5>
                            </div>
                            <div class="card-body" style="margin-bottom: -20px;">
                                <label class="form-label">Ram</label>
                                <select class="form-select mb-1" name="ram">
                                    <option value="2" {{ $product->ram == '2' ? 'selected' : '' }}>2 GB</option>
                                    <option value="4" {{ $product->ram == '4' ? 'selected' : '' }}>4 GB</option>
                                    <option value="6" {{ $product->ram == '6' ? 'selected' : '' }}>6 GB</option>
                                    <option value="8" {{ $product->ram == '8' ? 'selected' : '' }}>8 GB</option>
                                    <option value="12" {{ $product->ram == '12' ? 'selected' : '' }}>12 GB</option>
                                    <option value="16" {{ $product->ram == '16' ? 'selected' : '' }}>16 GB</option>
                                </select>
                            </div>
                            <div class="card-body">
                                <label class="form-label">Rom</label>
                                <select class="form-select mb-1" name="rom">
                                    @foreach ($memories as $memory)
                                        <option value="{{ $memory->id }}"
                                            @foreach ($product->memories as $productMemory)
                                             {{ $productMemory->id == $memory->id ? 'selected' : '' }} @endforeach>
                                            {{ $memory->rom }} GB</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="card-header" style="margin-bottom: -20px;">
                                <h5 class="card-title mb-0">Dung lượng pin</h5>
                            </div>
                            <div class="card-body">
                                <input type="text" name="battery" class="form-control"
                                    placeholder="Dung lượng pin tối đa - mAh" value="{{ $product->battery}}">
                            </div>
                            <div class="card-header" style="margin-bottom: -20px;">
                                <h5 class="card-title mb-0">Camera</h5>
                            </div>
                            <div class="card-body" style="margin-bottom: -20px;">
                                <label class="form-label">Camera trước</label>
                                <input type="text" class="form-control" name="front"
                                    placeholder="Độ phân giải camera trước - MP" value="{{$product->font_cam}}">
                            </div>
                            <div class="card-body">
                                <label class="form-label">Camera sau</label>
                                <input type="text" class="form-control" name="rear"
                                    placeholder="Độ phân giải camera sau - MP" value="{{$product->rear_cam}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer" style="text-align: center;">
                    <button type="submit" class="btn btn-primary">Cập nhật Sản Phẩm</button>
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
