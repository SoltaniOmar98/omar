<?php

namespace App\Http\Controllers;

use App\Models\Chapitre;
use App\Models\Domaine;
use App\Models\Grille;
use App\Models\Reference;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReferenceController extends Controller
{
    public function index($id){
        $domaine = Domaine::find($id);
        $reference = DB::table('references')->where('domaine_id', $id)->paginate(4);
        $chapitre = DB::table('chapitres')->where('id',$domaine->chapitre_id)->first();
        $grille = DB::table('grilles')->where('id', $chapitre->grille_id)->first();
        $etab = DB::table('users')->where('id', $grille->user_id)->first();
        return view('reference.index',[
            'reference' => $reference,
            'domaine'=>$domaine,
            'chapitre'=>$chapitre,
            'grille'=>$grille,
            'etab'=>$etab
        ]);
    }
    public function list_ref($id){
        $domaine = Domaine::find($id);
        $reference = DB::table('references')->where('domaine_id', $id)->get();
        return view('reference.list_ref',[
            'reference'=>$reference,
            'domaine'=>$domaine
        ]);

    }
    public function save(Request $request){
        $request->validate([
            'titre'=>'required'
        ]);
        $exit = DB::table('references')->where('titre' , $request->titre)->where('domaine_id',$request->id)->get();
        if($exit->count()==0){
            $ref = new Reference;
            $ref->titre = $request->titre ;
            $ref->domaine_id = $request->id;
            if($ref->save()){
                 return back()->with('succes', 'Référence ajouté avec succées');
             }else{
                 return back()->with('fail' , 'Erreur');
        }}
        else{
            return back()->with('fail' , 'ce refernce déja existant');
        }
        
    }

    public function Edit($id){
        $ref = Reference::find($id);
        return view('reference.edit',[
               'ref'=>$ref
        ]); 
        
    }
    public function Update(Request $request){
        $request->validate([
            'titre'=>'required'
        ]);
        if(DB::table('references')->where('id', $request->id)->update([
            'titre' => $request->titre

        ])
        )
        {
            return back()->with('succes' , 'Modification avec succés');
        }else{
            return back()->with('fail' , 'Erreur');
        } 
    }

    public function delete(Request $request){
        $i = Reference::find($request->id);
        $criteres = DB::table('criteres')->where('reference_id', $i->id)->get();
                            foreach ($criteres as $c) {
                                DB::table('criteres')->where('id', $c->id)->delete();
                            }
        $i->delete();
        return back()->with('succes', 'reference supprimé avec succés');
    }

    public function search(Request $request){
        $request->validate([
            'search'=>'required'
        ]);
        $domaine = Domaine::find($request->id);
        $chapitre = Chapitre::find($domaine->chapitre_id);
        $grille = Grille::find($chapitre->grille_id);
        $etab = User::find($grille->user_id);
        $reference = DB::table('references')
        ->where('titre','LIKE', '%'.$request->search.'%')
        ->where('domaine_id', '=', $request->id)
        ->get();
        if($reference->count()==0){
            return back()->with('fail' , 'refernce introuvable');
        }else{
            return view('reference.show', [
                'domaine'=>$domaine ,
                'chapitre'=>$chapitre ,
                'grille'=>$grille ,
                'reference'=>$reference,
                'etab'=>$etab
            ]);
        }
    }
}
