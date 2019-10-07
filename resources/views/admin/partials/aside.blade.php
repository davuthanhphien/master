<div class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{Auth::user()->name}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview menu-open">
                <a href="#">
                    <i class="fa fa-laptop"></i>
                    <span>Elements</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu"
                    @if(Request::is('admin/menu')||Request::is('admin/banner')||Request::is('admin/widgets')||Request::is('admin/dashboard')) style="display: block;" @endif>
                    <li class={{Request::is('admin/menu') ? 'active' : ''}}><a href="{{route('menu.index')}}"><i
                                class="fa fa-circle-o"></i>Menu</a></li>
                    <li class={{Request::is('admin/banner') ? 'active' : ''}}><a href="{{route('banner.index')}}"><i
                                class="fa fa-circle-o"></i>Banner</a></li>
                    <li class={{Request::is('admin/widgets') ? 'active' : ''}}><a href="{{route('widgets.index')}}"><i
                                class="fa fa-circle-o"></i>Widgets</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i> <span>Tables</span>
                    <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu"
                    @if(Request::is('admin/user')||Request::is('admin/role')||Request::is('admin/permission')) style="display: block;" @endif>
                    <li class={{Request::is('admin/user') ? 'active' : ''}}><a href="{{route('user.index')}}"><i
                                class="fa fa-circle-o"></i>User tables</a></li>
                    <li class={{Request::is('admin/role') ? 'active' : ''}}><a href="{{route('role.index')}}"><i
                                class="fa fa-circle-o"></i>Role tables</a></li>
                    <li class={{Request::is('admin/permission') ? 'active' : ''}}><a
                            href="{{route('permission.index')}}"><i class="fa fa-circle-o"></i>Permission tables</a>
                    </li>
                </ul>
            </li>
            <li @if(Request::is('admin/chat')) style="display: block" @endif>
                <a href="{{route('chat.index')}}">
                    <i class="fa fa-th"></i>
                    <span>Chat</span>
                    <span class="pull-right-container">
                        <small class="label pull-right bg-green">new</small>
                    </span>
                </a>
            </li>
            <li @if(Request::is('admin/uploadFile')) style="display: block" @endif>
                <a href="{{route('getUpload')}}">
                    <i class="fa fa-share">

                    </i>
                    <span>Upload File</span>
                </a>
            </li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</div>

