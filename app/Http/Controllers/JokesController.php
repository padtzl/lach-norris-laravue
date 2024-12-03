<?php

namespace App\Http\Controllers;

use App\Services\JokesService;
use Illuminate\Http\JsonResponse;

class JokesController extends Controller
{
    private JokesService $jokesService;

    public function __construct(JokesService $jokesService)
    {
        $this->jokesService = $jokesService;
    }

    public function index(): JsonResponse
    {
        $jokeData = $this->jokesService->getRandomJoke();
        return response()->json($jokeData);
    }
}
