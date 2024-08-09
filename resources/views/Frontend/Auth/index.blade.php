


@extends('frontend.layout.app')
@section('content')

<section class="py-3 py-md-5 py-xl-8 bg-light">
  <div class="container">
    <article>
      <div class="card border-0 shadow-sm rounded-3">
        <div class="row g-0 align-items-center">
          <div class="col-12 col-md-6">
            @yield('content')
            <img class="img-fluid rounded-start object-fit-cover" loading="lazy" src="{{asset('Frontend/assets/img/main.svg')}}" alt="Lecture Hall">
          </div>
          <div class="col-6 col-md-6">
            <div class="card-body p-md-4 p-xl-6">
              <h2 class="card-title display-4 fw-bold mb-4 lh-1">
                <a class="link-dark text-decoration-none" href="#!">Welcome to HALL+</a>
              </h2>
              <p class="card-text text-secondary mb-4">
                We offer a diverse selection of lecture halls available for reservation, perfect for your next educational or corporate event. Each hall is thoughtfully equipped and designed to provide a professional and comfortable environment for lectures, seminars, and workshops. Our intuitive booking system ensures a seamless experience, allowing you to focus on delivering a successful and memorable event.
              </p>
              <div class="entry-footer">
                <ul class="entry-meta list-unstyled d-flex mt-4">
                <a href="{{route('all.avenues')}}">Explore Our Website</a>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </article>
  </div>
</section>
<style>
  .body{
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f0f2f5;

  }
  .entry-meta {
    margin-bottom: 1.5rem;
}
.entry-meta a {
    text-transform: uppercase;
    font-size: 1rem;
    color: #5e17eb;
    text-decoration: none;
    padding: 0.5rem 1rem;
    border-radius: 1.5rem;
    background-color: transparent; 
    border: 1px solid #5e17eb;
    transition: background-color 0.3s, color 0.3s;
}
.entry-meta a:hover {
  background: linear-gradient(135deg, #5e17eb, #ac87f7);
  color: #fff;
}
</style>
@endsection
