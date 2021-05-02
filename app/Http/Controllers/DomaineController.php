<?php

namespace App\Http\Controllers;

use App\Models\Chapitre;
use App\Models\Domaine;
use App\Models\Grille;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class DomaineController extends Controller
{
    public function index($id){
        $chapitre = Chapitre::find($id);
        $domaines = DB::table('domaines')->where('chapitre_id', $id)->paginate(4);
        $grille = DB::table('grilles')->where('id',$chapitre->grille_id)->first();
        $etab = DB::table('users')->where('id',$grille->user_id)->first();
        if($chapitre){
            return view('domaine.index',[
                'chapitre'=>$chapitre,
                'domaines'=>$domaines,
                'grille'=>$grille,
                'etab'=>$etab
            ]);
        }
    }

    public function save(Request $request){
        $request->validate([
            'titre'=> 'required'
        ]);

        $exit = DB::table('domaines')
                ->where('titre' ,'=',$request->titre)
                ->where('chapitre_id' , '=', $request->idchapitre)->get();
        
        if($exit->count() == 0){
            $domaine = new Domaine;
            $domaine->titre = $request->titre;
            $domaine->chapitre_id = $request->idchapitre;
            $save = $domaine->save();
            if($save){
                return back()->with('succes' , 'chapitre ajouté avec succés');
            }else{
                
                return back()->with('fail' , 'Erreur !!');
            }
        }else{
                return back()->with('fail' , 'Erreur !! ce domaine est deja existante');
        }

    }

    public function list_domaine($id){
        $chapitre = Chapitre::find($id);
        $domaine = DB::table('domaines')
                    ->where('chapitre_id', $chapitre->id)
                    ->get();

        if($chapitre){
            return view('domaine.list_domaine',[
                'domaine'=> $domaine , 
                'chapitre'=> $chapitre
            ]);
        }
    }

    public function Edit($id){
        $domaine = Domaine::find($id);
        return view('domaine.edit',[
            'domaine'=>$domaine
        ]);
    }

    public function Update(Request $request){
        $request->validate([
            'titre'=>'required'
        ]);
        if(        DB::table('domaines')->where('id', $request->id)->update([
            'titre' => $request->titre

        ])){
            return back()->with('succes' , 'Modification avec succés');
        }else{
            return back()->with('fail' , 'Erreur! de modification');
        }
    }

    public function delete(Request $request){
        $i = Domaine::find($request->id);
        if($i){           
        $ref = DB::table('references')->where('domaine_id', $i->id)->get();
        foreach ($ref as $r) {
            $criteres = DB::table('criteres')->where('reference_id', $r->id)->get();
                foreach ($criteres as $c) {
                    DB::table('criteres')->where('id', $r->id)->delete();
                }
            DB::table('references')->where('id', $r->id)->delete();
        }
        $i->delete();
        return back()->with('succes', 'domaine supprimé avec succés');
        }
    }

    public function search(Request $request){
        $request->validate([
            'search' =>'required'
        ]);
        $chapitre = Chapitre::find($request->id);
        $grille = DB::table('grilles')
            ->where('id', '=', $chapitre->grille_id)
            ->first();
        $domaines = DB::table('domaines')
            ->where('titre', 'LIKE', '%'.$request->search.'%')
            ->where('chapitre_id' ,'=',$chapitre->id)
            ->get();
        $etab = User::find($grille->user_id);
        if ($domaines->count()==0) {
            return back()->with('fail' , 'aucun chapitre trouvé');
        } else {

            return view('domaine.show', [
                'domaines'=>$domaines,
                'chapitre' => $chapitre,
                'grille' => $grille,
                'etab'=>$etab
            ]);
        }
    }
}
