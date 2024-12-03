<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class JokesController extends Controller
{
    public function index()
    {
        try {
            $response = Http::get('https://api.chucknorris.io/jokes/random');
            if ($response->successful()) {
                $joke = $response->json()['value'];

                return response()->json(['joke' => $joke]);
            }
        } catch (\Exception $e) {
            return response()->json(['No jokes available.']);
        }
    }
}
