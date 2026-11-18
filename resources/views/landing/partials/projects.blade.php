<!-- Projects & Events Section -->
<section id="projects" class="py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <div
                class="flex items-center justify-center gap-2 mb-4 text-sk-green font-bold tracking-wider uppercase text-sm">
                <span class="w-8 h-1 bg-sk-green rounded-full"></span>
                Initiatives
                <span class="w-8 h-1 bg-sk-green rounded-full"></span>
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Recent Projects & Events</h2>
            <p class="text-gray-600 text-lg">Discover how we are making a positive impact in our barangay through various
                youth-oriented programs.</p>
        </div>



        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-12 fade-in-up">
            @forelse($projects as $project)
                <!-- Dynamic Project Card -->
                <div
                    class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col group transform hover:-translate-y-1">

                    <!-- Image Container -->
                    <div class="relative h-56 overflow-hidden bg-gray-100">
                        @if ($project->image_path)
                            <img src="{{ asset($project->image_path) }}" alt="{{ $project->title }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <!-- Fallback if no image exists -->
                            <div class="w-full h-full flex items-center justify-center text-gray-300">
                                <i class="fas fa-image text-4xl"></i>
                            </div>
                        @endif

                        <!-- Dynamic Status Badge -->
                        <div
                            class="absolute top-4 right-4 px-3 py-1 text-[10px] font-bold uppercase tracking-wider rounded-full shadow-md
                    {{ $project->status == 'completed' ? 'bg-blue-500 text-white' : '' }}
                    {{ $project->status == 'ongoing' ? 'bg-emerald-500 text-white' : '' }}
                    {{ $project->status == 'upcoming' ? 'bg-amber-500 text-white' : '' }}">
                            {{ $project->status }}
                        </div>
                    </div>

                    <!-- Content Container -->
                    <div class="p-6 flex flex-col flex-grow">
                        <!-- Date -->
                        <div class="flex items-center text-xs text-gray-500 mb-3 font-semibold">
                            <i class="far fa-calendar-alt text-sk-green mr-2"></i>
                            {{ $project->event_date->format('F d, Y') }}
                        </div>

                        <!-- Title & Description -->
                        <h4
                            class="font-bold text-xl text-gray-900 mb-2 leading-tight group-hover:text-sk-green transition-colors">
                            {{ $project->title }}
                        </h4>
                        <p class="text-gray-600 text-sm mb-6 flex-grow line-clamp-3">
                            {{ $project->description }}
                        </p>

                        <!-- Replace the existing button with this: -->
                        <button
                            class="read-more-btn mt-auto text-sk-green font-bold text-sm flex items-center hover:text-sk-darkgreen transition-colors"
                            data-title="{{ $project->title }}" data-desc="{{ $project->description }}"
                            data-date="{{ $project->event_date->format('F d, Y') }}"
                            data-status="{{ $project->status }}"
                            data-image="{{ $project->image_path ? asset($project->image_path) : '' }}">
                            Read More <i
                                class="fas fa-arrow-right ml-2 text-xs transition-transform group-hover:translate-x-1"></i>
                        </button>
                    </div>
                </div>
            @empty
                <!-- Empty State -->
                <div
                    class="col-span-full text-center py-16 bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200">
                    <div
                        class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-sm text-gray-400">
                        <i class="fas fa-calendar-times text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-700 mb-1">No Projects Published Yet</h3>
                    <p class="text-gray-500 text-sm">Check back later for updates on our community initiatives.</p>
                </div>
            @endforelse
        </div>

    </div>

    <div class="text-center mt-12">
        <div class="mt-12 text-center fade-in-up">
            <a href="{{ route('projects.all') }}"
                class="inline-flex items-center px-8 py-3 bg-white border-2 border-sk-green text-sk-green font-bold rounded-full hover:bg-sk-green hover:text-white transition-all duration-300 hover:shadow-lg transform hover:-translate-y-1">
                View All Projects <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
    </div>
</section>
