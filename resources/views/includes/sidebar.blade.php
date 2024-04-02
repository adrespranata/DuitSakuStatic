<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-text mx-3">{{ $title }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->routeIs('dashboard') ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Main Menu
    </div>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item {{ request()->is('IncomeCategory*') || request()->is('Incomes*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
            aria-expanded="true" aria-controls="collapseOne">
            <i class="fa-solid fa-wallet"></i>
            <span>Incomes</span>
        </a>
        <div id="collapseOne" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ request()->is('IncomeCategory*') ? 'active' : '' }}"
                    href="{{ route('IncomeCategory') }}">Income Category</a>
                <a class="collapse-item {{ request()->is('Incomes*') ? 'active' : '' }}"
                    href="{{ route('Incomes') }}">Incomes</a>
            </div>
        </div>
    </li>

    <li class="nav-item {{ request()->is('ExpenseCategory*') || request()->is('Expenses*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fa-solid fa-money-bills"></i>
            <span>Expenses</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ request()->is('ExpenseCategory*') ? 'active' : '' }}"
                    href="{{ route('ExpenseCategory') }}">Expense Category</a>
                <a class="collapse-item {{ request()->is('Expenses*') ? 'active' : '' }}"
                    href="{{ route('Expenses') }}">Expenses</a>
            </div>
        </div>
    </li>
    <li class="nav-item {{ request()->routeIs('Reports*') ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('Reports') }}">
            <i class="fa-solid fa-file-invoice"></i>
            <span>Reports</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
