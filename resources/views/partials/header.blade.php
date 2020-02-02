<style type="text/css">
	/*.navbar-toggle {
	    color: #555;
	    border: 0;
	    margin: 0;
	    padding: 15px 15px;
	}
	.navbar-collapse {
		background-color: #f4f4f4;
	}*/
</style>

<header class="main-header">
	<nav class="navbar navbar-static-top">
		<div class="container">
			<div class="navbar-header">
				<a href="{{ url('/') }}" class="navbar-brand"><b>Diagnostic Online Website of Physics</b></a>
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
					<i class="fa fa-bars"></i>
				</button>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse pull-left" id="navbar-collapse">
				<ul class="nav navbar-nav navcolor">
					{{-- <li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Media<span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="{{ url('media/image') }}">Image</a></li>
							<li><a href="{{ url('media/file') }}">File</a></li>
							<li><a href="{{ url('media/video') }}">Video</a></li>
						</ul>
					</li> --}}
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">KI dan KD <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="{{ url('kiandkd/ki') }}">KI</a></li>
							<li><a href="{{ url('kiandkd/kd') }}">KD</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Penilaian <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="{{ url('/evaluation/pretest/introduction') }}">Pre-Test</a></li>
							<li><a href="{{ url('/evaluation/posttest/introduction') }}">Post-Test</a></li>
							<li><a href="{{ url('/evaluation/diagnostic') }}">Diagnostik</a></li>
						</ul>
					</li>
					<li><a href="{{ url('profile') }}">Profile Pengembang</a></li>
					<li><a href="{{ url('theory') }}">Materi</a></li>
				</ul>
				{{-- <form class="navbar-form navbar-left" role="search">
					<div class="form-group">
						<input type="text" class="form-control" id="navbar-search-input" placeholder="Search">
					</div>
				</form> --}}
			</div>
			<!-- /.navbar-collapse -->
			<!-- Navbar Right Menu -->
			<div class="navbar-custom-menu">
				<ul class="nav navbar-nav">
					<!-- User Account Menu -->
					<li class="dropdown user user-menu">
						<!-- Menu Toggle Button -->
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<!-- The user image in the navbar-->
							<!-- hidden-xs hides the username on small devices so only the image appears. -->
							<span class="hidden-xs">{{ Auth::user()->name }}</span>
						</a>
						<ul class="dropdown-menu">
							<li class="user-footer">
			                  	<div class="pull-right">
			                    	<a href="#" class="btn btn-primary btn-flat">Profile</a>
			                    	<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-default btn-flat">{{ __('Logout') }}</a>
			                    	<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
			                  	</div>
			                </li>
		              	</ul>
	            	</li>
					<li>
						<img class="img-circle" src="{{ asset('/logo_uny.png') }}" alt="Logo UNY" style="width: 40px;margin-top: 4px;margin-right: -29px;">	
					</li>
	         	</ul>
			</div>
			<!-- /.navbar-custom-menu -->
		</div>
		<!-- /.container-fluid -->
	</nav>
</header>
<!-- Full Width Column -->