<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genres extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'genres';
    protected $primaryKey='id';
    protected $fillable=[
        'genre',
   ];
}
