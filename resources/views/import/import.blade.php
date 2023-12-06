@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Importar</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <form action="{{ route('import.import') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input class="form-control" type="file" name="file">
                        <button class="btn btn-success" type="submit">Importar</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
