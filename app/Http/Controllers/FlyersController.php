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


    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);

        parent::__construct();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {

        return view('flyers.create');
    }

    /**
     * Store a newly created flyer
     *
     * @param FlyerRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(FlyerRequest $request)
    {

        $flyer = $this->user->publish(
            new Flyer($request->all())
        );

        flash()->success('Success!','Flyer successfully created!');

        return redirect(flyer_path($flyer));

    }

    /**
     * Show flyer.
     *
     * @param $zip
     * @param $street
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($zip, $street)
    {
        $flyer = Flyer::locatedAt($zip, $street);

        return view('flyers.show', compact('flyer'));
    }

    /**
     * Validation the ajax request.
     *
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Symfony\Component\HttpFoundation\Response
     */
    protected function unauthorized(Request $request)
    {
        if($request->ajax()){

            return response(['message' => 'No Way'], 403);
        }
        flash('No Way');
        return redirect('/');
    }



}
