<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;


class Photo extends Model
{
    protected $table = 'flyer_photos';

    protected $fillable = ['photo_path'];

    protected $baseDir = 'flyers/photos';



    public function flyer()
    {
        return $this->belongsTo('App\Flyer');
    }

    public static function fromForm(UploadedFile $file)
    {
        $photo = new static;

        $name = time() . $file->getClientOriginalName();

        $photo->photo_path = $photo->baseDir . '/' . $name;

        $file->move($photo->baseDir, $name);

        return $photo;


    }
}
