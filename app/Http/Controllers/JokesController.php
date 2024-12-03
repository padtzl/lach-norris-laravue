<?php

namespace App\Http\Controllers;

use App\Models\Joke;
use App\Services\JokesService;
use Illuminate\Http\Request;
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

    public function search(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'q' => 'nullable|string|max:255',
            'page' => 'nullable|integer|min:1',
            'per_page' => 'nullable|integer|min:1|max:100',
        ]);
        $query = $validated['q'] ?? '';
        $page = isset($validated['page']) ? (int) $validated['page'] : 1;
        $perPage = isset($validated['per_page']) ? (int) $validated['per_page'] : 6;


        $result = Joke::search($query)
            ->paginate($perPage, 'page', $page);

        return response()->json($result);
    }
}
