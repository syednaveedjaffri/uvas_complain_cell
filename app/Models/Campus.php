<?php

namespace App\Models;

use App\Models\Faculty;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Campus extends Model
{
    use HasFactory;
    public $timestamps = false;

    // protected $table = 'campuses';

    protected $fillable = [
    'campus_name','user_id'];

    public function faculties()
    {
        return $this->hasMany(Faculty::class);
    }
    // public function users()
    // {
    //     return $this->belongsTo(User::class,'user_id','id');
    // }
    // public function campusers()
    // {
    //     return $this->HasMany(User::class);
    // }


}
