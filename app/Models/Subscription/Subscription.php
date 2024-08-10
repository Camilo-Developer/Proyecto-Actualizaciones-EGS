<?php

namespace App\Models\Subscription;

use App\Models\Organization\Organization;
use App\Models\State\State;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $table = 'subscriptions';
    protected $primaryKey = 'id';
    protected $fillable = [
        'date_init',
        'date_finish',
        'organization_id',
        'state_id',
    ];

    /*Relacion directa Lista*/
    public function organization(){
        return $this->belongsTo(Organization::class);
    }
    /*Relacion directa Lista*/
    public function state(){
        return $this->belongsTo(State::class);
    }
}
