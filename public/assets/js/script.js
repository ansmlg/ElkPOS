// header home
fetch('./templates/header.html')
    .then(function(response){
        return response.text()
    })
    .then(function(data){
        const header_placeholder = document.getElementById('header-palceholder');
        header_placeholder.innerHTML = data;
    })

// footer home
fetch('./templates/footer.html')
    .then(function(response){
        return response.text()
    })
    .then(function(data){
        const footer_placeholder = document.getElementById('footer-paceholder');
        footer_placeholder.innerHTML = data;
    })

