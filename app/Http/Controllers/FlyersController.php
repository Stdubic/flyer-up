<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Flyer;
use App\Photo;

use App\Http\Requests\FlyerRequest;
use App\Http\Requests\ChangeFlyerRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\UploadedFile;

class FlyersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }


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
        $flyer = Flyer::locatedAt($zip, $street);

        return view('flyers.show', compact('flyer'));
    }

    public function addPhoto($zip, $street, ChangeFlyerRequest $request)
    {

        $photo = $this->makePhoto($request->file('photo'));

        Flyer::locatedAt($zip, $street)->addPhoto($photo);


    }
    protected function userCreatedFlyer(Request $request)
    {

    }
    protected function unauthorized(Request $request)
    {
        if($request->ajax()){

            return response(['message' => 'No Way'], 403);
        }
        flash('No Way');
        return redirect('/');
    }


    protected function makePhoto(UploadedFile $file)
    {
        return Photo::named($file->getClientOriginalName())
            ->move($file);
    }
}
