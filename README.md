# ArtusFacturación

**ArtusFacturación** es un sistema web integral para la gestión de inventarios, ventas y facturación, diseñado para pequeños y medianos negocios. Ofrece control total sobre productos, proveedores, categorías y usuarios, así como la generación de reportes detallados de ganancias, inversiones y ventas, todo desde una interfaz moderna, intuitiva y responsiva.

---

## Características Destacadas

- **Gestión de Productos:** Alta, baja y modificación de productos, control de stock y categorías.
- **Gestión de Proveedores:** Registro y seguimiento de proveedores y compras asociadas.
- **Ventas y Facturación:** Registro de ventas, generación de facturas y control de historial.
- **Reportes Dinámicos:** Generación de reportes PDF de productos, proveedores, inversiones y ganancias.
- **Gestión de Usuarios y Roles:** Registro y autenticación de usuarios (administrador y cajero).
- **Interfaz UI/UX Moderna:** Basada en Bootstrap, con componentes reutilizables y experiencia de usuario optimizada.
- **Despliegue con Docker:** Implementación rápida y sencilla mediante Docker Compose.
- **Base de Datos MariaDB:** Estructura optimizada y scripts de inicialización incluidos.

---

## Instalación Rápida (Docker)

1. **Clona el repositorio:**

   ```bash
   git clone https://github.com/tuusuario/ArtusFacturacion.git
   cd ArtusFacturacion
   ```

2. **Configura variables si es necesario**  
   (por defecto, usuario root y base de datos `Artus`).

3. **Levanta los servicios:**

   ```bash
   docker-compose up --build
   ```

4. **Accede a la aplicación:**  
   [http://localhost:8080](http://localhost:8080) (o el puerto configurado en tu entorno)

---

## Uso Básico

- **Login:** Accede con tus credenciales.
- **Dashboard:** Visualiza estadísticas y accesos rápidos.
- **Gestión de Productos/Proveedores:** Navega mediante el menú lateral.
- **Ventas:** Registra ventas y genera facturas.
- **Reportes:** Descarga reportes en PDF desde el dashboard o los módulos correspondientes.

---

## Estructura del Proyecto

```
/App
  /Config           # Configuración, rutas y base de datos
  /Controlador      # Lógica de negocio (MVC)
  /Modelo           # Modelos de datos
  /Vista            # Vistas HTML/PHP y componentes
/Public
  /css              # Hojas de estilo
  /img              # Imágenes y logos
  /js               # Scripts JS
  index.php         # Front controller
/bd
  Artus.sql         # Script de base de datos
docker-compose.yml  # Orquestación de contenedores
Dockerfile          # Imagen PHP personalizada
nginx.conf          # Configuración de Nginx
README.md           # Este archivo
```

---

## Base de Datos

- El script `bd/Artus.sql` crea todas las tablas y relaciones necesarias.
- Se carga automáticamente al iniciar el contenedor de base de datos por primera vez.

---

## Personalización

- **Estilos:** Modifica los archivos en `/Public/css/`.
- **Vistas:** Edita o agrega archivos en `/App/Vista/`.
- **Controladores y Modelos:** Añade lógica en `/App/Controlador/` y `/App/Modelo/`.

---

## Contribuciones

Las contribuciones son bienvenidas. Por favor, abre un issue o pull request para sugerencias, mejoras o reportes de bugs.

---

## Licencia

Este proyecto está bajo la licencia MIT.

---

## Autor

Desarrollado por **CodeAdvance**  
Contacto: [eabarros2610@gmail.com]
