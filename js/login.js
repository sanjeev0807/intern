$(document).ready(function() {
    // Handle form submission on login
    $('#loginForm').submit(function(event) {
        event.preventDefault(); // Prevent default form submission

        // Get login credentials from form inputs
        var email = $('#email').val();
        var password = $('#password').val();

        // Prepare data for AJAX request
        var formData = {
            email: email,
            password: password
        };

        // Send AJAX POST request to login.php (or equivalent backend endpoint)
        $.ajax({
            type: 'POST',
            url: 'php/login.php', // Adjust path to actual backend endpoint
            data: formData,
            dataType: 'json', // Expect JSON response from server
            success: function(response) {
                // Handle successful login response
                if (response.success) {
                    // Redirect to profile page after successful login
                    window.location.href = 'profile.html';
                } else {
                    // Display error message if login failed
                    $('#loginMessage').text('Invalid email or password. Please try again.');
                }
            },
            error: function() {
                // Handle AJAX error
                $('#loginMessage').text('Error occurred while processing login. Please try again.');
            }
        });
    });
});
