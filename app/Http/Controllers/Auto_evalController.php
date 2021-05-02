<?php

namespace App\Http\Controllers;

use App\Models\Chapitre;
use App\Models\Critere;
use App\Models\Domaine;
use App\Models\Grille;
use App\Models\Reference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Cast\Bool_;

class Auto_evalController extends Controller
{
    public function index(){

        $grille =  Grille::where('user_id', '=', session('LoggedUser'))->first();

        if(!$grille){
            return back()->with('warning' , 'Votre Grille est en cours de création');
        }else{
            return view('auto_eval.evaluation' , [
                'grille' => $grille
            ]);
        }
    }

    public function getallchapitre($id){
        $grille = Grille::find($id);
        if($grille){
            $chapitres = DB::table('chapitres')->where('grille_id', $grille->id)->get();
            if($chapitres->count()>0){
                return view('auto_eval.chapitre',[
                    'grille'=>$grille,
                    'chapitres'=>$chapitres
                ]);
            }else{
                return back()->with('warning', 'Vos chapitres en cours de création');
            }
        }else{
            return redirect()->route('auto_eval');
        }
    }

    public function get_chapitre(Request $request){
        $request->validate([
            'search' => 'required'
        ]);
        $chapitres = DB::table('chapitres')->where('titre' , 'LIKE' , '%'.$request->search.'%')->where('grille_id',$request->id)->get();
        if($chapitres->count()>0){
            $grille = Grille::find($request->id);
            return view('auto_eval.chapitre',[
                'grille'=>$grille,
                'chapitres'=>$chapitres
            ]);
        }
    }

    public function getalldomaine($id){
        $chapitre = Chapitre::find($id);    
        if($chapitre){
            $grille = Grille::find($chapitre->grille_id);
            $domaines = DB::table('domaines')->where('chapitre_id' , $chapitre->id)->get();
            if($domaines->count()>0){
                return view('auto_eval.domaines' , [
                    'grille'=>$grille ,
                    'chapitre'=>$chapitre ,
                    'domaines'=>$domaines
                ]);
            }else{
                return back()->with('warning','Les domaines pour le chapitre '.$chapitre->titre.'en cours de création');
            }
        }
    }
    public function get_domaine(Request $request){
        $chapitre = Chapitre::find($request->id);
        if($chapitre){
            $grille = Grille::find($chapitre->grille_id);
            $domaines = DB::table('domaines')->where('titre' , 'LIKE' , '%'.$request->search.'%')->where('chapitre_id' , $request->id)->get();
            if($domaines->count()>0){
                return view('auto_eval.domaines' , [
                    'grille'=>$grille ,
                    'chapitre'=>$chapitre ,
                    'domaines'=>$domaines
                ]);
            }else{
                return back()->with('warning' ,'Aucun domaine trouvé');
            }
        }
    }

    public function getallreference($id){
        $domaine = Domaine::find($id);
        if($domaine){
            $chapitre = Chapitre::find($domaine->chapitre_id);
            $grille = Grille::find($chapitre->grille_id);
            $references = DB::table('references')->where('domaine_id' , $domaine->id)->get();
            if($references->count()>0){
                return view('auto_eval.references' , [
                    'grille'=>$grille ,
                    'chapitre'=>$chapitre ,
                    'domaine'=>$domaine,
                    'references'=>$references
                ]);
            }else{
                return back()->with('warning' ,'les references de domaine ' .$domaine->titre.'en cours de création');
            }
        }
    }

    public function get_reference(Request $request){
        $request->validate([
            'search'=>'required'
        ]);

        $domaine = Domaine::find($request->id);
        if($domaine){
            $chapitre = Chapitre::find($domaine->chapitre_id);
            $grille = Grille::find($chapitre->grille_id);
            $references = DB::table('references')->where('titre' , 'LIKE' , '%'.$request->search.'%')->where('domaine_id' , $request->id)->get();
            if($references->count()>0){
                return view('auto_eval.references' , [
                    'grille'=>$grille ,
                    'chapitre'=>$chapitre ,
                    'domaine'=>$domaine,
                    'references'=>$references
                ]);
            }else{
                return back()->with('warning' ,'Aucun réference trouvé');
            }
        }
    }

    public function getallcritere($id){
        $ref = Reference::find($id);
        if($ref){
            $domaine = Domaine::find($ref->domaine_id);
            $chapitre = Chapitre::find($domaine->chapitre_id);
            $grille = Grille::find($chapitre->grille_id);
            $critere = DB::table('criteres')->where('reference_id' , $ref->id)->get();
            if($critere->count()>0){
                return view('auto_eval.critere' , [
                    'grille'=>$grille ,
                    'chapitre'=>$chapitre ,
                    'domaine'=>$domaine,
                    'ref'=>$ref,
                    'critere'=>$critere
                ]);
            }else{
                return back()->with('warning' , 'les criteres de referernce'.$ref->titre.' en cours de préparation');
            }
        }
    }
    public function InsertNote(Request $request){
        $request->validate([
            'note'=>'required'
        ]);
            foreach($request->id as $item=>$v){
                $x = false;
                $affected = DB::table('criteres')
                              ->where('id', $v)
                              ->update(['note_AE' => $request->note[$item]]);
                $x = true;
            }
            if($x){
                return back()->with('success' , 'Critere complet');
            }
        
    }
}
