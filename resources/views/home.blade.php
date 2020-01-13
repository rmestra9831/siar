@extends('layouts.extructure')
{{-- vista del main --}}
@include('components.Main')

{{-- contenedor principal --}}
{{-- En esta vista se cargan todos los contenidos home de todos los usuarios y de cada rol --}}
@hasrole('super admin')
@include('superAdmin.home')
@endhasrole
