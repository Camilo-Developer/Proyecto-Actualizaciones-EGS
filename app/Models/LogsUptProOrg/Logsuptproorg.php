<?php

namespace App\Models\LogsUptProOrg;

use App\Models\Proyect\Proyect;
use App\Models\Uptproorgananization\Uptproorganization;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logsuptproorg extends Model
{
    use HasFactory;

    protected $table = 'logsuptproorgs';
    protected $primaryKey = 'id';
    protected $fillable = [
        'description',
        'uptproorganization_id',
        'proyect_id',
    ];

    /*Relacion directa Lista*/
    public function uptproorganization(){
        return $this->belongsTo(Uptproorganization::class);
    }

     /*Relacion directa Lista*/
     public function proyect(){
        return $this->belongsTo(Proyect::class);
    }

}
