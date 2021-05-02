<?php

namespace App\Http\Controllers;

use App\Mail\Mail_c;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class UtilisateurController extends Controller
{


    public $code;
    function Index(){
        return view('auth.login');
    }

    function Check(Request $request){
           //Controle de saisi
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:5|max:12'
    ]);

     //Verifier les information en DB
     $userInfo = User::where('email' , '=', $request->email)->first();
    
     if(!$userInfo){
         //Adresse email introuvable
         return back()->with('fail', 'Merci de vérifier vote adresse email.');
     }else{
         //Vérifier mot de passe 
         if(Hash::Check($request->password , $userInfo->password)){
             $request->session()->put('LoggedUser',$userInfo->id);
             
             $role = $userInfo->role;
             if($role == 1){
                 return redirect('admin/dashboard');
             }elseif($role == 2){
                 return redirect('auditeur/dashboard');
             }elseif($role == 3){
                 return redirect('etablissement/dashboard');
             }
             
         }else{
             return back()->with('fail', 'Mot de passe incorrect');
         }
     }
 
    }

    public function Home(){
        $data = ['LoggedUserInfo' => User::where('id', '=', session('LoggedUser'))->first()];
        return view('components.home',$data);
    }
    //Redirect admin dashboard
    function Dash_admin()
    {
            $expert = DB::table('users')->where('role',2)->get();
            $etab = DB::table('users')->where('role',3)->get();
            $demande = DB::table('demandes')->get();
            $data = ['LoggedUserInfo' => User::where('id', '=', session('LoggedUser'))->first()];
            return view('components.home', [
                'expert'=>$expert,
                'etab'=>$etab,
                'demande'=>$demande
            ],$data);
     }
        //Redirect admin dashboard
    function Dash_expert()
    {
        
            $data = ['LoggedUserInfo' => User::where('id', '=', session('LoggedUser'))->first()];
            return view('auditeur.dashboard', $data);
     }
        //Redirect admin dashboard
    function Dash_etab()
    {    
            $data = ['LoggedUserInfo' => User::where('id', '=', session('LoggedUser'))->first()];
            return view('etablissement.dashboard', $data);
     }
    //Affiche donneées user
    function Show_me()
    {
        $data = ['LoggedUserInfo' => User::where('id', '=', session('LoggedUser'))->first()];
        return view('components.profil', $data);
    }
    function Resetpassword(){
        return view('auth.ResetPassword');
    }
    //Sendmail
    function Sendmail(Request $request){
        
        $request->validate([
            'email' => 'required|email'
        ]);
        $data = ['LoggedUser' =>User::where('email' , '=', $request->email)->first()];
        $user = User::where('email' , '=', $request->email)->first();

        if($user == null){
            return back()->with('fail' , 'Merci de vérifier votre adresse email');
        }else {
            $this->code = rand(10000,9999999);
        DB::table('users')->where('email', $user->email)->update([
            'code' => $this->code
        ]);

        $details = [
            'title' =>'Récupération du compte',
            'body' => 'Votre code de récupération est'. " " .$this->code.'.'
        ];

        Mail::to($user->email)->send(new Mail_c($details));
        return view('auth.validecode', $data);
        }
        
    }

    //Valider Compte 
    function ValiderCode(Request $request){
        $request->validate([
            'code'=> 'required'
        ]);
        $data = ['LoggedUser' =>User::where('id' , '=', $request->id)->first()];
        $user = User::where('id' , '=', $request->id)->first();
        if($request->code == $user->code){
            return view('auth.UpdatePassword',$data);
        }
        else{
            return back()->with('fail' , 'Code incorrect');
        }
    }

    function UpdatePassword(Request $request){
        $request->validate([
            'NV_password' => 'required',
            'Conf_password' => 'required'
        ]);
    
        if($request->NV_password == $request->Conf_password){

            DB::table('users')->where('id', $request->id)->update([
                'password' => Hash::make($request->Conf_password)
            ]);
            return back()->with('succes', 'Vous avez recupérer votre compte');
        }else{
            return back()->with('fail', 'Merci de confirmer votre mot de passe');
        }
    }
    //Logout
    function Logout()
    {
        if (session()->has('LoggedUser')) {
            session()->pull('LoggedUser');
            return redirect('/auth/login');
        }
    }
}
