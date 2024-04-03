<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';

    protected $primaryKey = 'produkID';
    
    protected $keyType = 'integer';

    protected $fillable = [
        'namaProduk',
        'harga',
        'stok'
    ];

    public function detailPembelian(): BelongsTo
    {
        return $this->belongsTo(DetailPembelian::class, 'detailPembelianID', 'detailPembelianID');
    }
}
