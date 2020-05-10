<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $table = "users_profile";

    protected $fillable = [
        'nama',
        'tempat_lahir',
        'tgl_lahir',
        'domisili',
        'akun_facebook',
        'akun_instagram',
        'no_hp',
    ];

    protected $guarded = [
        'user_id',
    ];

    public $timestamps = false;
    
    public function user(){
        return $this->belongsTo('App\User');
    }
}
