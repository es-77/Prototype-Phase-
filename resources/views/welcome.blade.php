<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Service Manager (VServiceDB)</title>
    <!-- load vite styles and scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body {
            /* Task 3: add background picture here */
            background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('{{ asset("images/background.png") }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
    </style>
</head>
<body class="min-h-screen text-gray-900 font-sans p-4 md:p-8">
    <div class="max-w-7xl mx-auto">
        
        <!-- Header -->
        <header class="bg-white/90 rounded-lg p-6 mb-8 text-center shadow border border-gray-200">
            <h1 class="text-3xl font-bold text-gray-800">Vehicle Service Management System</h1>
            <p class="text-gray-600 mt-1">Prototype Phase - Database: VServiceDB</p>
        </header>

        <!-- Notification Alerts -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 shadow">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6 shadow">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6 shadow">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Forms Grid (4 Forms CRUD) -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            
            <!-- FORM 1: Create (Add Record) -->
            <div class="bg-white/95 rounded-lg p-6 shadow border border-gray-200">
                <h2 class="text-xl font-semibold mb-4 text-blue-800 border-b pb-2">Form 1: Add New Vehicle Service (Create)</h2>
                
                <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Service Name</label>
                        <input type="text" name="ServiceName" required value="{{ old('ServiceName') }}" placeholder="e.g. Oil Change" class="mt-1 block w-full rounded border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Vehicle Model</label>
                        <input type="text" name="VehicleModel" required value="{{ old('VehicleModel') }}" placeholder="e.g. Toyota Corolla 2022" class="mt-1 block w-full rounded border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Service Type</label>
                        <select name="ServiceType" required class="mt-1 block w-full rounded border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
                            <option value="">-- Select Type --</option>
                            <option value="Routine Maintenance" {{ old('ServiceType') == 'Routine Maintenance' ? 'selected' : '' }}>Routine Maintenance</option>
                            <option value="Repair" {{ old('ServiceType') == 'Repair' ? 'selected' : '' }}>Repair</option>
                            <option value="Inspection" {{ old('ServiceType') == 'Inspection' ? 'selected' : '' }}>Inspection</option>
                            <option value="Detailing" {{ old('ServiceType') == 'Detailing' ? 'selected' : '' }}>Detailing</option>
                            <option value="Tuning" {{ old('ServiceType') == 'Tuning' ? 'selected' : '' }}>Tuning</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Service Amount ($)</label>
                        <input type="number" name="ServiceAmount" step="0.01" min="0" required value="{{ old('ServiceAmount') }}" placeholder="0.00" class="mt-1 block w-full rounded border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Picture (Upload Image)</label>
                        <input type="file" name="Picture" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>

                    <div class="flex gap-4 pt-2">
                        <button type="submit" class="flex-1 bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded text-sm transition">
                            Add Service Record
                        </button>
                        <button type="reset" class="bg-gray-400 hover:bg-gray-500 text-white font-medium py-2 px-4 rounded text-sm transition">
                            Reset
                        </button>
                    </div>
                </form>
            </div>

            <!-- FORM 2: Search (Read) -->
            <div class="bg-white/95 rounded-lg p-6 shadow border border-gray-200">
                <h2 class="text-xl font-semibold mb-4 text-blue-800 border-b pb-2">Form 2: Search / View Service (Read)</h2>
                
                <form action="{{ route('services.index') }}" method="GET" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Enter Service ID to Search</label>
                        <div class="mt-1 flex gap-2">
                            <input type="number" name="search_id" id="search_service_id" required value="{{ request('search_id') }}" placeholder="e.g. 1" class="block w-full rounded border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded text-sm transition whitespace-nowrap">
                                Search Record
                            </button>
                        </div>
                    </div>

                    <div class="flex pt-2">
                        <a href="{{ route('services.index') }}" class="flex-1 text-center bg-gray-400 hover:bg-gray-500 text-white font-medium py-2 px-4 rounded text-sm transition">
                            Reset Search
                        </a>
                    </div>
                </form>

                <!-- Search Results Display -->
                <div id="search_results_container" class="{{ $searchPerformed ? '' : 'hidden' }} mt-6 p-4 border border-gray-300 rounded bg-gray-50">
                    <h3 class="font-semibold text-gray-800 mb-2 border-b pb-1">Search Result:</h3>
                    
                    <div id="search_result_found" class="{{ ($searchPerformed && $searchedService) ? '' : 'hidden' }} flex flex-col sm:flex-row gap-4">
                        <div class="w-full sm:w-1/3">
                            <div id="search_pic_container">
                                @if($searchPerformed && $searchedService && $searchedService->Picture)
                                    <img id="search_pic" src="{{ asset($searchedService->Picture) }}" alt="Service Picture" class="w-full h-auto rounded border shadow-sm max-h-32 object-cover">
                                    <div id="search_no_pic" class="w-full h-24 bg-gray-200 border rounded flex items-center justify-center text-xs text-gray-500 hidden">
                                        No Picture
                                    </div>
                                @else
                                    <img id="search_pic" src="" alt="Service Picture" class="w-full h-auto rounded border shadow-sm max-h-32 object-cover hidden">
                                    <div id="search_no_pic" class="w-full h-24 bg-gray-200 border rounded flex items-center justify-center text-xs text-gray-500">
                                        No Picture
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="w-full sm:w-2/3 space-y-1 text-sm text-gray-700">
                            <p><strong>Service ID:</strong> <span id="search_display_id">{{ $searchPerformed && $searchedService ? $searchedService->ServiceId : '' }}</span></p>
                            <p><strong>Service Name:</strong> <span id="search_display_name">{{ $searchPerformed && $searchedService ? $searchedService->ServiceName : '' }}</span></p>
                            <p><strong>Vehicle Model:</strong> <span id="search_display_model">{{ $searchPerformed && $searchedService ? $searchedService->VehicleModel : '' }}</span></p>
                            <p><strong>Service Type:</strong> <span id="search_display_type">{{ $searchPerformed && $searchedService ? $searchedService->ServiceType : '' }}</span></p>
                            <p><strong>Service Amount:</strong> $<span id="search_display_amount">{{ $searchPerformed && $searchedService ? number_format($searchedService->ServiceAmount, 2) : '' }}</span></p>
                        </div>
                    </div>
                    
                    <div id="search_result_not_found" class="{{ ($searchPerformed && !$searchedService) ? '' : 'hidden' }} text-red-600 text-sm">
                        No service record was found with ID: <strong id="search_display_not_found_id">{{ request('search_id') }}</strong>
                    </div>
                </div>
            </div>

            <!-- FORM 3: Update (Edit Record) -->
            <div class="bg-white/95 rounded-lg p-6 shadow border border-gray-200">
                <h2 class="text-xl font-semibold mb-4 text-blue-800 border-b pb-2">Form 3: Update Service Record (Update)</h2>
                
                <form action="{{ route('services.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Service ID to Update (Mandatory)</label>
                        <input type="number" name="ServiceId" id="update_service_id" required placeholder="Select from list below or enter ID" class="mt-1 block w-full rounded border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">New Service Name</label>
                        <input type="text" name="ServiceName" id="update_service_name" required placeholder="ServiceName" class="mt-1 block w-full rounded border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">New Vehicle Model</label>
                        <input type="text" name="VehicleModel" id="update_vehicle_model" required placeholder="VehicleModel" class="mt-1 block w-full rounded border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">New Service Type</label>
                        <select name="ServiceType" id="update_service_type" required class="mt-1 block w-full rounded border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
                            <option value="">-- Select Type --</option>
                            <option value="Routine Maintenance">Routine Maintenance</option>
                            <option value="Repair">Repair</option>
                            <option value="Inspection">Inspection</option>
                            <option value="Detailing">Detailing</option>
                            <option value="Tuning">Tuning</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">New Service Amount ($)</label>
                        <input type="number" name="ServiceAmount" id="update_service_amount" step="0.01" min="0" required placeholder="0.00" class="mt-1 block w-full rounded border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">New Picture (Leave blank to keep current)</label>
                        <input type="file" name="Picture" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>

                    <div class="flex gap-4 pt-2">
                        <button type="submit" class="flex-1 bg-amber-500 hover:bg-amber-600 text-white font-medium py-2 px-4 rounded text-sm transition">
                            Update Service Record
                        </button>
                        <button type="reset" class="bg-gray-400 hover:bg-gray-500 text-white font-medium py-2 px-4 rounded text-sm transition">
                            Reset
                        </button>
                    </div>
                </form>
            </div>

            <!-- FORM 4: Delete (Remove Record) -->
            <div class="bg-white/95 rounded-lg p-6 shadow border border-gray-200 flex flex-col justify-between">
                <div>
                    <h2 class="text-xl font-semibold mb-4 text-blue-800 border-b pb-2">Form 4: Delete Service Record (Delete)</h2>
                    
                    <form id="deleteForm" action="{{ route('services.destroy') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Service ID to Delete</label>
                            <input type="number" name="ServiceId" id="delete_service_id" required placeholder="Select from list below or enter ID" class="mt-1 block w-full rounded border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
                        </div>

                        <p class="text-xs text-red-500 italic mt-2">Warning: Delete action is permanent and cannot be undone.</p>

                        <div class="flex gap-4 pt-6">
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this record?')" class="flex-1 bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded text-sm transition">
                                Delete Service Record
                            </button>
                            <button type="reset" class="bg-gray-400 hover:bg-gray-500 text-white font-medium py-2 px-4 rounded text-sm transition">
                                Reset
                            </button>
                        </div>
                    </form>
                </div>
                
                <div class="mt-8 p-4 border border-dashed border-gray-300 rounded bg-gray-50 text-xs text-gray-600">
                    <span class="font-bold">Quick Guide:</span> You can type in the ID manually or simply click the "Select" button on any record in the table below to load its details into both the <strong>Update</strong> and <strong>Delete</strong> forms automatically!
                </div>
            </div>

        </div>

        <!-- Database Records Table -->
        <div class="bg-white/95 rounded-lg p-6 shadow border border-gray-200">
            <h2 class="text-2xl font-bold mb-4 text-gray-800 border-b pb-2">All Vehicle Service Records in VServiceDB</h2>
            
            @if($services->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-left text-sm">
                        <thead class="bg-gray-100 text-gray-700 uppercase font-semibold text-xs">
                            <tr>
                                <th class="px-6 py-3 border-b">Service ID</th>
                                <th class="px-6 py-3 border-b">Picture</th>
                                <th class="px-6 py-3 border-b">Service Name</th>
                                <th class="px-6 py-3 border-b">Vehicle Model</th>
                                <th class="px-6 py-3 border-b">Service Type</th>
                                <th class="px-6 py-3 border-b">Service Amount</th>
                                <th class="px-6 py-3 border-b text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 text-gray-700">
                            @foreach($services as $service)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 font-bold text-gray-900">#{{ $service->ServiceId }}</td>
                                    <td class="px-6 py-4">
                                        @if($service->Picture)
                                            <img src="{{ asset($service->Picture) }}" alt="Preview" class="w-12 h-12 rounded object-cover border">
                                        @else
                                            <span class="text-xs text-gray-400">No Image</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 font-medium">{{ $service->ServiceName }}</td>
                                    <td class="px-6 py-4">{{ $service->VehicleModel }}</td>
                                    <td class="px-6 py-4">
                                        <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">
                                            {{ $service->ServiceType }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 font-semibold">${{ number_format($service->ServiceAmount, 2) }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <button onclick='loadServiceDetails({{ json_encode($service) }})' class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-1 px-3 rounded text-xs transition">
                                            Select
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-8 text-gray-500 italic">
                    No vehicle service records found. Use Form 1 above to add the first record!
                </div>
            @endif
        </div>

    </div>

    <!-- JS script to fill update/delete forms when selecting record -->
    <script>
        function loadServiceDetails(service) {
            // fill up field of search form (Form 2)
            const searchServiceIdInput = document.getElementById('search_service_id');
            if (searchServiceIdInput) {
                searchServiceIdInput.value = service.ServiceId;
            }

            // fill up and show details in search result display box of Form 2
            const searchContainer = document.getElementById('search_results_container');
            const searchResultFound = document.getElementById('search_result_found');
            const searchResultNotFound = document.getElementById('search_result_not_found');

            if (searchContainer) searchContainer.classList.remove('hidden');
            if (searchResultFound) searchResultFound.classList.remove('hidden');
            if (searchResultNotFound) searchResultNotFound.classList.add('hidden');

            const displayId = document.getElementById('search_display_id');
            const displayName = document.getElementById('search_display_name');
            const displayModel = document.getElementById('search_display_model');
            const displayType = document.getElementById('search_display_type');
            const displayAmount = document.getElementById('search_display_amount');

            if (displayId) displayId.textContent = service.ServiceId;
            if (displayName) displayName.textContent = service.ServiceName;
            if (displayModel) displayModel.textContent = service.VehicleModel;
            if (displayType) displayType.textContent = service.ServiceType;
            if (displayAmount) displayAmount.textContent = parseFloat(service.ServiceAmount).toFixed(2);

            // handle picture preview in Form 2
            const searchPic = document.getElementById('search_pic');
            const searchNoPic = document.getElementById('search_no_pic');
            if (searchPic && searchNoPic) {
                if (service.Picture) {
                    searchPic.src = '/' + service.Picture;
                    searchPic.classList.remove('hidden');
                    searchNoPic.classList.add('hidden');
                } else {
                    searchPic.src = '';
                    searchPic.classList.add('hidden');
                    searchNoPic.classList.remove('hidden');
                }
            }

            // fill up fields of update form
            document.getElementById('update_service_id').value = service.ServiceId;
            document.getElementById('update_service_name').value = service.ServiceName;
            document.getElementById('update_vehicle_model').value = service.VehicleModel;
            document.getElementById('update_service_type').value = service.ServiceType;
            document.getElementById('update_service_amount').value = service.ServiceAmount;

            // fill up field of delete form
            document.getElementById('delete_service_id').value = service.ServiceId;

            // scroll to forms section smoothly
            window.scrollTo({
                top: 250,
                behavior: 'smooth'
            });
        }
    </script>
</body>
</html>
