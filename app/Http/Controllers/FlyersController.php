<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Flyer;


use App\Http\Requests\FlyerRequest;
use App\Http\Controllers\Controller;

class FlyersController extends Controller
{

    /*
     *
     *
     */
    public function create()
    {

        return view('flyers.create');
    }

    public function store(FlyerRequest $request)
    {
        Flyer::create($request->all());

        flash()->success('Success!','Flyer successfully created!');

        return redirect()->back();

    }

    public function show($zip, $street)
    {
        $flyer = Flyer::locatedAt($zip, $street)->first();

        return view('flyers.show', compact('flyer'));
    }

    public function addPhoto($zip, $street, Request $request)
    {

        $file = $request->file('file');

        $name = time() . $file->getClientOriginalName();

        $file->move('flyers/photos', $name);

        $flyer = Flyer::locatedAt($zip, $street)->first();

        $flyer->photos()->create(['photo_path' => "flyers/photos/{$name}"]);

        return 'done';

    }
}
