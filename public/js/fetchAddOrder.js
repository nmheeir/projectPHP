function fetchAddOrder() {
    // Sử dụng Fetch API để thực hiện PUT request
    var order = {
        'company_id': document.getElementById('company_id').value,
        'shipper_id': document.getElementById('shipper_id').value,
        'description': document.getElementById('description').value,
        'latitude': document.getElementById('latitude').value,
        'longitude': document.getElementById('longitude').value,
        'address': document.getElementById('searchAddress').value
    };
    fetch(`http://localhost/Project/TEST_3/Order/save`, {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
    },
    body: JSON.stringify(order),
    })
    .then(() => {
        showToast("đã thêm đơn hàng thành công")
    })
    .catch(error => {
        console.error('Error:', error);
        // Xử lý lỗi (nếu cần)
    });
}