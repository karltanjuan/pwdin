<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>PWDIn</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{ asset('img/favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    {{-- <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Template Stylesheet -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body>
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
            <a href="/" class="navbar-brand d-flex align-items-center text-center py-0 px-4 px-lg-5">
                <img class="img-fluid w-10 rounded pwdin-logo" src="{{ asset('img/pwdin_logo.png') }}" alt="pwdIn Logo">
                <span>&nbsp;</span>
                <h1 class="m-0 text-primary">PWDIn</h1>
            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto p-4 p-lg-0">
                    <a href="{{ url('/') }}" class="nav-item nav-link">Home</a>
                    <a href="{{ url('/about-us') }}" class="nav-item nav-link">About</a>
                    <a href="{{ url('/choose-account') }}" class="nav-item nav-link d-md-none">Login Account</a>
                    {{-- <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Jobs</a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <a href="#" class="dropdown-item">Job List</a>
                            <a href="#" class="dropdown-item">Job Detail</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <a href="category.html" class="dropdown-item">Job Category</a>
                            <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                            <a href="404.html" class="dropdown-item">404</a>
                        </div>
                    </div> --}}
                    <a href="{{ url('/contact-us') }}" class="nav-item nav-link active">Contact</a>
                </div>
                @if(auth()->check())
                    <a href="{{ url('/applicant/jobs') }}" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">Dashboard<i class="fa fa-arrow-right ms-3"></i></a>
                @elseif(auth()->guard('employers')->check())
                    <a href="{{ url('/employer/dashboard') }}" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">Dashboard<i class="fa fa-arrow-right ms-3"></i></a>
                @else
                    <a href="{{ url('/choose-account') }}" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">Login Account<i class="fa fa-arrow-right ms-3"></i></a>
                @endif
            </div>
        </nav>
    <!-- Navbar End -->


<!-- ======= Contact Section ======= -->
<section id="contact" class="contact">

<div class="container" data-aos="fade-up">

  <header class="section-header">
    <h1>Contact Us</h1>
  </header>

  <div class="row gy-4 mb-4">
    <div class="col-md-6">
      <div class="info-box">
        <i class="bi bi-geo-alt"></i>
        <h3>Address</h3>
        <p>STI Academic Center, University Pkwy, Taguig, Metro Manila</p>
      </div>
    </div>
    
    <div class="col-md-6">
      <div class="info-box">
        <i class="bi bi-envelope"></i>
        <h3>Email Us</h3>
        <p>pwdinhelp@gmail.com</p>
      </div>
    </div>
    
  </div>

  <div class="row gy-4">
    <div class="col-lg-12">
        <div class="row gy-4">

          <div class="col-md-6">
            <div class="form-outline form-floating">
              <input type="text" id="full_name" class="form-control form-control-lg full_name" placeholder="Enter full name">
              <label class="form-label" for="full_name">Full Name</label>
              <span class="err-full_name err-msg"></span>
            </div>
          </div>

          <div class="col-md-6">
              <div class="form-outline form-floating">
                <input type="text" id="email_address" class="form-control form-control-lg email_address" placeholder="Enter email_address">
                <label class="form-label" for="email_address">Email Address</label>
                <span class="err-email_address err-msg"></span>
              </div>
          </div>

          <div class="col-md-12">
              <div class="form-outline form-floating">
                <input type="text" id="subject" class="form-control form-control-lg subject" placeholder="Enter subject">
                <label class="form-label" for="subject">Subject</label>
                <span class="err-subject err-msg"></span>
              </div>
          </div>

          <div class="col-md-12">
            <div class="form-floating">
                <textarea class="form-control message" id="message" rows="10" placeholder="Message" style="height: 106px;"></textarea>
                <label for="message">Message</label>
                <span class="err-message err-msg"></span>
            </div>
          </div>

          <div class="col-md-12">
            <button type="button" class="btn-send btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Send Message</button>
          </div>
        </div>
    </div>

  </div>
</div>
</section>




    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
    integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('js/main.js') }}"></script>
    
    <script>
       let click_counter = 0;

      $('.btn-send').on('click', function() {
          
          $(this).html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...`);

          var formData = new FormData();
          formData.append('_token', "{{ csrf_token() }}");
          formData.append('full_name', $('#full_name').val());
          formData.append('email_address', $('#email_address').val());
          formData.append('subject', $('#subject').val());
          formData.append('message', $('#message').val());

          if (click_counter === 0) {
              click_counter++;
              $(this).prop('disabled', true);

              $.ajax({
                  url: '{{ route('send-inquiry') }}',
                  type: 'POST',
                  data: formData,
                  processData: false,
                  contentType: false,
                  success: function(response) {
                      if (response.code == "200") {
                          $('.btn-send').html(`Login`);
                          $('input').removeClass('error')
                          $('.err-msg').hide()

                          toastr.success('Inquiry sent, please wait for admin\'s reply', 'Sent Successful');

                          setTimeout(function() {
                              window.location.href =
                                  '{{ url('/') }}'
                          }, 2000)
                          
                      } else {
                          displayErrors(JSON.parse(response.errors));
                          $('.btn-send').html(`Login`).prop('disabled', false);
                          click_counter = 0;
                      }
                  },
                  error: function(xhr, status, error) {
                      var result = JSON.parse(xhr.responseText)
                      displayErrors(result.errors)
                      $('.btn-send').html(`Login`).prop('disabled', false);
                      click_counter = 0;
                  }
              });
          }

      })
    </script>
</body>
</html>