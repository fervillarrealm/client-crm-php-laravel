@extends('layouts.anon')

@section('content')
<div>
    
    
    
</div>

<section class="login-box-body">
    {{ Form::open(array('action' => 'LoginController@postLogin')) }}
    <!--<form action="{{ route('postLogin') }}" method="post" data-bind="submit: validateAndSubmit">-->
        <div class="form-group">
            <div class="input-group">
                <input type="text" id="loginUserName" name="loginUserName" placeholder="Usuario" class="form-control" data-bind="value: loginForm.loginUserName" />
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
            </div>
        </div><!-- .form-group -->
        <div class="form-group">
            <div class="input-group">
                <input type="password" id="password" name="password" placeholder="Contraseña" class="form-control" data-bind="value: loginForm.password" />
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
            </div>
        </div><!-- .form-group -->
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <div class="checkbox">
                         <label><input type="checkbox" id="remember" name="remember" value="">Recordarme</label>
                    </div>
                </div>
                <div class="col-md-6 text-right">
                    <button type="submit" class="btn btn-primary" data-bind="enable: !sending()">Iniciar Sesión</button>
                </div>
            </div><!-- .row -->
        </div><!-- .form-group -->
    {{ Form::close() }}
    <!--</form><!-- form -->
</section><!-- .login-box-body -->

 @if(count($errors) > 0)
  <div id="alertSpam" class="alert alert-danger alert-dismissible" role="alert">
    @foreach($errors->all() as $errors)
      <strong>Error! </strong><span>{{ $errors }}</span>
    @endforeach
  </div>
@endif

@if(Session::has('fail'))
  <div id="alertSpam" class="alert alert-danger alert-dismissible" role="alert">
      <strong>Error! </strong><span>{{ Session::get('fail') }}</span>
  </div>
@endif

@endsection

@push('scripts')
    <!-- Laravel Javascript Validation -->
     <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
     
     {!! Toastr::render() !!}
     {!! $validator !!}
     
    <script type="text/javascript">
        $(function (){
            $.ajaxSetup({
                headers:{'X-CSRF-Token': '{{ csrf_token() }}'}
            });
        });
    </script>
@endpush