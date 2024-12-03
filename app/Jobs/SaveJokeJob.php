<?php

namespace App\Jobs;

use App\Models\Joke;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SaveJokeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        private readonly string $jokeId,
        private readonly string $value
    ) {}

    public function handle(): void
    {
        Joke::updateOrCreate(
            ['joke_id' => $this->jokeId],
            ['value' => $this->value]
        );
    }
}
