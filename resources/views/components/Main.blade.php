{{-- logo --}}
@section('img')
    <img class="ui centered small image" src=" {{asset('icon/folder.svg')}} " alt="">
@endsection
{{-- menus --}}
@section('menus')
  @include('components.Items_main')
@endsection
{{-- footer --}}
@section('footer')
    <div class="row">
        <a href="#" class="column btn_logout ui "href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="icon user"></i>
            Logout  
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
    </div>
@endsection