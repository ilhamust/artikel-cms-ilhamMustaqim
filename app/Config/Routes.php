<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/detailArtikel/(:any)', 'DetailArtikelController::index/$1');
$routes->post('detailArtikel/addComment/(:num)', 'DetailArtikelController::addComment/$1');

//routers admin dashbord
$routes->get('dashboard', 'Admin\DashboardController::index', ['filter' => 'auth']);
//routers login
$routes->get('login', 'Admin\LoginController::index');
$routes->post('/login', 'Admin\LoginController::authenticate');
//routes logout
$routes->get('/logout', 'Admin\LoginController::logout');
//routes tags
$routes->get('/tags', 'Admin\TagsController::index');
$routes->add('/tags', 'Admin\TagsController::create');
$routes->get('/tags/delete/(:num)', 'Admin\TagsController::delete/$1');
$routes->get('/tags/edit/(:num)', 'Admin\TagsController::edit/$1');
$routes->post('/tags/(:num)', 'Admin\TagsController::update/$1');
//routes categories
$routes->get('/categories', 'Admin\CategoriesController::index');
$routes->add('/categories', 'Admin\CategoriesController::create');
$routes->get('/categories/delete/(:num)', 'Admin\CategoriesController::delete/$1');
$routes->get('/categories/edit/(:num)', 'Admin\CategoriesController::edit/$1');
$routes->post('/categories/update/(:num)', 'Admin\CategoriesController::update/$1');
$routes->get('kategori/(:any)', 'Home::kategori/$1');

//routes posts
$routes->get('/posts', 'Admin\PostsController::index');
$routes->get('/posts/create', 'Admin\PostsController::create', ['filter' => 'auth']);
$routes->post('/posts/store', 'Admin\PostsController::store', ['filter' => 'auth']);
$routes->post('/posts/upload_image', 'Admin\PostsController::upload_image');
$routes->get('/posts/edit/(:num)', 'Admin\PostsController::edit/$1');
$routes->post('/posts/update/(:num)', 'Admin\PostsController::update/$1');
$routes->get('/posts/delete/(:num)', 'Admin\PostsController::delete/$1');
$routes->get('uploads/(:segment)', 'Admin\PostsController::getImage/$1');

//routes slider
$routes->get('/sliders', 'Admin\SlidersController::index');
//routes users
$routes->get('/users', 'Admin\UsersController::index');
$routes->post('/users/store', 'Admin\UsersController::store');
$routes->get('/users/edit/(:num)', 'Admin\UsersController::edit/$1');

$routes->get('/users/delete/(:num)', 'Admin\UsersController::delete/$1'); 
$routes->post('/users/update', 'Admin\UsersController::update');

//routes comments
$routes->get('comments/post/(:num)', 'Admin\CommentsController::commentsByPost/$1');
$routes->get('comments/delete/(:num)', 'Admin\CommentsController::delete/$1');


