// memuat header dan footer
fetch('./templates/header.html').then(function(response){return response.text()}).then(function(data){const header = document.getElementById('header'); header.innerHTML = data})
fetch('./templates/footer.html')
.then(function(response){
    return response.text();
})
.then(function(data){
    document.getElementById('footer').innerHTML = data;
})


const formLogin = document.getElementById('formLogin');

formLogin.addEventListener('submit', function(event){
    event.preventDefault();

    const input_noid_username = document.getElementById('input_noid_username').value;
    const input_password = document.getElementById('input_password').value;

    const ObjekUntukData = {
        nama: input_noid_username,
        password: input_password
    }

    fetch("api/users.php", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(ObjekUntukData)
    })
    .then(function(responMentah){
        return responMentah.json(); // ubah json menjadi objek js
    })
    .then(function(hasilRespon){
        alert(hasilRespon.pesan);

        if(hasilRespon.status === "sukses"){
            window.location.href = "dashboard.html"
        }
    })
    .catch(function(error){
        console.error("Terjadi Error sistem", error);
    });
})