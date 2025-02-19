<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Urlshort extends Model
{
    protected $table = "urls";
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($url) {
            $url->output_url = generateUrl();
            if (Auth::check()) {
                $url->created_by = Auth::id();
            }
        });

        function generateUrl() {
            $length = getCurrentLength();
            
            do {
                $url = randomString($length);
                $exists = Urlshort::where('output_url', $url)->exists();
            } while ($exists);
            
            return $url;
        }

        function randomString($length) {
            $allChars = array_merge(range('A', 'Z'), range('a', 'z'), range('0', '9'));
            $urlArray = [];
            
            for ($i = 0; $i < $length; $i++) {
                $urlArray[] = $allChars[array_rand($allChars)];
            }
            
            return implode('', $urlArray);
        }
        
        function getCurrentLength() {
            $count = Urlshort::count();
            $base = 62;
            $length = 4;
            
            while ($count >= pow($base, $length)) {
                $length++;
            }
            
            return $length;
        }

        
    }
}
