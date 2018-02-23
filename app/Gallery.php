<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Gallery extends Model
{
    public function pictures() {
        return $this->hasMany(Picture::class);
    }

    public function user() {
        return $this->belongsTo('App\User', 'author_id', 'id');
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    /**
     * @param array $images
     */
    public function syncImages(array $images)
    {
        $oldImages = $this->images;
        $images = collect($images);

        $oldImages->filter(
            function (Picture $oldImage) use ($images) {
                return empty($images->where('id', $oldImage->id)->first());
            }
        )->map(function (Picture $oldImage) {
            $id = $oldImage->id;
            $oldImage->delete();

            return $id;
        });

        $newImages = $images->filter(function ($image) {
            return empty($image['id']);
        })->map(function ($newImage) {
            return new Picture($newImage);
        });

        $images->filter(
            function ($image) {
                return !empty($image['id']);
            })->map(function ($updateImage) {
            $image = Picture::find($updateImage['id']);

            $image->url = $updateImage['url'];
            $image->order = $updateImage['order'];

            $image->save();

            return $image;
        });

        $this->images()->saveMany($newImages);
    }

    public function images()
    {
        return $this->hasMany(Picture::class);
    }





}
