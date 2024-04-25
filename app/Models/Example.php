<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Example extends Model
{
    use HasFactory;

    public function casts()
    {
        return [
            'name' => 'string',
            'category' => 'string',
            'option' => 'string',
        ];
    }
}
