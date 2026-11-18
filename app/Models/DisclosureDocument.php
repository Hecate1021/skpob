<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DisclosureDocument extends Model
{
    protected $fillable = ['disclosure_category_id', 'title', 'year', 'file_path'];

    public function category()
    {
        return $this->belongsTo(DisclosureCategory::class, 'disclosure_category_id');
    }
}
