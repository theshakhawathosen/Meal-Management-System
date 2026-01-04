
<div class="header-message-box ml-15 d-none d-md-flex">
    <button class="dropdown-toggle" type="button" id="message" data-bs-toggle="dropdown"
        aria-expanded="false">

        <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path
                d="M11 20.1667C9.88317 20.1667 8.88718 19.63 8.23901 18.7917H13.761C13.113 19.63 12.1169 20.1667 11 20.1667Z"
                fill="" />
            <path
                d="M10.1157 2.74999C10.1157 2.24374 10.5117 1.83333 11 1.83333C11.4883 1.83333 11.8842 2.24374 11.8842 2.74999V2.82604C14.3932 3.26245 16.3051 5.52474 16.3051 8.24999V14.287C16.3051 14.5301 16.3982 14.7633 16.564 14.9352L18.2029 16.6342C18.4814 16.9229 18.2842 17.4167 17.8903 17.4167H4.10961C3.71574 17.4167 3.5185 16.9229 3.797 16.6342L5.43589 14.9352C5.6017 14.7633 5.69485 14.5301 5.69485 14.287V8.24999C5.69485 5.52474 7.60672 3.26245 10.1157 2.82604V2.74999Z"
                fill="" />
        </svg>
        {!! Auth::user()->unreadNotifications->count() > 0  ? "<span></span>" : ""!!}

    </button>
    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="message">
        @forelse (Auth::user()->unreadNotifications->take(3) as $notification)
        <li>
            <a href="{{ route('user.readandredirect',['id' => $notification->id,'redirect' => base64_encode($notification->data[0]['userurl'])]) }}">
                <div class="image">
                    <img src="{{ \App\Models\User::find($notification->notifiable_id)->photo }}" alt="" />
                </div>
                <div class="content">
                    <h6>{{ $notification['data'][0]['stitle'] }}</h6>
                    <p>{{ Str::words($notification['data'][0]['messege'],5,"...") }}</p>
                    <span>{{ $notification->created_at->diffForHumans() }}</span>
                </div>
            </a>
        </li>
        @empty
        <li class="text-center">
            No Notification Found!
        </li>
        @endforelse

        <a href="{{ route('user.notifications') }}" class="d-block text-center text-sm text-black">See All</a>
    </ul>
</div>
