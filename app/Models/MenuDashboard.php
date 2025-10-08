<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuDashboard extends Model
{
    use SoftDeletes;

    protected $table = 'menu_dashboard';

    protected $fillable = [
        'parent_id',
        'name',
        'icon',
        'route',
    ];

    public function parent()
    {
        return $this->belongsTo(MenuDashboard::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(MenuDashboard::class, 'parent_id')->with('children');
    }
}
