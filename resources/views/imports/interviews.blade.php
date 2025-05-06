@extends('layouts.app')

@section('content')

<form action="{{route('interviews.import')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="file" class="form-label">Upload do Arquivo Excel: Interviews</label>
        <input type="file" name="file" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Importar</button>
</form>

@endsection