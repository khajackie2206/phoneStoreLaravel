@extends('admin.main')
@section('content')
<main class="content">
<div class="container-fluid bg-white mt-30 mb-30">
    <form action="/admin/change-info/{{ $admin->id }}" role="form" enctype="multipart/form-data" method="POST">
        <input type="hidden" name="_method" value="PUT">
        <div class="row">
            <div class="col-md-4 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <div id="image_show">
                        <img class="mt-5 img-xs rounded-circle" src="{{ $admin->avatar }}" width="250px">
                    </div>
                    <span class="font-weight-bold mt-3">{{ $admin->name }}</span>
                    <span class="text-black-50">{{ $admin->email }}</span>
                    <span>
                        <input type="file" name="file" class="form-control" id="actual-btn" hidden>
                        <input type="hidden" name="thumb" id="thumb" value="{{ $admin->avatar }}">
                        <!--our custom file upload button-->
                        <label style="background-color: #fff;color:#555;width:
                        100px;padding: 0.5rem;font-family: sans-serif;border-radius: 0.1rem;cursor:
                         pointer;margin-top: 1rem; border: 1px solid grey;" for="actual-btn">Chọn ảnh</label>
                </div>

            </div>
            <div class="col-md-8 border">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="text-right" style="font-weight: bold;">Thông tin cá nhân</h3>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6"><label class="labels">Email</label>
                            <input type="text" name="name" class="form-control" placeholder=""
                                value="{{ $admin->email }}" disabled>
                        </div>
                        <div class="col-md-6"><label class="labels">Số điện thoại</label>
                            <input type="text" name="phone" class="form-control" value="{{ $admin->phone }}"
                                placeholder="">
                        </div>
                    </div>
                    <div class="row mt-5 mb-6">

                        <div class="col-md-6">
                            <label class="labels">Địa chỉ</label>
                            <input type="text" name="address" class="form-control" placeholder=""
                                value="{{ $admin->address }}">
                        </div>



                          <div class="col-md-6"><label class="labels">Họ và tên</label>
                                <input type="text" name="name" class="form-control" placeholder="" value="{{ $admin->name }}">
                            </div>


                        <div class="col-md-12 mt-20 ml-20">
                            {{-- <div class="row">
                                <label class="labels" style="margin-right: ">Giới tính</label>
                            </div>
                            <div class="row">

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="inlineRadio1"
                                        value="male" {{ $admin->gender == 'male' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineRadio1">Nam</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="inlineRadio2"
                                        value="female" {{ $admin->gender == 'female' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineRadio2">Nữ</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="inlineRadio2"
                                        value="other" {{ $admin->gender == 'other' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineRadio2">Khác</label>
                                </div>
                            </div> --}}
                        </div>
                    </div>

                    <div class="mt-60 text-center">
                        @csrf
                        <button class="btn btn-primary profile-button" type="submit">Cập nhật thông tin</button>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>
</main>
@endsection
