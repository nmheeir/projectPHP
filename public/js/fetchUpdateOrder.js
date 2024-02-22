
function completedOrderUpdate(orderId, isCompleted) {
    // Dữ liệu bạn muốn gửi lên server
    const dataToSend = {
        id: orderId,
        is_completed: isCompleted == 0 ? 1 : 0,
        completed_at: new Date().toISOString().slice(0, 19).replace('T', ' ')
    };
    // Sử dụng Fetch API để thực hiện PUT request
    fetch(`http://localhost/Project/TEST_3/Order/save`, {
    method: 'PUT',
    headers: {
        'Content-Type': 'application/json',
    },
    body: JSON.stringify(dataToSend),
    })
    .then(() => {
        location.reload()
    })
    .catch(error => {
        console.error('Error:', error);
        // Xử lý lỗi (nếu cần)
    });
}

function updateOrder() {
    // Dữ liệu bạn muốn gửi lên server
    let dataToSend = {
        'company_id': document.getElementById('company_id').value,
        'shipper_id': document.getElementById('shipper_id').value,
        'description': document.getElementById('description').value,
        'latitude': document.getElementById('latitude').value,
        'longitude': document.getElementById('longitude').value,
        'address': document.getElementById('searchAddress').value
    };
    if(document.getElementById('orderId')) {
        dataToSend["id"] = document.getElementById('orderId').value
    }
    console.log(dataToSend)
    // Sử dụng Fetch API để thực hiện PUT request
    fetch(`http://localhost/Project/TEST_3/Order/save`, {
    method: 'PUT',
    headers: {
        'Content-Type': 'application/json',
    },
    body: JSON.stringify(dataToSend),
    })
    .then(() => {
        showToast("đã cập nhật đơn hàng thành công");
    })
    .catch(error => {
        console.error('Error:', error);
        // Xử lý lỗi (nếu cần)
    });
}