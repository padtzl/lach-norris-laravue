<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Joke extends Model
{
    use Searchable;
    protected $fillable = ['joke_id', 'value'];

    public function searchableAs()
    {
        return 'jokes';
    }

    public function toSearchableArray()
    {
        return [
            'joke_id' => $this->joke_id,
            'joke' => $this->value,
        ];
    }
}
