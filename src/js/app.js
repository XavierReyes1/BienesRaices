document.addEventListener('DOMContentLoaded',function(){
   EventListeners()
    darkMode()
})

function darkMode(){

    const body = document.querySelector('body')
    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');
    if(prefiereDarkMode.matches){
        document.body.classList.add('dark-mode')
    }
    else{
        document.body.classList.remove('dark-mode')
    }
    prefiereDarkMode.addEventListener('change',function(){
        if(prefiereDarkMode.matches){
            document.body.classList.add('dark-mode')
        }
        else{
            document.body.classList.remove('dark-mode')
        }
    })


    const botonDarkMode = document.querySelector('.dark-mode-boton')
    botonDarkMode.addEventListener('click', function(){
       
        document.body.classList.toggle('dark-mode')
    })
}
function EventListeners(){
    const mobileMenu = document.querySelector('.mobile-menu')
    mobileMenu.addEventListener('click',navegacionReposive)

        //muestra campo condicionales
        const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');
        metodoContacto.forEach(input => input.addEventListener('click', metodoMostrarContacto));
    
     



}
function navegacionReposive(){
    const navegacion = document.querySelector('.navegacion')
    navegacion.classList.toggle('mostrar')
    
}

function metodoMostrarContacto(e){
    const contactoDiv = document.querySelector('#contacto')
    if(e.target.value === 'telefono') {
        contactoDiv.innerHTML = `
            <label for="telefono">Teléfono</label>
            <input type="tel" placeholder="Tu Teléfono" id="telefono"  name="contacto[telefono]" required>

            <label for="fecha">Fecha Llamada:</label>
            <input type="date" id="fecha"  name="contacto[fecha]" required>

            <label for="hora">Hora Llamada:</label>
            <input type="time" id="hora" min="09:00" max="18:00"  name="contacto[hora]" required>

        `;
    } else {
        contactoDiv.innerHTML = `
            <label for="email">E-mail</label>
            <input type="email" placeholder="Tu Email" id="email" name="contacto[email]" required>
        `;
    }
}