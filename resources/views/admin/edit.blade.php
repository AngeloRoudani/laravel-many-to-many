@extends('layouts.admin')

@section('content')

    <div class="container">
        <div class="row justify-content-between">

            <form action="{{route('admin.projects.update',['project' => $project->slug])}}" method="POST">
            @csrf
            @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Modifica progetto</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name') ?? $project->name }}">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="language_dev" class="form-label">Modifica Linguaggio</label>
                    <input type="text" id="language_dev" name="language_dev" class="form-control" value="{{ old('language_dev') ?? $project->language_dev  }}">
                    @error('language_dev')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="framework" class="form-label">Modifica Framework Usato</label>
                    <input type="text" id="framework" name="framework" class="form-control" value="{{ old('framework') ?? $project->framework  }}">
                    @error('framework')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="start_date" class="form-label">Modifica Data di inizio</label>
                    <input type="text" id="start_date" name="start_date"  class="form-control" value="{{ old('start_date') ?? $project->start_date  }}">
                    @error('start_date')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Select del tipo di progetto-->
                <label for="type_id" class="form-label">Data di inizio</label>
                <select class="form-select" id="type_id" name="type_id">
                    <option @selected(old('type_id', $project->type_id) == '') value="">Nessun Tipo</option>
                    @foreach ($types as $type )
                        <option @selected(old('type_id' , $project->type_id) == $type->id) value="{{old('type_id')}}">{{$type->name}}</option>
                    @endforeach

                </select>
                @error('type_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="mb-3">
                    <label for="description" class="form-label">Descrizione</label>
                    <textarea type="text" id="description" name="description" class="form-control">{{ old('description') ?? $project->description }}</textarea>
                    @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">Modifica</button>
            </form>

        </div>
    </div>
    
@endsection