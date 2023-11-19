<?php

// list of accessible routes of your application, add every new route here
// key : route to match
// values : 1. controller name
//          2. method name
//          3. (optional) array of query string keys to send as parameter to the method
// e.g route '/item/edit?id=1' will execute $itemController->edit(1)
return [
    '' => ['HomeController', 'index',],
    'items' => ['ItemController', 'index',],
    'items/edit' => ['ItemController', 'edit', ['id']],
    'items/show' => ['ItemController', 'show', ['id']],
    'items/add' => ['ItemController', 'add',],
    'items/delete' => ['ItemController', 'delete',],
    'groupe' => ['GroupeController', 'index',],
    'discographie' => ['DiscographyController', 'index',],
    'actus' => ['ActusController', 'index',],
    'forgotPassword' => ['ForgotPasswordController', 'index',],
    'contact' => ['ContactController', 'index',],
    'concerts' => ['ConcertController', 'index',],
    'goodies' => ['GoodiesController', 'index'],
    'admin/dashboard' => ['DashboardController', 'index',],
    'admin/actusadmin' => ['ActusController', 'indexAdmin',],
    'admin/ActusAdmin/new' => ['ActusController', 'new',],
    'admin/ActusAdmin/edit' => ['ActusController', 'edit', ['id']],
    'admin/ActusAdmin/delete' => ['ActusController', 'delete', ['id']],
    'admin/DiscoAdmin' => ['DiscographyController', 'indexAdmin',],
    'admin/DiscoAdmin/newAlbum' => ['DiscographyController', 'newAlbum',],
    'admin/DiscoAdmin/newSong' => ['DiscographyController', 'newSong',],
    'admin/DiscoAdmin/editAlbum' => ['DiscographyController', 'editAlbum', ['id']],
    'admin/DiscoAdmin/editSong' => ['DiscographyController', 'editSong', ['id']],
    'admin/DiscoAdmin/deleteAlbum' => ['DiscographyController', 'deleteAlbum', ['id']],
    'admin/DiscoAdmin/deleteSong' => ['DiscographyController', 'deleteSong', ['id']],
    'admin/GoodiesAdmin' => ["GoodiesController", 'indexAdmin'],
    'admin/GoodiesAdmin/edit' => ["GoodiesController", 'edit', ['id']],
    'admin/GoodiesAdmin/add' => ["GoodiesController", 'add'],
    'admin/GoodiesAdmin/delete' => ["GoodiesController", 'delete', ['id']],
    'admin/MessagesAdmin' => ["AdminMessagesController" , "index"],
    'admin/MessagesAdmin/delete' => ["AdminMessagesController" , "delete", ['id']],
    'register' => ['RegisterUserController', 'index'],
    'unscribeNewsletter' => ['Component\NewsletterController' , 'unscribeNewsletter'],
    'logout' => ['UserController', 'logout']
];
