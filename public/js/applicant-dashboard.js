
const navBar = document.querySelector("nav")
const navToggle = document.querySelector(".navToggle")
const navLinks = document.querySelectorAll(".navList")
const darkToggle = document.querySelector(".darkToggle")
const body = document.querySelector("body")


navToggle.addEventListener('click',()=>{
    navBar.classList.toggle('close')
})

navLinks.forEach(function (element){
    element.addEventListener('click',function (){
        navLinks.forEach((e)=>{
            e.classList.remove('active')
            this.classList.add('active')
        })
    })
})

$(document).on('click', '.settings-dropdown', function() {

    var $caretIcon = $(this).find('.fa-caret-right');
    
    if ($caretIcon.hasClass('fa-caret-right')) {
        $caretIcon.removeClass('fa-caret-right');
        $caretIcon.addClass('fa-caret-down');

        $('.settings-dropdown-list').show()
    } else {
        $(this).find('.fa-caret-down').addClass('fa-caret-right');
        $(this).find('.fa-caret-down').removeClass('fa-caret-down');

        $('.settings-dropdown-list').hide()
    }
})

$(document).ready(function() {
    var pathname = window.location.pathname.split('/'); 
    var page = pathname[pathname.length - 1];

    var settings = ['profile-info', 'pwd-card', 'change-password'];

    var $caretIcon = $('.settings-dropdown').find('.fa-caret-right');

    if (settings.includes(page)) {
        $caretIcon.removeClass('fa-caret-right');
        $caretIcon.addClass('fa-caret-down');

        $('.settings-dropdown-list').show()
    } else {
        $(this).find('.fa-caret-down').addClass('fa-caret-right');
        $(this).find('.fa-caret-down').removeClass('fa-caret-down');

        $('.settings-dropdown-list').hide()
    }
});
