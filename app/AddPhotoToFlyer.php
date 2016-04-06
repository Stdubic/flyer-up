<?php

namespace App;


use App\Http\Controllers\PhotosController;
use Illuminate\Http\UploadedFile;


class AddPhotoToFlyer
{
    /**
     * The Flyer instance.
     *
     * @var Flyer
     */
    protected $flyer;
    /**
     * The Photo instance.
     *
     * @var
     */
    protected $photo;

    /**
     * Create new AddPhotoToFlyer from object.
     *
     * @param Flyer $flyer
     * @param UploadedFile $file
     * @param Thumbnail $thumbnail
     */
    public function __construct(Flyer $flyer, UploadedFile $file, Thumbnail $thumbnail= null)
    {
        $this->flyer = $flyer;
        $this->file = $file;
        $this->thumbnail = $thumbnail ?: new Thumbnail;

    }

    /**
     * Process the form.
     *
     * @return void
     */

    public function save()
    {
        $photo = $this->flyer->addPhoto($this->makePhoto());
        $this->file->move($photo->baseDir(), $photo->name);
        $this->thumbnail->make($photo->path, $photo->thumbnail_path);
    }

    /**
     * Make new photo instance.
     *
     * @return Photo
     */
    protected function makePhoto()
    {
        return new Photo(['name' => $this->makeFileName()]);
    }

    /**
     * Make a file name, based on the upload file.
     *
     * @return string
     */
    protected function makeFileName()
    {
        $name = sha1(
            time() . $this->file->getClientOriginalName()
        );
        $extension = $this->file->getClientOriginalName();

        return "{$name} . {$extension}";

    }
}
