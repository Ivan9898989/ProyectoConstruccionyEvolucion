# ESCUELA POLITÉCNICA NACIONAL

---

**Integrantes:**

- Castro Rafael
- Oña Brandon
- Simbaña Ivan

---

# Estándares de codificación del Proyecto

## HTML

**1. Indentación y Estructura:**

- Agrupa lógicamente las secciones del documento, como `head`, `body`, y otros elementos.

  Ejemplos:

  ```
  <!DOCTYPE html>
  <html lang="es">
  <head>
    <!-- ... -->
  </head>
  <body>
    <!-- ... -->
  </body>
  </html>
  ```

---
**2. Atributos:**

- Utiliza comillas dobles para los valores de los atributos.
- Usa el atributo alt en las etiquetas <img> para proporcionar descripciones significativas.

  Ejemplo:

  ```
  <img src="imagen.png" alt="Descripción de la imagen">

  ```
---
## CSS

**1. Separación de estilos:**

- Consolida estilos similares para evitar redundancias y facilitar el mantenimiento.
- Considera mover los estilos a un archivo CSS externo para mejorar la organización.

  Ejemplo

  ```
  body {
    font-family: Arial, sans-serif;
    text-align: center;
    margin: 20px;
  }
  ```

---

**2. Comentarios:**

- Incluye comentarios explicativos para secciones importantes del código CSS.
  
  Ejemplo
  ```
  /* Estilos para el cuerpo de la página */
  body {
    /* ... */
  }

  /* Estilos para formularios */
  form {
    /* ... */
  }
  ```
---
## JavaScript

**1. Nomenclatura y Convenciones:**

- Utiliza nombres descriptivos y sigue las convenciones de nomenclatura (camelCase para funciones y clases).
- Agrupa funciones relacionadas y variables al principio del script.

  Ejemplo
  ```
  class Accion {
    // ...
  }

  function 
  agregarAccion() {
    // ...
  }
  ```
  ---

**2. Manejo de Eventos:**

- Prefiere el uso de addEventListener para asociar eventos en lugar de atributos de eventos HTML.

  Ejemplo
  ```
  document.getElementById('miBoton').addEventListener('click', function() 
  {
    // Acciones al hacer clic en el botón
  });
  ```
 ---

**3. Validación y Manejo de Errores:**

- Implementa una validación más detallada según las necesidades del formulario.
- Utiliza try-catch para manejar excepciones.

  Ejemplo

  ```
  function agregarAccion() {
    try {
        // ... Código de validación ...

        // ... Código de agregar acción ...
    } catch (error) {
        console.error('Error:', error.message);
        }
    }
  ```
 ---
