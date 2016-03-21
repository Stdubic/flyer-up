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
        $street = str_replace('-', ' ', $street);

        $flyer = Flyer::where(compact('zip', 'street'))->first();

        return view('flyers.show', compact('flyer'));
    }
}
