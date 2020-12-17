<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\ActionType;

class ActionTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         return view('action-type.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('action-type.create');
    }
}

