<?php

namespace App\Http\Controllers;

use App\Models\Grille;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class GrilleController extends Controller
{
    public function list_grille()
    {
        $grilles = DB::select('SELECT name ,  grilles.id as id , titre FROM users , grilles where users.id = grilles.user_id');
        return view('grille.index', [
            'grilles' => $grilles
        ]);
    }
    public function create_grille()
    {
        $grilles = DB::table('users')->where('role', 3)->get();
        return view('grille.add_grille', ['grilles' => $grilles]);
    }


    public function index($id)
    {
        $grille = Grille::find($id);
        if ($grille) {
            $data = ['query' => User::where('id', '=', $grille->user_id)->first()];
            $chapitres = DB::table('chapitres')->where('grille_id', $id)->paginate(4);
            return view('chapitre.add-chapitre', [
                'grille' => $grille,
                'chapitres' => $chapitres,
            ], $data);
        }
        return redirect()->route('add_grille');
    }

    public function save(Request $request)
    {
        $request->validate([
            'titre' => 'required',
            'id_etab' => 'required'
        ]);

        $exit = DB::table('grilles')
            ->where('user_id', $request->id_etab)
            ->get();
        if ($exit->count() == 0) {
            $grille = new Grille;
            $grille->titre = $request->titre;
            $grille->user_id = $request->id_etab;
            $save = $grille->save();
            if ($save) {
                return redirect()->route('x', $grille->id);
            }
        } else {
            return back()->with('fail', 'Grille existant');
        }
    }

    public function delete(Request $request)
    {
        $i = Grille::find($request->id);
        if ($i) {
            $chapitres = DB::table('chapitres')->where('grille_id', $i->id)->get();
            foreach ($chapitres as $x) {
                $domaine = DB::table('domaines')->where('chapitre_id', $x->id)->get();
                foreach ($domaine as $d) {
                    $ref = DB::table('references')->where('domaine_id', $d->id)->get();
                    foreach ($ref as $r) {
                        $criteres = DB::table('criteres')->where('reference_id', $d->id)->get();
                        foreach ($criteres as $c) {
                            $c->delete();
                        }
                        DB::table('references')->where('id', $r->id)->delete();
                    }
                    DB::table('domaines')->where('id', $d->id)->delete();
                }
                DB::table('chapitres')->where('id', $x->id)->delete();
            }
            $i->delete();
            return back()->with('succes', 'grille suprimé avec succées');
        }
    }

    public function Edit($id)
    {
        $grille = Grille::find($id);
        //$grille = DB::select('SELECT users.name as name ,  grilles.id as id , grilles.titre as titre FROM users , grilles where users.id = grilles.user_id and grilles.id = ?' , [$id]);
        $etab = DB::table('users')->where('role', '=', 3)->get();
        if ($grille) {
            return view('grille.edit', [
                'grille' => $grille,
                'etab' => $etab
            ]);
        }
    }

    public function Update(Request $request)
    {
        $request->validate([
            'titre' => 'required',
            'id_etab' => 'required'
        ]);
        $r = DB::table('grilles')
            ->where('titre', '=', $request->titre)
            ->where('user_id', '=', $request->id_etab)
            ->get();
        if ($r->count()) {
            return back()->with('fail', 'Erreur ce titre déja utilisé pour ce établissement');
        } else {
            if (DB::table('grilles')->where('id', $request->id)->update([
                'titre' => $request->titre,
                'user_id' => $request->id_etab

            ])) {
                return back()->with('succes', 'Modification avec succés');
            } else {
                return back()->with('fail', 'Erreur! de modification');
            }
        }
    }

    public function search(Request $request)
    {
        $request->validate([
            'search' => 'required'
        ]);
        $grilles = DB::select('SELECT name ,grilles.id as id, titre FROM users ,grilles WHERE users.name =  ? or grilles.titre = ? and grilles.user_id = users.id', [$request->search, $request->search]);
        if ($grilles) {
            return view('grille.index', [
                'grilles' => $grilles
            ]);
        } else {
            return back()->with('fail', 'introuvable');
        }
    }
}
