<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class Lelang extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = false;

    protected $fillable = [
        'id_barang',
        'id_user',
        'id_petugas',
        'tanggal',
        'harga_akhir',
        'status',
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    public function barang(): HasOne
    {
        return $this->hasOne(Barang::class, 'id', 'id_barang');
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }

    public function petugas(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'id_petugas');
    }

    public function historyLelang(): HasMany
    {
        return $this->hasMany(HistoryLelang::class, 'id_lelang', 'id');
    }
}
