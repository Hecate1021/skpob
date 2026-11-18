@extends('layouts.app')

@section('content')
@if(session('success'))
        <div id="toast-success" class="fixed top-5 right-5 z-[200] flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow-lg border-l-4 border-[#00a651] transition-opacity duration-500" role="alert">
            <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg">
                <i class="fas fa-check"></i>
            </div>
            <div class="ml-3 text-sm font-normal">{{ session('success') }}</div>
            <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8" onclick="document.getElementById('toast-success').remove();">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Auto-hide script -->
        <script>
            setTimeout(function() {
                const toast = document.getElementById('toast-success');
                if (toast) {
                    // Fade out
                    toast.style.opacity = '0';
                    // Remove from DOM after fade completes (500ms)
                    setTimeout(() => toast.remove(), 500);
                }
            }, 5000); // 5000 milliseconds = 5 seconds
        </script>
    @endif

    <!-- Navbar -->
    @include('landing.partials.navbar')

    <!-- Hero Section -->
    @include('landing.partials.hero')

    <!-- Disclosure Board -->
    @include('landing.partials.disclosure')

    <!-- Projects & Events -->
    @include('landing.partials.projects')

    <!-- SK ID Section -->
    @include('landing.partials.sk-id')

    <!-- About Section -->
    @include('landing.partials.about')

    <!-- Call to Action & Footer -->
    @include('landing.partials.footer')

    <!-- Modals -->
    @include('landing.partials.modals')

@endsection

@push('scripts')
<script>
    // 1. Laravel securely injects the database array as a JSON object
    const disclosureData = @json($disclosureData);

    // Update Copyright Year
    const yearEl = document.getElementById('year');
    if (yearEl) yearEl.textContent = new Date().getFullYear();

    // Mobile Menu Logic
    const btn = document.getElementById('mobile-menu-btn');
    const menu = document.getElementById('mobile-menu');
    if (btn && menu) {
        const icon = btn.querySelector('i');
        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
            icon.classList.toggle('fa-bars');
            icon.classList.toggle('fa-times');
        });

        menu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                menu.classList.add('hidden');
                icon.classList.add('fa-bars');
                icon.classList.remove('fa-times');
            });
        });
    }

    // Disclosure Modals Logic
    const bookBtns = document.querySelectorAll('.book-container');
    const selectionModal = document.getElementById('selection-modal');
    const selectionModalTitle = document.getElementById('selection-modal-title');
    const docListContainer = document.getElementById('doc-list-container');
    const closeSelectionBtn = document.getElementById('close-selection-btn');
    const selectionBackdrop = document.getElementById('selection-backdrop');

    const pdfModal = document.getElementById('pdf-modal');
    const closeModalBtn = document.getElementById('close-modal-btn');
    const modalBackdrop = document.getElementById('modal-backdrop');
    const backToDocsBtn = document.getElementById('back-to-docs-btn');
    const pdfModalTitle = document.getElementById('pdf-modal-title');

    const bindDocButtons = () => {
        document.querySelectorAll('.doc-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const docTitle = e.currentTarget.getAttribute('data-title');
                const docUrl = e.currentTarget.getAttribute('data-url');

                pdfModalTitle.textContent = docTitle;

                const pdfFrame = document.querySelector('#pdf-modal iframe');
                if (pdfFrame) {
                    pdfFrame.src = docUrl;
                }

                selectionModal.classList.add('hidden');
                pdfModal.classList.remove('hidden');
            });
        });
    };

    bookBtns.forEach(book => {
        book.addEventListener('click', (e) => {
            const categoryId = e.currentTarget.getAttribute('data-category-id');
            const title = e.currentTarget.getAttribute('data-title');

            selectionModalTitle.textContent = title;
            docListContainer.innerHTML = '';

            const files = disclosureData[categoryId] || [];

            if (files.length === 0) {
                docListContainer.innerHTML = '<p class="col-span-2 text-center text-gray-500 py-8">No documents available in this category yet.</p>';
            } else {
                files.forEach(file => {
                    docListContainer.insertAdjacentHTML('beforeend', `
                        <button class="doc-btn flex items-center p-4 bg-white border border-gray-200 rounded-xl hover:bg-sk-green hover:text-white hover:border-sk-green transition-all text-left group shadow-sm hover:shadow-md" data-title="${file.title}" data-url="${file.url}">
                            <div class="w-12 text-center flex-shrink-0 mr-4">
                                <i class="fas fa-file-pdf text-red-500 group-hover:text-white text-3xl mb-1 block"></i>
                                <span class="text-[10px] font-bold text-gray-400 group-hover:text-emerald-100">${file.year}</span>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800 group-hover:text-white text-md leading-tight mb-1">${file.title}</h4>
                                <p class="text-xs text-gray-500 group-hover:text-emerald-100 leading-tight">${file.desc}</p>
                            </div>
                        </button>
                    `);
                });
                bindDocButtons();
            }
            selectionModal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        });
    });

    const hideSelectionModal = () => {
        selectionModal.classList.add('hidden');
        if (pdfModal.classList.contains('hidden')) document.body.style.overflow = '';
    };

    const hidePdfModal = () => {
        pdfModal.classList.add('hidden');
        document.body.style.overflow = '';

        const pdfFrame = document.querySelector('#pdf-modal iframe');
        if (pdfFrame) pdfFrame.src = '';
    };

    if (closeSelectionBtn) closeSelectionBtn.addEventListener('click', hideSelectionModal);
    if (selectionBackdrop) selectionBackdrop.addEventListener('click', hideSelectionModal);
    if (closeModalBtn) closeModalBtn.addEventListener('click', hidePdfModal);
    if (modalBackdrop) modalBackdrop.addEventListener('click', hidePdfModal);

    if (backToDocsBtn) {
        backToDocsBtn.addEventListener('click', () => {
            pdfModal.classList.add('hidden');
            selectionModal.classList.remove('hidden');

            const pdfFrame = document.querySelector('#pdf-modal iframe');
            if (pdfFrame) pdfFrame.src = '';
        });
    }

    // Project Modal Logic
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

            const title = this.getAttribute('data-title');
            const desc = this.getAttribute('data-desc');
            const date = this.getAttribute('data-date');
            const status = this.getAttribute('data-status');
            const image = this.getAttribute('data-image');

            pModalTitle.textContent = title;
            pModalDesc.textContent = desc;
            pModalDate.textContent = date;
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
        if (document.getElementById('selection-modal').classList.contains('hidden') &&
            document.getElementById('pdf-modal').classList.contains('hidden')) {
            document.body.style.overflow = '';
        }
    };

    if (closeProjectBtn) closeProjectBtn.addEventListener('click', hideProjectModal);
    if (projectBackdrop) projectBackdrop.addEventListener('click', hideProjectModal);

    // Global Escape key handler
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            if (!pdfModal.classList.contains('hidden')) {
                hidePdfModal();
            } else if (!selectionModal.classList.contains('hidden')) {
                hideSelectionModal();
            } else if (!projectModal.classList.contains('hidden')) {
                hideProjectModal();
            }
        }
    });
</script>
@endpush
