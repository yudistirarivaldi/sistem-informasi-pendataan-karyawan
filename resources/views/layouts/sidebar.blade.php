<aside class="main-sidebar sidebar-light-dark elevation-4">
    <a href="{{ route('home') }}" class="brand-link bg-dark">
        <img src="{{ asset('img/logo-2.png') }}" alt="Logo" class="brand-image elevation-3" style="opacity: .8">

        {{-- <i class="nav-icon fas fa-chart-line"></i> --}}

        <span class="brand-text font-weight-lighter font-weight-bolder">SIPK - APP</span>
    </a>

    <div class="sidebar">
        {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset(Auth::user()->staff->photo ?? 'img/user.jpg') }}" class="img-circle elevation-2" alt="User Image" style="width: 35px; height: 35px;">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ ucwords(Auth::user()->staff->name ?? Auth::user()->name) }}</a>
            </div>
        </div> --}}

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ $page == 'home' || $page == '' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chart-line"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                @if (!Auth::user()->hasRole('karyawan'))
                    <li class="nav-item has-treeview {{ $page == 'master' ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ $page == 'master' ? 'active' : '' }}">
                            <i class="nav-icon fa fa-laptop"></i>
                            <p>
                                Master
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('master.position.index') }}"
                                    class="nav-link {{ \Route::current()->getName() == 'master.position.index' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>Posisi</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('master.departement.index') }}"
                                    class="nav-link {{ \Route::current()->getName() == 'master.departement.index' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-building"></i>
                                    <p>Departemen</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('master.staff.index') }}"
                                    class="nav-link {{ \Route::current()->getName() == 'master.staff.index' ? 'active' : '' }} ">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>Karyawan</p>
                                </a>
                            </li>
                        </ul>

                    </li>
                @endif


                <li class="nav-header">Manajemen Karyawan</li>

                <li class="nav-item">
                    <a href="{{ route('overtime.index') }}"
                        class="nav-link {{ $page == 'overtime' ? 'active' : '' }}">
                        <i class="nav-icon fa fa-clock"></i>
                        <p>Lembur</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('schedule.index') }}"
                        class="nav-link {{ $page == 'schedule' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-clipboard-list"></i>
                        <p>Jadwal Masuk</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('cuti.index') }}" class="nav-link {{ $page == 'cuti' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-calendar-times"></i>
                        <p>Permohonan Cuti</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('sanksi.index') }}" class="nav-link {{ $page == 'sanksi' ? 'active' : '' }}">
                        <i class="nav-icon fa fa-user-times"></i>
                        <p>Sanksi Karyawan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('mutasi.index') }}" class="nav-link {{ $page == 'mutasi' ? 'active' : '' }}">
                        <i class="nav-icon fa fa-exchange"></i>
                        <p>Mutasi Karyawan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('absensi.index') }}" class="nav-link {{ $page == 'absensi' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tasks"></i>
                        <p>Absensi</p>
                    </a>
                </li>
                @if (Auth::user()->hasRole('admin'))
                    <li class="nav-item">
                        <a href="{{ route('salary.index') }}"
                            class="nav-link {{ $page == 'salary' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-money-check-alt"></i>
                            <p>Penggajian</p>
                        </a>
                    </li>
                @endif

                <li class="nav-header">Laporan Data Karyawan</li>

                @if (!Auth::user()->hasRole('karyawan'))
                    <li class="nav-item has-treeview {{ $page == 'laporan' ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ $page == 'laporan' ? 'active' : '' }}">
                            <i class="nav-icon fa fa-book"></i>
                            <p>
                                Laporan
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('laporan.karyawan.index') }}" class="nav-link {{ \Route::current()->getName() == 'laporan.karyawan.index' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-book"></i>
                                    <p>Karyawan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('laporan.jadwal.index') }}" class="nav-link {{ \Route::current()->getName() == 'laporan.jadwal.index' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-book"></i>
                                    <p>Jadwal Masuk</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('laporan.cuti.index') }}" class="nav-link {{ \Route::current()->getName() == 'laporan.cuti.index' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-book"></i>
                                    <p>Cuti</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('laporan.sanksi.index') }}" class="nav-link {{ \Route::current()->getName() == 'laporan.sanksi.index' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-book"></i>
                                    <p>Sanksi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('laporan.mutasi.index') }}" class="nav-link {{ \Route::current()->getName() == 'laporan.mutasi.index' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-book"></i>
                                    <p>Mutasi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('laporan.gaji.index') }}" class="nav-link {{ \Route::current()->getName() == 'laporan.gaji.index' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-book"></i>
                                    <p>Penggajian</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('laporan.lembur.index') }}" class="nav-link {{ \Route::current()->getName() == 'laporan.lembur.index' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-book"></i>
                                    <p>Lembur</p>
                                </a>
                            </li>

                        </ul>


                    </li>
                @endif

            </ul>
        </nav>
    </div>
</aside>
