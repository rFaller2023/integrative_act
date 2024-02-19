const button = document.getElementById('submit');

button.addEventListener("click", () => {
    let role = document.getElementById('role').value;
    let name = document.getElementById('name').value;
    let email = document.getElementById('email').value;

    const data = {
        role: role,
        name: name,
        email: email,
    };

    fetch('http://localhost/assign/create.php', {
        method: "POST",
        headers: {
            "Content-Type": "application/json; charset=UTF-8",
        },
        body: JSON.stringify(data),
    })
    .then((res) => res.json())
    .then(response => {
        console.log(response);
        fetchAndDisplay();
    });

});

    function fetchAndDisplay() {
        fetch('http://localhost/assign/display.php')
        .then(response => response.json())
        .then(data => {
            let tableBody = document.getElementById('tableBody');

            tableBody.innerHTML = '';

            for(let i = 0; i < data.length; i++){
                let tableRow = `<tr>
                              <td>${data[i].id}</td>
                              <td>${data[i].role}</td>
                              <td>${data[i].name}</td>
                              <td>${data[i].email}</td>
                            </tr>`;
                tableBody.innerHTML += tableRow;
            }
        })
        .catch(error => console.error('error!', error));
    }
    fetchAndDisplay();