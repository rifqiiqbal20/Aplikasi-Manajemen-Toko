<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setAutoRoute(true);

$routes->get('/', 'Login::index');
$routes->get('/kategori/hapus/(:any)', 'Kategori::index');
$routes->delete('/kategori/hapus/(:any)', 'Kategori::hapus/$1');
// $routes->get('/kategori', 'Kategori::index');
// $routes->get('/satuan', 'Satuan::index');
$routes->get('/barang/hapus/(:any)', 'barang::index');
$routes->delete('/barang/hapus/(:any)', 'barang::hapus/$1');
