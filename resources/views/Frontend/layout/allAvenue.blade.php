@extends('frontend.layout.app')

@section('content')
    <section class="bg-light py-3 py-md-5 py-xl-8">
        <div class="container">
            <div class="row gy-4 gy-md-5 gx-xl-6 gy-xl-6 gx-xxl-9 gy-xxl-9">
                @foreach ($avenues as $avenue)
                    <div class="col-12 col-lg-4">
                        <article>
                            <div class="card border-0 bg-transparent">
                                <figure class="card-img-top mb-4 overflow-hidden bsb-overlay-hover">
                                    <a href="{{ route('show', $avenue->id) }}">
                                        <img class="img-fluid bsb-scale bsb-hover-scale-up" loading="lazy" src="{{ asset('storage/' . $avenue->image->url) }}" alt="{{ $avenue->name }}">
                                    </a>
                                    <figcaption>
                                        <a href="{{ route('show', $avenue->id) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-eye text-white bsb-hover-fadeInLeft" viewBox="0 0 16 16">
                                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                            </svg>
                                            <h4 class="h6 text-white bsb-hover-fadeInRight mt-2">view</h4>
                                        </a>
                                    </figcaption>
                                </figure>
                                <div class="card-body m-0 p-0">
                                    <div class="entry-header mb-3">
                                        <ul class="entry-meta list-unstyled d-flex mb-3">
                                            <li>
                                                <a class="d-inline-flex px-2 py-1 link-accent text-accent-emphasis bg-accent-subtle border border-accent-subtle rounded-2 text-decoration-none fs-7" href="#!">{{ $avenue->category ?? 'Classroom-based Lectures' }}</a>
                                            </li>
                                        </ul>
                                        <h2 class="card-title entry-title h4 m-0">
                                            <a class="link-dark text-decoration-none" href="{{ route('show', $avenue->id) }}">{{ $avenue->name }}</a>
                                        </h2>
                                        <a class="btn btn-primary mt-2 mb-3" href="{{ route('show', $avenue->id) }}">View</a>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
