<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property float $balance
 * @property string $address
 * @property string $bio
 * @property string $birthday
 * @property string $time
 * @property string $color
 * @property string $icon
 * @property string $html
 * @property mixed $info
 * @property boolean $is_active
 * @property string $created_at
 * @property string $updated_at
 */
class Customer extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'email', 'phone', 'balance', 'address', 'bio', 'birthday', 'time', 'color', 'icon', 'html', 'info', 'is_active', 'created_at', 'updated_at'];

    protected $casts = [
        "is_active" => "boolean",
        "info" => "array"
    ];

}
