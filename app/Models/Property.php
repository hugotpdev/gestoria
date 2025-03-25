<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction;

class Property extends Model {
    use HasFactory;

    protected $fillable = [
        'user_id', 'title', 'description', 'price',
        'location', 'type', 'status',
        'bedrooms', 'bathrooms', 'area', 'image_url' 
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function isAvailable()
    {
        return $this->status === 'disponible';
    }
}