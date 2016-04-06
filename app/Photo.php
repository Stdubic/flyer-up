<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Image;

class Photo extends Model
{
    /**
     * The associated table
     *
     * @var string
     */
    protected $table = 'flyer_photos';

    /**
     * Fillable fields for a photo.
     *
     * @var array
     */
    protected $fillable = ['path', 'name', 'thumbnail_path'];


    /**
     * Photo belongs to flyer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function flyer()
    {
        return $this->belongsTo('App\Flyer');
    }

    /**
     * Get photos directory path.
     *
     * @return string
     */
    public function baseDir()
    {
        return 'images/photos';
    }

    /**
     * Setting name attributes for photo.
     *
     * @param $name
     */
    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;
        $this->path = $this->baseDir() . '/' . $name;
        $this->thumbnail_path = $this->baseDir() . '/tn-' . $name;
    }

    /**
     * Delete the photo.
     *
     * @return bool|null|void
     * @throws \Exception
     */
    public function delete()
    {
        \File::delete([
            $this->path,
            $this->thumbnail_path
        ]);

        parent::delete();

    }


}
