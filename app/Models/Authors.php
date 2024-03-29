<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Authors extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'authors';
    protected $primaryKey='id';
    protected $fillable=[
        'name',
        'about',
   ];
}
