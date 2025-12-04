<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PurchaseController;
use App\Mail\TicketPurchase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'index']);
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout']);

Route::middleware(['auth', 'role:Admin,Organizer'])->group(function(){
    Route::resource('event', EventController::class);
    Route::get('getcity', [EventController::class, 'getCity'])->name('getcity');
    Route::get('filterData', [EventController::class, 'filterData'])->name('filterData');
    Route::get('softList', [EventController::class, 'softList'])->name('softList');
    Route::get('restore/{id}', [EventController::class, 'restore'])->name('restore');
    Route::post('forceDelete/{id}', [EventController::class, 'forceDelete'])->name('forceDelete');

});

Route::middleware(['auth', 'role:Admin,Attendee'])->group(function(){
    Route::get('purchaseIndex', [PurchaseController::class, 'index'])->name('purchaseIndex');
    Route::get('purchaseCreate', [PurchaseController::class, 'create'])->name('purchaseCreate');
    Route::post('purchaseStore', [PurchaseController::class, 'store'])->name('purchaseStore');
    Route::get('getTicketType', [PurchaseController::class, 'getTicketType'])->name('getTicketType');
    Route::get('getQuantity', [PurchaseController::class, 'getQuantity'])->name('getQuantity');
    Route::get('send-mail',function(){
        $purchase = request()->query('purchase');
        Mail::to('mathew@elroi.com')->send(new TicketPurchase($purchase));
    });
});


