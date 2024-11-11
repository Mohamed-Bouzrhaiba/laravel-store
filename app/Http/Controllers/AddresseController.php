<?php

namespace App\Http\Controllers;

use App\Models\Addresse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddresseController extends Controller
{

    public function add(Request $request){
        $formFields = $request->validate([
            'address_line1'=>'required',
            'address_line2'=>'required',
            'city'=>'required',
            'state'=>'required',
            'postal_code'=>'required',
            'country'=>'required',
        ]);

        $formFields['user_id'] = Auth::user()->id;

       //dd($formFields);
       Addresse::create($formFields);
        return back()->with("success","addresse added ... select it now !");
    }
}
