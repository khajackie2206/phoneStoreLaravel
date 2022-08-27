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
					<div class="row">
						<div class="col-12 col-lg-6">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Tên điện thoại</h5>
								</div>
								<div class="card-body">
									<input type="text" class="form-control" placeholder="Tên điện thoại">
								</div>
							</div>
								<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Giá bán</h5>
								</div>
								<div class="card-body">
									<input type="text" class="form-control" placeholder="Giá bán">
								</div>
							</div>

							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Mô tả chi tiết</h5>
								</div>
								<div class="card-body">
									<textarea class="form-control" id="content" rows="2" placeholder="mô tả chi tiết"></textarea>
								</div>
							</div>

							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Hình ảnh</h5>
								</div>	
								<div class="card-body">
								    <label class="form-label">Cover</label>
									  <input type="file" name="file" class="form-control" id="upload">
								</div>

								<div class="card-body">
								    <label class="form-label">Gallery</label>
									  <input type="file" name="files" class="form-control" id="uploads" multiple>
								</div>
							</div>

							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Kích hoạt</h5>
								</div>
								<div class="card-body">
									<div>
									  <input class="custom-control-input" value="1" type="radio" id="active" name="active" checked="true">
                    <label for="active" class="custom-control-label">Có</label>
									
									</div>
									<div>
										 <input class="custom-control-input" value="0" type="radio" id="no_active" name="active" >
                  						  <label for="no_active" class="custom-control-label">Không</label>
									</div>
								</div>
							</div>
						</div>

						<div class="col-12 col-lg-6">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Năm sản xuất</h5>
								</div>
								<div class="card-body">
			<select class="form-select mb-3">
		 <option selected>Cũ hơn</option>
          <option>2020</option>
          <option>2021</option>
          <option>2022</option>
        </select>


									</div>
							</div>
								<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Số lượng</h5>
								</div>
								<div class="card-body">
										<input type="text" class="form-control" placeholder="Số lượng">
									</div>
							</div>

							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Radios</h5>
								</div>
								<div class="card-body">
									  <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="active" name="active" checked="">
                    <label for="active" class="custom-control-label">Có</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="no_active" name="active" >
                    <label for="no_active" class="custom-control-label">Không</label>
                </div>
									<div>
										<label class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inline-radios-example" value="option1">
            <span class="form-check-label">
              1
            </span>
          </label>
										<label class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inline-radios-example" value="option2">
            <span class="form-check-label">
              2
            </span>
          </label>
										<label class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inline-radios-example" value="option3" disabled>
            <span class="form-check-label">
              3
            </span>
          </label>
									</div>
								</div>
							</div>

							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Selects</h5>
								</div>
								<div class="card-body">
									<select class="form-select mb-3">
          <option selected>Open this select menu</option>
          <option>One</option>
          <option>Two</option>
          <option>Three</option>
        </select>

									<select multiple class="form-control">
          <option>One</option>
          <option>Two</option>
          <option>Three</option>
          <option>Four</option>
        </select>
								</div>
							</div>

							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Disabled</h5>
								</div>
								<div class="card-body">
									<div class="mb-3">
										<label class="form-label">Disabled input</label>
										<input type="text" class="form-control" placeholder="Disabled input" disabled>
									</div>
									<div class="mb-3">
										<label class="form-label">Disabled select menu</label>
										<select class="form-control" disabled>
            <option>Disabled select</option>
          </select>
									</div>
									<label class="form-check">
          <input class="form-check-input" type="checkbox" value="" disabled>
          <span class="form-check-label">
            Can't check this
          </span>
        </label>
								</div>
							</div>
						</div>
					</div>

				</div>
			</main>
		
	@endsection

	@section('footer')
	 <script>
        CKEDITOR.replace('content');
    </script>
	@endsection