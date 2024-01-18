function validateUsername() {
    var username = document.getElementsByName('username')[0].value;
    var usernameError = document.getElementById('usernameError');
    if (username.length < 6) {
        usernameError.innerHTML = 'Username phải có ít nhất 6 kí tự';
    } else {
        usernameError.innerHTML = '';
    }
}

function validatePassword() {
    var password = document.getElementsByName('password')[0].value;
    var passwordError = document.getElementById('passwordError');
    if (password.length < 8) {
        passwordError.innerHTML = 'Mật khẩu phải có ít nhất 8 kí tự';
    } else {
        passwordError.innerHTML = '';
    }
}

function validateConfirmPassword() {
    var password = document.getElementsByName('password')[0].value;
    var confirmPassword = document.getElementsByName('confirm_password')[0].value;
    var confirmPasswordError = document.getElementById('confirmPasswordError');
    if (password !== confirmPassword) {
        confirmPasswordError.innerHTML = 'Mật khẩu không khớp';
    } else {
        confirmPasswordError.innerHTML = '';
    }
}

function validateForm() {
    // Kiểm tra tất cả các trường và trả về true nếu hợp lệ, false nếu không hợp lệ
    validateUsername();
    validatePassword();
    validateConfirmPassword();

    var usernameError = document.getElementById('usernameError').innerHTML;
    var passwordError = document.getElementById('passwordError').innerHTML;
    var confirmPasswordError = document.getElementById('confirmPasswordError').innerHTML;

    if (usernameError || passwordError || confirmPasswordError) {
        return false; // Form không hợp lệ
    }

    return true; // Form hợp lệ
}