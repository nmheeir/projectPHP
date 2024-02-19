const addOrderForm = document.getElementById('addOrderForm');
const searchAddressInput = document.getElementById('searchAddress');
const searchResultsList = document.getElementById('searchResults');
const latitudeInput = document.getElementById('latitude');
const longitudeInput = document.getElementById('longitude');

searchAddressInput.addEventListener('input', debounce(handleSearch, 300));

function debounce(func, delay) {
    let timeoutId;
    return function() {
        clearTimeout(timeoutId);
        timeoutId = setTimeout(func, delay);
    };
}

function handleSearch() {
    const searchTerm = searchAddressInput.value;

    // Gửi yêu cầu HTTP để lấy gợi ý địa chỉ
    fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(searchTerm)}`)
        .then(response => response.json())
        .then(data => {
            displaySearchResults(data);
        })
        .catch(error => console.error('Lỗi:', error));
}

function displaySearchResults(results) {
    searchResultsList.innerHTML = '';

    results.forEach(result => {
        const listItem = document.createElement('li');
        listItem.textContent = result.display_name;
        listItem.addEventListener('click', () => selectSearchResult(result));
        searchResultsList.appendChild(listItem);
    });
}

function selectSearchResult(result) {
    const selectedAddress = result.display_name;
    const selectedCoordinates = { lat: result.lat, lon: result.lon };

    // Cập nhật giá trị của input thành địa chỉ đã chọn
    searchAddressInput.value = selectedAddress;

    // Cập nhật giá trị của input ẩn (latitude và longitude) theo tọa độ đã chọn
    latitudeInput.value = selectedCoordinates.lat;
    longitudeInput.value = selectedCoordinates.lon;

    console.log('Địa chỉ đã chọn:', selectedAddress);
    console.log('Tọa độ đã chọn:', selectedCoordinates);

    searchResultsList.innerHTML = '';
}

