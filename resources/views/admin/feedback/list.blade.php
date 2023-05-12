@extends('admin.main')

@section('content')
<main class="content">
    <div class="container-fluid">

        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Phản hồi về đơn hàng</h1>
        </div>
        <div class="row">
            <div class="col-md-12 col-xl-12">
                <div class="card">
                    <div class="card-body h-100">
                        <div class="container ">
                            {{-- <div class="mb-2 d-flex justify-content-between align-items-center">
                                <div class="position-relative" style="margin-bottom: 20px;">
                                    <span class="position-absolute" style="top: 6px; left: 10px;"><i
                                            class="fa fa-search"></i></span>
                                    <input class="form-control w-100" style="text-indent: 17px;"
                                        placeholder="Tìm kiếm theo tên, mã sản phẩm...">
                                </div>


                            </div> --}}
                            <table class="table table-responsive table-borderless table-striped" id="feedback-table"
                                style="padding-top: 20px;">

                                <thead>
                                    <tr class="bg-warning text-dark" style="text-align: center;">
                                        <th scope="col" width="18%">Tên khách hàng</th>
                                        <th scope="col" width="12%">Đơn hàng</th>
                                        <th scope="col" width="15%">Mức độ hài lòng</th>
                                        <th scope="col" width="30%">Nội dung phản hồi</th>
                                        <th scope="col" width="15%">Thời gian phản hồi</th>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach ($comments as $comment)
                                    <tr style="text-align: center;">
                                        <td>{{ $comment->id }}</td>
                                        <td>{{ $comment->user->name }}</td>
                                        <td style="font-weight: bold;">{{ $comment->product->name }}
                                            {{ $comment->product->rom }}</td>
                                        <td> <span class="g-color-gray-dark-v4 g-font-size-12">
                                                <div class="small-ratings">
                                                    <i
                                                        class="fa fa-star {{ $comment->rating >= 1 ? 'rating-color' : '' }}"></i>
                                                    <i
                                                        class="fa fa-star {{ $comment->rating >= 2 ? 'rating-color' : '' }}"></i>
                                                    <i
                                                        class="fa fa-star {{ $comment->rating >= 3 ? 'rating-color' : '' }}"></i>
                                                    <i
                                                        class="fa fa-star {{ $comment->rating >= 4 ? 'rating-color' : '' }}"></i>
                                                    <i
                                                        class="fa fa-star {{ $comment->rating >= 5 ? 'rating-color' : '' }}"></i>
                                                </div>
                                            </span></td>
                                        <td>{{ $comment->comment }} </td>
                                        <td> <i class="fa fa-check-circle-o green"></i><span class="ms-1">
                                                @if ($comment->status == 0)
                                                <span class="badge bg-danger">Chờ duyệt</span>
                                                @else
                                                <span class="badge bg-success">Đã duyệt</span>
                                                @endif
                                            </span></td>

                                        <td style="text-align: left;">
                                            @if ($comment->status == 0)
                                            <form method="post"
                                                style="display:inline!important; margin-left:20px; margin-right: 7px;"
                                                action="/admin/comments/censorship/{{ $comment->id }}?status=1">
                                                @csrf
                                                <input name="_method" type="hidden" value="post">
                                                <i type="submit"
                                                    class="fa fa-check-square fa-xl show-alert-approve-comment"
                                                    style="color: rgb(53, 112, 240);" aria-hidden="true"></i>
                                            </form>
                                            @else
                                            <form method="post"
                                                style=" display:inline!important; margin-left:20px; margin-right: 7px;"
                                                action="/admin/comments/censorship/{{ $comment->id }}?status=0">
                                                @csrf
                                                <input name="_method" type="hidden" value="post">
                                                <i type="submit" class="fa fa-ban fa-xl show-alert-reject-comment"
                                                    style="color: rgb(53, 112, 240);" aria-hidden="true"></i>
                                            </form>
                                            @endif
                                            <form method="post" style=" display:inline!important;"
                                                action="/admin/comments/delete/{{ $comment->id }}">
                                                @csrf
                                                <input name="_method" type="hidden" value="post">
                                                <i type="submit" style="color: red;"
                                                    class="fas fa-trash fa-xl show-alert-delete-box"></i>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {{-- {{ $comments->links('custom') }} --}}
        </div>
    </div>
</main>





<script>
    $(document).ready(function() {
            $('#feedback-table').DataTable({
                processing: true,
                serverSide: true,
                order: [[ 4, "desc" ]],
                "language": {
                     "lengthMenu": "Hiển thị _MENU_ dòng mỗi trang",
                      "zeroRecords": "Không tìm thấy kết quả",
                      "info": "Hiển thị từ _START_ đến _END_ của _TOTAL_ kết quả",
                      "infoEmpty": "Hiển thị 0 tới 0 của 0 kết quả",
                      "infoFiltered": "(Lọc từ _MAX_ kết quả)",
                      "search": "Tìm kiếm:",
                      "paginate": {
                         "first": "Đầu tiên",
                          "last": "Cuối cùng",
                          "next": "Sau",
                         "previous": "Trước"
                    },
                 },
                ajax: '{!! route('feedback_data') !!}',
                columns: [
                    {
                    data: 'user_id',
                    },
                    {
                    data: 'id',
                    "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html("<a href='/admin/order/detail/"+oData.id+"'>#"+oData.id+"</a>");
                    }
                    },
                    {
                        data: 'rating',
                        "orderable": true,
                        "render": function(data, type, row, meta) {
                            if (row["rating"] === 1) {
                                return `<span class="g-color-gray-dark-v4 g-font-size-12">
                                                            <div class="small-ratings">
                                                          <i class="fa fa-star></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star rating-color"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                            </div>
                                                        </span>`
                            }  else if(row["rating"] === 2) {
                             return `<span class="g-color-gray-dark-v4 g-font-size-12">
                                                            <div class="small-ratings">
                                                               <i class="fa fa-star></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star rating-color"></i>
                                                                <i class="fa fa-star rating-color"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                            </div>
                                                        </span>`
                            }  else if(row["rating"] === 3) {
                             return `<span class="g-color-gray-dark-v4 g-font-size-12">
                                                            <div class="small-ratings">
                                                                <i class="fa fa-star></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star rating-color"></i>
                                                                <i class="fa fa-star rating-color"></i>
                                                                <i class="fa fa-star rating-color"></i>
                                                                <i class="fa fa-star "></i>
                                                                <i class="fa fa-star "></i>
                                                            </div>
                                                        </span>`
                            }  else if(row["rating"] === 4) {
                             return `<span class="g-color-gray-dark-v4 g-font-size-12">
                                            <div class="small-ratings">
                                                                <i class="fa fa-star></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star rating-color"></i>
                                                                <i class="fa fa-star rating-color"></i>
                                                                <i class="fa fa-star rating-color"></i>
                                                                <i class="fa fa-star rating-color"></i>
                                                                <i class="fa fa-star "></i>

                                                            </div>
                                                        </span>`
                            } else {
                             return `<span class="g-color-gray-dark-v4 g-font-size-12">
                                                            <div class="small-ratings">
                                                                <i class="fa fa-star></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star rating-color"></i>
                                                                <i class="fa fa-star rating-color"></i>
                                                                <i class="fa fa-star rating-color"></i>
                                                                <i class="fa fa-star rating-color"></i>
                                                                <i class="fa fa-star rating-color"></i>
                                                            </div>
                                                        </span>`
                            }
                        }

                    },
                    {
                        data: 'feedback',
                    },
                    {
                        data: 'updated_at'
                    }
                ],

            });
        });
</script>
@endsection
