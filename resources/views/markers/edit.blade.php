@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                {{ link_to_route('markers.index', 'Voltar', [], ['class' => 'btn btn-default'])}}<br />
                <h3>Editar marcador</h3>
                @if($errors->any())
                    <ul class="alert">
                        @foreach($errors->all() as $erro)
                            <li>{{ $erro }}</li>
                        @endforeach
                    </ul>
                @endif
                {!! Form::model($markers,['method'=>'put','route'=>array('markers.update', "id=".$markers->id)]) !!}

                @include('markers._form')

                {!! Form::submit('Salvar',['class'=>'btn btn-primary']) !!}

                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection