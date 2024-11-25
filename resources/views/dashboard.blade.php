<link href="https://api.mapbox.com/mapbox-gl-js/v3.8.0/mapbox-gl.css" rel="stylesheet">
<script src="https://api.mapbox.com/mapbox-gl-js/v3.8.0/mapbox-gl.js"></script>
<style>
  .map-form-container {
      display: flex;
      gap: 20px;
      align-items: flex-start;
  }

  #map {
    width: 50%;
    height: 500px;
  }

  .mapboxgl-popup-content {
      color: black;
      font-family: Arial, sans-serif;
  }

  tbody {
    color: white;
  }

  form {
      width: 50%;
      display: flex;
      flex-direction: column;
      gap: 15px;
  }
</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">                    
                    <div class="map-form-container">                        
                        <div id="map"></div>
                        
                        <form method="POST" action="{{ route('markers.store') }}">
                            @csrf
                            <div>
                                <x-input-label for="place_name" :value="__('Place Name')" />
                                <x-text-input id="place_name" class="block mt-1 w-full" type="text" name="place_name" :value="old('place_name')" required />
                                <x-input-error :messages="$errors->get('place_name')" class="mt-2" />
                            </div>
                            
                            <div>
                                <x-input-label for="detail_address" :value="__('Detail Address')" />
                                <x-text-input id="detail_address" class="block mt-1 w-full" type="text" name="detail_address" :value="old('detail_address')" required />
                                <x-input-error :messages="$errors->get('detail_address')" class="mt-2" />
                            </div>
                            
                            <div>
                                <x-input-label for="description" :value="__('Description')" />
                                <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description')" required />
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>
                            
                            <div class="mb-4">
                                <x-input-label for="latitude" :value="__('Latitude')" />
                                <x-text-input id="latitude" class="block mt-1 w-full" type="text" name="latitude" :value="old('latitude')" required />
                                <x-input-error :messages="$errors->get('latitude')" class="mt-2" />
                            </div>
                            
                            <div>
                                <x-input-label for="longitude" :value="__('Longitude')" />
                                <x-text-input id="longitude" class="block mt-1 w-full" type="text" name="longitude" :value="old('longitude')" required />                                
                                <x-input-error :messages="$errors->get('longitude')" class="mt-2" />
                            </div>
                            
                            <div>
                                <x-input-label for="category" :value="__('Category')" />
                                
                                <div class="flex items-center gap-4">
                                    <label for="food" class="inline-flex items-center">
                                        <input type="radio" id="food" name="category" value="food" class="form-radio" {{ old('category') == 'food' ? 'checked' : '' }}>
                                        <span class="ml-2">Food</span>
                                    </label>
                                    
                                    <label for="school" class="inline-flex items-center">
                                        <input type="radio" id="school" name="category" value="school" class="form-radio" {{ old('category') == 'school' ? 'checked' : '' }}>
                                        <span class="ml-2">School</span>
                                    </label>
                                    
                                    <label for="hotel" class="inline-flex items-center">
                                        <input type="radio" id="hotel" name="category" value="hotel" class="form-radio" {{ old('category') == 'hotel' ? 'checked' : '' }}>
                                        <span class="ml-2">Hotel</span>
                                    </label>
                                    
                                    <label for="hospital" class="inline-flex items-center">
                                        <input type="radio" id="hospital" name="category" value="hospital" class="form-radio" {{ old('category') == 'hospital' ? 'checked' : '' }}>
                                        <span class="ml-2">Hospital</span>
                                    </label>

                                    <label for="other" class="inline-flex items-center">
                                        <input type="radio" id="other" name="category" value="other" class="form-radio" {{ old('category') == 'other' ? 'checked' : '' }}>
                                        <span class="ml-2">Other</span>
                                    </label>
                                </div>

                                <x-input-error :messages="$errors->get('category')" class="mt-2" />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <x-primary-button class="ml-4">
                                    {{ __('Save Marker') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-9" style="padding-bottom:100px">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <form>
                        <div class="flex items-center gap-4">
                            <x-input-label for="category" :value="__('Filter by Category')" />
                            <select id="category" name="category" class="block mt-1 w-1/4" style="color:black;">
                                <option value="">All</option>
                                <option value="food" {{ request('category') == 'food' ? 'selected' : '' }}>Food</option>
                                <option value="school" {{ request('category') == 'school' ? 'selected' : '' }}>School</option>
                                <option value="hotel" {{ request('category') == 'hotel' ? 'selected' : '' }}>Hotel</option>
                                <option value="hospital" {{ request('category') == 'hospital' ? 'selected' : '' }}>Hospital</option>
                            </select>                            
                        </div>
                    </form>
                    <div class="overflow-hidden w-full overflow-x-auto rounded-md border border-neutral-300 dark:border-neutral-700">
                        <table class="w-full text-left text-sm text-neutral-600 dark:text-neutral-300">
                            <thead class="border-b border-neutral-300 bg-neutral-50 text-sm text-neutral-900 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white">
                                <tr>                                    
                                    <th scope="col" class="p-4">Place Name</th>
                                    <th scope="col" class="p-4">Detail Address</th>
                                    <th scope="col" class="p-4">Description</th>
                                    <th scope="col" class="p-4">Latitude</th>
                                    <th scope="col" class="p-4">Longitude</th>
                                    <th scope="col" class="p-4">Category</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-neutral-300 dark:divide-neutral-700">
                            </tbody>
                        </table>
                    </div>                    
                </div>
            </div>
        </div>    
    </div>    
</x-app-layout>

<script>
mapboxgl.accessToken = 'pk.eyJ1IjoibHV0cGkiLCJhIjoiY20zd2c1eDd4MTdqZDJrb25zd3RtOHR2ZyJ9.PNumriWk6d_liFZVU6Z74A';
const map = new mapboxgl.Map({
	container: 'map',
	style: 'mapbox://styles/mapbox/streets-v12',
	center: [107.61861, -6.90389 ],
	zoom: 13,
});

let currentMarkers = [];

function loadMarkers(category = '') {
    currentMarkers.forEach(marker => marker.remove());
    currentMarkers = [];

    const url = category ? `/markers/get?category=${category}` : '/markers/get';
    fetch(url)
        .then(response => response.json())
        .then(data => {
            data.forEach(marker => {
                const customMarker = document.createElement('div');
                customMarker.style.width = '50px';
                customMarker.style.height = '50px';
                customMarker.style.backgroundSize = 'cover';
                customMarker.style.borderRadius = '50%';

                if (marker.category === 'school') {
                    customMarker.style.backgroundImage = 'url(https://cdn-icons-png.flaticon.com/512/5193/5193783.png)';
                } else if (marker.category === 'food') {
                    customMarker.style.backgroundImage = 'url(https://cdn-icons-png.flaticon.com/512/4287/4287725.png)';
                } else if (marker.category === 'hospital') {
                    customMarker.style.backgroundImage = 'url(https://cdn-icons-png.flaticon.com/512/10714/10714002.png)';
                } else if (marker.category === 'hotel') {
                    customMarker.style.backgroundImage = 'url(https://cdn-icons-png.flaticon.com/512/10713/10713991.png)';
                } else {
                    customMarker.style.backgroundImage = 'url(https://cdn-icons-png.flaticon.com/512/9131/9131546.png)';
                }

                const mapMarker = new mapboxgl.Marker(customMarker)
                    .setLngLat([marker.longitude, marker.latitude])
                    .setPopup(new mapboxgl.Popup().setHTML(`
                        <h4><b>Place Name: </b>${marker.place_name}</h4>
                        <p><b>Detail Address: </b>${marker.detail_address}</p>
                        <p><b>Description: </b>${marker.description}</p>
                        <p><b>Latitude: </b>${marker.latitude}</p>
                        <p><b>Longitude: </b>${marker.longitude}</p>
                        <p><b>Category: </b>${marker.category}</p>                        
                    `))
                    .addTo(map);

                currentMarkers.push(mapMarker);
            });
        })
        .catch(error => console.error('Error loading markers:', error));
}

function updateTable(category) {
    const tableBody = document.querySelector('tbody');
    tableBody.innerHTML = ''; // Hapus data sebelumnya

    const url = category ? `/markers/get?category=${category}` : '/markers/get';
    fetch(url)
        .then(response => response.json())
        .then(data => {
            data.forEach(marker => {
                const row = `
                    <tr>
                        <td class="p-4">${marker.place_name}</td>
                        <td class="p-4">${marker.detail_address}</td>
                        <td class="p-4">${marker.description}</td>
                        <td class="p-4">${marker.latitude}</td>
                        <td class="p-4">${marker.longitude}</td>
                        <td class="p-4">${marker.category}</td>
                    </tr>
                `;
                tableBody.innerHTML += row;
            });
        })
        .catch(error => console.error('Error fetching table data:', error));
}

const categoryFilter = document.querySelector('select[name="category"]');
categoryFilter.addEventListener('change', function() {
    const selectedCategory = this.value;
    loadMarkers(selectedCategory);
    updateTable(selectedCategory);
});

// Initial load
document.addEventListener('DOMContentLoaded', () => {
    const selectedCategory = categoryFilter.value;
    loadMarkers(selectedCategory);
    updateTable(selectedCategory);
});
</script>
