<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'birth_date',
        'user_id',
        'package_id',
        'class_id', // Add this line
        'locker_id'
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // In app/Models/Child.php

public function locker()
{
    return $this->belongsTo(Locker::class);
}
public function class()
{
    return $this->belongsTo(Classes::class, 'class_id');

}
public function sepa()
{
    return $this->hasOne(Sepa::class); // Adjust if necessary based on your setup
}
}
