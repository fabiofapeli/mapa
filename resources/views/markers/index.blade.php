@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h2>Marcadores</h2>
            {{link_to_route('markers.create', 'Novo marcador', [], ['class' => 'btn btn-primary', 'style' => 'float:right'])}}
            <br /><br />
            <table class="table">
            <tr>
                <th width="100%">Nome</th>
                <th></th>
                <th></th>
            </tr>
            @foreach($markers as $marker)
            <tr>
                <td>{{ $marker->name }}</td>
                <td>{{link_to_route('markers.edit', 'Editar', $marker->id , ['class' => 'btn btn-primary'] )}}</td>
                <td>{{link_to_route('markers.destroy', 'Excluir', $marker->id, ['class' => 'btn btn-danger'])}}</td>
            </tr>
            @endforeach
        </table>
        {!! $markers->render() !!}

        </div>
    </div>        

</div>
@endsection
