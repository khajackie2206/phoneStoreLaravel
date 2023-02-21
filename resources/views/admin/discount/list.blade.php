 @extends('admin.main')
 @section('content')
     <main class="content">
         <div class="container-fluid">

             <div class="mb-3">
                 <h1 class="h3 d-inline align-middle">Danh sách giảm giá</h1>
                 <a class="badge bg-info text-white ms-2" href="/admin/discount/add">
                     Thêm +
                 </a>
             </div>
             <div class="row">
                 <div class="col-md-12 col-xl-12">
                     <div class="card">
                         <div class="card-body h-100">
                             <div class="container ">

                                <table id="example" class="display" width="100%"></table>
                                 <div class="table-responsive">
                                     <table class="table table-responsive table-borderless table-striped">

                                         <thead>
                                             <tr class="bg-warning text-dark" style="text-align: center;">
                                                 <th scope="col" width="5%"># &nbsp;<span><img src="https://cdn-icons-png.flaticon.com/512/6687/6687601.png" width="15px"></th>
                                                 <th scope="col" width="12%">Mã giảm giá &nbsp;<span><img src="https://cdn-icons-png.flaticon.com/512/6687/6687601.png" width="15px"></th>
                                                 <th scope="col" width="10%">Số lượng &nbsp;<span><img src="https://cdn-icons-png.flaticon.com/512/6687/6687601.png" width="15px"></th>
                                                 <th scope="col" width="10%">Loại giảm giá &nbsp;<span><img src="https://cdn-icons-png.flaticon.com/512/6687/6687601.png" width="15px"></th>
                                                  <th scope="col" width="13%">Giá trị &nbsp;<span><img src="https://cdn-icons-png.flaticon.com/512/6687/6687601.png" width="15px"></th>
                                                 <th scope="col" width="15%">Ngày bắt đầu &nbsp;<span><img src="https://cdn-icons-png.flaticon.com/512/6687/6687601.png" width="15px"></th>
                                                 <th scope="col" width="15%">Ngày kết thúc &nbsp;<span><img src="https://cdn-icons-png.flaticon.com/512/6687/6687601.png" width="15px"></th>
                                                 <th scope="col" class="text-center" width="10%"><span>Thao
                                                         tác</span>
                                                 </th>
                                             </tr>
                                         </thead>

                                     </table>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </main>
     <script type="text/javascript">
         $('.show-alert-delete-brand').click(function(event) {
             var form = $(this).closest("form");
             var name = $(this).data("name");
             event.preventDefault();
             swal({
                 title: "Bạn có chắc muốn xóa thương hiệu này không?",
                 icon: "warning",
                 type: "warning",
                 buttons: ["Cancel", "Yes!"],
                 confirmButtonColor: '#3085d6',
                 cancelButtonColor: '#d33',
                 confirmButtonText: 'Đã xóa!'
             }).then((willDelete) => {
                 if (willDelete) {
                      swal({
                         title: 'Thành công!',
                         icon: 'success',
                         text: 'Đã xóa thương hiệu!',
                         type: 'success'
                     }).then(function() {
                         form.submit();
                     });
                 }
             });
         });
     </script>
     <script type="text/javascript">
         $('.show-alert-deactive-brand').click(function(event) {
             var form = $(this).closest("form");
             var name = $(this).data("name");
             event.preventDefault();
             swal({
                 title: "Bạn có chắc muốn hủy kích hoạt thương hiệu này không?",
                 icon: "warning",
                 type: "warning",
                 buttons: ["Cancel", "Yes!"],
                 confirmButtonColor: '#3085d6',
                 cancelButtonColor: '#d33',
                 confirmButtonText: 'Đã hủy kích hoạt!'
             }).then((willDelete) => {
                 if (willDelete) {
                     swal({
                         title: 'Thành công!',
                         icon: 'success',
                         text: 'Đã hủy kích hoạt!',
                         type: 'success'
                     }).then(function() {
                         form.submit();
                     });
                 }
             });
         });
     </script>

     <script type="text/javascript">
         $('.show-alert-active-brand').click(function(event) {
             var form = $(this).closest("form");
             var name = $(this).data("name");
             event.preventDefault();
             //const swal = new SweetAlert2();
             swal({
                 title: "Bạn có chắc muốn kích hoạt thương hiệu này không?",
                 icon: "warning",
                 type: "warning",
                 buttons: ["Cancel", "Yes!"],
                 confirmButtonColor: '#3085d6',
                 cancelButtonColor: '#d33',
                 confirmButtonText: 'Đã kích hoạt!'
             }).then((willDelete) => {
                 if (willDelete) {
                     swal({
                         title: 'Thành công!',
                         icon: 'success',
                         text: 'Đã kích hoạt thương hiệu!',
                         type: 'success'
                     }).then(function() {
                         form.submit();
                     });

                 }
             });
         });
     </script>
     <script>

    var dataSet = '{{$vouchers}}';
    dataSet = dataSet.replace(/&quot;/g, '"');
    //console.log JSON.stringify(dataSet);
    // var dataSet = [["1","srping","JACK","85","500000","2022-11-02 00:00:00","2022-11-10 00:00:00","money","2022-10-23T00:00:00.000000Z","2022-10-24T17:30:51.000000Z"],["2","sprint","KHA","96","10","2022-11-02 00:00:00","2022-11-10 00:00:00","percent","2022-11-10T00:00:00.000000Z","2022-11-08T14:07:22.000000Z"]]
    dataSet = '['+dataSet+']';
    //convert dataSet to array
    dataSet = JSON.parse(dataSet);
    $('#example').DataTable({
        data: dataSet,
        columns: [
            { title: 'Mã giảm giá' },
            { title: 'Số lượng' },
            { title: 'Loại giảm giá' },
            { title: 'Giá trị ' },
            { title: 'Ngày bắt đầu' },
            { title: 'Ngày kết thúc' },
            { title: 'Thao tác' },
            { title: 'Thao tác' },
            { title: 'Thao tác' },
            { title: 'Thao tác' },
        ],

    });
     </script>
 @endsection
