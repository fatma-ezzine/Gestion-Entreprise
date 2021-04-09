<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
@role('manager')
<li class="nav-item nav-dropdown">
	<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i> Authentication</a>
	<ul class="nav-dropdown-items">
	  <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user"></i> <span>Users</span></a></li>
	  <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon la la-id-badge"></i> <span>Roles</span></a></li>
	  <li class="nav-item"><a class="nav-link" href="{{ backpack_url('permission') }}"><i class="nav-icon la la-key"></i> <span>Permissions</span></a></li>
	</ul>
</li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('gouvernorat') }}'><i class='nav-icon la la-question'></i> Gouvernorats</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('ville') }}'><i class='nav-icon la la-question'></i> Villes</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('conge') }}'><i class='nav-icon la la-question'></i> Demandes Conges</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('salarie') }}'><i class='nav-icon la la-question'></i> Salaries</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('manager') }}'><i class='nav-icon la la-question'></i> Managers</a></li>
@else

<li class='nav-item'><a class='nav-link' href='{{ backpack_url('conge') }}'><i class='nav-icon la la-question'></i> Conges</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('typeconge') }}'><i class='nav-icon la la-question'></i> TypeConges</a></li>
<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
@endrole

<!-- Users, Roles, Permissions -->
