<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\like;

class likeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function like($image_id)
    {

        $user = \Auth::user();

        $isset_like = like::where('user_id', $user->id)
            ->where('image_id', $image_id)
            ->count();

        if ($isset_like == 0) {

            $like = new like();
            $like->user_id = $user->id;
            $like->image_id = (int)$image_id;

            $like->save();

            return response()->json(['like' => $like]);
        } else {

            return response()->json(['message' => 'El like ya existe']);
        }
    }

    public function dislike($image_id)
    {
        $user = \Auth::user();

        $isset_dislike = like::where('user_id', $user->id)
            ->where('image_id', $image_id)
            ->first();

        if ($isset_dislike) {


            $isset_dislike->delete();

            return response()->json([
                'like' => $isset_dislike,
                'message' => 'Has dado dislike correctamente'
            ]);
        } else {

            return response()->json(['message' => 'El like NO existe']);
        }
    }

    public function likeList(){
        $user= \Auth::user();
        $likeList= like::where('user_id',$user->id)->orderBy('id','desc')->paginate(5);

        return view('likes.likes',[
            'likeList'=>$likeList
        ]);
    }
}
