<?php

namespace App\Models\Uptproorgananization;

use App\Models\LogsUptProOrg\Logsuptproorg;
use App\Models\Organization\Organization;
use App\Models\Proyect\Proyect;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uptproorganization extends Model
{
    use HasFactory;

    protected $table = 'uptproorganizations';
    protected $primaryKey = 'id';
    protected $fillable = [
        'description',
        'user_id',
        'organization_id',
    ];


    /*Relacion directa Lista*/
    public function organization(){
        return $this->belongsTo(Organization::class);
    }

    /*Relacion de muchos a muchos*/
    public function proyects(){
        return $this->belongsToMany(Proyect::class, 'uptproorganizations_has_proyects');
    }

    /*Relacion inversa Lista*/
    public function logsuptproorgs(){
        return $this->hasMany(Logsuptproorg::class);
    }
}
