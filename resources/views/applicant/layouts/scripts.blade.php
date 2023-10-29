<script>
    let path_segment = "{{request()->segment(2)}}"
    $('.navbar-nav > .nav-link').removeClass('active');
    $('.navbar-nav > .nav-link').filter(function() {
        const href = $(this).attr('href');
        const segments = href.split('/');
        const lastSegment = segments[segments.length - 1];
        return lastSegment === path_segment;
    }).addClass('active')
</script>