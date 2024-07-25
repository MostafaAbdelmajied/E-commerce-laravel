@include("user.head")

  

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <!-- Header -->
    @include("user.header")

    <!-- Page Content -->
    <!-- Banner Starts Here -->

    @yield("body")


    @include("user.footer")