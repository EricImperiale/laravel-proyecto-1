@extends('layout.main')

@section('title', 'Iniciar Sesión con mi Cuenta')

@section('main')
<h1 class="mb-3">Ingresar con mi Cuenta</h1>

<form action="{{ route('auth.processLogin') }}" method="post">
    @csrf
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" id="password" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary w-100">Ingresar</button>
</form>
@endsection
