# Mercado-Express

## Descripcion
Mercado Express es una aplicación web inspirada en Mercado Libre. Este proyecto imita algunas de las funciones esenciales de una plataforma de comercio electrónico, siguiendo el patrón de arquitectura MVC y el enfoque Active Record para la gestión de datos.

La aplicación está construida con:

PHP – Lógica de servidor y estructura MVC.

MySQL – Base de datos relacional.

JavaScript – Interactividad en el cliente.

SASS / CSS – Estilos personalizados y responsivos.

HTML – Estructura del contenido web.

## ⚙️ Funcionalidades
- 🗂️ Visualización de productos por categorías.
- 🔎 Filtros por:
  - Nombre del producto
  - Categoría
  - Marca
  - Precio exacto o por rango de precios
- 📄 Paginación de productos para facilitar la navegación.
- 🛒 Carrito de compras con resumen y gestión de productos seleccionados.
- 💳 Procesamiento de pagos mediante **PayPal**.
- 🛍️ Vista de detalle de producto con toda la información releva.
- 📝 Registro de cuenta con validación por **token enviado al correo electrónico**.
- 🔒 Restablecimiento de contraseña a través de **correo electrónico**.
  
 📊 **Dashboard** con:
  - Top 5 productos más vendidos
  - Total de ingresos
  - Total de pedidos realizados

- 🧾 Gestión de pedidos:
  - Listado de pedidos con paginación
  - Vista de detalle por pedido

- 📦 Gestión de stock de productos:
  - Listar stock disponible
  - Crear, actualizar y eliminar stock por producto

- 🛍️ CRUDs con paginación para:
  - Productos
  - Categorías
  - Marcas

## 🛠️ Tecnologías Usadas

### 🧠 Backend
- **PHP**
- **MySQL**
- **Patrón MVC**
- **Active Record**
- **PHPMailer**

### 🎨 Frontend
- **HTML5**
- **SASS**
- **JavaScript**

### 💳 Pasarela de Pago
- **PayPal**

## 📦 Instalación

Sigue estos pasos para ejecutar Mercado Express en tu entorno local:

### 1. Requisitos previos

- PHP 7.4 o superior
- MySQL 5.7 o superior
- Servidor local como:
  - [XAMPP](https://www.apachefriends.org/)
  - [Laragon](https://laragon.org/)
- Composer (opcional, si utilizas dependencias externas como PHPMailer)

---

### 2. Clonar el repositorio

```bash
git clone https://github.com/tu-usuario/mercado-express.git
```
