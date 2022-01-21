<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/extrafield'], function (Router $router) {
    $router->bind('extrafield', function ($id) {
        return app('Modules\Extrafield\Repositories\ExtrafieldRepository')->find($id);
    });
    $router->get('extrafields', [
        'as' => 'admin.extrafield.extrafield.index',
        'uses' => 'ExtrafieldController@index',
        'middleware' => 'can:extrafield.extrafields.index'
    ]);
    $router->get('extrafields/create', [
        'as' => 'admin.extrafield.extrafield.create',
        'uses' => 'ExtrafieldController@create',
        'middleware' => 'can:extrafield.extrafields.create'
    ]);
    $router->post('extrafields', [
        'as' => 'admin.extrafield.extrafield.store',
        'uses' => 'ExtrafieldController@store',
        'middleware' => 'can:extrafield.extrafields.create'
    ]);
    $router->get('extrafields/{extrafield}/edit', [
        'as' => 'admin.extrafield.extrafield.edit',
        'uses' => 'ExtrafieldController@edit',
        'middleware' => 'can:extrafield.extrafields.edit'
    ]);
    $router->put('extrafields/{extrafield}', [
        'as' => 'admin.extrafield.extrafield.update',
        'uses' => 'ExtrafieldController@update',
        'middleware' => 'can:extrafield.extrafields.edit'
    ]);
    $router->delete('extrafields/{extrafield}', [
        'as' => 'admin.extrafield.extrafield.destroy',
        'uses' => 'ExtrafieldController@destroy',
        'middleware' => 'can:extrafield.extrafields.destroy'
    ]);
// append

});
