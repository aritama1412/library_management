<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'books';
    protected $primaryKey='id';
    protected $fillable=[
        'author_id',
        'title',
        'description',
        'note',
        'shelves_id',
        'release_date',
   ];

   public function getAuthor()
   {
        return $this->hasOne(Authors::class, 'id', 'author_id');
   }

   public function getShelf()
   {
        return $this->hasOne(Shelves::class, 'id', 'shelves_id');
   }
}
