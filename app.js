//console.log('funcionando');

var formulario = document.getElementById('formulario');
//console.log(nombre);
formulario.addEventListener('submit',function(e){
    e.preventDefault();
    console.log('aea un click');
    var datos = new FormData(formulario);
    /*console.log(datos);
    console.log(datos.get('name'));
    console.log(datos.get('apellidop'));
    console.log(datos.get('apellidom'));
    console.log(datos.get('direccion'));*/
    fetch('reservar.php',{
        method: 'POST',
        mode : 'no-cors',
        body : datos
    })
        .then(res => res.json())
        .then(data => {
            console.log(data)
        })
})