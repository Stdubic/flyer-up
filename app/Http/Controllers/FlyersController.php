<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Flyer;
use App\Photo;
use App\User;

use App\Http\Requests\FlyerRequest;
use App\Http\Requests\AddPhotoRequest;
use App\Http\Controllers\Controller;



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

        parent::__construct();
    }


    public function create()
    {

        return view('flyers.create');
    }

    public function store(FlyerRequest $request)
    {
        //$flyer = Flyer::create($request->all());


        $flyer = $this->user->publish(
            new Flyer($request->all())
        );

        flash()->success('Success!','Flyer successfully created!');

        return redirect(flyer_path($flyer));

    }

    public function show($zip, $street)
    {
        $flyer = Flyer::locatedAt($zip, $street);

        return view('flyers.show', compact('flyer'));
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



}
