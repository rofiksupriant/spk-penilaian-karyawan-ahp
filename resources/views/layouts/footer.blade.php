    <!-- <footer class="footer py-4  ">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-12 mb-lg-0 mb-2">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                © <script>
                  document.write(new Date().getFullYear())
                </script>
              </div>
            </div>
          </div>
        </div>
    </footer> -->
    </div>
  </main>
</div>
  <!--   Core JS Files   -->
<script src="{{ asset('/') }}js/core/popper.min.js"></script>
<script src="{{ asset('/') }}js/core/bootstrap.min.js"></script>
<script src="{{ asset('/') }}js/plugins/perfect-scrollbar.min.js"></script>
<script src="{{ asset('/') }}js/plugins/smooth-scrollbar.min.js"></script>
<script src="{{ asset('/') }}js/plugins/chartjs.min.js"></script>
<script>
  var win = navigator.platform.indexOf('Win') > -1;
  if (win && document.querySelector('#sidenav-scrollbar')) {
    var options = {
      damping: '0.5'
    }
    Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
  }
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{ asset('/') }}js/material-dashboard.min.js?v=3.0.4"></script>
</body>

</html>