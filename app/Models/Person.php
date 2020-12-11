<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string name
 * @property string address
 * @property boolean checked
 * @property string description
 * @property string interest
 * @property string date_of_birth
 * @property string email
 * @property string account
 */
class Person extends Model
{
    use HasFactory;

    protected $table = "person";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'address',
        'checked',
        'description',
        'interest',
        'date_of_birth',
        'email',
        'account'
    ];

    public function creditCard()
    {
        return $this->hasOne(CreditCard::class);
    }

}
