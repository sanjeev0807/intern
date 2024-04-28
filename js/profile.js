$(document).ready(function() {
    // Fetch user profile details via AJAX
    $.ajax({
        type: 'GET',
        url: 'profileData.php', // Replace 'profileData.php' with actual backend endpoint
        dataType: 'json', // Expect JSON response from server
        success: function(response) {
            // Check if user data was retrieved successfully
            if (response.success) {
                var userData = response.data; // User data object received from backend

                // Populate user profile details in the HTML
                $('#name').text(userData.firstName + ' ' + userData.lastName);
                $('#email').text(userData.email);
                $('#age').text(calculateAge(userData.dob)); // Calculate age from DOB
                $('#dob').text(userData.dob);
                $('#contact').text(userData.contact);
                
                // Additional profile details can be populated here
            } else {
                // Display error message if user data retrieval failed
                alert('Failed to fetch user profile data.');
            }
        },
        error: function() {
            // Handle AJAX error
            alert('Error occurred while fetching user profile data.');
        }
    });

    // Function to calculate age based on Date of Birth (DOB)
    function calculateAge(dob) {
        var today = new Date();
        var birthDate = new Date(dob);
        var age = today.getFullYear() - birthDate.getFullYear();
        var monthDiff = today.getMonth() - birthDate.getMonth();

        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
            age--; // Subtract 1 year if birthday hasn't occurred yet in current year
        }

        return age;
    }
});
