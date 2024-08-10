<?php

namespace App\Models\Product;

use App\Models\Proyect\Proyect;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'version',
    ];

    /*Relacion inversa Lista*/
    public function proyects(){
        return $this->hasMany(Proyect::class);
    }

}
