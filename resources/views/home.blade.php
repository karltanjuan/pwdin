<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home</title>
        <link rel="stylesheet" href="{{asset('css/home.css')}}">
    </head>
    <body>
        <!-- Navbar -->
        <header>
            <nav class="navbar">
                <a href="#">
                    <img src="{{asset('img/logo.png')}}" href="#" class="logo"></img>
                </a>
                <div class="navbar-buttons">
                    <a href="home">Home</a>
                    <a href="job_seeker">Job Seekers</a>
                    <a href="employer">Employers</a>
                    <a href="about_us">About Us</a>
                </div>
            </nav>
        </header>
        <!-- Slider -->
        <div class = "slider">
            <div class="slides">
                <input type="radio" name="radio-btn" id = "radio1">
                <input type="radio" name="radio-btn" id = "radio2">
                <input type="radio" name="radio-btn" id = "radio3">
                <div class = "slide first">
                    <img src = "{{asset('img/pic1.png')}}" alt = "" >
                </div>
                <div class="slide">
                    <img src = "{{asset('img/pic2.png')}}" alt = "" >
                </div>
                <div class="slide">
                    <img src = "{{asset('img/pic3.png')}}" alt = "" >
                </div>
                <div class="navigation-auto">
                    <div class="auto-btn1"></div>
                    <div class="auto-btn2"></div>
                    <div class="auto-btn3"></div>
                </div>
            </div>
            <div class="navigation-manual">
                <label for="radio1" class = "manual-btn"></label>
                <label for="radio2" class = "manual-btn"></label>
                <label for="radio3" class = "manual-btn"></label>
            </div>
        </div>
        <!-- Slider//Javascript -->
        <script type ="text/javascript">
        var counter =1;
        setInterval(function(){
        document.getElementById('radio' + counter).checked = true;
        counter++;
        if(counter > 3){
        counter = 1;
        }
        }, 5000);
        </script>
        <!-- Floating button -->
        <a href="login.html" class="floating-button">Looking for a JOB? </a>
        <a href="#" class="floating-button2">Looking to HIRE? </a>
        <!-- Floating image -->
        <img src= "{{asset('img/bgc.png')}}" ref="#" class="inner-img1">
        <img src= "{{asset('img/zIaO.png')}}" ref="#" class="inner-img2">
        <img src= "{{asset('img/ct.png')}}" ref="#" class="inner-img3">
        <img src ="{{asset('img/tc.png')}}" ref="#" class="inner-img4">
        <div class="text-container">
            <p> "EMPOWERING ABILITIES, <br> CONNECTING OPPORTUNITIES"</p>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    
    <div class = "text-container1">
        <p class ="txt-1"> "Innovative assistive tools for <br> a more accesible world." </p>
    </div>
    <br>
    <br>
    <!-- Our Services -->
    <div class = "home-pic2">
        <div class = "image-container">
            <img src = "{{asset('img/pic4.png')}}" ref="#" class="pic2">
            
            <div class="text-container2">
                <p> OUR SERVICES </p>
            </div>
            <div class="slide-container">
                <div class="card">
                    <figure>
                        <img src="{{asset('img/c1.jpg')}}">
                    </figure>
                    <div class="content">
                        <h3> Job Search</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit rem dolores laborum itaque possimus pariatur esse necessitatibus quibusdam eos labore, facilis at ab. Odit non deserunt repellat, voluptatem similique laborum?</p>
                        
                    </div>
                </div>
                <div class="card">
                    <figure>
                        <img src="{{asset('img/c2.jpg')}}">
                    </figure>
                    <div class="content">
                        <h3> Resume Builder</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit rem dolores laborum itaque possimus pariatur esse necessitatibus quibusdam eos labore, facilis at ab. Odit non deserunt repellat, voluptatem similique laborum?</p>
                        
                    </div>
                </div>
                <div class="card">
                    <figure>
                        <img src="{{asset('img/c3.jpg')}}">
                    </figure>
                    <div class="content">
                        <h3> Employer Search</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit rem dolores laborum itaque possimus pariatur esse necessitatibus quibusdam eos labore, facilis at ab. Odit non deserunt repellat, voluptatem similique laborum?</p>
                        
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <!-- Latest Article -->
    <div class="article-content clearfix">
        <div class="main-content">
            <h1 class="recent-article-title"> Latest Article </h1>
            <div class="post">
                <img src="{{asset('img/c1.jpg')}}" alt="" class="post-image">
                <div class="post-review">
                    <h1><a href ="#"> Hire Confidently with PWDIn</a></h1>
                    <i class="far fa-user"> Mar 11, 2019</i>
                    <p class="preview-text">
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                        Est officiis excepturi quaerat exercitationem assumenda corporis non vel magnam quos delectus. Nam mollitia quos quae aspernatur, nesciunt placeat ullam labore nulla.
                    </p>
                    <a href="#" class="btn"> Read More </a>
                </div>
            </div>
        </div>
        <div class="sidebar"></div>
    </div>
</body>
</html>