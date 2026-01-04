<aside class="sidebar-nav-wrapper">
    <div class="navbar-logo">
        <a href="{{ route('admin.dashboard') }}">
            <h4> <span class="text-primary">Meal</span> Manager</h4>
        </a>
    </div>
    <nav class="sidebar-nav">
        <ul>
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}">
                    <span class="icon">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M8.74999 18.3333C12.2376 18.3333 15.1364 15.8128 15.7244 12.4941C15.8448 11.8143 15.2737 11.25 14.5833 11.25H9.99999C9.30966 11.25 8.74999 10.6903 8.74999 10V5.41666C8.74999 4.7263 8.18563 4.15512 7.50586 4.27556C4.18711 4.86357 1.66666 7.76243 1.66666 11.25C1.66666 15.162 4.83797 18.3333 8.74999 18.3333Z" />
                            <path
                                d="M17.0833 10C17.7737 10 18.3432 9.43708 18.2408 8.75433C17.7005 5.14918 14.8508 2.29947 11.2457 1.75912C10.5629 1.6568 10 2.2263 10 2.91665V9.16666C10 9.62691 10.3731 10 10.8333 10H17.0833Z" />
                        </svg>
                    </span>
                    <span class="text">Dashboard</span>
                </a>
            </li>


            <li class="nav-item nav-item-has-children">
                <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#ddmenu_2"
                    aria-controls="ddmenu_2" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="lni lni-dollar" style="margin-right: 10px;"></i>
                    <span class="text">Deposite</span>
                </a>
                <ul id="ddmenu_2" class="collapse dropdown-nav">
                    <li>
                        <a href="{{ route('admin.deposite') }}"> Deposite </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.Createdeposite') }}"> Add Deposite </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.pendingDeposite') }}"> Pending Deposite </a>
                    </li>
                </ul>
            </li>


            <li class="nav-item nav-item-has-children">
                <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#meals"
                    aria-controls="meals" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="lni lni-chef-hat" style="margin-right: 10px;"></i>
                    <span class="text ml-2">Meals</span>
                </a>
                <ul id="meals" class="collapse dropdown-nav">
                    <li>
                        <a href="{{ route('admin.meals') }}"> Meals </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.addmeal') }}"> Add Meals </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.pendingmeal') }}"> Pending Meals </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item nav-item-has-children">
                <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#cost"
                    aria-controls="cost" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="lni lni-coin" style="margin-right: 10px;"></i>
                    </span>
                    <span class="text">Costs</span>
                </a>
                <ul id="cost" class="collapse dropdown-nav">
                    <li>
                        <a href="{{ route('admin.individualcost') }}"> Individual Cost </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.addindividualcost') }}">Add Individual Cost </a>
                    </li>
                </ul>
            </li>



            <li class="nav-item nav-item-has-children">
                <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#bazar"
                    aria-controls="bazar" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="lni lni-cart" style="margin-right: 10px;"></i>
                    <span class="text">Bazar</span>
                </a>
                <ul id="bazar" class="collapse dropdown-nav">
                    <li>
                        <a href="{{ route('admin.bazar') }}"> Bazar </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.addbazar') }}">Add Bazar </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.pendingbazar') }}">Pending Bazar </a>
                    </li>
                </ul>
            </li>


            <li class="nav-item nav-item-has-children">
                <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#users"
                    aria-controls="users" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="lni lni-users" style="margin-right: 10px;"></i>
                    <span class="text">Users</span>
                </a>
                <ul id="users" class="collapse dropdown-nav">
                    <li>
                        <a href="{{ route('admin.users') }}"> All Users </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.adduser') }}"> Add User </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.pendingusers') }}"> Pending User </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.changemanager') }}">
                    <i class="lni lni-consulting" style="margin-right: 10px;"></i>
                    <span class="text">Change Manager</span>
                </a>
            </li>


            <span class="divider">
                <hr />
            </span>

            <li class="nav-item nav-item-has-children">
                <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#authuser"
                    aria-controls="authuser" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon">
                       <img style="height: 20px;width:20px;border-radius:50%" src="{{ Auth::user()->photo }}" alt="">
                    </span>
                    <span class="text">{{ Auth::user()->name }}</span>
                </a>
                <ul id="authuser" class="collapse dropdown-nav">
                    <li>
                        <a href="{{ route('admin.profile') }}"> View Profile </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.settings') }}"> Settings </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.logout') }}"> Logout </a>
                    </li>
                </ul>
            </li>

        </ul>
    </nav>
</aside>
