<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BooksGenres extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'books_genres';
    protected $primaryKey='id';
    protected $fillable=[
        'books_id',
        'genres_id',
   ];

   public function getGenre()
   {
        return $this->hasOne(Genres::class, 'id', 'genres_id');
   }
}
