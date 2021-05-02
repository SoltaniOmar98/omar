<?php

namespace App\Http\Controllers;

use App\Http\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\MainController;
use App\Models\User as ModelsUser;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use phpDocumentor\Reflection\PseudoTypes\True_;

class AdminController extends Controller
{



    function Update_profil(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'digits:8',
            'adresse' => 'required',
            'ville' => 'required'

        ]);

        if (DB::table('users')->where('id', $request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'adresse' => $request->adresse,
            'ville' => $request->ville
        ])) {

            return back()->with('profil_update', 'modification avec succées');
        } else {
            return back()->with('fail', 'Erreur');
        }
    }

    function Update_password(Request $request)
    {
        $request->validate([
            'anc_password' => 'required',
            'nv_password' => 'required|min:5|max:12',
            'c_password' => 'required|min:5|max:12'
        ]);

        $userInfo = ModelsUser::where('id', '=', $request->id)->first();

        if (Hash::Check($request->anc_password, $userInfo->password)) {
            if ($request->nv_password == $request->c_password) {
                DB::table('users')->where('id', $request->id)->update([
                    'password' => Hash::make($request->c_password)
                ]);

                return back()->with('password_updated' , 'Votre mot de passe est modifié');
            } else {
                return back()->with('fail', 'Merci de confirmez votre mot de passe.');
            }
        } else {
            return back()->with('fail', 'Merci de vérifier votre ancien mot de passe.');
        }
    }
}
