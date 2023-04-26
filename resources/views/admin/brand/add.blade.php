 @extends('admin.main')
 @section('content')
     <main class="content">
         <div class="container-fluid p-0">
             <div class="mb-3">
                 <h1 class="h3 d-inline align-middle">Thêm thương hiệu mới</h1>
             </div>
             <form action="/admin/brand/add" method="POST" onsubmit="return ValidationEvent()">
                 <div class="row">
                     <div class="col-12 col-lg-6">
                         <div class="card" style="padding-top: -2px;">
                             <div class="card-header">
                                 <h5 class="card-title mb-0">Tên</h5>
                             </div>
                             <div class="card-body" style="margin-top: -20px; ">
                                 <input type="text" class="form-control" placeholder="Tên thương hiệu" name="name">
                                 <p class="name_alert" style="color:red;margin-top:5px; margin-bottom:-20px; height: 20px;"></p>
                             </div>
                             @if ($errors->first('name') != '')
                                 <ul style="margin-top:-45px;list-style-type:none; ">
                                     <li class="text-danger">{{ $errors->first('name') }}</li>
                                 </ul>
                             @endif

                             <div class="card-header" style="padding-top:20px; ">
                                <h5 class="card-title mb-0">Hình ảnh thương hiệu</h5>
                            </div>
                            <div class="card-body" style="margin-top: -20px;padding-bottom: 60px;">
                                <input type="file" name="file" class="form-control" id="upload">
                                <p class="file_alert" style="color:red;margin-top:5px; margin-bottom:-20px; height: 20px;"></p>
                                <div id="image_show" style="margin-top: 15px; height: 50px;"></div>
                                <input type="hidden" name="image" id="thumb">

                            </div>
                            @if ($errors->first('image') != '')
                            <ul style="margin-top:-60px;list-style-type:none; ">
                                <li class="text-danger">{{ $errors->first('image') }}</li>
                            </ul>
                            @endif

                         </div>



                     </div>

                     <div class="col-12 col-lg-6">

                         <div class="card">

                             <div class="card-header">
                                 <h5 class="card-title mb-0">Mô tả</h5>
                             </div>
                             <div class="card-body" style="margin-top: -22px;">
                                 <input type="text" id="description" name="description" class="form-control"
                                     placeholder="Thêm mô tả....">
                                <p class="description_alert" style="color:red;margin-top:5px; margin-bottom:-20px; height: 20px;"></p>
                             </div>
                             @if ($errors->first('description') != '')
                                 <ul style="margin-top:-5px;list-style-type:none; ">
                                     <li class="text-danger">{{ $errors->first('description') }}</li>
                                 </ul>
                             @endif

                             <div class="card-header">
                                 <h5 class="card-title mb-0">Quốc gia</h5>
                             </div>
                             <div class="card-body" style="margin-top: -22px;">
                                 <input type="text" name="country" class="form-control"
                                     placeholder="Tên quốc gia của thương hiệu">
                                <p class="country_alert" style="color:red;margin-top:5px; margin-bottom:-20px; height: 20px;"></p>
                             </div>
                             @if ($errors->first('country') != '')
                                 <ul style="margin-top:-5px;list-style-type:none; ">
                                     <li class="text-danger">{{ $errors->first('country') }}</li>
                                 </ul>
                             @endif
                             <div class="card-header">
                                        <h5 class="card-title mb-0">Kích hoạt</h5>
                                    </div>
                                    <div class="card-body" style="margin-top: -20px;">
                                        <div>
                                            <input class="custom-control-input" value="1" type="radio" id="active" name="active" checked="true">
                                            <label for="active" class="custom-control-label">Có</label>
                                        </div>
                                        <div>
                                            <input class="custom-control-input" value="0" type="radio" id="no_active" name="active">
                                            <label for="no_active" class="custom-control-label">Không</label>
                                        </div>
                                    </div>
                         </div>

                     </div>
                 </div>
                 <div class="card-footer" style="text-align: center;">
                     <button type="submit" class="btn btn-primary">Thêm thương hiệu</button>
                 </div>
                 @csrf
             </form>
         </div>
     </main>
 @endsection
<script>
    function ValidationEvent() {
        let check = true;
        var name = document.getElementsByName("name")[0];
        var description = document.getElementById("description").value;
        var country = document.getElementsByName("country")[0];
        //get file from upload id
        var file = document.getElementById("upload").files[0];

        if (name.value == "") { //innerHTML for getElementsByTagName for note
          document.getElementsByClassName("name_alert")[0].innerHTML="Tên không được để trống" ;
          check=false;
        } else {
            document.getElementsByClassName("name_alert")[0].innerHTML="" ;
        }

        if (country.value == "") { //innerHTML for getElementsByTagName for note
          document.getElementsByClassName("country_alert")[0].innerHTML="Tên quốc gia không được để trống" ;
          check=false;
        } else {
            document.getElementsByClassName("country_alert")[0].innerHTML="" ;
        }

        //validate short description
        if (description == "") {
          document.getElementsByClassName("description_alert")[0].innerHTML="Mô tả không được để trống" ;
          check=false;
        } else {
            document.getElementsByClassName("description_alert")[0].innerHTML="" ;
        }

        if (file == null) {
          document.getElementsByClassName("file_alert")[0].innerHTML="Hình ảnh thương hiệu không được để trống" ;
          check=false;
        } else {
            document.getElementsByClassName("file_alert")[0].innerHTML="" ;
        }

        return check;
    }
</script>
