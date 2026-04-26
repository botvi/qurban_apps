<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;

use App\Models\Materi;
use App\Models\NilaiQuiz;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index()
    {
        return view('pageuser.index');
    }
}