<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class DetailPembelian extends Model
{
    use HasFactory;

    protected $table = 'detailPembelian';

    protected $primaryKey = 'detailID';
    
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
    
    public function produk(): HasOne
    {
        return $this->hasOne(Produk::class, 'produkID', 'produkID');
    }

}
