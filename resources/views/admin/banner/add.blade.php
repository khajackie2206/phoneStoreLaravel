 @extends('admin.main')
 @section('content')
     <main class="content">
         <div class="container-fluid p-0">
             <div class="mb-3">
                 <h1 class="h3 d-inline align-middle">Thêm banner mới</h1>
                 <a class="badge bg-dark text-white ms-2" href="upgrade-to-pro.html">
                     +
                 </a>
             </div>
             <form action="/admin/banner/add" method="POST">
                 <div class="row">
                     <div class="col-12 col-lg-6">
                         <div class="card" style="margin-bottom: 0px;">
                             <div class="card-header" style="margin-bottom: -20px;">
                                 <h5 class="card-title mb-0">Tiêu đề</h5>
                             </div>
                             <div class="card-body">
                                 <input type="text" class="form-control" placeholder="Tên tiêu đề banner"
                                     name="header">

                             </div>
                             @if ($errors->first('header') != '')
                                 <ul style="margin-top:-5px; list-style-type:none;">
                                     <li class="text-danger">{{ $errors->first('header') }}
                                    </li>
                                 </ul>

                             @endif
                             <div class="card-header" style="margin-bottom: -20px;">
                                 <h5 class="card-title mb-0">Tên sản phẩm</h5>
                             </div>
                             <div class="card-body">
                                 <input type="text" class="form-control" placeholder="Tên sản phẩm quảng bá" name="product_name">
                             </div>
                             @if ($errors->first('product_name') != '')
                                 <ul style="margin-top:-5px;list-style-type:none; ">
                                     <li class="text-danger">{{ $errors->first('product_name') }}</li>
                                 </ul>
                             @endif
                             <div class="card-header" style="margin-bottom: -20px;">
                                 <h5 class="card-title mb-0">Giá</h5>
                             </div>
                             <div class="card-body">
                                 <input type="text" class="form-control" placeholder="Giá của sản phẩm quảng bá" name="price">
                             </div>
                             @if ($errors->first('price') != '')
                                 <ul style="margin-top:-5px;list-style-type:none; ">
                                     <li class="text-danger">{{ $errors->first('price') }}</li>
                                 </ul>
                             @endif

                         </div>
                         <div class="card">
                         </div>
                         <div class="card">
                             <div class="card-header">
                                 <h5 class="card-title mb-0">Hình ảnh banner</h5>
                             </div>
                             <div class="card-body" style="margin-top: -22px; margin-bottom: 25px;">
                                 <input type="file" name="file" class="form-control" id="upload">
                                 <div id="image_show" style="margin-top: 5px;"></div>
                                 <input type="hidden" name="thumb" id="thumb">

                             </div>
                               @if ($errors->first('thumb') != '')
                                 <ul style="margin-top:-35px;list-style-type:none; ">
                                     <li class="text-danger">{{ $errors->first('thumb') }}</li>
                                 </ul>
                             @endif
                         </div>


                     </div>

                     <div class="col-12 col-lg-6">

                         <div class="card">
                             <div class="card-header" style="margin-bottom: -20px;">
                                 <h5 class="card-title mb-0">Loại banner</h5>
                             </div>
                             <div class="card-body">
                                 <select class="form-select mb-1" name="type_banner">
                                     <option value="header" selected>Tiêu đề</option>
                                     <option value="header static">Tiêu đề Tĩnh</option>
                                     <option value="center static">Giữa Tĩnh</option>
                                     <option value="broadcast">Quảng bá</option>
                                 </select>
                             </div>
                              @if ($errors->first('type_banner') != '')
                                 <ul style="margin-top:5px;list-style-type:none; ">
                                     <li class="text-danger">{{ $errors->first('type_banner') }}</li>
                                 </ul>
                             @endif
                             <div class="card-header">
                                 <h5 class="card-title mb-0">Đường dẫn</h5>
                             </div>
                             <div class="card-body" style="margin-top: -22px;">
                                 <input type="text" name="url" class="form-control"
                                     placeholder="Đường dẫn đến sản phẩm quảng bá">
                             </div>
                             @if ($errors->first('url') != '')
                                 <ul style="margin-top:-5px;list-style-type:none; ">
                                     <li class="text-danger">{{ $errors->first('url') }}</li>
                                 </ul>
                             @endif

                             <div class="card-header">
                                 <h5 class="card-title mb-0">Thứ tự banner</h5>
                             </div>
                             <div class="card-body" style="margin-top: -22px;">
                                 <input type="text" name="order" class="form-control"
                                     placeholder="Thứ tự hiển thị banner">
                             </div>
                             @if ($errors->first('order') != '')
                                 <ul style="margin-top:-5px;list-style-type:none; ">
                                     <li class="text-danger">{{ $errors->first('order') }}</li>
                                 </ul>
                             @endif
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
                     </div>
                 </div>
                 <div class="card-footer" style="text-align: center;">
                     <button type="submit" class="btn btn-primary">Thêm banner</button>
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
