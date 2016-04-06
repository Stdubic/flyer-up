<?php

namespace App;
use Image;


class Thumbnail
{
    /**
     * Make thumbnail for the photo.
     *
     * @param $src
     * @param $destination
     */
    public function make($src, $destination)
    {
        Image::make($src)
             ->fit(200)
             ->save($destination);
    }

}