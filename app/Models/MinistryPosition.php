<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MinistryPosition extends Model
{
    use HasFactory;

    protected $table = 'member_position_ministry';

    protected $fillable = [
        'member_id',
        'position_id',
        'ministry_id'
    ];

    public function members(){
        return $this->hasMany(Member::class,'member_id');
    }
}
