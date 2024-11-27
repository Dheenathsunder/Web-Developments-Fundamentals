function fetchBookInfo() {
    fetch('book.xml')  // Fetch the XML file
        .then(response => response.text())
        .then(data => {
            const parser = new DOMParser();
            const xmlDoc = parser.parseFromString(data, 'application/xml');
            const books = xmlDoc.getElementsByTagName('book');
            const bookInfoDiv = document.getElementById('bookInfo');
            let output = '<h2>Book List</h2>';
            for (let book of books) {
                const title = book.getElementsByTagName('title')[0].textContent;
                const author = book.getElementsByTagName('author')[0].textContent;
                const isbn = book.getElementsByTagName('isbn')[0].textContent;
                const publisher = book.getElementsByTagName('publisher')[0].textContent;
                const edition = book.getElementsByTagName('edition')[0].textContent;
                const price = book.getElementsByTagName('price')[0].textContent;

                output += `
                    <div>
                        <h3>${title}</h3>
                        <p><strong>Author:</strong> ${author}</p>
                        <p><strong>ISBN:</strong> ${isbn}</p>
                        <p><strong>Publisher:</strong> ${publisher}</p>
                        <p><strong>Edition:</strong> ${edition}</p>
                        <p><strong>Price:</strong> ₹${price}</p>
                    </div>
                    <hr>
                `;
            }
            bookInfoDiv.innerHTML = output;
        })
        .catch(error => {
            console.error('Error fetching XML:', error);
        });
}

document.onload = fetchBookInfo();
