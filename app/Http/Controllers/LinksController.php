<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Link;

class LinksController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {
        Link::create(['url' => request('url')]);
        $request->session()->flash('message', 'Link successfully added');
        return redirect('dashboard');
    }

    public function delete(Request $request)
    {
        Link::destroy(request('linkId'));
        $request->session()->flash('message', 'Link successfully deleted');
        return redirect('dashboard');
    }
}
