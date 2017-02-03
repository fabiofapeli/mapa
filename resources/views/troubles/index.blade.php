@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h2>Indicadores</h2><br />
            <br />
            <table class="table">
            <tr>
                <th>Endereço</th>
                <th>Usuário</th>
                <th>Status</th>
                <th></th>
            </tr>
            @foreach($troubles as $trouble)
            <?php 
                $address = $trouble->address . ', ' . $trouble->number;
            ?>  
            <tr>
                <td>{{ $address }}</td>
                <td>{{ $trouble->user->name }}</td>
                <td>{{ $status[$trouble->status] }}</td>
                <td>{{link_to_route('troubles.edit', 'Gerenciar', $trouble->id , ['class' => 'btn btn-primary'])}}</td>
            </tr>
            @endforeach
        </table>
        {!! $troubles->render() !!}

        </div>
    </div>        

</div>
@endsection
