<?php

namespace App\Services;

use App\Jobs\SaveJokeJob;
use App\Models\ApiSetting;
use App\Models\Joke;
use Illuminate\Support\Facades\Http;
use Exception;

class JokesService
{
    private const API_URL = 'https://api.chucknorris.io/jokes/random';

    public function getRandomJoke(): array
    {
        //for showcase purpose
        if (ApiSetting::isApiEnabled()) {
            try {
                $response = Http::get(self::API_URL);

                if ($response->successful()) {
                    $jokeData = $response->json();

                    SaveJokeJob::dispatch(
                        $jokeData['id'],
                        $jokeData['value']
                    );

                    return [
                        'joke' => $jokeData['value'],
                        'source' => 'API'
                    ];
                }
                throw new Exception('Unable to retrieve joke via API'); //meeh

            } catch (Exception $e) {
                // Exception Handling - return fallback from database or error
                return $this->getFallbackJoke();
            }
        }
        return $this->getFallbackJoke();
    }

    private function getFallbackJoke(): array
    {
        $randomJoke = Joke::inRandomOrder()->first();

        if (!$randomJoke) {
            return [
                'joke' => 'No jokes available at the moment.',
                'source' => null,
            ];
        }

        return [
            'joke' => $randomJoke->value,
            'source' => 'Database',
        ];
    }
}
