@extends('frontend.layout.app')
@section('content')

<section class="py-3 py-md-5 py-xl-8 bg-light">
  <div class="container">
    <article>
      <div class="card border-0 shadow-sm rounded-3">
        <div class="row g-0 align-items-center">
          <div class="col-12 col-md-6">
            <img class="img-fluid rounded-start object-fit-cover" loading="lazy" src="{{asset('Frontend/assets/img/main.svg')}}" alt="Lecture Hall">
          </div>
          <div class="col-6 col-md-6">
            <div class="card-body p-md-4 p-xl-6">
              <h2 class="card-title display-4 fw-bold mb-4 lh-1">
                <a class="link-dark text-decoration-none" href="#!">Welcome to Online Avenue's Lecture Hall Reservation</a>
              </h2>
              <p class="card-text text-secondary mb-4">
                We offer a diverse selection of lecture halls available for reservation, perfect for your next educational or corporate event. Each venue is thoughtfully equipped and designed to provide a professional and comfortable environment for lectures, seminars, and workshops. Our intuitive booking system ensures a seamless experience, allowing you to focus on delivering a successful and memorable event.
              </p>
              <div class="entry-footer">
                <a href="{{route('all.avenues')}}" class="btn btn-primary btn-lg rounded-pill mt-4">Explore Our Website</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </article>
  </div>
</section>

@endsection
