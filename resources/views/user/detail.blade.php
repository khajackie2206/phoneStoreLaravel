@extends('index')
@section('content')
    <div class="container rounded bg-white mt-30 mb-30">
        <form action="/users/update/{{ $user->id }}" role="form" enctype="multipart/form-data" method="POST">
            <input type="hidden" name="_method" value="PUT">
            <div class="row">
                <div class="col-md-4 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        <div id="image_show">
                        <img class="mt-5" style="border-radius: 50%" src="{{ $user->avatar }}" width="250px">
                        </div>
                        <span class="font-weight-bold mt-30">{{ $user->name }}</span>
                        <span class="text-black-50">{{ $user->email }}</span>
                        <span>
                            <input type="file" name="file" class="form-control" id="actual-btn" hidden>
                            <input type="hidden" name="thumb" id="thumb" value="{{ $user->avatar }}">
                            <!--our custom file upload button-->
                            <label
                                style="background-color: #fff;color:#555;width:
                        100px;padding: 0.5rem;font-family: sans-serif;border-radius: 0.1rem;cursor:
                         pointer;margin-top: 1rem; border: 1px solid grey;"
                                for="actual-btn">Chọn ảnh</label>
                    </div>

                </div>
                <div class="col-md-8 border">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Thông tin cá nhân</h4>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6"><label class="labels">Họ và tên</label>
                                <input type="text" name="name" class="form-control" placeholder=""
                                    value="{{ $user->name }}">
                            </div>
                            <div class="col-md-6"><label class="labels">Số điện thoại</label>
                                <input type="text" name="phone" class="form-control" value="{{ $user->phone }}"
                                    placeholder="">
                            </div>
                        </div>
                        <div class="row mt-3">

                            <div class="col-md-6">
                                <label class="labels">Địa chỉ</label>
                                <input type="text" name="address" class="form-control" placeholder=""
                                    value="{{ $user->address }}">
                            </div>

                            <div class="col-md-6">
                                <label class="labels">Tổng số tiền bạn mua</label>
                                {{-- <input type="text" name="address" class="form-control" placeholder="" value="{{ number_format($totalPrice) }} VNĐ" style="color: red;" disabled> --}}
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" value="{{ number_format($totalPrice) }} VNĐ" style="color: red;" disabled>

                                </div>
                            </div>

                            <div class="col-md-12 mt-20 ml-20">
                                <div class="row">
                                    <label class="labels" style="margin-right: ">Giới tính</label>
                                </div>
                                <div class="row">

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio1"
                                            value="male" {{ $user->gender == 'male' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="inlineRadio1">Nam</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio2"
                                            value="female" {{ $user->gender == 'female' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="inlineRadio2">Nữ</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio2"
                                            value="other" {{ $user->gender == 'other' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="inlineRadio2">Khác</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-30 text-center">
                            @csrf
                            <button class="btn btn-primary profile-button" type="submit">Cập nhật thông tin</button>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
    </div>
    </div>
@endsection
