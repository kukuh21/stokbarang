<li class="dropdown user user-menu">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
    @if(Auth::user()->avatar != null)
      <img src="{{ asset('images/avatar/'.Auth::user()->avatar) }}" class="user-image" alt="User Image">
    @else
      <img src="{{ asset('images/no-image.png') }}" class="user-image" alt="User Image">
    @endif
    <span class="hidden-xs">
      @if(auth()->check())
        {{ Auth::user()->nama }}
      @endif
    </span>
  </a>
  <ul class="dropdown-menu">
    <!-- User image -->
    <li class="user-header">
      @if(auth()->check())
      @if(Auth::user()->avatar != null)
        <img src="{{ asset('images/avatar/'.Auth::user()->avatar) }}" class="img-circle" alt="User Image">
      @else
        <img src="{{ asset('images/no-image.png') }}" class="img-circle" alt="User Image">
      @endif
      <p>
        {{ Auth::user()->nama }}
      </p>
      @endif
    </li>
    <!-- Menu Footer-->
    <li class="user-footer">
      <div class="pull-left">
        <a href="{{ route('profile.index') }}" class="btn btn-default btn-flat">Profile</a>
      </div>
      <div class="pull-right">
        <a href="{{ url('/logout') }}"  class="btn btn-default btn-flat logout-trigger">Logout</a>
      </div>
    </li>
  </ul>
</li>