/**
 * Valida que el campo esté vacío
 * @param {*} valor 
 * @returns 
 */
export function val_vacio(valor){
    return valor.trim() !== "";
}


// Nombre y apellidos: no vacíos y solo letras
export function val_nombre(valor) {
    return /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/.test(valor.trim()) && valor.trim() !== "";
}

export function val_apellidos(valor) {
    return /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/.test(valor.trim()) && valor.trim() !== "";
}

// Email: formato básico con @ y dominio
export function val_email(valor) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(valor.trim());
}

// Ciudad: no vacía y solo letras
export function val_ciudad(valor) {
    return /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/.test(valor.trim()) && valor.trim() !== "";
}

// Teléfono: solo dígitos, entre 9 y 15 caracteres
export function val_telefono(valor) {
    return /^[0-9]{9,15}$/.test(valor.trim());
}


export function val_password(valor) {
    return valor.trim().length >= 8;
}