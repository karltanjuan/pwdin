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
                    <a href="{{ url('/') }}" class="nav-item nav-link active">Home</a>
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
                    <a href="{{ url('/contact') }}" class="nav-item nav-link">Contact</a>
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

    <!-- Content -->
    <div class="container py-0 ">
    <div class="container pt-0 pb-0">
        <img class="img-fluid max-width-100" src="{{ asset('img/about-5.jpg') }}" alt="pwdIn Logo">
    </div>
    </div>


    <div class="text-center wow fadeInUp" data-wow-delay="0.3s">
        <div>
            <h1 class="display-3 " >PWDIn - Empowering Abilities, Transforming Lives</h1>
            <div class="container text-center wow fadeInUp" data-wow-delay="0.3s">
                <p class="fs-5 fw-medium text-black mb-4 pb-2">
                    Welcome to PWDIn, your dedicated partner in the mission to transform opportunities for persons with disabilities (PWDs) in the realm of employment. PWDIn is more than just a website; it embodies a vision and unwavering commitment to forge a workplace landscape that is truly inclusive and accessible for all.
                </p>
            </div>
    </div>
        
        <button type="button" class="btn-update btn btn-primary btn-lg mb-5" style="padding-left: 2.5rem; padding-right: 2.5rem;">Learn More</button>
    </div>
        
    <!-- ======= About Section ======= -->
    <section id="about" class="about">

    <div class="container" data-aos="fade-up">
    <div class="row gx-0">

        <div class="col-lg-6 d-flex align-items-center wow fadeInUp" data-wow-delay="0.3s">
        <img src="{{ asset('img/about-mission.jpg') }}" class="img-fluid" alt="">
        </div>

        <div class="col-lg-6 d-flex flex-column justify-content-centerwow fadeInUp" data-wow-delay="0.3s">
        <div class="content wow fadeInUp" data-wow-delay="0.3s">
            <h3>Our Mission</h3>
            <h2>Breaking Barriers, Building Futures</h2>
            <p>
            Our mission at PWDIn is to break barriers and build futures. We aim to revolutionize the job-searching experience for PWDs, connecting them with employers who appreciate the unique talents they bring to the workplace. Through our platform, we strive to contribute to a more inclusive society where diversity is celebrated and individuals of all abilities can thrive.
            </p>
            
        </div>
        </div>

        

        <div class="container" data-aos="fade-up">
    <div class="row gx-0">

        <div class="col-lg-6 d-flex flex-column justify-content-center wow fadeInUp" data-wow-delay="0.3s">
        <div class="content wow fadeInUp" data-wow-delay="0.3s">
            <h3>Our Vision</h3>
            <h2> A World of Equal Opportunities</h2>
            <p>
            Our vision is a world where equal opportunities are not just a concept but a reality. PWDIn envisions a future where persons with disabilities are seamlessly integrated into the workforce, contributing their skills, creativity, and perspectives to create a richer and more vibrant professional landscape.
            </p>
            
        </div>
        </div>

        <div class="col-lg-6 d-flex align-items-center wow fadeInUp" data-wow-delay="0.3s">
        <img src="{{ asset('img/about-vision.jpeg') }}" class="img-fluid" alt="">
        </div>

    </div>
    </div>

     <!-- ======= Features Section ======= -->
     <section id="features" class="features">

<div class="container wow fadeInUp" data-wow-delay="0.3s">

  <header class="section-header">
    <h2>Features</h2>
    <p>Assistive Features on PWDIn: Enhancing Accessibility for All</p>
  </header>

  <div class="row">

    <div class="col-lg-6">
      <img src="{{ asset('img/features.png') }}" class="img-fluid" alt="">
    </div>

    <div class="col-lg-6 mt-5 mt-lg-0 d-flex">
      <div class="row align-self-center gy-4">

        <div class="col-md-6" data-aos="zoom-out" data-aos-delay="200">
          <div class="feature-box d-flex align-items-center">
            <i class="bi bi-check"></i>
            <h3>Text-to-speech</h3>
          </div>
        </div>

        <div class="col-md-6" data-aos="zoom-out" data-aos-delay="300">
          <div class="feature-box d-flex align-items-center">
            <i class="bi bi-check"></i>
            <h3>Bigger cursor</h3>
          </div>
        </div>

        <div class="col-md-6" data-aos="zoom-out" data-aos-delay="400">
          <div class="feature-box d-flex align-items-center">
            <i class="bi bi-check"></i>
            <h3>Dyslexia Friendly</h3>
          </div>
        </div>

        <div class="col-md-6" data-aos="zoom-out" data-aos-delay="500">
          <div class="feature-box d-flex align-items-center">
            <i class="bi bi-check"></i>
            <h3>Contrast</h3>
          </div>
        </div>

        <div class="col-md-6" data-aos="zoom-out" data-aos-delay="600">
          <div class="feature-box d-flex align-items-center">
            <i class="bi bi-check"></i>
            <h3>Saturation</h3>
          </div>
        </div>

        <div class="col-md-6" data-aos="zoom-out" data-aos-delay="700">
          <div class="feature-box d-flex align-items-center">
            <i class="bi bi-check"></i>
            <h3>Highlight Links</h3>
          </div>
        </div>

      </div>
    </div>

  </div> <!-- / row -->

        <!-- ======= Team Section ======= -->
    <section id="team" class="team">

