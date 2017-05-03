@extends('layouts.anon')

@section('content')
<section class="login-box-body">
    <form action="" method="post" data-bind="submit: validateAndSubmit">
        <div class="form-group">
            <div class="input-group">
                <input type="text" id="loginUserName" name="loginUserName" placeholder="Usuario" class="form-control" data-bind="value: loginForm.loginUserName" />
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
            </div>
        </div><!-- .form-group -->
        <div class="form-group">
            <div class="input-group">
                <input type="password" id="password" name="password" placeholder="Contraseña" class="form-control" data-bind="value: loginForm.password" />
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
            </div>
        </div><!-- .form-group -->
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <div class="checkbox">
                         <label><input type="checkbox" value="">Recordarme</label>
                    </div>
                </div>
                <div class="col-md-6 text-right">
                    <button type="submit" class="btn btn-primary" data-bind="enable: !sending()">Iniciar Sesión</button>
                    <input type="hidden" name="_token" value="{{ Session::token() }}" />
                </div>
            </div><!-- .row -->
        </div><!-- .form-group -->
    </form><!-- form -->
</section><!-- .login-box-body -->

 @if(count($errors) > 0)
  <div id="alertSpam" class="alert alert-danger alert-dismissible" role="alert">
    @foreach($errors->all() as $errors)
      <strong>Error! </strong><span>{{ $errors }}</span>
    @endforeach
  </div>
@endif

@endsection

@push('scripts')
    <!-- Laravel Javascript Validation -->
     <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
     {!! $validator !!}
     {!! Toastr::render() !!}
     
    <script type="text/javascript">
        $(function (){
            $.ajaxSetup({
                headers:{'X-CSRF-Token': '{{ csrf_token() }}'}
            });
        });
    </script>
@endpush