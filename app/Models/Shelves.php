<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shelves extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'shelves';
    protected $primaryKey='id';
    protected $fillable=[
        'name',
   ];
}
