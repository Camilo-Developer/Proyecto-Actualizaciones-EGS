<?php

namespace App\Models\Organization;

use App\Models\Proyect\Proyect;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subscription\Subscription;
use App\Models\Uptproorgananization\Uptproorganization;

class Organization extends Model
{
    use HasFactory;

    protected $table = 'organizations';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'subdomain',
        'route',
        'server',
        'connection_db',
    ];

    /*Relacion inversa Lista*/
    public function subscriptions(){
        return $this->hasMany(Subscription::class);
    }

    /*Relacion inversa Lista*/
    public function uptproorganizations(){
        return $this->hasMany(Uptproorganization::class);
    }

     /*Relacion de muchos a muchos*/
     public function proyects(){
        return $this->belongsToMany(Proyect::class);
    }
}
