<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    
    protected $table = 'members';
    
    protected $fillable = [
        'full_name',
        'date_of_birth',
        'place_of_residence',
        'job',
        'contact1',	
        'contact2',	
        'spouse_name',
        'spouse_contact',
        'fathers_name',
        'Fathers_contact',	
        'mothers_name',
        'mothers_contact',	
        'photo',	
    ];
    public function MinistryPosition(){
        return $this->hasMany(MinistryPosition::class);
    }
}
