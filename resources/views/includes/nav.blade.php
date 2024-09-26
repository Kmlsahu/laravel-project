<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{Auth::user()->getFirstMediaUrl('image')}}" class="img-circle" alt="User Image" />
      </div>
      <div class="pull-left info">
        <p>{{Auth::user()->name}}</p>

        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- search form -->

    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li>
        <a href="{{ route('dashboard') }}">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>

      {{-- @can('user_index') --}}
      <li class="treeview">
        <a href="#">
          <i class="fa fa-user"></i> <span>Manage User</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="active"><a href="{{ route('user.index') }}"><i class="fa fa-list"></i> User List</a></li>
          {{-- @can('user_create') --}}
          <li><a href="{{ route('user.create') }}"><i class="fa fa-plus-square"></i> User Add</a></li>
          {{-- @endcan --}}
        </ul>
      </li>
      {{-- @endcan --}}

      {{-- @can("role_index") --}}
      <li class="treeview">
        <a href="#">
          <i class="fa fa-circle-thin"></i> <span>Manage Role</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="active"><a href="{{ route('role.index') }}"><i class="fa fa-list"></i> Role List</a></li>
          {{-- @can("role_create") --}}
          <li><a href="{{ route('role.create') }}"><i class="fa fa-plus-square"></i> Role Add</a></li>
          {{-- @endcan --}}
        </ul>
      </li>
      {{-- @endcan --}}

      {{-- @can("permission_index") --}}
      <li class="treeview">
        <a href="#">
          <i class="fa fa-unlock"></i><span>Manage Permission</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="active"><a href="{{ route('permission.index') }}"><i class="fa fa-list"></i> Permission List</a></li>
          {{-- @can("permission_create") --}}
          <li><a href="{{ route('permission.create') }}"><i class="fa fa-plus-square"></i> Permission Add</a></li>
          {{-- @endcan --}}
        </ul>
      </li>
      {{-- @endcan --}}

      {{-- @can("slider_index") --}}
      <li class="treeview">
        <a href="#">
          <i class="fa fa-sliders"></i> <span>Manage Slider</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="active"><a href="{{ route('slider.index') }}"><i class="fa fa-list"></i> Slider List</a></li>
          {{-- @can("slider_create") --}}
          <li><a href="{{ route('slider.create') }}"><i class="fa fa-plus-square"></i> Slider Add</a></li>
          {{-- @endcan --}}
        </ul>
      </li>
      {{-- @endcan --}}

      {{-- @can("page_index") --}}
      <li class="treeview">
        <a href="#">
          <i class="fa fa-file-text"></i> <span>Manage Page</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="active"><a href="{{ route('page.index') }}"><i class="fa fa-list"></i> Page List</a></li>
          {{-- @can("page_create") --}}
          <li><a href="{{ route('page.create') }}"><i class="fa fa-plus-square"></i> Page Add</a></li>
          {{-- @endcan --}}
        </ul>
      </li>
      {{-- @endcan --}}

      {{-- @can("block_index") --}}
      <li class="treeview">
        <a href="#">
          <i class="fa fa-square"></i> <span>Manage Block</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="active"><a href="{{ route('block.index') }}"><i class="fa fa-list"></i> Block List</a></li>
          {{-- @can("block_create") --}}
          <li><a href="{{ route('block.create') }}"><i class="fa fa-plus-square"></i> Block Add</a></li>
          {{-- @endcan --}}
        </ul>
      </li>
      {{-- @endcan --}}

      {{-- @can("category_index") --}}
      <li class="treeview">
        <a href="#">
          <i class="fa fa-list-alt"></i> <span>Manage Category</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="active"><a href="{{ route('category.index') }}"><i class="fa fa-list"></i> Category List</a></li>
          {{-- @can("category_create") --}}
          <li><a href="{{ route('category.create') }}"><i class="fa fa-plus-square"></i> Category Add</a></li>
          {{-- @endcan --}}
        </ul>
      </li>
      {{-- @endcan --}}

      {{-- @can("product_index") --}}
      <li class="treeview">
        <a href="#">
          <i class="fa fa-briefcase"></i> <span>Manage Product</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="active"><a href="{{ route('product.index') }}"><i class="fa fa-list"></i> Product List</a></li>
          {{-- @can("product_create") --}}
          <li><a href="{{ route('product.create') }}"><i class="fa fa-plus-square"></i> Product Add</a></li>
          {{-- @endcan --}}
        </ul>
      </li>
      {{-- @endcan --}}

      {{-- @can("attribute_index") --}}
      <li class="treeview">
        <a href="#">
          <i class="fa fa-check"></i> <span>Manage Attribute</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="active"><a href="{{ route('attribute.index') }}"><i class="fa fa-list"></i> Attribute List</a></li>
          {{-- @can("attribute_create") --}}
          <li><a href="{{ route('attribute.create') }}"><i class="fa fa-plus-square"></i> Attribute Add</a></li>
          {{-- @endcan --}}
        </ul>
      </li>
      {{-- @endcan --}}

      {{-- @can("attribute_value_index") --}}
      <li class="treeview">
        <a href="#">
          <i class="fa fa-thumb-tack"></i> <span>Manage Attribute Value</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="active"><a href="{{ route('attribute_value.index') }}"><i class="fa fa-list"></i> Attribute List</a></li>
          {{-- @can("attribute_value_create") --}}
          <li><a href="{{ route('attribute_value.create') }}"><i class="fa fa-plus-square"></i> Attribute Add</a></li>
          {{-- @endcan --}}
        </ul>
      </li>
      {{-- @endcan --}}

      {{-- @can("coupon_index") --}}
      <li class="treeview">
        <a href="#">
          <i class="fa fa-gift"></i> <span>Manage Coupon</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="active"><a href="{{ route('coupon.index') }}"><i class="fa fa-list"></i> Coupon List</a></li>
          {{-- @can("coupon_create") --}}
          <li><a href="{{ route('coupon.create') }}"><i class="fa fa-plus-square"></i> Coupon Add</a></li>
          {{-- @endcan --}}
        </ul>
      </li>
      {{-- @endcan --}}

      {{-- @can("order_index") --}}
      <li class="treeview">
        <a href="#">
          <i class="fa fa-shopping-cart"></i> <span>Manage Order</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="active"><a href="{{ route('order.index') }}"><i class="fa fa-list"></i> Order List</a></li>
        </ul>
      </li>
      {{-- @endcan --}}

      {{-- @can("enquiry_index") --}}
      <li class="treeview">
        <a href="#">
          <i class="fa fa-envelope"></i> <span>Manage Enquiry</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="active"><a href="{{ route('enquiry') }}"><i class="fa fa-list"></i> Enquiry List</a></li>
        </ul>
      </li>
      {{-- @endcan --}}
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>