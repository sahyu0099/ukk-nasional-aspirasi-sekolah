<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    // Tambahkan 'location' di sini
    protected $fillable = ['user_id', 'date', 'title', 'location', 'description', 'photo', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function responses()
    {
        return $this->hasMany(Response::class);
    }
    
}