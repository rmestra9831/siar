@section('title',auth()->user()->program->name)
@section('title_content')
    Jefe de Programa de {{auth()->user()->program->name}}
@endsection
    
@section('body_main')
    @include('components.Card')
@endsection