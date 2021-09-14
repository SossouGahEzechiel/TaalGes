<?php

namespace App\Http\Controllers;

use App\models\Demande;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class StatController extends Controller
{
    public function futur(Request $request)
    {
        
        // dd(Demande::where('dateDeb','<',$list[$val])->get() ?? "Pas de résultat pour cette requête",$val,$list[$val]);
    } 

    public function maFonction ($int){
        switch ($int) {
            case 1:
                return 1;
                break;
            case 2:
                return 2;
                break;
            case 3:
                return 3;
                break;
            case 4:
                return 4;
                break;
            case 5:
                return 5;
                break;
            case 6:
                return 6;
                break;
        }
    } 
}
