<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\ProductScore;
use App\Http\Controllers\Controller;
use App\Comment;

class CommentController extends Controller
{
    public function index()
    {
        $score=ProductScore::with(['get_comment','get_product'])->orderBy('id','DESC')->paginate(10);
        return View('Admin.comment.index',['score'=>$score]);
    }
    public function set_comment_status(Request $request)
    {
        if($request->ajax())
        {
            $comment_id=$request->get('comment_id');
            $row=Comment::where('id',$comment_id)->first();
            if($row)
            {
                $row->status=($row->status==0) ? 1 : 0;
                $row->update();
                $msg=($row->status==1)  ? 'تایید شده' : 'تایید نظر';
                return $msg;
            }
            else
            {
                return 'خطا در درخواست ارسالی';
            }
        }
    }
    public function delete($id)
    {
        $row=Comment::findOrFail($id);
        $row1=ProductScore::findorFail($id);
        $row->delete();
        $row1->delete();
        return redirect()->back();
    }
}
