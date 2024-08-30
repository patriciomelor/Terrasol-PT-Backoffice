<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;

class TestController extends Controller
{
    public function cacheTest()
    {
        Cache::store('database')->put('key', 'value', 60);
        $value = Cache::store('database')->get('key');

        return response()->json(['value' => $value]);
    }
}
