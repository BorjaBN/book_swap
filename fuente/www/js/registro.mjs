//------------------------------------------------------------
// Dependencias
//-----------------------------------------------------------

import * as validaciones from "./validacionesRegistro.mjs";

//------------------------------------------------------------
// Variables y constantes globales
//-----------------------------------------------------------

const ELEMENTO_MENSAJE = $("#mensaje");

const MENSAJES_ERROR = {
    vacio: "No se pueden dejar campos vacíos.",
    nombre: "El nombre solo puede contener letras.",
    apellidos: "Los apellidos solo pueden contener letras.",
    email: "El email debe tener un formato válido (ejemplo@dominio.com).",
     password: "La contraseña debe tener al menos 8 caracteres.",
    ciudad: "La ciudad solo puede contener letras.",
    telefono: "El teléfono debe contener entre 9 y 15 dígitos."
};

//------------------------------------------------------------
// Inicialización
//-----------------------------------------------------------

$(document).ready(function (){

    //Asigna evento Submit al formulario
    const formulario = $("#formulario")
                       .on("submit", onFormularioSubmit);  

    //Asigna el evento para los campos que hay que validar
    const camposValidar = $('#formulario [data-validacion]')
                        .on("focusout", onInputFocusOutValidar);
   
    
});


//------------------------------------------------------------
// Eventos
//-----------------------------------------------------------

/**
 * Evento que se da al enviar el formulario
 * Funcionalidades:
 *  -Comprueba los errores
 *  -Evita el envio si hay errores
 * @param {*} evento 
 */
function onFormularioSubmit(evento){

    //Obtiene los campos que tienen error
    const camposConError = $("#formulario .error");

    //Evita que se envíe el formulario si hay un error y muestra un mensaje
    if (camposConError.length > 0) {
        evento.preventDefault(); 
        ELEMENTO_MENSAJE.text("Hay errores en el formulario.");
    }

}


/**
 *  Evento que se da al poner el foco en los imputs del formulario
 *  Funcionalidades:
 *  - Obtiene las validaciones del campo data-validacion del formulario
 *  - Obtiene el mombre de la función de validación uniendo el prefijo val_
 *    con el nombre de la validación del data-validacion
 *  - Llama a la función, si NO pasa la validación se añade una clase error que aplica un estilo y muestra un mensaje de error personalizado
 *  - Si se CORRIGE el error, se elimina la clase error y se borra el mensaje de error
 * @param {*} evento 
 */
function onInputFocusOutValidar(evento){

    //Obtengo el campo
    const campo = $(evento.target);

    //Obtengo la validación a mostrar como un array de strings
    const listaValidaciones = campo.data("validacion").split(",");
    let errores = 0; //Contador

    for(let n = 0; n < listaValidaciones.length && errores == 0; n++){

        //Obtengo el nombre de la validación 
        const nombreValidacion = listaValidaciones[n];
    
        //Obtengo la función validación 
        const funcionValidacion = validaciones["val_" + nombreValidacion];

        //Variable de control para comprobar si se pasan las validaciones
        let esValido = true;

    
        //Para el resto de validaciones solo se tiene que pasar un parámetro
        esValido = funcionValidacion(campo.val());
       

        //Si no se pasan las validaciones se suman errores y si pasan se limpia el error
        if (!esValido){
            mostrarError(campo, MENSAJES_ERROR[nombreValidacion]);
            errores++;
        } else {
            limpiarError(campo);
        }
    }
}


//------------------------------------------------------------
// Funciones de utilidad
//-----------------------------------------------------------

/**
 * Añade la clase error para aplicar estilo y muestra el mensaje de error específico
 * @param {*} campo 
 * @param {*} mensaje 
 */
function mostrarError(campo, mensaje) {
    campo.addClass("error");
    campo.next(".mensaje-error").text(mensaje);
}


/**
 * Elimina el estilo de error y borra el mensaje de error
 * @param {*} campo 
 */
function limpiarError(campo) {
    campo.removeClass("error");
    campo.next(".mensaje-error").text("");
}

