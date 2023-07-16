<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Userprofile extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','contact','campus_id','campus_name','faculty_id','department_id'];

    public function campprofiles()
    {
        return $this->belongsTo(Campus::class,'campus_id','id');
    }
    public function facprofiles()
    {
        return $this->belongsTo(Faculty::class,'faculty_id','id');
    }
    public function depprofiles()
    {
        return $this->belongsTo(Department::class,'department_id','id');
    }
    public function userprofiles()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

}

