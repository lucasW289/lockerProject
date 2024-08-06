<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sepa extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'full_name',
        'email',
        'iban',
        'bic',
    ];
}
