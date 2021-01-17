<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HoneyType;

class HoneyTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('honey-type.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('honey-type.create');
    }

}
