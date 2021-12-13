<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const RATE_SELECT = [
        '1' => 1,
        '2' => 2,
        '3' => 3,
        '4' => 4,
        '5' => 5,
    ];

    public const STATUS_SELECT = [
        'completed'   => 'Completed',
        'incomplete' => 'Incomplete',
    ];

    public $table = 'orders';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'price',
        'status',
        'comment',
        'date',
        'time',
        'address',
        'rate',
        'remark',
        'merchant_id',
        'package_id',
        'user_id',
        'servicer_id',
        'qr_code_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function merchant()
    {
        return $this->belongsTo(Merchant::class, 'merchant_id');
    }

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function servicer()
    {
        return $this->belongsTo(Servicer::class, 'servicer_id');
    }

    public function qr_code()
    {
        return $this->belongsTo(QrCode::class, 'qr_code_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d');
    }
}
