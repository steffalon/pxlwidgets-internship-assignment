<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string type
 * @property integer number
 * @property string name
 * @property string expiration_date
 */
class CreditCard extends Model
{
    use HasFactory;

    protected $table = "credit_card";
    public $timestamps = false;

    protected $fillable = [
        'person_id',
        'type',
        'number',
        'name',
        'expiration_date',
    ];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

}
