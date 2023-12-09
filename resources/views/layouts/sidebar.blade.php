<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main" style="z-index: 0">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0" href="{{ route('home') }}" target="_blank">
      <img src="{{ asset('/img/logo-ct.png') }}" class="navbar-brand-img h-100" alt="main_logo">
      <span class="ms-1 font-weight-bold text-white">SPK-NEWTRONIC</span>
    </a>
  </div>
  <hr class="horizontal light mt-0 mb-2">
  {{-- <div class="collapse navbar-collapse w-auto " id="sidenav-collapse-main"> --}}
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link text-white" href="{{ route('home') }}">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">dashboard</i>
          </div>
          <span class="nav-link-text ms-1">Dashboard</span>
        </a>
      </li>
      @if(auth()->user() && auth()->user()->hasRole('ADMIN'))
      <li class="nav-item">
        <a class="nav-link text-white" href="{{ route('user') }}">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">people</i>
          </div>
          <span class="nav-link-text ms-1">User</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link text-white" href="{{ route('criteria') }}">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">list</i>
          </div>
          <span class="nav-link-text ms-1">Kriteria</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link text-white" href="{{ route('division') }}">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">list</i>
          </div>
          <span class="nav-link-text ms-1">Divisi</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link text-white" href="{{ route('employee') }}">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">people</i>
          </div>
          <span class="nav-link-text ms-1">Pegawai</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link text-white dropdown-toggle" data-bs-toggle="collapse" href="#collapsePerhitungan" role="button" aria-expanded="false" aria-controls="collapsePerhitungan">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons">grid_on</i> <!-- Icon representing a student with an outline -->
          </div>
          <span class="nav-link-text ms-1">Penilaian</span>
        </a>
        <div class="collapse" id="collapsePerhitungan">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link text-white" style="padding-left: 35px;" href="{{ route('assessment') }}">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="material-icons">assessment</i>
                </div>
                <span class="nav-link-text ms-1">Input Nilai</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" style="padding-left: 35px;" href="{{ route('assessment.matrix') }}">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="material-icons">calculate</i>
                </div>
                <span class="nav-link-text ms-1">Hasil Penilaian</span>
              </a>
            </li>
          </ul>
        </div>
      </li>

      @else

      <li class="nav-item">
        <a class="nav-link text-white" href="{{ route('assessment') }}">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">assessment</i>
          </div>
          <span class="nav-link-text ms-1">Input Nilai</span>
        </a>
      </li>
      @endif

    </ul>
  {{-- </div> --}}
</aside>