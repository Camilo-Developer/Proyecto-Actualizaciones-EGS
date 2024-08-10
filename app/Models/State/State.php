<?php

namespace App\Models\State;

use App\Models\Subscription\Subscription;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    protected $table = 'states';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'type_state',
    ];
    /*Relacion inversa Lista*/
    public function users(){
        return $this->hasMany(User::class);
    }
    
    /*Relacion inversa Lista*/
    public function subscriptions(){
        return $this->hasMany(Subscription::class);
    }
}
