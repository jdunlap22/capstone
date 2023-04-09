<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Item extends Model
{
    use SoftDeletes;

    public $table = 'items';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    protected $dates = ['deleted_at'];
    protected $fillable = ['name', 'description', 'image', 'category_id'];

    public function category() {
        return $this->hasOne('\App\Category','id', 'category_id')->orderBy('name','ASC');
    }

    //function to set image that will auto update the image field when a new image is added
    public function setImage($value) {
        $this->attributes['image'] = $value;
        if ($value) {
            $this->deleteImage();
            $this->attributes['image'] = $this->newImage($value);
        }
    }

    //function checks if there was a previous image, then if new iamge is different delete old image and place new one
    protected function deleteImage() {
        if($this->getOriginal('image') && $this->getOriginal('image') !== $this->image) {
            Storage::delete('public/storage/images' . $this->getOriginal('image'));
        }
    }

    //stores new image into proper directory, returns path to new image
    protected function newImage($image) {
        return $image->store('public/storage/images');
    }

}
