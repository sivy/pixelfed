<div class="bg-white py-5 border-bottom">
  <div class="container">
    <div class="row">
      <div class="col-12 col-md-4 d-flex">
        <div class="profile-avatar mx-auto">
          <img class="img-thumbnail" src="{{$user->avatarUrl()}}" style="border-radius:100%;" width="172px">
        </div>
      </div>
      <div class="col-12 col-md-8 d-flex align-items-center">
        <div class="profile-details">
          <div class="username-bar pb-2 d-flex align-items-center">
            <span class="font-weight-ultralight h1">{{$user->username}}</span>
            @if($is_admin == true)
            <span class="pl-4">
              <span class="btn btn-outline-danger font-weight-bold py-0">ADMIN</span>
            </span>
            @endif
            @if($owner == true)
            <span class="pl-4">
            <a class="fas fa-cog fa-lg text-muted" href="{{route('settings')}}"></a>
            </span>
            @elseif (Auth::check() && $is_following == true)
            <span class="pl-4">
              <form class="follow-form" method="post" action="/i/follow" style="display: inline;" data-id="{{$user->id}}" data-action="unfollow">
                @csrf
                <input type="hidden" name="item" value="{{$user->id}}">
                <button class="btn btn-outline-secondary font-weight-bold px-4 py-0" type="submit">Unfollow</button>
              </form>
            </span>
            @elseif (Auth::check() && $is_following == false)
            <span class="pl-4">
              <form class="follow-form" method="post" action="/i/follow" style="display: inline;" data-id="{{$user->id}}" data-action="follow">
                @csrf
                <input type="hidden" name="item" value="{{$user->id}}">
                <button class="btn btn-primary font-weight-bold px-4 py-0" type="submit">Follow</button>
              </form>
            </span>
            @endif
            {{-- TODO: Implement action dropdown
            <span class="pl-4">
              <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle py-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="icon-options"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="#">Report User</a>
                  <a class="dropdown-item" href="#">Block User</a>
                </div>
              </div>
            </span>
            --}}
          </div>
          <div class="profile-stats pb-3 d-inline-flex lead">
            <div class="font-weight-light pr-5">
              <a class="text-dark" href="{{$user->url()}}">
              <span class="font-weight-bold">{{$user->statuses()->whereNull('reblog_of_id')->whereNull('in_reply_to_id')->count()}}</span> 
              Posts
              </a>
            </div>
            @if($settings->show_profile_follower_count)
            <div class="font-weight-light pr-5">
              <a class="text-dark" href="{{$user->url('/followers')}}">
              <span class="font-weight-bold">{{$user->followerCount(true)}}</span> 
              Followers
              </a>
            </div>
            @endif
            @if($settings->show_profile_following_count)
            <div class="font-weight-light pr-5">
              <a class="text-dark" href="{{$user->url('/following')}}">
              <span class="font-weight-bold">{{$user->followingCount(true)}}</span> 
              Following
              </a>
            </div>
            @endif
          </div>
          <p class="lead mb-0">
            <span class="font-weight-bold">{{$user->name}}</span> 
            @if($user->remote_url)
            <span class="badge badge-info">REMOTE PROFILE</span>
            @endif
          </p>
          <p class="mb-0 lead">{{$user->bio}}</p>
          <p class="mb-0"><a href="{{$user->website}}" class="font-weight-bold" rel="external nofollow noopener" target="_blank">{{str_limit($user->website, 30)}}</a></p>
        </div>
      </div>
    </div>
  </div>
</div>
