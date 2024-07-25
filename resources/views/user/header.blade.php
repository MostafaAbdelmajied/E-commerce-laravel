<header class="header">
    <nav class="navbar navbar-expand-lg">
      <div class="container">
        <a class="navbar-brand" href="index.html"><h2>E_ <em>Commerce</em></h2></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="{{route('redirect')}}">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            {{-- <li class="nav-item">
              <a class="nav-link" href="products.html">Our Products</a>
            </li> --}}
            <li class="nav-item">
              <a class="nav-link" href="/cart">My Cart</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contact.html">Arabic</a>
            </li>
            <li class="nav-item">
                <form action="http://127.0.0.1:8000/logout" method="post">
                    @csrf
                    <button class="btn btn-danger ml-auto" type="submit">Log Out</button>
                </form>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>