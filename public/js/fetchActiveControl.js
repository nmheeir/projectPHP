function activeUpdate(userId, activeUpdate) {
    // Dữ liệu bạn muốn gửi lên server
    const dataToSend = {
        id: userId,
        active: activeUpdate
    };
    // Sử dụng Fetch API để thực hiện PUT request
    fetch(`http://localhost/Project/TEST_3/User/activeControl`, {
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