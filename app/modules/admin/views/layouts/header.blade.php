<header>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <strong>Email: </strong>minhliemphp@gmail.com
                &nbsp;&nbsp;
                <strong>Support: </strong>+902 942 054
            </div>
        </div>
    </div>
</header>
<!-- HEADER END-->
<div class="navbar navbar-inverse set-radius-zero">
    <div class="container">
        <div class="row">
            <div class="col-xs-6">
                <div class="left-nav">
                    <a href="#" class="logo-admin"><img src="{{asset('public/backend')}}/assets/img/logo.png" class="img-responsive"></a>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- LOGO HEADER END-->
<section class="menu-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="navbar-collapse collapse ">
                    <ul id="menu-top" class="nav navbar-nav navbar-right">
                        <li><a class="{{\Active::setActive(2,'dashboard','menu-top-active')}}"  href="{{URL::route('dashboard')}}">Dashboard</a></li>
                        @if(Auth::user()->hasRole('Super Admin'))
                        <li><a class="{{\Active::setActive(2,'category','menu-top-active')}}" href="{{URL::route('admin.category.index')}}">Categrories</a></li>
                        @endif
                        <li><a class="{{\Active::setActive(2,'post','menu-top-active')}}" href="{{route('admin.post.index')}}">Posts</a></li>
                        <li><a class="{{\Active::setActive(2,'contact','menu-top-active')}}" href="{{URL::route('admin.contact')}}">Contact Information</a></li>
                        <li><a class="{{\Active::setActive(2,'album','menu-top-active')}}" href="{{route('admin.album.index')}}">Albums</a></li>
                        <li><a class="{{\Active::setActive(2,'image','menu-top-active')}}" href="{{route('admin.image.index')}}">Image</a></li>
                        @if(Auth::user()->hasRole('Super Admin'))
                        <li><a class="{{\Active::setActive(2,'user','menu-top-active')}}" href="{{route('admin.user.index')}}">User</a></li>
                        @endif
                        <li class="dropdown"><a href="#" class="dropdown-toggle {{\Active::setActive(2,'account','menu-top-active')}}" data-toggle="dropdown" role="button" >My Account</a>
                            <ul class="submenu dropdown-menu">
                               @if(Auth::user()->hasRole('Super Admin'))
                                <li><a href="{{URL::route('admin.user.create')}}">Create User</a></li>
                                @endif
                                <li><a href="{{URL::route('admin.user.changePass')}}">Change Password</a></li>
                                <li><a href="{{URL::route('getLogout')}}">Logout</a></li>
                            </ul>
                        </li>
                </ul>
            </div>
        </div>
    </div>
</div>
</section>
