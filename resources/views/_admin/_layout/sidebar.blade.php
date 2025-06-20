    @php
        $page = Request::segment(2);
    @endphp

    <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
        <ul id="sidebarnav">
            <li class="nav-small-cap mb-3 mt-4" style="color: #adadad">
                <span class="hide-menu ms-1">MENU APLIKASI</span>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link {{ $page == '/' ? 'active' : '' }}" href="{{ base_url('') }}" aria-expanded="false"
                    navigate>
                    @include('_admin._layout.icons.dashboard')
                    <span class="hide-menu">Dashboard</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link has-arrow {{ in_array($page, ['member', 'member-category']) ? 'active' : '' }}"
                    href="#" data-toggle="collapse"
                    aria-expanded="{{ in_array($page, ['member']) ? 'true' : 'false' }}">
                    @include('_admin._layout.icons.member')

                    <span class="hide-menu">Anggota (Example)</span>
                </a>
                <ul
                    class="collapse with-bullets show mm-collapse {{ in_array($page, ['member', 'member-category']) ? 'show mm-collapse mm-show' : '' }}">
                    <li class="py-2 nav-item">
                        <a href="{{ base_url('member') }}" navigate class="{{ $page == 'member' ? 'active' : '' }}">
                            <p class="mb-0">Data Angota</p>
                        </a>
                    </li>
                    <li class="py-2 nav-item {{ $page == 'member-category' ? 'active' : '' }}">
                        <a href="{{ base_url('member-category') }}" navigate
                            class="{{ $page == 'member-category' ? 'active' : '' }}">
                            <p class="mb-0">Data Kategori Anggota</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link has-arrow {{ in_array($page, ['student']) ? 'active' : '' }}"
                    href="#" data-toggle="collapse"
                    aria-expanded="{{ in_array($page, ['student']) ? 'true' : 'false' }}">
                    @include('_admin._layout.icons.member')

                    <span class="hide-menu">SISWA</span>
                </a>
                <ul
                    class="collapse with-bullets show mm-collapse {{ in_array($page, ['student']) ? 'show mm-collapse mm-show' : '' }}">
                    <li class="py-2 nav-item">
                        <a href="{{ base_url('student') }}" navigate class="{{ $page == 'student' ? 'active' : '' }}">
                <p class="mb-0">Data Siswa</p>
            </a>
                    </li>
                    <li class="py-2 nav-item {{ $page == 'class' ? 'active' : '' }}">
                        <a href="{{ base_url('class') }}" navigate
                            class="{{ $page == 'class' ? 'active' : '' }}">
                            <p class="mb-0">Data Kelas</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link {{ $page == 'user' ? 'active' : '' }}" href="{{ base_url('user') }}"
                    aria-expanded="false" navigate>
                    @include('_admin._layout.icons.users')
                    <span class="hide-menu">Pengguna Aplikasi</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link {{ $page == 'setting' ? 'active' : '' }}"
                    href="{{ base_url('setting/general') }}" aria-expanded="false" navigate>
                    @include('_admin._layout.icons.setting')
                    <span class="hide-menu">Pengaturan</span>
                </a>
            </li>

            <span class="sidebar-divider lg my-4"></span>
            <div class="card shadow-sm">
                <div class="card-body">
                    <p class="fs-10 mb-2">Kamu login sebagai</p>
                    <p class="mb-0 fw-bolder fs-13">{{ Auth::user()->name }}</p>
                    <p class="fs-10">{{ getUserAccessType(accessType()) }}</p>
                    <div class="d-grid gap-2 mt-3">
                        <a class="btn btn-outline-danger text-start rounded-3" href="{{ base_url('auth/logout/') }}"
                            aria-expanded="false" onclick="return confirm('Apakah kamu yakin?')">
                            <span class="hide-menu"><b>Keluar Aplikasi</b></span>
                        </a>
                    </div>
                </div>
            </div>
        </ul>
    </nav>
