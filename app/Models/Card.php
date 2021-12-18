<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Card extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const BANK_SELECT = [
        'hongleongBank' => 'HongLeong Bank',
        'mayBank' => 'MayBank',
        'publicBank' => 'Public Bank',
        'cimbBank' => 'CIMB Bank',
        'rhbBank' => 'RHB Bank',
    ];

    public $table = 'cards';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'bank_of_card',
        'name_of_card',
        'expired_date',
        'cvv',
        'card_number',
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d');
    }
}
