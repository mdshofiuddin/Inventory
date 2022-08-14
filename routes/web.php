<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Another system to write Route
//...........................
//Route::get('/user',[
//    'uses'      =>      'backend\UserController@userView',
//    'as'        =>      'user-view'
//]);
//..................................

Route::group(['middleware'=>'auth'],function(){
Route::prefix('users')->group(function (){
   //"For single middleware" Route::get('/view', 'backend\UserController@view')->name('user-view')->middleware('ims');
    Route::get('/view', 'backend\UserController@view')->name('user-view');
    Route::get('/add', 'backend\UserController@add')->name('user-add');
    Route::post('/store', 'backend\UserController@store')->name('user-store');
    Route::get('/edit/{id}', 'backend\UserController@edit')->name('user-edit');
    Route::post('/update/{id}', 'backend\UserController@update')->name('user-update');
    Route::get('/delete/{id}', 'backend\UserController@delete')->name('user-delete');
});


Route::prefix('profiles')->group(function (){
    Route::get('/view', 'backend\ProfileController@view')->name('profile-view');
    Route::get('/edit', 'backend\ProfileController@edit')->name('profile-edit');
    Route::post('/update', 'backend\ProfileController@update')->name('profile-update');
    Route::get('/password/view', 'backend\ProfileController@passwordView')->name('profile-password-view');
    Route::post('/password/update','backend\ProfileController@passwordUpdate')->name('profile-password-update');
});

    Route::prefix('suppliers')->group(function (){
        //"For single middleware" Route::get('/view', 'backend\UserController@view')->name('user-view')->middleware('ims');
        Route::get('/view', 'backend\SupplierController@view')->name('suppliers-view');
        Route::get('/add', 'backend\SupplierController@add')->name('suppliers-add');
        Route::post('/store', 'backend\SupplierController@store')->name('suppliers-store');
        Route::get('/edit/{id}', 'backend\SupplierController@edit')->name('suppliers-edit');
        Route::post('/update/{id}', 'backend\SupplierController@update')->name('suppliers-update');
        Route::get('/delete/{id}', 'backend\SupplierController@delete')->name('suppliers-delete');
    });

    Route::prefix('customers')->group(function (){
        //"For single middleware" Route::get('/view', 'backend\UserController@view')->name('user-view')->middleware('ims');
        Route::get('/view', 'backend\CustomerController@view')->name('customers-view');
        Route::get('/add', 'backend\CustomerController@add')->name('customers-add');
        Route::post('/store', 'backend\CustomerController@store')->name('customers-store');
        Route::get('/edit/{id}', 'backend\CustomerController@edit')->name('customers-edit');
        Route::post('/update/{id}', 'backend\CustomerController@update')->name('customers-update');
        Route::get('/delete/{id}', 'backend\CustomerController@delete')->name('customers-delete');
        Route::get('/credit', 'backend\CustomerController@credit')->name('customers-credit');
        Route::get('/credit/pdf', 'backend\CustomerController@creditPdf')->name('customers-credit-pdf');
        Route::get('/invoice/edit/{invoice_id}', 'backend\CustomerController@editInvoice')->name('customers-edit-invoice');
        Route::post('/invoice/update/{invoice_id}', 'backend\CustomerController@updateInvoice')->name('customers-update-invoice');
        Route::get('/invoice/details/{invoice_id}', 'backend\CustomerController@detailsInvoice')->name('customers-details-invoice');
        Route::get('/paid', 'backend\CustomerController@paid')->name('customers-paid');
        Route::get('/paid/pdf', 'backend\CustomerController@paidPdf')->name('customers-paid-pdf');
        Route::get('/wise/report', 'backend\CustomerController@customerWiseReport')->name('customers-wise-report');
        Route::get('/wise/credit/report', 'backend\CustomerController@customerCreditReport')->name('customers-credit-report');
        Route::get('/wise/paid/report', 'backend\CustomerController@customerPaidReport')->name('customers-paid-report');
    });
    Route::prefix('unites')->group(function (){
        //"For single middleware" Route::get('/view', 'backend\UserController@view')->name('user-view')->middleware('ims');
        Route::get('/view', 'backend\UnitController@view')->name('unites-view');
        Route::get('/add', 'backend\UnitController@add')->name('unites-add');
        Route::post('/store', 'backend\UnitController@store')->name('unites-store');
        Route::get('/edit/{id}', 'backend\UnitController@edit')->name('unites-edit');
        Route::post('/update/{id}', 'backend\UnitController@update')->name('unites-update');
        Route::get('/delete/{id}', 'backend\UnitController@delete')->name('unites-delete');
    });
    Route::prefix('categories')->group(function (){
        //"For single middleware" Route::get('/view', 'backend\UserController@view')->name('user-view')->middleware('ims');
        Route::get('/view', 'backend\CategoryController@view')->name('categories-view');
        Route::get('/add', 'backend\CategoryController@add')->name('categories-add');
        Route::post('/store', 'backend\CategoryController@store')->name('categories-store');
        Route::get('/edit/{id}', 'backend\CategoryController@edit')->name('categories-edit');
        Route::post('/update/{id}', 'backend\CategoryController@update')->name('categories-update');
        Route::get('/delete/{id}', 'backend\CategoryController@delete')->name('categories-delete');
    });

    Route::prefix('products')->group(function (){
        //"For single middleware" Route::get('/view', 'backend\UserController@view')->name('user-view')->middleware('ims');
        Route::get('/view', 'backend\ProductController@view')->name('products-view');
        Route::get('/add', 'backend\ProductController@add')->name('products-add');
        Route::post('/store', 'backend\ProductController@store')->name('products-store');
        Route::get('/edit/{id}', 'backend\ProductController@edit')->name('products-edit');
        Route::post('/update/{id}', 'backend\ProductController@update')->name('products-update');
        Route::get('/delete/{id}', 'backend\ProductController@delete')->name('products-delete');
    });

    Route::prefix('purchase')->group(function (){
        //"For single middleware" Route::get('/view', 'backend\UserController@view')->name('user-view')->middleware('ims');
        Route::get('/view', 'backend\PurchaseController@view')->name('purchase-view');
        Route::get('/add', 'backend\PurchaseController@add')->name('purchase-add');
        Route::post('/store', 'backend\PurchaseController@store')->name('purchase-store');
        Route::get('/pending', 'backend\PurchaseController@pendingList')->name('purchase-pending-list');
        Route::get('/approve/{id}', 'backend\PurchaseController@approve')->name('purchase-approve');
        Route::get('/delete/{id}', 'backend\PurchaseController@delete')->name('purchase-delete');
        Route::get('/report', 'backend\PurchaseController@report')->name('purchase-report');
        Route::get('/report.pdf', 'backend\PurchaseController@reportPdf')->name('purchase-report-pdf');
    });

    Route::get('/get-category', 'backend\DefaultController@getCategory')->name('get-category');
    Route::get('/get-product', 'backend\DefaultController@getProduct')->name('get-product');
    Route::get('/get-stock', 'backend\DefaultController@getStock')->name('check-product-stock');

        Route::prefix('invoice')->group(function (){
            Route::get('/view', 'backend\InvoiceController@view')->name('invoice-view');
            Route::get('/add', 'backend\InvoiceController@add')->name('invoice-add');
            Route::post('/store', 'backend\InvoiceController@store')->name('invoice-store');
            Route::get('/pending', 'backend\InvoiceController@pendingList')->name('invoice-pending-list');
            Route::get('/approve/{id}', 'backend\InvoiceController@approve')->name('invoice-approve');
            Route::get('/delete/{id}', 'backend\InvoiceController@delete')->name('invoice-delete');
            Route::post('/approve/store/{id}', 'backend\InvoiceController@approvalStore')->name('invoice-approve-store');
            Route::get('/print/list', 'backend\InvoiceController@printInvoiceList')->name('invoice-print-list');
            Route::get('/print/{id}', 'backend\InvoiceController@printInvoice')->name('invoice-print');
            Route::get('/daily/report', 'backend\InvoiceController@dailyReport')->name('invoice-daily-report');
            Route::get('/daily/report/pdf', 'backend\InvoiceController@dailyReportPdf')->name('invoice-daily-report-pdf');
        });

    Route::prefix('stock')->group(function (){
        Route::get('/report', 'backend\StockController@stockReport')->name('stock-report');
         Route::get('/report/pdf', 'backend\StockController@stockReportPdf')->name('stock-report-pdf');
         Route::get('/report/supplier/product/wise', 'backend\StockController@supplierProductWise')->name('stock-supplier-product-wise');
         Route::get('/report/supplier/wise/pdf', 'backend\StockController@supplierWisePdf')->name('stock-supplier-wise-pdf');
         Route::get('/report/product/wise/pdf', 'backend\StockController@productWisePdf')->name('stock-product-wise-pdf');

    });
});
