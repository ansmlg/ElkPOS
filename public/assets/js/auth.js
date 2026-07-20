const formLogin = document.getElementById('formLogin');

formLogin.addEventListener('submit', function(event){
    event.preventDefault();

    const input_noid_username = document.getElementById('input_noid_username').value;
    const input_password = document.getElementById('input_password').value;

    const ObjekUntukData = {
        nama: input_noid_username,
        password: input_password
    }

    fetch("../api/users.php", {
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
            window.location.href = "../app/index.html"
        }
    })
    .catch(function(error){
        console.error("Terjadi Error sistem", error);
    });
})