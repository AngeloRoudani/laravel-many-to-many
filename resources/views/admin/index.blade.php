@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="row d-flex justify-content-between">

        @foreach($projects as $project)
        <div class="card mt-2" style="width: 18rem;">
            @if($project->image)
                <img src="{{asset('storage/'.$project->image)}}" class="card-img-top" alt="{{$project->name}}">
            @endif
            <div class="card-body">
                <h5 class="card-title">{{$project->name}}</h5>
                <h6 class="card-subtitle mb-2 text-body-secondary">Framework: {{$project->framework}}</h6>
                <h6 class="card-subtitle mb-2 text-body-secondary">Data inizio: {{$project->start_date}}</h6>
                <a href="{{route('admin.projects.edit',['project'=>$project->slug])}}" class="btn btn-success">Modifica</a>
                <form action="{{route('admin.projects.destroy',['project'=>$project->slug])}}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Elimina</button>
                </form>
                
                <a href="{{route('admin.projects.show',['project'=>$project->slug])}}" class="btn btn-secondary">Vedi</a>
            </div>
        </div>

        @endforeach
    </div>
</div>
    
@endsection