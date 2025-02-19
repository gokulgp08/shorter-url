<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UrlshortController;
use App\Models\Urlshort;
use App\Models\Urlvisit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/url',[UrlshortController::class,'index'])->name('url.index');
    Route::get('/url/create',[UrlshortController::class,'create'])->name('url.create');
    Route::post('/url/store',[UrlshortController::class,'store'])->name('url.store');
    Route::get('/url/show/{urlshort}',[UrlshortController::class,'show'])->name('url.show');
    Route::delete('/url/delete/{urlshort}',[UrlshortController::class,'destroy'])->name('url.destroy');

});


require __DIR__.'/auth.php';

Route::get('/{output_url}', function(Request $request, $output_url){

    $short = Urlshort::where('output_url', $output_url)->first();

    if ($short) {

        $ip = $request->ip();

        Urlvisit::insert([
            'url_id' => $short->id,
            'ip_address' => $ip,
            'visited_at' => now(),
        ]);

        return redirect()->away($short->input_url);
    }

    abort(404);
    
})->name('url.new');
