<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Payment extends Model
{
    use HasFactory, Notifiable;


    protected $fillable = [
        'user_id', 
        'amount', 
        'status', 
        'account_name',
        'source',
        'client_name' 
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
