<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('test', function(){
    /*
    $category = \App\Categery::create([
        'name' => 'politics 3',
    ]);


    $category = $category->fresh();

   return ['category' => $category, 'active' => $category->active];
    */
   /*
   $users = \App\User::with();
       if(true){
        $users = $users->where();
       }
       $users = $users->get();
   */
   //$category = \App\Categery::find(2);
    /*
    $category = \App\Categery::where('id', '>', 2)->get();
   return $category;
    */
    $category5 = \App\Category::with(['articles', 'subCategories' => function($query){
        $query = $query->where('active', true);
        return $query;
    }, 'superCategory'])->find(5);
    //return $category;
    //dd((string) $category->created_at); //->diffForHumans());
    //return $category5->subCategories;
/*
    $newCategory = new \App\Categery(['name' => 'politics4']);
    $newCategory->parent_id = 5;
    $newCategory->save();
*/
/*
    $newCategory = new \App\Categery(['name' => 'politics5']);
    $category5->subCategories()->save($newCategory);
    $newCategory = $newCategory->fresh(['superCategory']);
*/
    return $category5;
});



/* remove tests above */

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'backoffice', 'as'=>'admin_', 'namespace'=>'Admin', 'middleware' =>['auth']], function(){
    Route::get('private', ['as'  => 'private_route', function(){
        echo 'I can see this';
    }]);

    Route::resource('category', 'CategoryController');


/*
    Route::get('/use/{id1?}/{id2?}/{id3?}/{id4?}/{id5?}', 'UserController@index');
    Route::get('user/{id?}', ['as' => 'user_with_id', 'uses' => 'UserController@user']);
    */
});
Route::auth();

Route::get('/home', 'HomeController@index');
