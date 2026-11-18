<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DisclosureCategory extends Model
{
    protected $fillable = ['name', 'description', 'icon', 'theme_color'];

    public function documents()
    {
        return $this->hasMany(DisclosureDocument::class);
    }
}
