<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DetailPembelian extends Model
{
    use HasFactory;

    protected $table = 'detailPembelian';

    protected $primaryKey = 'detailPembelianID';
    
    protected $keyType = 'integer';

    protected $fillable = [
        'pembelianID',
        'produkID',
        'jumlah',
        'subtotal'
    ];

    public function pembelian(): BelongsTo
    {
        return $this->belongsTo(Pembelian::class, 'pembelianID', 'pembelianID');
    }
    
    public function produk(): HasMany
    {
        return $this->hasMany(Produk::class, 'produkID', 'produkID');
    }

}
