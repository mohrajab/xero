<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Service
 *
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property int $points
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service wherePoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service whereUpdatedAt($value)
 * @property string|null $image
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service whereImage($value)
 * @property-read mixed $image_linked
 * @property float $version
 * @property string|null $compatibility
 * @property-read mixed $downloads
 * @property-read mixed $tags_classes
 * @property-read mixed $tags_list
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Tag[] $tags
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service whereCompatibility($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service whereVersion($value)
 */
class Service extends Model
{
    protected $fillable = ["name", "points", "image"];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function getDownloadsAttribute()
    {
        return rand(100,1000);
    }

    public function getTagsClassesAttribute()
    {
        return $this->tags->pluck('name')->map(function($name){
            return strtolower($name);
        })->implode(" ");
    }

    public function getTagsListAttribute()
    {
        return $this->tags->pluck('name')->implode(" , ");
    }
}
