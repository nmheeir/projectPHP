function completedOrderUpdate(orderId, isCompleted) {
    // Dữ liệu bạn muốn gửi lên server
    const dataToSend = {
        id: orderId,
        is_completed: isCompleted == 0 ? 1 : 0,
    };
    // Sử dụng Fetch API để thực hiện PUT request
    fetch(`http://localhost/Project/TEST_3/Order/updateOrder`, {
    method: 'PUT',
    headers: {
        'Content-Type': 'application/json',
    },
    body: JSON.stringify(dataToSend),
    })
    .then(() => {
        location.reload()
    })
    location.reload()
    .catch(error => {
        console.error('Error:', error);
        // Xử lý lỗi (nếu cần)
    });
}