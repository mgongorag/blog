/*const formulario = document.getElementById('formulario');


document.getElementById('boton').addEventListener('click', function (evt) {
    evt.preventDefault();
    // this.style.disabled = 'true';
    let datos = new FormData(formulario);
    console.log(datos.get('nombre'));

    fetch('registro.php',{
        method: 'POST',
        
    })
        .then(function(resp){
            console.log('response =', resp);
            return resp.json();
        })
        .then(function(data){
            console.log('data = ', data);
        })
        .catch(function(err){
            console.error(err);
        })

})
