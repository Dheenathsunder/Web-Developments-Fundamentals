function fetchUserInfo() {
    const userId = document.getElementById('userId').value;

    // Check if the user ID is valid
    if (userId === "") {
        alert("Please enter a User ID.");
        return;
    }

    fetch('users.xml')  // Fetch the XML file
        .then(response => response.text())
        .then(data => {
            const parser = new DOMParser();
            const xmlDoc = parser.parseFromString(data, "application/xml");

            // Search for the user by ID
            const user = xmlDoc.querySelector(`user[id='${userId}']`);

            // Display user information if found
            if (user) {
                const name = user.querySelector('name').textContent;
                const email = user.querySelector('email').textContent;
                const phone = user.querySelector('phone').textContent;

                const userInfoDiv = document.getElementById('userInfo');
                userInfoDiv.innerHTML = `
                    <h2>User Info:</h2>
                    <p><strong>Name:</strong> ${name}</p>
                    <p><strong>Email:</strong> ${email}</p>
                    <p><strong>Phone:</strong> ${phone}</p>
                `;
            } else {
                alert("User not found!");
            }
        })
        .catch(error => {
            alert("Error fetching the XML file.");
        });
}
