<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// use App\image;

Route::get('/', function () {
    /* $images = image::all();

    foreach ($images as $image) {
        echo $image->image_path . "<br>";
        echo $image->description . "<br>";
        echo $image->user->name . ' ' . $image->user->surname . "<br>";
        if (count($image->comments) >= 1) {
            echo "<h4>Comentarios:</h4>";
            foreach ($image->comments as $comments) {
                echo $comments->user->name . ' ' . $comments->user->surname .':';
                echo "<br>" . $comments->content . "<br>";
            }
        }
        echo "LIKES:".count($image->like);

        echo "<hr>";
    }
    die;
*/
    return view('welcome');
});

// GENERALES
Auth::routes();
Route::get('/', 'HomeController@index')->name('home');

// USUARIO
Route::get('/configuracion', 'userController@config')->name('config');
Route::post('/user/update', 'userController@update')->name('user.update');
Route::get('/users/avatar/{filename}', 'userController@getImage')->name('user.avatar');
Route::get('/perfil/{id}', 'userController@profile')->name('profile');
Route::get('/image/gente/{search?}', 'userController@index')->name('user.index');

// IMAGEN
Route::get('/subir-imagen', 'imageController@create')->name('image.create');
Route::post('/image/saveController', 'imageController@saveController')->name('image.save');
Route::get('/images/file/{filename}', 'imageController@getImageFeed')->name('image.file');
Route::get('/imagenDesc/{id}', 'imageController@detailImage')->name('image.detailImage');
Route::get('/image/delete/{id}', 'imageController@deleteImage')->name('image.delete');
Route::get('/image/editar/{id}', 'imageController@editImage')->name('image.edit');
Route::post('/image/update', 'imageController@updateImage')->name('image.update');

// COMENTARIOS
Route::post('/comment/save', 'commentController@saveComment')->name('comment.save');
Route::get('/comment/delete/{id}', 'commentController@deleteComment')->name('comment.delete');

// LIKES
Route::get('/like/{image_id}', 'likeController@like')->name('like.save');
Route::get('/dislike/{image_id}', 'likeController@dislike')->name('like.delete');
Route::get('/likes', 'likeController@likeList')->name('likes');