<div class="container wow fadeInUp" data-wow-delay="0.3s">

  <header class="section-header">
    <h2>Team</h2>
    <p class = "text-center">Our hard working team</p>
  </header>

  <div class="row gy-4">

    <div class="col-lg-3 col-md-6 d-flex align-items-stretch wow fadeInUp" data-wow-delay="0.1s">
      <div class="member">
        <div class="member-img">
          <img src="{{ asset('img/team/team-1.png') }}" class="img-fluid" alt="">
          <div class="social">
            <a href=""><i class="bi bi-twitter"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>
        <div class="member-info">
          <h4>Abigail Larupay</h4>
          <span>Web Developer</span>
          <p>As a web developer, I leverage coding languages like HTML, CSS, and JavaScript to craft visually appealing and functionally seamless online experiences, transforming creative ideas into dynamic and engaging digital platforms.</p>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-md-6 d-flex align-items-stretch wow fadeInUp" data-wow-delay="0.1s">
      <div class="member">
        <div class="member-img">
          <img src="{{ asset('img/team/team-2.jpg') }}" class="img-fluid" alt="">
          <div class="social">
            <a href=""><i class="bi bi-twitter"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>
        <div class="member-info">
          <h4>Irene Estelle Domingo</h4>
          <span>Web Designer</span>
          <p>As a web designer, I fuse creativity with user experience, utilizing design principles and tools to craft visually compelling and intuitive websites that leave a lasting impression.</p>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-md-6 d-flex align-items-stretch wow fadeInUp" data-wow-delay="0.1s">
      <div class="member">
        <div class="member-img">
          <img src="{{asset('img/team/team-3.png')}}" class="img-fluid" alt="">
          <div class="social">
            <a href=""><i class="bi bi-twitter"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>
        <div class="member-info">
          <h4>Carl Gabriel Dadula</h4>
          <span>Documentator</span>
          <p>In my role as a documentator, I meticulously organize and articulate complex technical information into clear and comprehensive documentation, empowering users and teams to navigate and understand intricate systems with ease.</p>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-md-6 d-flex align-items-stretch wow fadeInUp" data-wow-delay="0.1s">
      <div class="member">
        <div class="member-img">
          <img src="{{asset('img/team/team-4.jpg')}}" class="img-fluid" alt="">
          <div class="social">
            <a href=""><i class="bi bi-twitter"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>
        <div class="member-info">
          <h4>Numer Paul James Edralin</h4>
          <span>Quality Assurance (QA)</span>
          <p>As a quality assurance professional, I meticulously scrutinize and test software products, ensuring they meet the highest standards of functionality, performance, and user experience, to deliver a seamless and reliable end-user journey.</p>
        </div>
      </div>
    </div>

  </div>

</div>

</section><!-- End Team Section -->

<section class="ourFooter expand-lg container-fluid">
  <!-- Footer -->
  <footer class="text-center text-white" style="background-color: #0a4275;">
    <!-- Grid container -->
    <div class="container p-4 pb-0">
      <!-- Section: CTA -->
      <section class="">
        <p class="d-flex justify-content-center align-items-center">
          <span class="me-3" style="color: white;">Register for free</span>
          <button type="button" class="btn btn-outline-light btn-rounded" onclick="window.location.href='{{ url('/applicant/register') }}'">
            Sign up as Applicant!
          </button>
          <button type="button" class="btn btn-outline-light btn-rounded" onclick="window.location.href='{{ url('/employer/register') }}'">
            Sign up as Employer!
          </button>
        </p>
      </section>
      <!-- Section: CTA -->
    </div>
    <!-- Grid container -->

    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
    © PWDin  All Right Reserved. 2023  
    </div>
    <!-- Copyright -->
  </footer>
  <!-- Footer -->
</section>

    </main>
    
    <!-- End #main -->
    </div>
</div>


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

    <script>
        (function(d){
           var s = d.createElement("script");
           /* uncomment the following line to override default position*/
           s.setAttribute("data-position", 100);
           /* uncomment the following line to override default size (values: small, large)*/
           /* s.setAttribute("data-size", "large");*/
           /* uncomment the following line to override default language (e.g., fr, de, es, he, nl, etc.)*/
           /* s.setAttribute("data-language", "null");*/
           /* uncomment the following line to override color set via widget (e.g., #053f67)*/
           /* s.setAttribute("data-color", "#2d68ff");*/
           /* uncomment the following line to override type set via widget (1=person, 2=chair, 3=eye, 4=text)*/
           /* s.setAttribute("data-type", "1");*/
           /* s.setAttribute("data-statement_text:", "Our Accessibility Statement");*/
           /* s.setAttribute("data-statement_url", "http://www.example.com/accessibility";*/
           /* uncomment the following line to override support on mobile devices*/
           /* s.setAttribute("data-mobile", true);*/
           /* uncomment the following line to set custom trigger action for accessibility menu*/
           /* s.setAttribute("data-trigger", "triggerId")*/
           s.setAttribute("data-account", "HaifC5drHg");
           s.setAttribute("src", "https://cdn.userway.org/widget.js");
           (d.body || d.head).appendChild(s);})(document)
   </script>
  <!-- Template Javascript -->
  <script src="{{ asset('js/main.js') }}"></script>
                    

    
</body>
</html>