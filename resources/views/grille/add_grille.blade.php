@extends('admin.dashboard')
@section('title')
créer un grille
@endsection

@section('content')

<div>
    @if(Session::get('succes'))
    <div class="alert alert-success">
        {{Session::get('succes')}}
    </div>
    @endif
    @if(Session::get('fail'))
    <div class="alert alert-danger">
        {{Session::get('fail')}}
    </div>
    @endif

</div>
<div class="center">
    <br>
<div class="col-md-5 col-md-offset-4">
        <h2>créer un nouveau grille</h2>
        <form action="{{route('save_grille')}}" method="POST">
            @csrf
            <div class="form-group">
                <label>Titre</label>
                <input type="text" class="form-control" name="titre" placeholder="Entrez titre de grille " value="{{old('titre')}}">
                <span class="text-danger">@error('titre') {{$message}} @enderror</span>
            </div>
                <br>
            <div class="form-group">
                <label for="">Établissement</label>
                <select name="id_etab" id="" class="form-select">
                @foreach($grilles as $i)
                <option value="{{$i->id}}">{{$i->name}}</option>
                @endforeach
                </select>
            </div>
            <br>

            <div class="modal-footer">
            <button type="submit" class="btn btn-success" >Suivant</button>
            </div>
        </form>
    </div>
</div>
@endsection
