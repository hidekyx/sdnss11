<?php

namespace App\Models;

use App\Enums\PublikasiKategori;
use App\Enums\PublikasiStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table = "berita";

    protected $fillable = [
        'tags',
        'kategori',
        'title',
        'slug',
        'writer_id',
        'content',
        'caption',
        'img',
        'img_2',
        'img_3',
        'img_4',
        'quote',
        'quote_by',
        'thumbnail',
        'viewed',
        'is_published',
        'published_at',
    ];

    protected $casts = [
        'kategori'       => PublikasiKategori::class,
        'is_published'   => PublikasiStatus::class,
    ];

    // RELATION
    public function writer()
    {
        return $this->belongsTo(User::class, 'writer_id', 'id');
    }

    public function quoteBy()
    {
        return $this->belongsTo(User::class, 'quote_by', 'id');
    }

    // SCOPE
    public function scopeSearch($query, $search)
    {
        $query->where('title', 'like', '%' . $search . '%')
            ->orWhere('content', 'like', '%' . $search . '%');
    }

    public function scopeStatus($query, $status)
    {
        if ($status != "Semua") {
            $query->where('is_published', $status);
        }
    }

    public function scopeCategory($query, $kategori)
    {
        if ($kategori != "Semua") {
            $query->where('kategori', $kategori);
        }
    }

    public function scopeTag($query, $tag)
    {
        $query->where('tags', 'like', '%' . $tag . '%');
    }

    public function scopeMonth($query, $bulan)
    {
        $filter = explode('-', $bulan);
        $query->whereMonth('published_at', $filter[1])->whereYear('published_at', $filter[0]);
    }

    public function scopeDaterange($query, $daterange)
    {
        $filter = explode(' - ', $daterange);
        $startDate = Carbon::createFromFormat('Y-m-d', $filter[0])->startOfDay();
        $endDate = Carbon::createFromFormat('Y-m-d', $filter[1])->endOfDay();
        $query->whereBetween('published_at', [$startDate, $endDate]);
    }

    public function scopePublished($query)
    {
        $query->where('is_published', 1)->where('published_at', '<', Carbon::now());
    }

    public function scopeUnpublished($query)
    {
        $query->where('is_published', 0);
    }

    public function scopeLatestWithTotal($query)
    {
        $query->selectRaw('*, (SELECT COUNT(*) FROM berita AS b2 WHERE b2.is_published = 1 AND b2.kategori = berita.kategori) as total')->whereIn('id', function ($subquery) {
            $subquery->selectRaw('MAX(id)')
                ->from('berita')
                ->groupBy('kategori');
        });
    }

    public function scopeTrending($query)
    {
        $query->orderByDesc('viewed');
    }

    public function scopeYearly($query)
    {
        $query->whereBetween('published_at', [
            Carbon::now()->startOfYear(),
            Carbon::now()->endOfYear()
        ]);
    }

    public function scopeMonthly($query)
    {
        $query->whereBetween('published_at', [
            Carbon::now()->startOfMonth(),
            Carbon::now()->endOfMonth()
        ]);
    }

    public function scopeWeekly($query)
    {
        $query->whereBetween('published_at', [
            Carbon::now()->subDays(7)->startOfDay(),
            Carbon::now()->endOfDay()
        ]);
    }

    // ACCESSORS
    protected static function getOrderByTagCount()
    {
        $tags = self::select('tags')
            ->whereNotNull('tags')
            ->where('tags', '!=', '')
            ->published()
            ->distinct()
            ->pluck('tags')
            ->implode(', ');

        $tagsArray = explode(', ', $tags);
        $tagCounts = array_count_values($tagsArray);
        arsort($tagCounts);

        return collect($tagCounts)->take(15);
    }

    public function getTagsArray()
    {
        return explode(', ', $this->tags);
    }

    protected static function getSameTags($tags)
    {
        return self::where('tags', 'like', '%' . $tags . '%')->orderByDesc('id')->limit(5)->get();
    }

    public static function getTotalBeritaViewed()
    {
        return self::sum('viewed');
    }
}
