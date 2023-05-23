document.addEventListener('DOMContentLoaded', function(){
    var inputBusqueda = document.getElementById('campo-busqueda');
    var listaCientificos = document.getElementById('lista-cientificos');
    var botonBuscar = document.getElementById('boton-buscar');

    botonBuscar.addEventListener('click', function() {
        var valorBusqueda = inputBusqueda.value.toLowerCase();
        var nombresCientificos = listaCientificos.getElementsByTagName('li');
    
        // Si el campo de búsqueda está vacío, no encuentra nada:
        if (valorBusqueda.trim() === '') {
            console.log('No se ha ingresado ningún término de búsqueda.');
            return;
        }

        // Recorre los científicos y busca cuáles coinciden:
        for (var i = 0; i < nombresCientificos.length; i++) {
            var nombreCientifico = nombresCientificos[i].innerText.toLowerCase();
        
            if (nombreCientifico.includes(valorBusqueda)) {
                nombresCientificos[i].classList.add('encontrado');
            } else {
                nombresCientificos[i].classList.remove('encontrado');
            }
        }
    });
});