@extends('layouts.extructure')
{{-- vista del main --}}
@include('components.Main')

{{-- contenedor principal --}}
{{-- En esta vista se cargan todos los contenidos home de todos los usuarios y de cada rol --}}
@hasrole('Super Admin')
@include('superAdmin.home')
@endhasrole

@hasrole('Direccion')
@include('direccion.home')
@endhasrole

@hasrole('Admisiones')
@include('admission.home')
@endhasrole

@hasrole('Jef Programa')
@include('jefProgram.home')
@endhasrole
