


@extends('frontend.layout.app')
@section('content')
@section('title','HALL Plus - Home')

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
  <div class="container my-5">
    <article id="about-us">
      <div class="card border-0 shadow-sm rounded-3">
        <div class="row g-0 align-items-center">
           <!-- Image on the Right -->
           <div class="col-12 col-md-6">
            <img class="img-fluid rounded-end object-fit-cover" loading="lazy" src="{{asset('Frontend/assets/img/COC.png')}}" alt="Lecture Hall">
          </div>
          <!-- Text Content on the Left -->
          <div class="col-12 col-md-6">
            <div class="card-body p-md-4 p-xl-5">
              <h2 class="card-title display-4 fw-bold mb-4 lh-1">
                <a class="link-dark text-decoration-none" href="#!">About Us</a>
              </h2>
              <p class="card-text text-secondary mb-4">
                We are a team of Qassim University students who have undergone training at Qassim Tech. As part of our final project, we proudly present HALL+—an innovative platform designed to connect hall owners with users looking to book fully equipped classrooms for educational and professional events.
              </p>
              <h3 class="mb-3">Group Members:</h3>
              <div class="entry-footer">
                <ul class="list-unstyled">
                  <li class="mb-3">
                    <a class="nav-link link-dark d-flex align-items-center" href="https://www.linkedin.com/in/deemalgherair" target="_blank">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-linkedin me-2" viewBox="0 0 16 16">
                        <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z" />
                      </svg>
                      <span>Deem Ahmad Alghraier</span>
                    </a>
                  </li>
                  <li class="mb-3">
                    <a class="nav-link link-dark d-flex align-items-center"  href="https://www.linkedin.com/in/mona-aloufi-1b8123242/?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=" target="_blank">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-linkedin me-2" viewBox="0 0 16 16">
                        <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z" />
                      </svg>
                      <span>Mona Hamdan Aloufi </span>
                    </a>
                  </li>
                  <li class="mb-3">
                    <a class="nav-link link-dark d-flex align-items-center" href="https://www.linkedin.com/in/razan-alturaifi-25a608308/?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=ios_app" target="_blank">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-linkedin me-2" viewBox="0 0 16 16">
                        <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z" />
                      </svg>
                      <span>Razan Sultan Alturaifi
                      </span>
                    </a>
                  </li>
                  <li class="mb-3">
                    <a class="nav-link link-dark d-flex align-items-center" href="https://www.linkedin.com/in/%D8%B3%D9%85%D9%8A%D9%87-%D8%B9%D8%A8%D8%AF%D9%84%D9%84%D9%87-1780b5245/" target="_blank">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-linkedin me-2" viewBox="0 0 16 16">
                        <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z" />
                      </svg>
                      <span>Sumih Abdullah Alharbi</span>
                    </a>
                  </li>
                  <li class="mb-3">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                      </svg>
                      <span>Noura Naji Alrasheedi</span>
                    </a>
                  </li>
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
