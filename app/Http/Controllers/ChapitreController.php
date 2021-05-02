<?php

namespace App\Http\Controllers;

use App\Models\Chapitre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Grille;
use App\Models\User;

class ChapitreController extends Controller
{
    public function list_chapitre($id){
        $grille = Grille::find($id);
        $chapitre = DB::table('chapitres')->where('grille_id','=',$id)->get();
        return view('chapitre.index',[
            'chapitre'=>$chapitre,
            'grille'=>$grille
        ]);
    }
    function index()
    {
        return view('chapitre.add-chapitre');
    }
    public function save(Request $request)
    {

        $request->validate([
            'chapitre' => 'required'
        ]);

        $exit = DB::table('chapitres')
            ->where('titre' , $request->chapitre)
            ->where('grille_id' , $request->idgrille)
            ->get();
            if($exit->count() > 0){
                return back()->with('fail' , 'Chapitre déja utilisé');
            }else{
                $chapitre = new Chapitre;
                $chapitre->titre = $request->chapitre;
                $chapitre->grille_id = $request->idgrille;
                $save = $chapitre->save();

                if ($save) {
                         return back()->with('succes', 'bravo');
                } else {
                        return back()->with('fail', 'Erreur !');
                }
            }
    }

    public function Edit($id)
    {
        $chapitre = Chapitre::find($id);
        return view('chapitre.edit', compact('chapitre'));
    }

    public function Update(Request $request)
    {
        $request->validate([
            'chapitre' => 'required'
        ]);
        if (DB::table('chapitres')->where('id', $request->id)->update([
            'titre' => $request->chapitre

        ])) {
            return back()->with('succes', 'Modification avec succés');
        } else {
            return back()->with('fail', 'Erreur! de modification');
        }
    }
    public function Delete(Request $request)
    {
        $i = Chapitre::find($request->id);
        if ($i) {
            $domaine = DB::table('domaines')->where('chapitre_id', $i->id)->get();
            foreach ($domaine as $d) {
                $ref = DB::table('references')->where('domaine_id', $d->id)->get();
                    foreach ($ref as $r) {
                        $criteres = DB::table('criteres')->where('reference_id', $r->id)->get();
                            foreach ($criteres as $c) {
                                DB::table('criteres')->where('id', $c->id)->delete();
                            }
                        DB::table('references')->where('id', $r->id)->delete();
                    }
                    DB::table('domaines')->where('id', $d->id)->delete();
                }
                $i->delete();
                return back()->with('succes', 'grille suprimé avec succées');
    
            }            
    }

    public function read(Request $request){
        $request->validate([
            'search'=>'required'
        ]);
        $grille = Grille::find($request->id);
        $chapitres = DB::table('chapitres')
            ->where('titre', 'LIKE','%'.$request->search.'%')
            ->where('grille_id', '=', $request->id)
            ->get();
            if($chapitres->count()==0){
                return back()->with('fail' , 'aucun chapitre trouvé');
            }else{
                return view('chapitre.index',[
                    'grille'=>$grille ,
                    'chapitre'=>$chapitres
                ]);
            }
    }

    public function search(Request $request)
    {
        $request->validate([
            'search' => 'required'
        ]);
        $grille = Grille::find($request->id);
        $chapitres = DB::table('chapitres')
            ->where('titre', 'LIKE','%'.$request->search.'%')
            ->where('grille_id', '=', $request->id)
            ->get();
        $data = ['query' => User::where('id', '=', $grille->user_id)->first()];
        if ($chapitres->count()==0) {
            return back()->with('fail' , 'aucun chapitre trouvé');
        } else {

            return view('chapitre.show', [
                'chapitres' => $chapitres,
                'grille' => $grille
            ], $data);
        }
    }
}
