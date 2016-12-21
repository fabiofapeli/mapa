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
                <th>Nome</th>
                <th></th>
            </tr>
            @foreach($markers as $marker)
            <tr>
                <td>{{link_to_route('markers.edit', $marker->name, $marker->id )}}</td>
                <td align="right">{{link_to_route('markers.destroy', 'Excluir', $marker->id, ['class' => 'btn btn-danger'])}}</td>
            </tr>
            @endforeach
        </table>
        {!! $markers->render() !!}

        </div>
    </div>        

</div>
@endsection
