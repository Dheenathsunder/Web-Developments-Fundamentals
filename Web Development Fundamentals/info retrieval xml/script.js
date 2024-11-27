function fetchUserInfo() {
    const userId = document.getElementById('userId').value.trim(); // Get user input

    // Check if the user has entered a valid ID
    if (!userId) {
        alert("Please enter a User ID.");
        return;
    }

    // Fetch the XML file
    fetch('users.xml')
        .then(response => response.text())
        .then(data => {
            const parser = new DOMParser();
            const xmlDoc = parser.parseFromString(data, 'application/xml');
            
            // Search for the user by the entered ID
            const user = xmlDoc.querySelector(`user[id='${userId}']`);
            
            // Display the user information if found
            if (user) {
                const name = user.querySelector('name').textContent;
                const email = user.querySelector('email').textContent;
                const phone = user.querySelector('phone').textContent;

                // Update the HTML to display the user's info
                document.getElementById('userInfo').innerHTML = `
                    <h2>User Information:</h2>
                    <p><strong>Name:</strong> ${name}</p>
                    <p><strong>Email:</strong> ${email}</p>
                    <p><strong>Phone:</strong> ${phone}</p>
                `;
            } else {
                alert("User not found!");
            }
        })
        .catch(error => {
            console.error('Error fetching XML:', error);
            alert("Error fetching the user data.");
        });
}
