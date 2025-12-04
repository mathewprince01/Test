<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
  <div class="container-fluid">
    <div class="row-10">
    <a class="navbar-brand text-light" href="#">Event Management</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item me-10">
          <a href="{{ route('event.index') }}" class="nav-link text-light">Events</a>
        </li>
        <li class="nav-item me-10">
          <a href="{{ route('purchaseCreate') }}" class="nav-link text-light">Ticket Purchase</a>
        </li>

        <li class="nav-item dropdown me-10">
          <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            More
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ route('event.index') }}">Events</a></li>
            <li><a class="dropdown-item" href="{{ route('purchaseCreate') }}">Ticket Purchase</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item btn btn-danger text-white" href="/logout">Logout</a></li>
          </ul>
        </li>
      </ul>

      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"/>
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
   </div>
  </div>
</nav>
