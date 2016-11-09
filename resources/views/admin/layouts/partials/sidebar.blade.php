<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{asset('/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('adminlte_lang::message.online') }}</a>
                </div>
            </div>
        @endif

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="{{ trans('adminlte_lang::message.search') }}..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">{{ trans('adminlte_lang::message.header') }}</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="{{ url('admin/home') }}"><i class='fa fa-link'></i> <span>{{ trans('adminlte_lang::message.home') }}</span></a></li>
            <li><a href="{{ url('admin/tags') }}"><i class='fa fa-link'></i> <span>Tags</span></a></li>
            <li><a href="{{ url('admin/questions') }}"><i class='fa fa-link'></i> <span>Questions</span></a></li>
            <li><a href="{{ url('admin/users') }}"><i class='fa fa-link'></i> <span>Users</span></a></li>
            <li><a href="{{ url('admin/marketers') }}"><i class='fa fa-link'></i> <span>Marketers</span></a></li>
            <li class="treeview">
                <a href="#"><i class='fa fa-link'></i> <span>Pages</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('admin/contacts') }}"> Contact Page </a></li>
                    <li><a href="{{ url('admin/homePage') }}"> Home Page </a></li>
                    <li><a href="{{ url('admin/aboutPage') }}"> AboutUS Page </a></li>
                    <li><a href="{{ url('admin/partnerPage') }}"> PartnerWithUS Page </a></li>
                </ul>
            </li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
