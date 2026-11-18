@extends('layouts.admin')

@section('header_title', 'Manage SK ID Requests')

@section('content')
    @if(session('success'))
        <div class="bg-emerald-100 border-l-4 border-sk-green text-emerald-800 p-4 mb-6 rounded shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 overflow-hidden">
       <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6 border-b pb-4">
            <h3 class="font-bold text-gray-800 text-lg">Applicant Queue</h3>

            <!-- Search Form -->
            <form action="" method="GET" class="w-full md:w-1/3 relative">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search name, contact, or status..."
                       class="w-full pl-10 pr-10 py-2 border border-gray-300 rounded-lg focus:border-sk-green focus:ring-1 focus:ring-sk-green text-sm transition-colors">
                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>

                <!-- Clear Search Button (Shows only if searching) -->
                @if(request('search'))
                    <a href="{{ request()->url() }}" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-red-400 hover:text-red-600 transition-colors">
                        <i class="fas fa-times-circle"></i>
                    </a>
                @endif
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm whitespace-nowrap">
                <thead class="bg-gray-50 text-gray-600">
                    <tr>
                        <th class="px-4 py-3">Applicant</th>
                        <th class="px-4 py-3">Contact & Address</th>
                        <th class="px-4 py-3">Date Submitted</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($requests as $skRequest)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <!-- Applicant Info -->
                            <td class="px-4 py-4 flex items-center gap-3">
                                <a href="{{ asset($skRequest->id_photo_path) }}" target="_blank">
                                    <img src="{{ asset($skRequest->id_photo_path) }}" alt="ID Photo" class="w-12 h-12 rounded-lg object-cover shadow-sm border border-gray-200 hover:scale-110 transition-transform">
                                </a>
                                <div>
                                    <p class="font-bold text-gray-900 text-base">{{ $skRequest->first_name }} {{ $skRequest->last_name }}</p>
                                    <p class="text-xs text-gray-500">{{ $skRequest->gender }} • Born: {{ $skRequest->dob->format('M d, Y') }}</p>
                                </div>
                            </td>

                            <!-- Contact Info -->
                            <td class="px-4 py-4">
                                <p class="font-semibold text-gray-800"><i class="fas fa-phone-alt text-xs text-sk-green mr-1"></i> {{ $skRequest->contact_number }}</p>
                                <p class="text-xs text-gray-500 truncate max-w-[200px]" title="{{ $skRequest->address }}">{{ $skRequest->address }}</p>
                            </td>

                            <!-- Date -->
                            <td class="px-4 py-4">
                                <p class="text-gray-800 font-medium">{{ $skRequest->created_at->format('M d, Y') }}</p>
                                <p class="text-xs text-gray-500">{{ $skRequest->created_at->format('h:i A') }}</p>
                            </td>

                            <!-- Status Badge -->
                            <td class="px-4 py-4">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider
                                    {{ $skRequest->status === 'pending' ? 'bg-amber-100 text-amber-700 border border-amber-200' : '' }}
                                    {{ $skRequest->status === 'approved' ? 'bg-emerald-100 text-emerald-700 border border-emerald-200' : '' }}
                                    {{ $skRequest->status === 'printed' ? 'bg-blue-100 text-blue-700 border border-blue-200' : '' }}
                                    {{ $skRequest->status === 'rejected' ? 'bg-red-100 text-red-700 border border-red-200' : '' }}">
                                    {{ $skRequest->status }}
                                </span>
                                @if($skRequest->remarks)
                                    <p class="text-[10px] text-gray-500 mt-1 truncate max-w-[150px]" title="{{ $skRequest->remarks }}"><i class="fas fa-info-circle mr-1"></i>{{ $skRequest->remarks }}</p>
                                @endif
                            </td>

                            <!-- Actions -->
                            <td class="px-4 py-4 text-right">
                                <div class="flex justify-end gap-2">

                                    <!-- View Details Button (Using Safe Data Attributes) -->
                                    <button type="button"
                                            data-photo="{{ asset($skRequest->id_photo_path) }}"
                                            data-name="{{ $skRequest->first_name }} {{ $skRequest->last_name }}"
                                            data-dob="{{ $skRequest->dob->format('F d, Y') }}"
                                            data-gender="{{ $skRequest->gender }}"
                                            data-contact="{{ $skRequest->contact_number }}"
                                            data-address="{{ $skRequest->address }}"
                                            data-em-name="{{ $skRequest->emergency_contact_name }}"
                                            data-em-contact="{{ $skRequest->emergency_contact_number }}"
                                            data-em-address="{{ $skRequest->emergency_contact_address ?? 'Not Provided' }}"
                                            onclick="openViewModal(this)"
                                            class="px-3 py-1.5 bg-gray-100 text-gray-700 hover:bg-gray-200 rounded-md text-xs font-bold transition-colors shadow-sm">
                                        <i class="fas fa-eye mr-1"></i> View
                                    </button>

                                    @if($skRequest->status === 'pending')
                                        <!-- Approve -->
                                        <form action="{{ route('admin.sk_ids.update_status', $skRequest) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="approved">
                                            <button type="submit" class="px-3 py-1.5 bg-emerald-50 text-emerald-600 hover:bg-emerald-500 hover:text-white rounded-md text-xs font-bold transition-colors shadow-sm" onclick="return confirm('Approve this application?');">
                                                <i class="fas fa-check mr-1"></i> Approve
                                            </button>
                                        </form>

                                        <!-- Reject -->
                                        <button type="button" onclick="openRejectModal({{ $skRequest->id }})" class="px-3 py-1.5 bg-red-50 text-red-600 hover:bg-red-500 hover:text-white rounded-md text-xs font-bold transition-colors shadow-sm">
                                            <i class="fas fa-times mr-1"></i> Reject
                                        </button>
                                    @elseif($skRequest->status === 'approved')
                                        <!-- Mark as Printed -->
                                        <form action="{{ route('admin.sk_ids.update_status', $skRequest) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="printed">
                                            <button type="submit" class="px-3 py-1.5 bg-blue-50 text-blue-600 hover:bg-blue-500 hover:text-white rounded-md text-xs font-bold transition-colors shadow-sm">
                                                <i class="fas fa-print mr-1"></i> Mark Printed
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-xs text-gray-400 font-semibold px-2 flex items-center"><i class="fas fa-lock mr-1"></i> Closed</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-12 text-center">
                                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-3 text-gray-400">
                                    <i class="fas fa-inbox text-2xl"></i>
                                </div>
                                <p class="text-gray-500 font-medium">No SK ID requests found.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-6">
            {{ $requests->links() }}
        </div>
    </div>

    <!-- VIEW DETAILS MODAL -->
    <div id="view-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 bg-gray-900/50 backdrop-blur-sm">
        <div class="bg-white rounded-xl shadow-xl w-full max-w-2xl overflow-hidden animate-modal flex flex-col max-h-[90vh]">
            <div class="p-4 border-b border-gray-100 flex justify-between items-center bg-gray-50 shrink-0">
                <h3 class="font-bold text-gray-800 flex items-center gap-2"><i class="fas fa-id-card text-[#00a651]"></i> Applicant Details</h3>
                <button onclick="closeViewModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>

            <div class="p-6 overflow-y-auto">
                <div class="flex flex-col md:flex-row gap-6">
                    <!-- ID Photo Preview -->
                    <div class="shrink-0 flex flex-col items-center">
                        <div class="w-40 h-40 bg-gray-100 border-4 border-white shadow-md rounded-xl overflow-hidden mb-2">
                            <img id="view-photo" src="" alt="Applicant Photo" class="w-full h-full object-cover">
                        </div>
                        <p class="text-xs text-gray-500 font-bold uppercase tracking-wider">ID Photo</p>
                    </div>

                    <!-- Personal Information Grid -->
                    <div class="flex-grow space-y-4">
                        <div class="border-b border-gray-100 pb-2">
                            <h4 class="text-sm font-black text-[#00a651] uppercase tracking-wide">Personal Information</h4>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-[11px] text-gray-500 font-bold uppercase mb-0.5">Full Name</p>
                                <p id="view-name" class="font-bold text-gray-900 text-sm"></p>
                            </div>
                            <div>
                                <p class="text-[11px] text-gray-500 font-bold uppercase mb-0.5">Date of Birth</p>
                                <p id="view-dob" class="font-medium text-gray-800 text-sm"></p>
                            </div>
                            <div>
                                <p class="text-[11px] text-gray-500 font-bold uppercase mb-0.5">Gender</p>
                                <p id="view-gender" class="font-medium text-gray-800 text-sm"></p>
                            </div>
                            <div>
                                <p class="text-[11px] text-gray-500 font-bold uppercase mb-0.5">Contact Number</p>
                                <p id="view-contact" class="font-medium text-gray-800 text-sm"></p>
                            </div>
                            <div class="col-span-2">
                                <p class="text-[11px] text-gray-500 font-bold uppercase mb-0.5">Complete Address</p>
                                <p id="view-address" class="font-medium text-gray-800 text-sm"></p>
                            </div>
                        </div>

                        <div class="border-b border-gray-100 pb-2 mt-6">
                            <h4 class="text-sm font-black text-red-600 uppercase tracking-wide">Emergency Contact</h4>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-[11px] text-gray-500 font-bold uppercase mb-0.5">Contact Name</p>
                                <p id="view-em-name" class="font-bold text-gray-900 text-sm"></p>
                            </div>
                            <div>
                                <p class="text-[11px] text-gray-500 font-bold uppercase mb-0.5">Contact Number</p>
                                <p id="view-em-contact" class="font-medium text-gray-800 text-sm"></p>
                            </div>
                            <div class="col-span-2">
                                <p class="text-[11px] text-gray-500 font-bold uppercase mb-0.5">Emergency Address</p>
                                <p id="view-em-address" class="font-medium text-gray-800 text-sm"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-4 bg-gray-50 border-t border-gray-100 flex justify-end shrink-0">
                <button type="button" onclick="closeViewModal()" class="px-5 py-2 bg-gray-800 text-white rounded-lg hover:bg-black text-sm font-bold transition-colors shadow-sm">Close Window</button>
            </div>
        </div>
    </div>

    <!-- REJECT MODAL OVERLAY -->
    <div id="reject-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 bg-gray-900/50 backdrop-blur-sm">
        <div class="bg-white rounded-xl shadow-xl w-full max-w-md overflow-hidden animate-modal">
            <div class="p-4 border-b border-gray-100 flex justify-between items-center bg-red-50">
                <h3 class="font-bold text-red-700 flex items-center gap-2"><i class="fas fa-exclamation-triangle"></i> Reject Application</h3>
                <button onclick="closeRejectModal()" class="text-gray-400 hover:text-red-500 transition-colors">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>

            <form id="reject-form" method="POST" action="">
                @csrf
                @method('PUT')
                <input type="hidden" name="status" value="rejected">

                <div class="p-6">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Reason for Rejection <span class="text-red-500">*</span></label>
                    <textarea name="remarks" rows="3" required class="w-full rounded-md border-gray-300 focus:border-red-500 focus:ring focus:ring-red-500/20" placeholder="e.g. Blurry ID photo, invalid address..."></textarea>
                    <p class="text-xs text-gray-500 mt-2">The applicant will see this reason on their dashboard so they can correct it.</p>
                </div>

                <div class="p-4 bg-gray-50 border-t border-gray-100 flex justify-end gap-2">
                    <button type="button" onclick="closeRejectModal()" class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 text-sm font-bold transition-colors">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 text-sm font-bold transition-colors shadow-sm">Confirm Rejection</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Scripts are now moved INSIDE the content section to guarantee they load even if the layout is missing the stack -->
    <script>
        // View Modal Logic
        const viewModal = document.getElementById('view-modal');

        function openViewModal(button) {
            // Retrieve data safely from HTML attributes
            document.getElementById('view-photo').src = button.dataset.photo;
            document.getElementById('view-name').textContent = button.dataset.name;
            document.getElementById('view-dob').textContent = button.dataset.dob;
            document.getElementById('view-gender').textContent = button.dataset.gender;
            document.getElementById('view-contact').textContent = button.dataset.contact;
            document.getElementById('view-address').textContent = button.dataset.address;

            document.getElementById('view-em-name').textContent = button.dataset.emName;
            document.getElementById('view-em-contact').textContent = button.dataset.emContact;
            document.getElementById('view-em-address').textContent = button.dataset.emAddress;

            viewModal.classList.remove('hidden');
        }

        function closeViewModal() {
            viewModal.classList.add('hidden');
        }

        // Reject Modal Logic
        const rejectModal = document.getElementById('reject-modal');
        const rejectForm = document.getElementById('reject-form');

        function openRejectModal(requestId) {
            rejectForm.action = `/admin/sk-ids/${requestId}/status`;
            rejectModal.classList.remove('hidden');
        }

        function closeRejectModal() {
            rejectModal.classList.add('hidden');
            rejectForm.reset();
        }
    </script>
@endsection
