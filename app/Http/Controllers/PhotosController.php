<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AddPhotoToFlyer;
use App\Http\Requests;
use App\Flyer;
use App\Photo;


use App\Http\Requests\AddPhotoRequest;
use App\Http\Controllers\Controller;


class PhotosController extends Controller
{
    /**
     * Apply photo to the referenced flyer.
     *
     * @param $zip
     * @param $street
     * @param AddPhotoRequest $request
     */
    public function store($zip, $street, AddPhotoRequest $request)
    {
        $flyer = Flyer::locatedAt($zip, $street);
        $photo = $request->file('photo');

        (new AddPhotoToFlyer($flyer, $photo))->save();

    }

    /**
     * Delete photo from flyer.
     *
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $photo = Photo::findOrFail($id);
        $photo->delete();

        return back();
    }
}
