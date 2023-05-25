@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row text-center mt-5">
            <h1>Create your new Project</h1>
            <a href="{{route('admin.projects.create')}}" class="btn btn-success col-2 mx-auto mt-2">Crea Nuovo</a>
        </div>
    </div>
@endsection