<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\VarDumper\VarDumper;
use App\image;
use App\like;
use App\comment;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class imageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {

        return view('image.create');
    }

    public function saveController(Request $request)
    {

        $validate = $this->validate($request, [

            'description' => 'required',
            'image_path' => 'required|image'
        ]);

        $image_path = $request->file('image_path');
        $descripcion = $request->input('description');

        $user = \Auth::user();
        $image = new image();
        $image->user_id = $user->id;
        $image->description = $descripcion;

        if ($image_path) {
            $image_path_name = time() . $image_path->getClientOriginalName();
            Storage::disk('images')->put($image_path_name, File::get($image_path));
            // segun la explicacion de victor primero se indica el espacio en el disco donde se va guardar luego del put se saca el NOMBRE de la imagen y en el file se saca el ARCHIVO dende se guarda esa imagen. segun me explico este usuario de fb, el nombre q le pasamos a file es el nombre del archivo q le vamos a pasar como descripcion del metadato
            // aca pulir mas esta idea  
            $image->image_path = $image_path_name;
        }
        $image->save();

        return redirect()->route('home')->with('message', 'la foto ha sido subida correctamente');
    }

    public function getImageFeed($filename)
    {

        $file = Storage::disk('images')->get($filename);
        return response($file, 200);
    }

    public function detailImage($id)
    {
        $image = image::find($id);
        // el metodo find te saca un un objeto del id q le pasaste y de ahi podes acceder a todos sus propiedades segun endiendo
        return view('image.detailImage', ['image' => $image]);
    }

    public function deleteImage($id)
    {
        $user = \Auth::user();
        $image = image::find($id);
        $comments = comment::where('image_id', $id)->get();
        $likes = like::where('image_id', $id)->get();

        // eliminar comentarios
        if ($user && $image && $image->user->id = $user->id) {

            if ($comments && count($comments) >= 1) {
                foreach ($comments as $comment) {
                    $comment->delete();
                }
            }

            // eliminar likes
            if ($likes && count($likes) >= 1) {
                foreach ($likes as $like) {
                    $like->delete();
                }
            }

            // eliminar del disco
            Storage::disk('images')->delete($image->image_path);

            // eliminar el registro de la imagen

            $image->delete();

            $message = array('message' => 'La imagen  se ha borrado CORRECTAMENTE');
        } else {
            $message = array('message' => 'La imagen NO se ha borrado');
        }

        return redirect()->route('home')->with($message);
    }
    public function editImage($id)
    {
        $user = \Auth::user();
        $image = image::find($id);

        if ($user && $image && $image->user->id == $user->id) {
            return view('image.edit', ['image' => $image]);
        } else {
            return redirect()->route('home');
        }
    }

    public function updateImage(Request $request)
    {
        // validar formulario

        $validate = $this->validate($request, [

            'description' => 'required',
            'image_path' => 'image'
        ]);

        // recoger datos

        $image_path = $request->file('image_path');
        $image_id = $request->input('image_id');
        $description = $request->input('description');

        // conseguir objeto imagen

        $image = image::find($image_id);
        $image->description = $description;


        // subir fichero

        if ($image_path) {
            $image_path_name = time() . $image_path->getClientOriginalName();
            Storage::disk('images')->put($image_path_name, File::get($image_path));
            $image->image_path = $image_path_name;
        }

        // subir registro

        $image->update();

        return redirect()->route('image.detailImage', ['id' => $image_id])
            ->with(['message' => 'imagen actualizada con exito']);
    }
}
