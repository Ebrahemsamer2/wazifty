@extends("layouts.user")

@section('title', auth()->user()->name . ' messages | WAZIFTY')

@section('css')

<!-- My Home Custom CSS ( Home )-->
<link type="text/css" href="/css/home_custom.css" rel="stylesheet">

<!-- My User profile Custom CSS ( edit user profile )-->
<link type="text/css" href="/css/companychat.css" rel="stylesheet">

@endsection

@section('content')

<div class="container">
  <div id="message-error"></div>

  <div class="row">
        <div class="col-sm-3">
          
          <div class="list-group">
            @foreach($contact_users as $contact)

              <a href="/user/{{ $contact->user_id }}/contact" class="list-group-item list-group-item-action contactUser {{$contact->user_id == $user->id ? 'active':''}}">
                {{ \App\User::findOrFail($contact->user_id)->name }}

                @if(\App\User::findOrFail($contact->user_id)->checkUnReadMessages("company"))

                  <i class="fas fa-circle"></i>

                @endif 

              </a>

            @endforeach
          </div>

        </div>

        <div class="col-sm">
        
        <section id="msger" class="msger">
          <header class="msger-header">
            <div class="msger-header-title">
              <i class="fas fa-comment-alt"></i> {{$user->name}}
            </div>
            <div class="msger-header-options">
              <span><i class="fas fa-cog"></i></span>
            </div>
          </header>

            <main id="msger-chat" class="msger-chat">
            @if(count($messages) > 0)
            @foreach($messages as $message)
            @if($message->from == "user")
            <div class="msg left-msg">
              <div>
                @if(\App\User::findOrFail($user->id)->picture)
                @if(\App\User::findOrFail($user->id)->picture->filename)
                <img src="/images/{{ \App\User::findOrFail($user->id)->picture->filename }}" width="50" height="50">
                @else
                <img src="/images/user.jpg" width="50" height="50">
                @endif
                @else
                <img src="/images/user.jpg" width="50" height="50">
                @endif
              </div>

              <div class="msg-bubble">
                <div class="msg-info">
                  <div class="msg-info-name">{{ auth()->user()->name }}</div>
                  @if($message->created_at)
                  <div class="msg-info-time">{{ $message->created_at->diffForHumans() }}</div>
                  @endif
                </div>

                <div class="msg-text">
                  {{ $message->message }}
                </div>
              </div>
            </div>
            @else
            <div class="msg right-msg">
              <div>
                @if(auth()->user()->picture)
                <img src="/images/{{ auth()->user()->picture->filename }}" width="50" height="50">
                @else
                <img src="/images/user.jpg" width="50" height="50">
                @endif
              </div>

              <div class="msg-bubble">
                <div class="msg-info">
                  <div class="msg-info-name">{{ auth()->user()->name }}</div>
                  @if($message->created_at)
                  <div class="msg-info-time">{{ $message->created_at->diffForHumans() }}</div>
                  @endif
                </div>

                <div class="msg-text">
                  {{ $message->message }}
                </div>
              </div>
            </div>
            

            @endif
            @endforeach
            @endif
          </main>


          <form autocomplete="off" id="messageForm" method="POST" action="/user/{{$user->id}}/contact" class="msger-inputarea">

            @csrf
            <input type="hidden" name="user_id" value="{{$user->id}}">
            <input type="hidden" name="company_id" value="{{auth()->user()->id}}">
            <input type="hidden" name="from" value="company">
            <input type="hidden" name="read" value="0">

            <input name="message" autofocus type="text" class="msger-input" placeholder="Enter your message...">
            <button type="submit" class="msger-send-btn">Send</button>
          </form>

        </section>
      </div>
    </div>

</div>
@endsection
@section('scripts')
<script>
  let d = $('#msger-chat');
  $('#msger-chat').scrollTop(d.prop("scrollHeight"));
</script>

@endsection