<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\User as ModelsUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\MAIL_compte;

class EtablissementController extends Controller
{
    function Index()
    {
        $etabs = DB::table('users')->where('role', 3)->paginate(4);
        return view('etablissement.index', ['etabs' => $etabs]);
    }

    function AddEtab()
    {
        return view('etablissement.AddEtab');
    }
    function Save(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'digits:8',
            'adresse' => 'required',
            'ville' => 'required'
        ]);
        $exist = DB::table('users')->where('email' , $request->email)->orWhere('phone' , $request->phone)->get();
        if($exist->count() == 0){
            $passrandom = rand(10000,9999999);
        $etab = new ModelsUser;
        $etab->name = $request->name;
        $etab->email = $request->email;
        $etab->phone = $request->phone ;
        $etab->adresse = $request->adresse;
        $etab->ville = $request->ville;
        $etab->role = 3;
        $etab->password = Hash::make($passrandom);
        $save = $etab->save();
        
        if($save){
            $details = [
                'title' => 'MES CORDONNÉS',
                'login' => 'Votre login est' . " " . $etab->email,
                'password' => 'Votre mot de passe est' . " " . $passrandom . '.'
            ];
            Mail::to($etab->email)->send(new MAIL_compte($details));
            return back()->with('succes', 'l établissement '.$etab->name.' a était ajout avec succées!');
        }else{
            return back()->with('fail' , 'Erreur , Merci de ressayer plus tard!');
        }
        }else{
            return back()->with('fail' ,'utilisateur existant');
        }
    }
    function Edit($id){
        $etab = User::find($id);
        return view('etablissement.edit', compact('etab'));
    }

    function Update(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'digits:8',
            'adresse' => 'required',
            'ville' => 'required'
    ]);
    
        if(        DB::table('users')->where('id', $request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'adresse'=> $request->adresse,
            'ville'=> $request->ville

        ])){
            return back()->with('succes' , 'Modification avec succés');
        }else{
            return back()->with('fail' , 'Erreur! de modification');
        }

    }

    function Delete(Request $request) {
        DB::table('users')->where('id',$request->id)->delete();
        return back()->with('succes', 'Expert supprimé avec succées');
    }

    function Search()
    {
        $search_text = $_GET['search'];
        $etabs = DB::table('users')
                ->where('name', 'LIKE', '%'.$search_text.'%')
                ->where('role', '=', 3)
                ->paginate();
        //DB::select('SELECT * FROM `users` WHERE name LIKE'.'%'.$search_text.'%'.'AND role = 3');
        return view('etablissement.index', ['etabs' => $etabs]);
    }
}
