@extends('layouts.admin')

@section('content')

<div class="container">

    <div class="row col-5 m-auto">
        <div class="card mt-2">
            @if($project->image)
                <img src="{{asset('storage/'.$project->image)}}" class="card-img-top" alt="{{$project->name}}">
            @endif
            <div class="card-body">
                <h5 class="card-title">{{$project->name}}</h5>
                @foreach ($project->technologies as $technology )
                    <h6 class="card-subtitle mb-2 text-body-secondary">Tecnologie: {{$technology->name}}</h6>
                @endforeach
                <h6 class="card-subtitle mb-2 text-body-secondary">Framework: {{$project->framework}}</h6>
                <h6 class="card-subtitle mb-2 text-body-secondary">Data inizio: {{$project->start_date}}</h6>
                @if ($project->type_id)
                <h6 class="card-subtitle mb-2 text-body-secondary">Tipo di progetto: {{$project->type->name}}</h6>
                @endif
                <p class="card-text">{{$project->description}}</p>
                <a href="{{route('admin.projects.edit',['project'=> $project->slug])}}" class="btn btn-success">Modifica</a>
                <a href="#" class="btn btn-danger">Elimina</a>
            </div>
        </div>
    </div>

</div>

@endsection