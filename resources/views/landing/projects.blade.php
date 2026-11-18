@extends('layouts.app')

@section('content')
    <!-- Navbar -->
    @include('landing.partials.navbar')

    <div class="pt-32 pb-20 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Page Header -->
            <div class="text-center mb-12">
                <a href="{{ route('landing') }}#projects" class="inline-flex items-center text-sm font-bold text-sk-green hover:text-sk-darkgreen mb-4 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Home
                </a>
                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4">All <span class="text-sk-green">Projects & Events</span></h1>
                <p class="text-gray-600 max-w-2xl mx-auto">Explore the complete archive of initiatives, programs, and activities organized by the Sangguniang Kabataan.</p>
            </div>

            <!-- Projects Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($projects as $project)
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col group transform hover:-translate-y-1">
                        <div class="relative h-56 overflow-hidden bg-gray-100">
                            @if($project->image_path)
                                <img src="{{ asset($project->image_path) }}" alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-300">
                                    <i class="fas fa-image text-4xl"></i>
                                </div>
                            @endif
                            <div class="absolute top-4 right-4 px-3 py-1 text-[10px] font-bold uppercase tracking-wider rounded-full shadow-md
                                {{ $project->status == 'completed' ? 'bg-blue-500 text-white' : '' }}
                                {{ $project->status == 'ongoing' ? 'bg-emerald-500 text-white' : '' }}
                                {{ $project->status == 'upcoming' ? 'bg-amber-500 text-white' : '' }}">
                                {{ $project->status }}
                            </div>
                        </div>
                        <div class="p-6 flex flex-col flex-grow">
                            <div class="flex items-center text-xs text-gray-500 mb-3 font-semibold">
                                <i class="far fa-calendar-alt text-sk-green mr-2"></i>
                                {{ $project->event_date->format('F d, Y') }}
                            </div>
                            <h4 class="font-bold text-xl text-gray-900 mb-2 leading-tight group-hover:text-sk-green transition-colors">
                                {{ $project->title }}
                            </h4>
                            <p class="text-gray-600 text-sm mb-6 flex-grow line-clamp-3">
                                {{ $project->description }}
                            </p>
                            <button class="read-more-btn mt-auto text-sk-green font-bold text-sm flex items-center hover:text-sk-darkgreen transition-colors"
                                data-title="{{ $project->title }}"
                                data-desc="{{ $project->description }}"
                                data-date="{{ $project->event_date->format('F d, Y') }}"
                                data-status="{{ $project->status }}"
                                data-image="{{ $project->image_path ? asset($project->image_path) : '' }}">
                                Read More <i class="fas fa-arrow-right ml-2 text-xs transition-transform group-hover:translate-x-1"></i>
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-16 bg-white rounded-2xl border border-gray-100 shadow-sm">
                        <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-400">
                            <i class="fas fa-calendar-times text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-700">No Projects Found</h3>
                    </div>
                @endforelse
            </div>

            <!-- Laravel Pagination Links -->
            <div class="mt-12">
                {{ $projects->links() }}
            </div>

        </div>
    </div>

    <!-- Footer & Modals -->
    @include('landing.partials.footer')
    @include('landing.partials.modals')
@endsection

@push('scripts')
<script>
    // We need to re-initialize the Project Modal logic specifically for this page
    const projectModal = document.getElementById('project-modal');
    const projectBackdrop = document.getElementById('project-backdrop');
    const closeProjectBtn = document.getElementById('close-project-btn');

    const pModalImage = document.getElementById('project-modal-image');
    const pModalNoImage = document.getElementById('project-modal-no-image');
    const pModalStatus = document.getElementById('project-modal-status');
    const pModalDate = document.getElementById('project-modal-date');
    const pModalTitle = document.getElementById('project-modal-title');
    const pModalDesc = document.getElementById('project-modal-desc');

    const statusColors = {
        'upcoming': 'bg-amber-500',
        'ongoing': 'bg-emerald-500',
        'completed': 'bg-blue-500'
    };

    document.querySelectorAll('.read-more-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();

            pModalTitle.textContent = this.getAttribute('data-title');
            pModalDesc.textContent = this.getAttribute('data-desc');
            pModalDate.textContent = this.getAttribute('data-date');
            const status = this.getAttribute('data-status');
            const image = this.getAttribute('data-image');

            pModalStatus.textContent = status;
            pModalStatus.className = `px-3 py-1 text-[10px] font-bold uppercase tracking-wider rounded-full shadow-sm text-white ${statusColors[status] || 'bg-gray-500'}`;

            if (image) {
                pModalImage.src = image;
                pModalImage.classList.remove('hidden');
                pModalNoImage.classList.add('hidden');
            } else {
                pModalImage.src = '';
                pModalImage.classList.add('hidden');
                pModalNoImage.classList.remove('hidden');
            }

            projectModal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        });
    });

    const hideProjectModal = () => {
        projectModal.classList.add('hidden');
        document.body.style.overflow = '';
    };

    if (closeProjectBtn) closeProjectBtn.addEventListener('click', hideProjectModal);
    if (projectBackdrop) projectBackdrop.addEventListener('click', hideProjectModal);

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !projectModal.classList.contains('hidden')) {
            hideProjectModal();
        }
    });
</script>
@endpush
