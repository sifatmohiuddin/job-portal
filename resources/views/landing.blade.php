@extends('layouts.app')

@section('content')
    <!-- HERO SECTION -->
    <section class="relative h-[43vh] overflow-hidden" x-data="{ slide: 0, slides: ['images/slide1.jpg', 'images/slide2.jpg', 'images/slide3.jpg'] }" x-init="setInterval(() => slide = (slide + 1) % slides.length, 5000)">

        <!-- Background Image -->
        <div class="absolute inset-0 bg-cover bg-[center_20%] transition-all duration-1000"
            :style="`background-image: url(${slides[slide]})`">
        </div>


        <a href="{{ route('auth.create') }}">Sign in</a>

        <!-- Sign In Button (Top-Left) -->
        <div class="absolute top-4 right-4 z-10 mt-8">
            <a href="{{ route('auth.create') }}"
                class="bg-blue-600 hover:bg-blue-700 px-6 py-3 rounded-xl text-lg font-medium text-white">
                Sign In
            </a>
        </div>

        <!-- Content Overlay -->
        <div
            class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-center items-center text-white text-center px-4">
            <h1 class="text-4xl md:text-6xl font-bold mb-4">Top Categories</h1>
            <p class="text-lg mb-6">Join thousands of job seekers and top companies hiring right now</p>
            <a href="/jobs" class="bg-blue-600 hover:bg-blue-700 px-6 py-3 rounded-xl text-lg font-medium">Browse Jobs</a>
        </div>
    </section>



    <!-- CATEGORIES -->
    <section class="py-16 bg-white">
        <div class="max-w-6xl mx-auto px-4 text-center">
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-6">
                @foreach (['Finance', 'IT', 'marketing', 'sales'] as $cat)
                    <a href="{{ route('jobs.index', ['category' => ucfirst($cat)]) }}"
                        class="bg-gray-50 rounded-xl p-6 hover:bg-blue-50 transition block">
                        <img src="{{ asset("images/{$cat}.png") }}" alt="{{ ucfirst($cat) }}" class="h-14 mx-auto mb-4">
                        <h3 class="text-lg font-semibold capitalize">{{ $cat }}</h3>
                        <p class="text-sm text-gray-500">+120 Jobs</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- FEATURED COMPANIES -->
    <section class="bg-gray-100 py-12">
        <div class="max-w-6xl mx-auto px-4">
            <h2 class="text-2xl font-bold text-center mb-8">Featured Companies</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 justify-center items-center">
                @php
                    $featuredCompanies = [
                        'fedex' => 74,
                        'google' => 4,
                        'netflix' => 89,
                        'spotify' => 65,
                    ];
                @endphp

                @foreach ($featuredCompanies as $company => $jobId)
                    <a href="https://job.fwh.is/jobs/{{ $jobId }}" target="_blank"
                        class="bg-gray-50 rounded-xl p-6 hover:bg-blue-50 transition block">
                        <img src="{{ asset("images/{$company}.png") }}" alt="{{ ucfirst($company) }}" class="h-20">
                    </a>
                @endforeach
            </div>
        </div>
    </section>


    <!-- HOW IT WORKS -->
    <section class="py-20 bg-white">
        <div class="max-w-6xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-10">How It Works</h2>
            <div class="grid md:grid-cols-3 gap-6">
                @foreach ([['Register', 'Create your free account.'], ['Search Jobs', 'Browse thousands of job listings.'], ['Apply', 'Get hired by top companies.']] as $step)
                    <div class="bg-gray-50 p-6 rounded-xl shadow text-left">
                        <div class="text-blue-600 text-3xl font-bold mb-2">0{{ $loop->iteration }}</div>
                        <h3 class="text-xl font-semibold mb-1">{{ $step[0] }}</h3>
                        <p class="text-gray-600">{{ $step[1] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CALL TO ACTION -->
    <section class="bg-blue-600 text-white py-16 text-center px-4">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">Ready to Take the Next Step in Your Career?</h2>
        <p class="mb-6">Join our platform and start applying to top jobs now. It's fast, free, and easy.</p>
        <a href="/register" class="bg-white text-blue-600 font-semibold px-6 py-3 rounded-xl hover:bg-gray-100">Get
            Started</a>
    </section>

    <!-- TESTIMONIALS -->
    <section class="py-20 bg-white">
        <div class="max-w-6xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Testimonials</h2>
            <div class="grid md:grid-cols-3 gap-6">
                @foreach ([['“I landed my dream job through this platform in just two weeks.”', 'Jane Doe'], ['“The site is clean, easy to use, and filled with high-quality listings.”', 'John Smith'], ['“I got multiple offers after using it. Totally worth it!”', 'Emily Ray']] as [$quote, $name])
                    <div class="bg-gray-50 p-6 rounded-xl shadow text-center">
                        <p class="italic mb-4">{{ $quote }}</p>
                        <h4 class="font-semibold">{{ $name }}</h4>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
