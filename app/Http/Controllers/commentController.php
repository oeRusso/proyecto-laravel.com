<?php

namespace App\Http\Controllers;

use App\comment;
use Illuminate\Http\Request;

class commentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function saveComment(Request $request)
    {

        $validate = $this->validate($request, [
            'image_id' => 'integer|required',
            'content' => 'string|required'
        ]);

        $user = \Auth::user();
        $image_id = $request->input('image_id');
        $content = $request->input('content');

        $comment = new comment();
        $comment->user_id = $user->id;
        $comment->image_id = $image_id;
        $comment->content = $content;

        $comment->save();

        return redirect()->route('image.detailImage', ['id' => $image_id])
            ->with(['message' => 'Has publicado un comentario']);
    }

    public function deleteComment($id)
    {
        $user = \Auth::user();

        $comment = comment::find($id);

        if ($user && ($comment->user_id == $user->id || $comment->image->user_id == $user->id)) {
            $comment->delete();

            return redirect()->route('image.detailImage', ['id' => $comment->image->id])
                ->with(['message' => 'Comentario eliminado correctamente']);
        }else {
            return redirect()->route('image.detailImage', ['id' => $comment->image->id])
                ->with(['message' => 'Se ha producido un ERROR al eliminar el comentario']);
            
        }
    }
}
