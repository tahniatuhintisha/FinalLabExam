document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('registrationForm').addEventListener('submit', function(event) {
        let isValid = true;

        // Clear previous errors
        document.getElementById('nameError').textContent = '';
        document.getElementById('emailError').textContent = '';
        document.getElementById('passwordError').textContent = '';
        document.getElementById('confirmPasswordError').textContent = '';
        document.getElementById('contactError').textContent = '';
        document.getElementById('genderError').textContent = '';
        document.getElementById('emailStatus').textContent = ''; // Reset email status

        // Validate Name
        const name = document.getElementById('name').value.trim();
        if (name === '') {
            document.getElementById('nameError').textContent = 'Name is required.';
            isValid = false;
        }

        // Validate Email
        const email = document.getElementById('email').value.trim();
        if (email === '') {
            document.getElementById('emailError').textContent = 'Email is required.';
            isValid = false;
        } else if (!/\S+@\S+\.\S+/.test(email)) {
            document.getElementById('emailError').textContent = 'Invalid email format.';
            isValid = false;
        } else {
            // Use AJAX to check if the email exists in the database
            var xhttp = new XMLHttpRequest();
            xhttp.open("GET", "../Controller/RegistrationController.php?email=" + encodeURIComponent(email), true);
            
            xhttp.onload = function() {
                if (xhttp.status === 200) {
                    var response = JSON.parse(xhttp.responseText);
                    if (response.exists) {
                        document.getElementById("emailError").textContent = 'Email already exists!';
                        isValid = false;
                    }
                }
            };
            xhttp.send();
        }

        // Validate Password
        const password = document.getElementById('password').value;
        if (password === '') {
            document.getElementById('passwordError').textContent = 'Password is required.';
            isValid = false;
        }

        // Validate Confirm Password
        const confirmPassword = document.getElementById('confirm_password').value;
        if (confirmPassword === '') {
            document.getElementById('confirmPasswordError').textContent = 'Please confirm your password.';
            isValid = false;
        } else if (password !== confirmPassword) {
            document.getElementById('confirmPasswordError').textContent = 'Passwords do not match.';
            isValid = false;
        }

        // Validate Contact Number
        const contact = document.getElementById('contact').value;
        if (contact === '') {
            document.getElementById('contactError').textContent = 'Contact number is required.';
            isValid = false;
        } else if (!/^\d{1,13}$/.test(contact)) {
            document.getElementById('contactError').textContent = 'Contact number must be less than 14 digits.';
            isValid = false;
        }

        // Validate Gender
        const gender = document.querySelector('input[name="gender"]:checked');
        if (!gender) {
            document.getElementById('genderError').textContent = 'Gender is required.';
            isValid = false;
        }

        // Prevent form submission if there are validation errors
        if (!isValid) {
            event.preventDefault();
        }
        // Check if the old password is correct (on Change Password page)
    document.getElementById('oldPassword').addEventListener('blur', function() {
        const oldPassword = this.value.trim();
        
        if (oldPassword === '') {
            document.getElementById('oldPasswordError').textContent = 'Old password is required.';
            return;
        }
        
        // Send AJAX request to check old password
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'ChangePasswordController.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (!response.correct) {
                    document.getElementById('oldPasswordError').textContent = 'Old password is incorrect!';
                } else {
                    document.getElementById('oldPasswordError').textContent = '';
                }
            }
        };
        xhr.send('oldPassword=' + encodeURIComponent(oldPassword));
    });

    // Update Profile via AJAX POST request
    document.getElementById('updateProfileForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission
        
        const formData = new FormData(this); // Collect all form data

        // Send AJAX request to update the profile
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'UpdateProfileController.php', true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.success) {
                    alert('Profile updated successfully!');
                } else {
                    alert('Profile update failed!');
                }
            }
        };
        xhr.send(formData);
    });
});
