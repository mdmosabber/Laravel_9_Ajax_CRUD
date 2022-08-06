 <?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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


Route::controller( ProductController::class )->group(function (){
    Route::get('/', 'index');

    Route::post('/add-product', 'store')->name('add.product');
    Route::post('/update-product', 'update')->name('update.product');
    Route::post('/delete-product', 'destroy')->name('delete.product');
    Route::get('/product/paginate', 'pagination');
    Route::get('/product/search', 'productSearch')->name('product.search');


});
