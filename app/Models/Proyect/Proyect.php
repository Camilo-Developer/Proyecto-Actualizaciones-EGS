<?php

namespace App\Models\Proyect;

use App\Models\LogsUptProOrg\Logsuptproorg;
use App\Models\Organization\Organization;
use App\Models\Product\Product;
use App\Models\Uptproorgananization\Uptproorganization;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyect extends Model
{
    use HasFactory;

    protected $table = 'proyects';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'product_id',
    ];

    /*Relacion directa Lista*/
    public function product(){
        return $this->belongsTo(Product::class);
    }

     /*Relacion de muchos a muchos*/
     public function organizations(){
        return $this->belongsToMany(Organization::class, 'organizations_has_proyects');
    }

    /*Relacion de muchos a muchos*/
    public function uptproorganizations(){
        return $this->belongsToMany(Uptproorganization::class, 'uptproorganizations_has_proyects');
    }

    /*Relacion inversa Lista*/
    public function logsuptproorgs(){
        return $this->hasMany(Logsuptproorg::class);
    }
}
