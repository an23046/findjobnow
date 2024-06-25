<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Find Job Now</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body class="flex items-center justify-center" style="background: #edf2f7;">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;1,100;1,200&display=swap" rel="stylesheet" />
    <!-- AlpineJS -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Tailwind -->
    <script src="https://cdn-tailwindcss.vercel.app/"></script>

    <style>
        section {
            font-family: "Poppins", sans-serif;
        }
    </style>

    <div>
        <section>
            <div class="w-full flex justify-center"> <div>
                <div>
                    <h1 class="inline-flex w-full justify-center">Find Job Now</h1>
                    <div class="relative inline-block text-left w-full flex justify-center"> 
                        <button type="button" class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50" id="menu-button" aria-expanded="true" aria-haspopup="true">
                            Category
                            <svg class="-mr-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <button type="button" class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50" id="menu-button" aria-expanded="true" aria-haspopup="true">
                            <a href="{{ route('profile.show') }}">Profile</a>
                        </button>
                        @auth
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50" id="menu-button" aria-expanded="true" aria-haspopup="true">
                                    {{ __('Logout') }}
                                </button>
                            </form>
                        @endauth

                        <div hidden class="absolute z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" id="dropdown" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                            <div class="py-1" role="none">
                                @foreach ($categories as $index => $category)
                                    <a href="{{ route('job_offers.index', ['category' => $category->id]) }}" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-item-{{ $index }}">{{$category->title}}</a>
                                @endforeach
                                <a href="{{ route('job_offers.index') }}" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-item-{{ count($categories)+1 }}">All</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="bg-gray-100 dark:bg-gray-900 py-10 px-12">
            <!-- Card Grid -->
            <div class="grid grid-flow-row gap-8 text-neutral-600 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach ($jobs as $job)
                    <div>
                        <!-- Card Item -->
                        <div class="my-8 rounded shadow-lg shadow-gray-200 dark:shadow-gray-900 bg-white dark:bg-gray-800 duration-300 hover:-translate-y-1">
                            <!-- Clickable Area -->
                            <a href="{{ route('job_offers.show', $job->id) }}" class="cursor-pointer">
                                <figure>
                                    <!-- Image -->
                                    <!-- <img :src="post.image + '?auto=format&fit=crop&w=400&q=50'" class="rounded-t h-72 w-full object-cover" /> -->

                                    <figcaption class="p-4">
                                        <p class="text-lg mb-4 font-bold leading-relaxed text-gray-800 dark:text-gray-300">
                                            {{ $job->title }}
                                        </p>
                                        <p class=" text-base font-semibold">
                                            {{ $job->category->title}}
                                        </p>
                                        <!-- Description -->
                                        <small class="leading-5 text-gray-500 dark:text-gray-400">
                                            {{$job->description}}
                                        </small>
                                    </figcaption>
                                </figure>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
    <!-- <script>
        function xData() {
            /**
             * Shuffle an array
             * @param {Array} array
             * @source https://stackoverflow.com/a/2450976/6940144
             */
            function shuffle(array) {
                let currentIndex = array.length,
                    randomIndex;

                // While there remain elements to shuffle.
                while (currentIndex != 0) {
                    // Pick a remaining element.
                    randomIndex = Math.floor(Math.random() * currentIndex);
                    currentIndex--;

                    // And swap it with the current element.
                    [array[currentIndex], array[randomIndex]] = [
                        array[randomIndex],
                        array[currentIndex],
                    ];
                }

                return array;
            }

            const posts = [
                {
                    image:
                        "https://images.unsplash.com/photo-1495474472287-4d71bcdd2085",
                    title: "5 Easy Tips That Will Make Your Latte Art Flourish",
                    description:
                        "Latte art is quite often the most attractive thing for a new barista, and latte art is an excellent gateway to the exciting world of coffee. Latte art easy to start with, but to master latte art patterns, you need a lot practice and determination. Here are my tips that helped me to improve my latte art a few years ago!",
                },
                {
                    image:
                        "https://images.unsplash.com/photo-1512034400317-de97d7d6c3ed",
                    title: "Coffee Roasting Basics: Developing Flavour by Roasting",
                    description:
                        "Caffé latte and flat white are definitely the most ordered espresso based drinks in cafés around the world but what are they really? Have you ever wondered the difference between caffé latte vs. flat white? Let's see what makes caffé latte and flat white different from each other!",
                },
                {
                    image:
                        "https://images.unsplash.com/photo-1445077100181-a33e9ac94db0",
                    title: "Latte vs. Flat White - What is the Difference?",
                    description:
                        "I bet roasting is the thing that every barista wants to know about! We can develop flavour by roasting coffee. How can we achieve the best tasting coffee? What actually happens when roasting?",
                },
                {
                    image:
                        "https://images.unsplash.com/photo-1459257868276-5e65389e2722",
                    title: "Creating the Perfect Espresso Recipe",
                    description:
                        "Espresso recipes are important in cafés in terms of consistency and flavour. How and why are the espresso recipes made and what are the things you should consider when making a recipe for espresso? Let’s dig deeper into the world of espresso!",
                },
            ];

            return {
                posts: [
                    ...shuffle(posts),
                    ...shuffle(posts),
                    ...shuffle(posts),
                    ...shuffle(posts),
                    ...shuffle(posts),
                ],
            };
        }
    </script> -->

    <!-- Search drop dowm
    Home button
    Profile button -->
    <!-- @foreach ($jobs as $job)
        <div>
            <h2><a href="{{ route('job_offers.show', $job->id) }}">{{ $job->title }}</a></h2>
            <p>{{ $job->user->name }}</p>
            <p>{{ $job->category->title }}</p>
            <p>{{ $job->description }}</p>
            <p>{{ $job->salary }}€</p>
        </div>
    @endforeach -->
    <!-- component -->
<!-- component -->



    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>