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
 */
class Service extends Model
{
    protected $fillable = ["name", "points", "image"];

    protected $appends = ["image_linked"];

    public function getImageLinkedAttribute()
    {
        return isset($this->attributes["image"]) && $this->attributes["image"] ? \Storage::url($this->attributes["image"]) : null;
    }
}
