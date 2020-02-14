{{--NOTIFICACIONES--}}
<div class="ui text-center column notifications">
  <strong id="notify" class="ui floating notifications icon dropdown left pointing">
    <i class="circular orange inverted bell large icon"></i>
    @if(count(auth()->user()->unreadNotifications) != 0)<div class="floating small circular ui red label">{{count(auth()->user()->unreadNotifications )}}</div> @endif 
    <div class="menu ui list">
      <div class="header d-flex"><strong class="p-relative font-weight-bolder as-center mr-auto m-0 h5"><i class="star outline icon"></i>Notificaciones</strong><div id="allNotifyReaded" idUser="{{auth()->user()->id}}" class="ui red label pointer"><i class="trash alternate outline icon"></i> Limpiar</div></div>
      @foreach (auth()->user()->unreadNotifications as $notification)
        <div id="itemNotify" class="item" xvurl="{{$notification->data['url'] ?? ''}}" idUser="{{auth()->user()->id}}" idNotidy="{{$notification->id}}">
          <div class="content">
            <a class="header">{{$notification->data['title'] ?? ''}}</a>
            <div class="description w-85 text-truncate">{{$notification->data['affair'] ?? ''}}</div>
            <label class="text-black-50 d-flex w-100 justify-content-end" for="">{{$notification->created_at->diffForHumans() ?? ''}}</label>
          </div>
        </div>
      @endforeach
    </div>
  </strong>
</div>