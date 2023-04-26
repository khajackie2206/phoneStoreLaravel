@extends('admin.main')
@section('content')
<main class="content">
    <div class="container-fluid p-0">
        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Cập nhật thông tin danh mục</h1>
        </div>
        <form action="/admin/categories/edit/{{$category->id}}" method="POST" onsubmit="return ValidationEvent()">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Tên danh mục</h5>
                        </div>
                        <div class="card-body" style="margin-top: -22px;">
                            <textarea id="name" rows="7" class="form-control" name="name">{{ $category->name}}</textarea>
                            <p class="name_alert" style="color:red;margin-top: 5px; height: 20px;"></p>
                        </div>
                        <!-- select -->

                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="card">
                        <!-- select -->
                        <div class="card-header">
                            <h5 class="card-title mb-0">Mô tả danh mục</h5>
                        </div>
                        <div class="card-body" style="margin-top: -22px;">
                            <textarea class="form-control" rows="7" id="description" name="description">{{ $category->description }}</textarea>
                            <p class="description_alert" style="color:red;margin-top: 5px; height: 20px;"></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer" style="text-align: center;">
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </div>
            @csrf
        </form>
    </div>
</main>

<script>
    //validation event for form submit
    function ValidationEvent() {
    // Storing Field Values In Variables
    let check = true;
    var name = document.getElementById("name").value;
    var description = document.getElementById("description").value;

    if (name == "") { //innerHTML for getElementsByTagName for note
      document.getElementsByClassName("name_alert")[0].innerHTML="Tên không được để trống" ;
      check=false;
    } else {
      document.getElementsByClassName("name_alert")[0].innerHTML="" ;
    }

    if (description == "") { //innerHTML for getElementsByTagName for note
      document.getElementsByClassName("description_alert")[0].innerHTML="Mô tả không được để trống" ;
      check=false;
    } else {
      document.getElementsByClassName("description_alert")[0].innerHTML="" ;
    }

    return check;
}
</script>
@endsection
