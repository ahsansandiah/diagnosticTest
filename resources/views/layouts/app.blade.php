@extends('adminlte::page')

@yield('content-pages')

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}

	@yield('css-pages')
@stop

@section('js')
    
	@yield('js-pages')
@stop