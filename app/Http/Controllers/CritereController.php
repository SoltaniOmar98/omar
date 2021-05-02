<?php

namespace App\Http\Controllers;

use App\Models\Critere;
use App\Models\Reference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CritereController extends Controller
{
    public function list_critere($id){
        $ref = Reference::find($id);
        $critere = DB::table('criteres')->where('reference_id',$id)->get();
        if($critere){
            return view('critere.list',[
                'reference'=>$ref , 
                'critere'=>$critere
            ]);
        }
    }
    public function index($id)
    {
        $ref = Reference::find($id);
        $criteres = Db::table('criteres')->where('reference_id' , $id)->paginate(4);
        $domaine = DB::table('domaines')->where('id', $ref->domaine_id)->first();
        $chapitre = DB::table('chapitres')->where('id', $domaine->chapitre_id)->first();
        $grille = DB::table('grilles')->where('id', $chapitre->grille_id)->first();
        $etab = DB::table('users')->where('id', $grille->user_id)->first();
        return view('critere.index', [
            'reference' => $ref,
            'domaine' => $domaine,
            'chapitre' => $chapitre,
            'grille' => $grille,
            'etab' => $etab,
            'criteres'=>$criteres
        ]);
    }

    public function save(Request $request){
        $request->validate([
            'titre'=>'required'
        ]);
        $exist = DB::table('criteres')->where('titre',$request->titre)->where('reference_id',$request->id)->get();
        if($exist->count() == 0){
            $critere = new Critere;
            $critere->titre = $request->titre ;
            $critere->reference_id = $request->id;
            if($critere->save()){
                return back()->with('succes', 'critére ajouté avec succées');
            }else{
                return back()->with('fail' , 'Erreur');
        }
        }else{
            return back()->with('fail', 'Critere existant');
        }
    }

    public function Edit($id){
        $critere = Critere::find($id);
        return view('critere.edit' , [
            'critere' => $critere
        ]);
    }

    public function Update(Request $request){
        $request->validate([
            'titre'=> 'required'
        ]);
        if(        DB::table('domaines')->where('id', $request->id)->update([
            'titre' => $request->titre

        ])){
            return back()->with('succes' , 'Modification avec succés');
        }else{
            return back()->with('fail' , 'Erreur! de modification');
        }
    }

    public function search(Request $request){
        $request->validate([
            'search'=>'required'
        ]);
        $ref = Reference::find($request->id);
        if($ref){
            $critere = DB::table('criteres')
                ->where('titre','LIKE', '%'.$request->search.'%')
                ->where('reference_id' , '=', $ref->id)
                ->get();
            if($critere->count()==0){
                return back()->with('fail critére intouvable');
            }else{
                return view('critere.show',[
                    'critere'=>$critere,
                    'ref'=>$ref
                ]);
            }
        }
    }

    public function delete(Request $request){
        $critere = Critere::find($request->id);
        if($critere->delete()){
            return back()->with('succes','GOOD');
        }else{
            return back()->with('fail','Error');
        }

    }
}
