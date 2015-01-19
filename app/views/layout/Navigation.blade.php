<?php
   $url = Request::url();
?>

<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">
		<li class="text-center">
            {{ HTML::image('assets/img/indigo.png', '' , array('width' => '250px', 'class' => 'user-image img-responsive') ); }}
			</li>
            @if (Auth::check())  
                Logged in
            @else
            <li>
                <a  href="{{ URL::route('register-show') }}" class="{{ (strpos( $url, 'register' ) !== false) ?  e('active-menu') : '' }}" ><i class="glyphicon glyphicon-user fa-2x"></i> Register</a>
            </li> 
            @endif
        </ul>
       
    </div>
    
</nav>