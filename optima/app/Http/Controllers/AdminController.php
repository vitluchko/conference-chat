<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activeConference = Conference::where('isActive', true)->first();

        $isActiveConference = $activeConference->isActive;

        return view('admin.index', compact('isActiveConference'));
    }
}
