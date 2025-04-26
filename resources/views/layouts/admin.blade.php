<!doctype html>

<html
  lang="en"
  class="layout-menu-fixed layout-compact"
  data-assets-path="{{ asset('sneat-v3.0.0') }}/assets/"
  data-template="vertical-menu-template-free">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>@yield('title', 'Admin')</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('sneat-v3.0.0') }}/assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('sneat-v3.0.0') }}/assets/vendor/fonts/iconify-icons.css" />

    <!-- Core CSS -->
    <!-- build:css assets/vendor/css/theme.css  -->

    <link rel="stylesheet" href="{{ asset('sneat-v3.0.0') }}/assets/vendor/css/core.css" />
    <link rel="stylesheet" href="{{ asset('sneat-v3.0.0') }}/assets/css/demo.css" />

    <!-- Vendors CSS -->

    <link rel="stylesheet" href="{{ asset('sneat-v3.0.0') }}/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- endbuild -->

    <link rel="stylesheet" href="{{ asset('sneat-v3.0.0') }}/assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('sneat-v3.0.0') }}/assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->

    <script src="{{ asset('sneat-v3.0.0') }}/assets/js/config.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">

        <!-- Menu -->
        @include('parts.sidebar')
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          @include('parts.header')

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            @yield('content')
            <!-- / Content -->

            <!-- Footer -->
            @include('parts.footer')
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->

    <script src="{{ asset('sneat-v3.0.0') }}/assets/vendor/libs/jquery/jquery.js"></script>

    <script src="{{ asset('sneat-v3.0.0') }}/assets/vendor/libs/popper/popper.js"></script>
    <script src="{{ asset('sneat-v3.0.0') }}/assets/vendor/js/bootstrap.js"></script>

    <script src="{{ asset('sneat-v3.0.0') }}/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="{{ asset('sneat-v3.0.0') }}/assets/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('sneat-v3.0.0') }}/assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->

    <script src="{{ asset('sneat-v3.0.0') }}/assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="{{ asset('sneat-v3.0.0') }}/assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag before closing body tag for github widget button. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <script>
      document.addEventListener('DOMContentLoaded', function () {
        const toastLiveExample = document.getElementById('liveToast');
        if (toastLiveExample) {
          const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample);
          toastBootstrap.show();
        }
      });
    </script>

    <script>
      function setCurrentDateTime() {
        const now = new Date();
        const offset = now.getTimezoneOffset();
        const localISOTime = new Date(now.getTime() - offset * 60000).toISOString().slice(0,16);
        document.getElementById('datetime').value = localISOTime;
      }

      // Panggil saat halaman dimuat
      setCurrentDateTime();

      // Optional: update setiap detik (real-time)
      setInterval(setCurrentDateTime, 1000);
    </script>

    <script>
      const textarea = document.querySelector('.auto-resize');

      textarea.addEventListener('input', function () {
        this.style.height = 'auto';
        this.style.height = this.scrollHeight + 'px';
      });
    </script>

    <script>
const input = document.getElementById('rupiahInput');

input.addEventListener('input', function (e) {
  // Ambil angka asli tanpa titik
  let numberValue = this.value.replace(/\D/g, '');

  // Batasi maksimal 100.000.000
  if (parseInt(numberValue) > 100000000) {
    numberValue = '100000000';
  }

  // Format angka jadi ada titik
  let formattedValue = numberValue.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

  this.value = formattedValue;
});
    </script>
  </body>
</html>
