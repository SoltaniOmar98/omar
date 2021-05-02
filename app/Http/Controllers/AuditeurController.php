<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\User as ModelsUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Mail\MAIL_compte;
use Illuminate\Support\Facades\Mail;

class AuditeurController extends Controller
{
    function Add_Expert(){
        return view('auditeur.AddExpert');
    }

    function Save_Expert(Request $request){
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'phone' => 'digits:8',
                'adresse' => 'required',
                'ville' => 'required'
            ]);
            $passrandom = rand(10000,9999999);
            $experts = new ModelsUser;
            $experts->name = $request->name;
            $experts->email = $request->email;
            $experts->phone = $request->phone ;
            $experts->adresse = $request->adresse;
            $experts->ville = $request->ville;
            $experts->role = 2;
            $experts->password = Hash::make($passrandom);
            $save = $experts->save();
            
            if($save){
                
                    $details = [
                        'title' => 'MES CORDONNÉS',
                        'login' => 'Votre login est' . " " . $experts->email,
                        'password' => 'Votre mot de passe est' . " " . $passrandom . '.'
                     ];
                 Mail::to($experts->email)->send(new MAIL_compte($details));
                return back()->with('succes', 'l expert '.$experts->name.' a était ajout avec succées!');
            }else{
                return back()->with('fail' , 'Erreur , Merci de ressayer plus tard!');
            }
                

    }
    function Expert_List(){
        $experts = DB::table('users')->where('role', 2)->paginate(4);
        return view('auditeur.Listauditeur',['experts'=> $experts]);
    }
    function Edit($id){
        $expert = User::find($id);
        return view('auditeur.edit', compact('expert'));
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
        $experts = DB::table('users')
                ->where('name', 'LIKE', '%'.$search_text.'%')
                ->where('role', '=', 2)
                ->paginate();
        //DB::select('SELECT * FROM `users` WHERE name LIKE'.'%'.$search_text.'%'.'AND role = 3');
        return view('auditeur.Listauditeur',['experts'=> $experts]);
    }
}
