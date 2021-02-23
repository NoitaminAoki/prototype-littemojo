<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Catalog;

class CatalogTopic extends Model
{
    use HasFactory;
    protected $guarded  = [];

    public function catalog()
    {
        return $this->belongsTo(Catalog::class, 'catalog_id');
    }
}
