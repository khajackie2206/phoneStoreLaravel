<?php

namespace App\Http\Controllers;

use App\Services\RatingService;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Comment;
use Yajra\Datatables\Datatables;
use App\Models\Activity;

class RatingController extends Controller
{
    protected RatingService $ratingService;

    public function __construct(RatingService $ratingService)
    {
        $this->ratingService = $ratingService;
    }

    public function add(Request $request)
    {
        $user = session()->get('user');
        $input = $request->all();
        if (!$user) {
            $url = '/products/details/' . $input['product_id'] . '';
            Alert::error('Vui lòng đăng nhập trước khi đánh giá sản phẩm!');
            return redirect('/login?url=' . $url . '');
        }

        //if user has product in order table then can comment
        $check = $this->ratingService->checkUserComment($user->id, $input['product_id']);
        if (!$check) {
            Alert::error('Không thể đưa ra đánh giá do bạn chưa mua sản phẩm này!');
            return redirect()->back();
        }
        $input['user_id'] = $user->id;
        $result = $this->ratingService->add($input);

        if (!$result) {
            Alert::error('Thêm bình luận thất bại do lỗi');
            return redirect()->back();
        }

        Alert::success('Thêm thành công', 'Bình luận của bạn sẽ được quản trị viên duyệt qua!');
        return redirect()->back();
    }

    public function comments()
    {
        $comments = Comment::paginate(8);
        return view('admin.comment.list', [
            'title' => 'Danh sách bình luận',
            'comments' => $comments,
        ]);
    }

    public function delete(Comment $comment)
    {
        $comment->delete();
        //insert activity
        $user = session()->get('user');
        $dataActivity = [
            'staff_id' => $user->id,
            'action' => 'Xóa bình luận khách hàng',
        ];
        Activity::create($dataActivity);

        Alert::success('Đã xóa bình luận!');
        return redirect()->back();
    }

    public function updateStatus(Request $request, Comment $comment)
    {
        $input = $request->all();
        $comment->update(array('status' => $input['status']));
        //insert activity
        $user = session()->get('user');
        $dataActivity = [
            'staff_id' => $user->id,
            'action' => 'Duyệt bình luận khách hàng (Mã bình luận: #' . $comment->id . ')',
        ];
        Activity::create($dataActivity);

        return redirect()->back();
    }

     public function getData()
     {
         $comments = Comment::select(['id','comment','product_id','rating', 'user_id','status', 'created_at']);

         return Datatables::of($comments)->addColumn('action', function ($comment) {
             return $comment->status == 0 ? '<a href="/admin/comments/censorship/'.$comment->id.'?status=1" onclick="return approve(event);"><i  class="fa fa-check-square fa-xl show-alert-approve-comment"
                                                                    style="color: rgb(53, 112, 240);" aria-hidden="true"></i></a>
                                                                     <a href="/admin/comments/delete/'.$comment->id.'" onclick="return deleteComment(event);"
                                                                    <i type="submit" style="color: red;"
                                                                class="fas fa-trash fa-xl show-alert-delete-box"></i></a>' : '
                                                         &nbsp; &nbsp;  <a href="/admin/comments/delete/'.$comment->id.'" onclick="return deleteComment(event);">
                                                        <i type="submit" style="color: red;"
                                                                class="fas fa-trash fa-xl show-alert-delete-box"></i></a>';
         })->editColumn('product_id', function ($comment) {
             return  '<span style="font-weight: bold;">'.$comment->product->name.'
                                                        '.$comment->product->rom.'</span>';
         })->editColumn('user_id', function ($comment) {
             return $comment->user->name;
         })->editColumn('status', function ($comment) {
             return $comment->status == 0 ? '<span class="badge bg-danger">Chờ duyệt</span>' : '<span class="badge bg-success">Đã duyệt</span>';
         })->rawColumns(['action', 'product_id', 'user_id', 'status'])->make();
     }
}
