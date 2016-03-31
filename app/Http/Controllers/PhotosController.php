<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AddPhotoToFlyer;
use App\Http\Requests;
use App\Flyer;


use App\Http\Requests\AddPhotoRequest;
use App\Http\Controllers\Controller;


class PhotosController extends Controller
{
    public function store($zip, $street, AddPhotoRequest $request)
    {
        $flyer = Flyer::locatedAt($zip, $street);
        $photo = $request->file('photo');

        (new AddPhotoToFlyer($flyer, $photo))->save();

    }
}
