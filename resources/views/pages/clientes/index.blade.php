@extends('layouts.master')

@push('styles')

    <link rel="stylesheet" href="{{ asset('assets/css/jquery.datatables.css') }}" type="text/css" />

@endpush


@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header" style="height:49px;">
        <h1 class="pull-left">
            {{ $page_title or "Page Title" }}
            <small>{{ $page_description or null }}</small>
        </h1>
        <!-- You can dynamically generate breadcrumbs here -->
        <div class="pull-right">
           <div class="btn-group">
                <a href="https://demo.fusioninvoice.com/clients" class="btn btn-default  active ">Todos</a>
                <a href="https://demo.fusioninvoice.com/clients?status=active" class="btn btn-default ">Activos</a>
                <a href="https://demo.fusioninvoice.com/clients?status=inactive" class="btn btn-default ">Inactivos</a>
            </div>
            <a href="{{ route('crearcliente') }}" class="btn btn-primary btn-margin-left"><i class="fa fa-plus"></i> Nuevo</a>
        </div>
        <!--<ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
            <li class="active">Here</li>
        </ol>-->
    </section>
    
    <p>
        <div class="box box-primary">
            <div class="box-body no-padding">
                <table id="clientes" class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Email Address</th>
                            <th>Telefono</th>
                            <th>Tipo Cliente</th>
                            <th>Estatus</th>
                            <th>Accion</th>
                        </tr>
                    </thead>
                </table>
            </div>

        </div>
    </p>
@endsection

@push('scripts')
    
    <script type="text/javascript" src="{{ asset('assets/js/jquery.datatables.js') }}"></script>

    {!! Toastr::render() !!}
    
    <script type="text/javascript">
    
        $(function (){
            
            $.extend(true, $.fn.dataTable.defaults, {
                paging:     false,
                ordering:   false,
                info:       false,
                filter:     false,
                oLanguage: {
                    sProcessing: "<img src='{{ asset('assets/img/preloader01.gif') }}'>"
                }
            });
            
           $('#clientes').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route("listaClientes") !!}',
                columns: [
                    { data: 0, name: 'nombre' },
                    { data: 1, name: 'email' },
                    { data: 2, name: 'telf1' },
                    { data: 3, name: 'direccion' },
                    { data: 4, name: 'status' },
                    {   data: 5, 
                        name: 'actions',
                        sortable: false,
                        searchable: false,
                        render: function (data) {
                            console.log(data);
                            var actions = '<div class="btn-group">';
                            actions += '<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="true">';
                            actions += 'Options <span class="caret"></span>';
                            actions += '</button>'
                            actions += '<ul class="dropdown-menu dropdown-menu-right">';
                            actions += '<li><a href="https://demo.fusioninvoice.com/clients/1" id="view-client-1"><i class="fa fa-search"></i> View</a></li>';
                            actions += '<li><a href="https://demo.fusioninvoice.com/clients/1/edit" id="edit-client-1"><i class="fa fa-edit"></i> Edit</a></li>';
                            actions += '<li><a href="javascript:void(0)" class="create-quote" data-unique-name="test person"><i class="fa fa-file-text-o"></i> Create Quote</a></li>';
                            actions += '<li><a href="javascript:void(0)" class="create-invoice" data-unique-name="test person"><i class="fa fa-file-text"></i> Create Invoice</a></li>'
                            actions += '<li><a href="https://demo.fusioninvoice.com/clients/1/delete" id="delete-client-1" onclick="return confirm("If you delete this client you will also delete any invoices, quotes and payments related to this client. Are you sure you want to permanently delete this client?");"><i class="fa fa-trash-o"></i> Delete</a></li>';
                            actions += '</ul>';
                            actions += '</div>';
                            return actions;
                        }
                    }
                ]
            });
           
            
        });
    
        
    </script>

@endpush