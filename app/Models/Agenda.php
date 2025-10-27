<?php

namespace App\Models;

use App\Enums\PublikasiStatus;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Agenda extends Model
{
    protected $table = "agenda";
    
    protected $fillable = [
        'penanggung_jawab_id',
        'date',
        'time',
        'title',
        'location',
        'is_published',
    ];

    protected $casts = [
        'is_published'  => PublikasiStatus::class,
    ];

    // RELATION
    public function penanggungJawab()
    {
        return $this->belongsTo(User::class, 'penanggung_jawab_id', 'id');
    }

    // SCOPE
    public function scopePenanggungJawab($query, $penanggungJawab)
    {
        if ($penanggungJawab != "Semua") {
            $query->where('penanggung_jawab_id', $penanggungJawab);
        }
    }

    public function scopePublished($query)
    {
        $query->where('is_published', PublikasiStatus::Published);
    }

    public function scopeUnpublished($query)
    {
        $query->where('is_published', PublikasiStatus::Unpublished);
    }

    public function scopeOngoing($query)
    {
        $query->where('is_published', PublikasiStatus::Published)->whereDate('date', '>=', Carbon::today());
    }

    public function scopeStatus($query, $status)
    {
        if ($status != "Semua") {
            $query->where('is_published', $status);
        }
    }

    public function scopeDaterange($query, $daterange)
    {
        $filter = explode(' - ', $daterange);
        $startDate = Carbon::createFromFormat('Y-m-d', $filter[0])->startOfDay();
        $endDate = Carbon::createFromFormat('Y-m-d', $filter[1])->endOfDay();
        $query->whereBetween('date', [$startDate, $endDate]);
    }

    public function scopeSearch($query, $search)
    {
        $query->where('title', 'like', '%' . $search . '%')->orWhere('location', 'like', '%' . $search . '%');
    }
}