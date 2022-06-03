<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Babylist extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'user_id', 'articles', 'gender', 'description', 'invitation_code'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(BabylistItem::class);
    }
}
