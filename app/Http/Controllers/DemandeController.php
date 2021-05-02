<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use App\Models\User;
use App\Mail\MAIL_compte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


class DemandeController extends Controller
{
    function Index()
    {
        return view('/demande.engagement');
    }

    function Save(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'digits:8',
            'adresse' => 'required',
            'ville' => 'required'

        ]);
        
        $trouve = DB::table('users')->where('email', $request->email)->orWhere('phone', $request->phone)->get();
        $exit = DB::table('demandes')->where('email', $request->email)->orWhere('phone', $request->phone)->get();
        if ($trouve->count() == 0) {
            if ($exit->count() == 0) {
                $demande = new Demande;
                $demande->name = $request->name;
                $demande->email = $request->email;
                $demande->phone = $request->phone;
                $demande->adresse = $request->adresse;
                $demande->ville = $request->ville;
                $save = $demande->save();
                if ($save) {
                    return back()->with('success', 'Votre demande a était bien enregistrer nous envoyerons un email de confirmation');
                } else {
                    return back()->with('fail', 'Merci de ressayer votre demande plus tard');
                }
            } else {
                return back()->with('fail', 'votre demande a éte enregistré une mail de vérifiaction encore de traitement');
            }
        } else {
            return back()->with('fail', 'ce email où numéro du téléphone déja existant');
        }
    }

    function DisplayDemande()
    {
        $demandes = DB::table('demandes')->get();
        return view('demande.index', compact('demandes'));
    }

    function AccepterDemande($id)
    {
        $passrandom = rand(100000, 9999999);
        //Search Demande 
        $demande = Demande::find($id);
        if ($demande) {
            $etab = new User;
            $etab->name = $demande->name;
            $etab->email = $demande->email;
            $etab->phone = $demande->phone;
            $etab->adresse = $demande->adresse;
            $etab->ville = $demande->ville;
            $etab->role = 3;
            $etab->password = Hash::make($passrandom);
            $etab->save();
            $details = [
                'title' => 'MES CORDONNÉS',
                'login' => 'Votre login est' . " " . $etab->email,
                'password' => 'Votre mot de passe est' . " " . $passrandom . '.'
            ];
            Mail::to($etab->email)->send(new MAIL_compte($details));
            $demande->delete();
            return back()->with('succes', 'L etablissement' . " " . $etab->name . " " . 'a éte ajouter avec succées et en envoi un mail');
        } else {
            return back()->with('fail', 'Erreur ! Merci de réassyer plus tard');
        }
    }

    function Refuse(Request $request)
    {
        DB::table('demandes')->where('id', $request->id)->delete();
        return back()->with('succes', 'Demande supprimé avec succées');
    }
}
