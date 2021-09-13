<?php

namespace App\Http\Controllers;

use App\models\Demande;
use Illuminate\Support\Carbon;

class StatController extends Controller
{
    public function aVenir()
    {
        dd($this->travel(5)->milliseconds());
        dd(Demande::where('dateDeb','>',now())
            ->orWhere('dateDeb','<',now())
            ->get())
        ;
    }
}
