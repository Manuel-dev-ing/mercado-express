<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\ApiController;
use Controllers\CategoriasController;
use MVC\Router;
use Controllers\DashboardController;
use Controllers\HomeController;
use Controllers\LoginController;
use Controllers\MarcasController;
use Controllers\PedidosController;
use Controllers\ProductosController;
use Controllers\StockProductosController;

$router = new Router();


//Login
$router->get('/login', [LoginController::class, 'Login']);
$router->post('/login', [LoginController::class, 'Login']);

//logout
$router->get('/logout', [LoginController::class, 'Logout']);

//recuperar password
$router->get('/olvide-password', [LoginController::class, 'olvidePassword']);
$router->post('/olvide-password', [LoginController::class, 'olvidePassword']);

$router->get('/recuperar-password', [LoginController::class, 'recuperarPassword']);
$router->post('/recuperar-password', [LoginController::class, 'recuperarPassword']);

//crear cuenta
$router->get('/crear-cuenta', [LoginController::class, 'crearCuenta']);
$router->post('/crear-cuenta', [LoginController::class, 'crearCuenta']);

//confirmar cuenta
$router->get('/confirmar-cuenta', [LoginController::class, 'confirmar']);
$router->get('/mensaje', [LoginController::class, 'mensaje']);

//home
$router->get('/', [HomeController::class, 'index']);

//dashboard
$router->get('/dashboard', [DashboardController::class, 'index']);
$router->get('/dashboard/productos', [ProductosController::class, 'index']);
$router->get('/dashboard/stock', [StockProductosController::class, 'index']);
$router->get('/dashboard/categorias', [CategoriasController::class, 'index']);
$router->get('/dashboard/marcas', [MarcasController::class, 'index']);
$router->get('/dashboard/pedidos', [PedidosController::class, 'index']);

//Controlador Categorias
$router->get('/categorias/crear', [CategoriasController::class, 'crear']);
$router->post('/categorias/crear', [CategoriasController::class, 'crear']);
$router->post('/categorias/eliminar', [CategoriasController::class, 'eliminar']);
$router->get('/categorias/actualizar', [CategoriasController::class, 'actualizar']);
$router->post('/categorias/actualizar', [CategoriasController::class, 'actualizar']);

//Controlador Marcas
$router->get('/marcas/crear', [MarcasController::class, 'crear']);
$router->post('/marcas/crear', [MarcasController::class, 'crear']);
$router->get('/marcas/actualizar', [MarcasController::class, 'actualizar']);
$router->post('/marcas/actualizar', [MarcasController::class, 'actualizar']);
$router->post('/marcas/eliminar', [MarcasController::class, 'eliminar']);

//Controlador Productos
$router->get('/productos/crear', [ProductosController::class, 'crear']);
$router->post('/productos/crear', [ProductosController::class, 'crear']);
$router->get('/productos/actualizar', [ProductosController::class, 'actualizar']);
$router->post('/productos/actualizar', [ProductosController::class, 'actualizar']);
$router->get('/productos/mostrarProductos', [ProductosController::class, 'mostrarProductos']);
$router->get('/productos/detalleProducto', [ProductosController::class, 'mostrarDetalleProducto']);
//carrito
$router->get('/productos/carrito', [ProductosController::class, 'carrito']);
//compra
$router->get('/productos/pago', [ProductosController::class, 'pago']);

//Controlador Stock Productos   
$router->get('/productosStock/crear', [StockProductosController::class, 'crear']);
$router->post('/productosStock/crear', [StockProductosController::class, 'crear']);
$router->get('/productosStock/actualizar', [StockProductosController::class, 'actualizar']);
$router->post('/productosStock/actualizar', [StockProductosController::class, 'actualizar']);
$router->post('/productosStock/eliminar', [StockProductosController::class, 'eliminar']);

//Controlador Pedidos
$router->get('/pedidos/detalle', [PedidosController::class, 'detalle']);


//API 

//-Stock Productos
//consultar productos
$router->post('/api/consultarProducto', [ApiController::class, 'consultar']);
$router->get('/api/obtenerProductos', [ApiController::class, 'obtenerProductos']);

//-Listado Productos
// resultado de la busqueda de productos
$router->post('/api/obtenerResultadosBusqueda', [ApiController::class, 'obtenerResultadosBusqueda']);

//Detalle producto
$router->post('/api/obtenerProductoPorId', [ApiController::class, 'obtenerProductoPorId']);

//-Pedidos
$router->post('/api/guardarPedido', [ApiController::class, 'guardarPedido']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();