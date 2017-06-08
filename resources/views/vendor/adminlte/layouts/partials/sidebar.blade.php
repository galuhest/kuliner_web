
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ Gravatar::get($user->email) }}" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('adminlte_lang::message.online') }}</a>
                </div>
            </div>
        @endif

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">{{ 'KULINER' }}</li>
            <li><a href="{{ url('home') }}"><i class='fa fa-link'></i> <span>Home</span> <i class="fa fa-angle-left pull-right"></i></a></li>
<!--             <li class="treeview">
                <a href="#"><i class='fa fa-link'></i> <span>Monitoring</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('monitoring/transaction') }}">Transaction</a></li>
                    <li><a href="{{ url('monitoring/delivery') }}">Delivery</a></li>
                </ul>
            </li> -->
            <li class="treeview">
                <a href="#"><i class='fa fa-link'></i> <span>Management</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('management/customer') }}">Customer</a></li>
                    <li><a href="{{ url('management/kedai') }}">Kedai</a></li>
                    <li><a href="{{ url('management/member') }}">Member</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class='fa fa-link'></i> <span>Reporting</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('reporting/resume') }}">Resume Transaksi</a></li>
                    <li><a href="{{ url('reporting/customer') }}">Transaksi per Pelanggan</a></li>
                    <li><a href="{{ url('reporting/detail') }}">Detail Transaksi</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class='fa fa-link'></i> <span>Administration</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('administration/user') }}">User Management</a></li>
                    <li><a href="{{ url('administration/outlet-type') }}">Tipe Toko Management</a></li>
                    <li><a href="{{ url('administration/product-type') }}">Tipe Product Management</a></li>
                    <li><a href="{{ url('administration/territory') }}">Territory</a></li>
                </ul>
            </li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
