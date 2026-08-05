
@include('layouts.master.head')
@include('layouts.master.navbar')
@include('layouts.master.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('content')
  </div>
  <!-- /.content-wrapper -->

@include('layouts.master.footer')
@include('layouts.master.footer_link')
