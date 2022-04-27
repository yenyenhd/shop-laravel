<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Comment;
use App\Traits\Delete;



class AdminCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    use Delete;
    public function index()
    {
        $comment = Comment::where('parent_id', 0)->orderBy('id','DESC')->get();
        $comment_rep = Comment::where('parent_id','>',0)->get();
        return view('admin::comment.index', compact('comment', 'comment_rep'));
    }

    public function action($action, $id)
    {
        if($action){
            $comment = Comment::find($id);
            switch ($action)
            {
                case 'delete':
                    $this->deleteTrait($id, $comment );
                    break;
                case 'active':
                    $comment->status = $comment->status ? 0 : 1;
                    $comment->save();
                    break;  
            }
            
        }
        return redirect('admin/comment');
    }
}
