<?php

namespace App\Http\Controllers;

use App\Services\RatingService;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

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
        $input['user_id'] = $user->id;
        $result = $this->ratingService->add($input);

        if (!$result)
        {
            Alert::error('Thêm bình luận thất bại do lỗi');
            return redirect()->back();
        }

        Alert::success('Thêm thành công', 'Bình luận của bạn sẽ được quản trị viên duyệt qua!');
        return redirect()->back();
    }
}
