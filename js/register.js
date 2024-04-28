$(document).ready(function() {
    // Handle form submission on registration
    $('#registrationForm').submit(function(event) {
        event.preventDefault(); // Prevent default form submission

        // Validate password confirmation
        var password = $('#password').val();
        var confirmPassword = $('#confirmPassword').val();
        if (password !== confirmPassword) {
            $('#passwordHelpBlock').text("Passwords do not match!");
            return; // Exit function if passwords do not match
        }

        // If passwords match, prepare data for AJAX request
        var formData = {
            firstName: $('#firstName').val(),
            lastName: $('#lastName').val(),
            dob: $('#dob').val(),
            contact: $('#contact').val(),
            email: $('#email').val(),
            password: password // Use password entered (not confirmed password)
        };

        // Send AJAX POST request to register.php
        $.ajax({
            type: 'POST',
            url: 'register.php', // Replace 'register.php' with actual backend endpoint
            data: formData,
            dataType: 'json', // Expect JSON response from server
            success: function(response) {
                // Handle successful registration response
                if (response.success) {
                    // Redirect to login page after successful registration
                    window.location.href = 'login.html';
                } else {
                    // Display error message if registration failed
                    alert('Registration failed. Please try again.');
                }
            },
            error: function() {
                // Handle AJAX error
                alert('Error occurred while processing registration.');
            }
        });
    });
});
