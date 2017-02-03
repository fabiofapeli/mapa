@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                {{ link_to_route('troubles.index', 'Voltar', [], ['class' => 'btn btn-default'])}}<br />
                <h3>Gerenciar indicação</h3>

                {!! Form::model($troubles,['method'=>'put','route'=>array('troubles.update', "id=".$troubles->id)]) !!}

                <dl class="dl-horizontal">
                  <dt>Endereço:</dt>
                  <dd>{{ $troubles->address }}, {{ $troubles->number }}</dd>

                  <dt>Bairro:</dt>
                  <dd>{{ $troubles->district }}</dd>

                  <dt>Usuário:</dt>
                  <dd>{{ $troubles->user->name }}</dd>

                  <dt>Data de criação:</dt>
                  <dd>{{ date('d/m/Y', strtotime($troubles->created_at)) }}</dd>

                  <dt>Data de atualização:</dt>
                  <dd>{{ date('d/m/Y', strtotime($troubles->updated_at)) }}</dd>
                </dl>
                


                <h2>Status</h2>

                @foreach($status as $k=>$v)
                <?php 
                    $checked = ($troubles->status == $k)? true : false;
                ?>
                 <div class="form-group">
                    {!! Form::radio('status', $k, $checked) !!} {{ $v }}
                </div> 

                @endforeach


                <center>{!! Form::submit('Salvar',['class'=>'btn btn-primary']) !!}</center>

                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection