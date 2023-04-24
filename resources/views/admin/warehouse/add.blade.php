@extends('admin.main')
@section('content')
<main class="content">
    <div class="container-fluid p-0">
        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Thêm phiếu nhập mới</h1>
        </div>
        <form class="form repeater-default" action="/admin/warehouses/add" method="POST" onsubmit="return ValidationEvent()">
            @csrf
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Người lập phiếu</h5>
                        </div>
                        <div class="card-body" style="margin-top: -20px;">
                            <input type="text" class="form-control" placeholder="{{ $user->name}}" value="{{ $user->name}}" disabled>
                        </div>

                        <div class="card-header" style="margin-top: 20px;">
                            <h5 class="card-title mb-0">Nhà cung cấp</h5>
                        </div>
                        <div class="card-body" style="margin-top: -20px;">
                          <select class="form-select mb-1" name="supplier">
                            @foreach ($suppliers as $value)
                                  <option value="{{$value->id}}" selected>{{ $value->name}}</option>
                            @endforeach

                        </select>

                        </div>

                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Ghi chú</h5>
                        </div>
                        <div class="card-body" style="margin-top: -22px; ">
                            <textarea class="form-control" name="note" rows="6"
                                placeholder="Nhập mô tả ngắn"></textarea>
                                <p class="note_alert" style="color:red;margin-top:15px;height: 20px; margin-bottom: -10px;"></p>
                        </div>


                    </div>
                </div>

            </div>
            <div class="row">
                <div class="card" data-repeater-list="group_product">
                    <div class="row" data-repeater-item>
                        <div class="col-md-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Sản phẩm</h5>
                            </div>
                            <div class="card-body" style="margin-top: -22px;">
                                <select class="form-select mb-1" name="product">
                                    @foreach ($products as $value)
                                          <option value="{{$value->id}}" selected>{{ $value->name}} {{ $value->ram }} - {{ $value->rom}} - {{ $value->color}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="col-md-3">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Số lượng</h5>
                            </div>
                            <div class="card-body" style="margin-top: -22px;">
                               <input class="quantity_input" type="text" class="form-control" placeholder="" name="quantity">
                               <p class="quantity_alert" style="color:red;margin-top:15px;height: 20px;"></p>
                            </div>


                        </div>
                        <div class="col-md-3">
                            <div class="card-header">
                                <h5 class="card-title mb-0" >Giá nhập</h5>
                            </div>
                            <div class="card-body" style="margin-top: -22px;">
                               <input class="price_input" type="text" class="form-control" placeholder="" name="price">
                               <p class="price_alert" style="color:red;margin-top:15px;height: 20px;"></p>
                            </div>

                        </div>
                        <div class="col-md-2">
                            <div class="card-header">
                            </div>
                            <div class="card-body">
                              <button type="button" style="margin-top: -5px;" class="btn btn-danger" data-repeater-delete>Xóa</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer" style="text-align: center;">
                <button type="button" style="margin-right: 15px;" class="btn btn-success" data-repeater-create>Thêm sản phẩm</a>
                <button type="submit" class="btn btn-primary">Thêm phiếu nhập</button>
            </div>

        </form>

    </div>
</main>

<script>
    $('.repeater-default').repeater({
  show: function () {
    $(this).slideDown();
  },
  hide: function (deleteElement) {
    if (confirm('Bạn có chắc muốn xóa sản phẩm này không?')) {
      $(this).slideUp(deleteElement);
    }
  }
});
</script>
<script>
     //validation event for form submit
        function ValidationEvent() {
        let check = true;
        // Storing Field Values In Variables
        var prices = document.getElementsByClassName("price_input");
        //for loop for prices array
        for (var i = 0; i < prices.length; i++) {
            //if price is empty then check is false
            if (prices[i].value == "") {
                //innerHTML for getElementsByTagName for quantity
                document.getElementsByClassName("price_alert")[i].innerHTML = "Giá nhập không được để trống";
                check = false;
                break;
            } else {
                //innerHTML for getElementsByTagName for quantity
                document.getElementsByClassName("price_alert")[i].innerHTML = "";
            }
            //if price is not a number then check is false
            if (isNaN(prices[i].value)) {
                //innerHTML for getElementsByTagName for quantity
                document.getElementsByClassName("price_alert")[i].innerHTML = "Giá nhập không hợp lệ";
                check = false;
                break;
            } else
            {
                document.getElementsByClassName("price_alert")[i].innerHTML = "";
            }
        }
        var quantities = document.getElementsByClassName("quantity_input");
        //for loop for quantities array
        for (var i = 0; i < quantities.length; i++) {
            //if quantity is empty then check is false
            if (quantities[i].value == "") {
                //innerHTML for getElementsByTagName for quantity
                document.getElementsByClassName("quantity_alert")[i].innerHTML = "Số lượng không được để trống";
                check = false;
                break;
            } else {
                //innerHTML for getElementsByTagName for quantity
                document.getElementsByClassName("quantity_alert")[i].innerHTML = "";
            }
            //if quantity is not a number then check is false
            if (isNaN(quantities[i].value)) {
                //innerHTML for getElementsByTagName for quantity
                document.getElementsByClassName("quantity_alert")[i].innerHTML = "Số lượng không hợp lệ";
                break;
            } else {
                document.getElementsByClassName("quantity_alert")[i].innerHTML = "";
            }
        }

        //get element by name note
        var note = document.getElementsByName("note")[0];
        //if note is empty or less  than 10 characters then check is false
        if (note.value == "" || note.value.length < 10) {
            //innerHTML for getElementsByTagName for note
            document.getElementsByClassName("note_alert")[0].innerHTML = "Ghi chú không được để trống và phải lớn hơn 10 ký tự";
            check = false;
        } else
        {
            document.getElementsByClassName("note_alert")[0].innerHTML = "";
        }

        return check;
        }
</script>
@endsection


