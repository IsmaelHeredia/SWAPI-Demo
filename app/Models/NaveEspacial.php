<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NaveEspacial extends Model
{
	use HasFactory;
	
    public $timestamps = false;

	protected $table = "naves_espaciales";
    protected $fillable = ['nombre', 'cantidad'];
}