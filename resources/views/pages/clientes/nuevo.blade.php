@extends('layouts.master')

@push('scripts')
<link rel="stylesheet" href="{{URL::asset('assets/css/bootstrap-datepicker.css')}}">


@endpush



@section('content')
{{ Form::open(array('action' => 'ClientController@insertCliente', 'id' => 'clienteform')) }}
  <!-- Content Header (Page header) -->
    <section class="content-header" style="height:49px;">
        <h1 class="pull-left">
            {{ $page_title or "Page Title" }}
            <small>{{ $page_description or null }}</small>
        </h1>
        <!-- You can dynamically generate breadcrumbs here -->
        <div class="pull-right">
           <button type="submit" class="btn btn-primary btn-margin-left">
               Guardar
           </button>
        </div>
        <!--<ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
            <li class="active">Here</li>
        </ol>-->
    </section>
  <div class="col-md-12">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#tab-general" data-toggle="tab">General</a>
            </li>
        </ul><!-- .nav nav-tabs -->
        <div class="tab-content">
            <div class="tab-pane active" id="tab-general">
                <div class="row">
                    <div class="col-md-6" id="col-client-name">
                        <div class="form-group">
                            <label>* Nombre del Cliente:</label>
                            {{ Form::text('nombre', null, array('class' => 'form-control', 'id' => 'nombre')) }}
                            <p class="help-block">
                                <small>This value may be the name of a company or a person and will appear on quotes and invoices. This value does not need to be unique.
                                    <a href="javascript:void(0)" id="btn-show-unique-name" tabindex="-1">View Unique Name</a>
                                </small>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-3" id="col-client-email">
                        <div class="form-group">
                            <label>Código: </label>
                            {{ Form::text('cod', null, array('class' => 'form-control', 'id' => 'cod')) }}
                        </div>
                    </div>
                    <div class="col-md-3" id="col-client-active">
                        <div class="form-group">
                            <label>Tipo de Cliente:</label>
                            <select id="tipocli" class="form-control" name="tipocli">
                                <option value="-1">Seleccione...</option>
                                 @foreach($tipocli as $tipo)
                                    <option value="{{$tipo->id}}">{{$tipo->nombre}}</value>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div><!-- .row -->
                
                <div class="form-group">
                    <label>Dirección: </label>
                    {{ Form::textarea('direccion', null, ['class' => 'form-control', 'size' => '50x2', 'id' => 'direccion']) }}
                </div>
                
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Identificación: </label>
                            {{ Form::text('identificacion', null, array('class' => 'form-control', 'id' => 'identificacion')) }}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Correo Electrónico: </label>
                            {{ Form::text('email', null, array('class' => 'form-control', 'id' => 'email')) }}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Teléfono: </label>
                            {{ Form::text('telf1', null, array('class' => 'form-control', 'id' => 'telf1')) }}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Teléfono: </label>
                            {{ Form::text('telf2', null, array('class' => 'form-control', 'id' => 'telf2')) }}
                        </div>
                    </div>
                </div><!-- .row -->
                
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>WhatsApp: </label>
                            {{ Form::text('whatsapp', null, array('class' => 'form-control', 'id' => 'whatsapp')) }}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Skype: </label>
                            {{ Form::text('skype', null, array('class' => 'form-control', 'id' => 'skype')) }}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Web: </label>
                            {{ Form::text('web', null, array('class' => 'form-control', 'id' => 'web')) }}
                        </div>
                    </div>
                
                    <div class="col-md-3">
                        <div class="checkbox-inline">
                            <label>{!! Form::checkbox('status', 'value', array('id' => 'status')); !!} ¿Activo?</label>
                        </div>
                    </div>
                </div><!-- .row -->
                
                <div class="row">
                     <div class="col-md-3">
                        <div class="form-group">
                            <label>Fecha de Nacimiento: </label>
                            <input id="fecha_nac" class="form-control datepicker" name="fecha_nac" type="text" data-date-format="dd-mm-yyyy">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <div class="checkbox">
                              <label>{!! Form::checkbox('jubilado', 'value', array('id' => 'status')); !!} ¿Jubilado?</label>
                            </div>
                        </div>
                    </div>
                </div><!-- .row -->
                
                <div class="form-group">
                    <label>Referencia: </label>
                    {{ Form::textarea('referencia', null, ['class' => 'form-control', 'size' => '30x3']) }}
                    
                </div>
            </div><!-- .tab-content -->
        </div><!-- .nav nav-tabs -->
    </div><!-- .nav-tabs-custom -->
</div><!-- .col-md-12 -->
  
{{ Form::close() }}

@endsection

@push('scripts')
    <script type="text/javascript" src="{{ asset('assets/js/jquery.mask.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/bootstrap-datepicker.js') }}"></script>
    <!-- Laravel Javascript Validation -->
     <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
     
     
     {!! $validator !!}
     
     {!! Toastr::render() !!}
    
    <script type="text/javascript">
    $(function (){
        $('#telf1').mask('(000) 000-0000');
        $('#telf2').mask('(000) 000-0000');
        $('#whatsapp').mask('(000) 000-0000');
        $('.datepicker').datepicker();
    });
    
    </script>

    
@endpush