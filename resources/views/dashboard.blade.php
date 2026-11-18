@extends('layouts.user')

@section('header_title', 'My ID Request')

@section('content')
    <!-- Success/Error Messages -->
    @if (session('success'))
        <div class="bg-emerald-100 border-l-4 border-sk-green text-emerald-800 p-4 mb-6 rounded shadow-sm">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-800 p-4 mb-6 rounded shadow-sm">
            {{ session('error') }}
        </div>
    @endif

    <!-- CONDITION 1: Pending Status -->
    @if ($skId && $skId->status === 'pending')
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 border-t-4 border-t-amber-500 overflow-hidden">
            <div class="p-8 md:p-12 flex flex-col items-center text-center">
                <div
                    class="w-20 h-20 bg-amber-100 text-amber-500 rounded-full flex items-center justify-center text-3xl mb-4 shadow-sm">
                    <i class="fas fa-hourglass-half"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-2">Application Under Review</h3>
                <p class="text-gray-600 max-w-lg">Your SK ID request has been received and is currently being processed by
                    the barangay administrators. Please check back later.</p>

                @if ($skId->remarks && $skId->remarks !== 'LOST ID REPLACEMENT REQUESTED')
                    <div
                        class="mt-6 p-4 bg-gray-50 border border-gray-200 rounded-lg text-sm text-gray-600 w-full max-w-lg text-left">
                        <span class="font-bold text-gray-800"><i class="fas fa-comment-dots mr-1"></i> Admin Note:</span>
                        <p class="mt-1">{{ $skId->remarks }}</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- CONDITION 2: Approved / Printed Status (Custom SK ID Design) -->
    @elseif($skId && in_array($skId->status, ['approved', 'printed']))
        @php
            // Generate the ID Number matching the image format (e.g., SKPOB-26-0001)
            $idNumber = 'SKPOB-' . $skId->created_at->format('y') . '-' . str_pad($skId->id, 4, '0', STR_PAD_LEFT);

            // Calculate Expiration Date (3 years validity)
            $expireText = $skId->created_at->format('F, Y') . ' - ' . $skId->created_at->addYears(3)->format('Y');
        @endphp

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 border-t-4 border-t-sk-green overflow-hidden">
            <div class="p-6 md:p-10">
                <div class="text-center mb-8">
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Your Digital SK ID</h3>
                    <p class="text-gray-600">Your application is approved. Save this digital ID to your phone. The QR Code
                        contains your official ID number.</p>
                </div>


                <!-- Digital ID Cards Container -->
                <div id="printable-id-cards" class="flex flex-col gap-8 items-center mt-6 overflow-x-auto pb-4 w-full">

                    <!-- ================= FRONT CARD ================= -->
                    <div style="width: 450px; min-width: 450px; max-width: 450px; height: 285px; min-height: 285px; max-height: 285px;"
                         class="relative rounded-xl shadow-xl overflow-hidden shrink-0 border border-gray-200 bg-white font-sans">

                        <!-- Custom Background Image -->
                        <img src="{{ asset('images/id.png') }}" alt="Front Background" class="absolute inset-0 w-full h-full object-cover z-0">

                        <!-- SK Watermark -->
                        <div class="absolute inset-0 flex items-center justify-center pointer-events-none z-[5] opacity-[0.15]">
                            <img src="{{ asset('images/sklogo.png') }}" alt="Watermark" class="w-[220px] h-[220px] object-contain rounded-full">
                        </div>

                        <!-- Card Content Container -->
                        <div class="relative z-10 w-full h-full flex flex-col pt-3 px-5 pb-2">

                            <!-- Header -->
                            <div class="flex items-center justify-center gap-3 mb-2 shrink-0 overflow-hidden pr-6">
                                <img src="{{ asset('images/logo.jpg') }}" alt="Logo"
                                     style="width: 45px; height: 45px; min-width: 45px; max-width: 45px;"
                                     class="rounded-full object-cover shadow-sm border border-gray-200">
                                <div class="leading-tight shrink-0 text-center">
                                    <h1 class="text-[17px] font-black text-black uppercase tracking-wide drop-shadow-sm">Sangguniang Kabataan</h1>
                                    <h1 class="text-[14px] font-black text-black uppercase tracking-wide drop-shadow-sm">Brgy. Poblacion Lake Sebu</h1>
                                </div>
                            </div>

                            <!-- Body -->
                            <div class="flex h-full gap-4 mt-1">
                                <!-- Left Column: Photo Box & Signature -->
                                <div style="width: 120px; min-width: 120px; max-width: 120px;" class="flex flex-col items-center shrink-0">

                                    <!-- Photo -->
                                    <div style="width: 115px; height: 120px; min-width: 115px; min-height: 120px;" class="bg-[#d9f99d] rounded-lg overflow-hidden border border-gray-800 shadow-sm">
                                        <img src="{{ asset($skId->id_photo_path) }}" alt="Photo" class="w-full h-full object-cover">
                                    </div>

                                    <!-- New Signature Block Under Photo -->
                                    <div class="w-full flex flex-col items-center mt-3">
                                        <div class="w-[100px] border-b-[1.5px] border-gray-600"></div>
                                        <p class="text-[11px] text-gray-800 font-normal mt-0.5">Signature</p>
                                    </div>

                                </div>

                                <!-- Right Column: Details & QR -->
                                <div class="flex-grow flex flex-col justify-start pl-1">
                                    <!-- Name with gray underline -->
                                    <div class="border-b-[1.5px] border-gray-400 pb-0.5 mb-1.5 w-[95%]">
                                        <h2 class="text-[19px] font-black text-black uppercase leading-none tracking-wide">{{ $skId->first_name }} {{ $skId->last_name }}</h2>
                                    </div>

                                    <div class="flex justify-between items-start w-[95%]">
                                        <!-- Demographics -->
                                        <div class="flex flex-col gap-1">
                                            <div class="leading-none mt-0.5">
                                                <p class="text-[11px] text-gray-800 font-normal mb-0.5">Date of Birth</p>
                                                <p class="text-[12px] font-bold text-black">{{ $skId->dob->format('F d, Y') }}</p>
                                            </div>
                                            <div class="leading-none mt-1">
                                                <p class="text-[11px] text-gray-800 font-normal mb-0.5">Address</p>
                                                <p class="text-[12px] font-bold text-black max-w-[140px] leading-tight">{{ $skId->address }}</p>
                                            </div>
                                            <div class="leading-none mt-1">
                                                <p class="text-[11px] text-gray-800 font-normal mb-0.5">Contact No.</p>
                                                <p class="text-[12px] font-bold text-black">{{ $skId->contact_number }}</p>
                                            </div>
                                            <div class="leading-none mt-1">
                                                <p class="text-[9px] text-gray-800 font-normal mb-0.5">Expire Date</p>
                                                <p class="text-[11px] font-bold text-black">{{ $expireText }}</p>
                                            </div>
                                        </div>

                                        <!-- QR Code & ID Number -->
                                        <div class="shrink-0 flex flex-col items-center justify-start mt-0.5">
                                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&margin=1&data={{ urlencode($idNumber) }}" alt="QR Code" class="w-[85px] h-[85px] bg-white border border-gray-300 p-0.5">
                                            <p class="text-[11px] font-bold text-black mt-1">{{ $idNumber }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ================= BACK CARD ================= -->
                    <div style="width: 450px; min-width: 450px; max-width: 450px; height: 285px; min-height: 285px; max-height: 285px;"
                         class="relative rounded-xl shadow-xl overflow-hidden shrink-0 border border-gray-200 flex flex-col bg-white font-sans">

                        <!-- Custom Background Image -->
                        <img src="{{ asset('images/id.png') }}" alt="Back Background" class="absolute inset-0 w-full h-full object-cover z-0">

                        <!-- SK Watermark -->
                        <div class="absolute inset-0 flex items-center justify-center pointer-events-none z-[5] opacity-[0.15]">
                            <img src="{{ asset('images/sklogo.png') }}" alt="Watermark" class="w-[220px] h-[220px] object-contain rounded-full">
                        </div>

                        <!-- Card Content Container -->
                        <div class="relative z-10 w-full h-full flex flex-col items-center pt-9 pb-6 px-8 text-center">

                            <!-- Emergency Details -->
                            <div class="mb-4">
                                <p class="text-[14px] text-gray-900 font-normal mb-1">Incase of Emergency please contact</p>
                                <h3 class="text-[22px] font-black text-black uppercase leading-none">{{ $skId->emergency_contact_name }}</h3>
                                <p class="text-[17px] text-gray-900 font-normal mt-1 leading-none">{{ $skId->emergency_contact_number }}</p>

                                <!-- Added Emergency Address -->
                                <p class="text-[13px] text-gray-900 font-normal mt-1.5 leading-tight px-4 max-w-[300px] mx-auto">
                                    {{ $skId->emergency_contact_address ?? 'Poblacion, Lake Sebu, South Cotabato' }}
                                </p>
                            </div>

                            <!-- Return Info -->
                            <div class="mb-4">
                                <p class="text-[13px] text-gray-900 font-normal leading-tight">If found please return to:</p>
                                <p class="text-[13px] text-gray-900 font-normal leading-tight">Sangguniang Kabataan Hall</p>
                                <p class="text-[13px] text-gray-900 font-normal leading-tight">Poblacion Lake Sebu South Cotabato</p>
                            </div>

                            <!-- Signature Block -->
                            <div class="absolute bottom-5 w-full flex flex-col items-center">
                                <h3 class="text-[16px] font-black text-black uppercase pb-0.5 px-8 border-b-[1.5px] border-gray-600 inline-block">PRINCESS ANDRES</h3>
                                <p class="text-[13px] text-gray-800 font-normal mt-0.5">SK Chairperson</p>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-8 pt-6 border-t border-gray-100 w-full max-w-md mx-auto space-y-3">
                    <button onclick="window.print()"
                        class="w-full py-3 bg-[#00a651] hover:bg-green-700 text-white font-bold rounded-lg transition-colors flex items-center justify-center gap-2 shadow-sm">
                        <i class="fas fa-download"></i> Save or Print Digital ID
                    </button>

                    {{-- <form action="{{ route('sk_id.replace') }}" method="POST"
                        onsubmit="return confirm('Request a physical replacement? This cannot be undone.');">
                        @csrf
                        <button type="submit"
                            class="w-full py-3 bg-red-50 hover:bg-red-100 text-red-600 border border-red-200 font-bold rounded-lg transition-colors flex items-center justify-center gap-2">
                            <i class="fas fa-exclamation-triangle"></i> Report Lost Physical ID
                        </button>
                    </form> --}}
                </div>
            </div>
        </div>

        <!-- CONDITION 3: No Application or Rejected Status (Application Form) -->
    @else
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
            <div class="mb-8 border-b pb-4">
                <h3 class="text-2xl font-bold text-sk-darkgreen">Official SK ID Application</h3>
                <p class="text-gray-600 mt-1">Fill out this form to claim your official youth passport. All fields are
                    required.</p>
                @if ($skId && $skId->status === 'rejected')
                    <div class="mt-4 p-4 bg-red-50 text-red-700 rounded-lg border border-red-200">
                        <strong><i class="fas fa-times-circle mr-1"></i> Your previous application was rejected:</strong>
                        <p class="mt-1">{{ $skId->remarks }}</p>
                        <p class="mt-2 text-sm">Please correct the issues and submit a new application below.</p>
                    </div>
                @endif
            </div>

            <form action="{{ route('sk_id.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div class="bg-green-50 p-5 rounded-xl border border-green-200 mb-8 shadow-sm">
                    <p class="text-sm text-green-800 font-medium"><i class="fas fa-info-circle mr-2 text-lg align-middle"></i> Your personal details (Name, Address, DOB) will be automatically pulled from your Registration profile for your ID.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-8">
                    <!-- Emergency Contact -->
                    <div class="md:col-span-2">
                        <h4 class="font-black text-gray-900 text-xl mb-2 border-b-2 border-gray-100 pb-3">In Case of Emergency</h4>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-800 mb-2">Contact Person Name</label>
                        <input type="text" name="emergency_contact_name" required
                               class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg shadow-inner focus:bg-white focus:border-sk-green focus:ring-2 focus:ring-sk-green/30 transition-all text-gray-900 font-medium">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-800 mb-2">Emergency Contact Number</label>
                        <input type="text" name="emergency_contact_number" required
                               class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg shadow-inner focus:bg-white focus:border-sk-green focus:ring-2 focus:ring-sk-green/30 transition-all text-gray-900 font-medium">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-gray-800 mb-2">Emergency Contact Address</label>
                        <input type="text" name="emergency_contact_address" placeholder="e.g. Poblacion, Lake Sebu, South Cotabato" required
                               class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg shadow-inner focus:bg-white focus:border-sk-green focus:ring-2 focus:ring-sk-green/30 transition-all text-gray-900 font-medium placeholder-gray-400">
                    </div>

                    <!-- Uploads -->
                    <div class="md:col-span-2 pt-6 border-t border-gray-100 mt-2">
                        <label class="block text-sm font-bold text-gray-800 mb-2">Upload 2x2 ID Picture</label>
                        <p class="text-xs text-gray-500 mb-4 font-medium">Must be a clear photo with a white background. Format: JPG or PNG. Max size: 2MB.</p>

                        <input type="file" name="id_photo" accept="image/jpeg,image/png" required
                               class="w-full text-sm text-gray-700 bg-gray-50 border border-gray-300 rounded-lg shadow-inner p-1.5 cursor-pointer
                                      file:mr-4 file:py-2.5 file:px-5 file:rounded-md file:border-0 file:text-sm file:font-bold file:bg-[#00a651] file:text-white hover:file:bg-green-700 transition-all">
                    </div>
                </div>

                <div class="pt-8 border-t border-gray-100 mt-8 flex justify-end">
                    <button type="submit" class="px-8 py-3.5 bg-[#00a651] hover:bg-green-700 text-white font-black rounded-lg transition-colors shadow-md flex items-center gap-2 text-lg">
                        Submit Application <i class="fas fa-paper-plane ml-1"></i>
                    </button>
                </div>
            </form>
        </div>
    @endif


    <style>
        @media print {

            /* Hide headers, footers, and margins injected by the browser */
            @page {
                margin: 0.5cm;
            }

            /* Hide everything on the page by default */
            body * {
                visibility: hidden;
            }

            /* Make only the ID cards and their contents visible */
            #printable-id-cards,
            #printable-id-cards * {
                visibility: visible;
            }

            /* Position the cards cleanly at the top-left of the paper */
            #printable-id-cards {
                position: absolute;
                left: 0;
                top: 0;
                margin: 0;
                padding: 0;
                width: 100%;
                display: flex !important;
                flex-direction: column !important;
                gap: 20px !important;
                /* Spacing between front and back card */
                align-items: flex-start !important;
            }

            /* Remove shadows and round corners slightly for a cleaner physical print */
            #printable-id-cards>div {
                box-shadow: none !important;
                border: 1px solid #9ca3af !important;
                /* Add a slight gray border for cutting guides */
                border-radius: 8px !important;
                page-break-inside: avoid;
                /* Prevents a card from being split across two pages */
            }

            /* Ensure background colors and images actually print */
            * {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
        }
    </style>
@endsection
