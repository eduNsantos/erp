<?php

namespace App\Custom;

use Illuminate\Routing\ResourceRegistrar as OriginalRegistrar;

class ResourceRegistrar extends OriginalRegistrar
{
    // add data to the array
    /**
     * The default actions for a resourceful controller.
     *
     * @var array
     */
    protected $resourceDefaults = ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy', 'exportToExcel'];


    /**
     * Add the data method for a resourceful route.
     *
     * @param  string  $name
     * @param  string  $base
     * @param  string  $controller
     * @param  array   $options
     * @return \Illuminate\Routing\Route
     */
    protected function addResourceExportToExcel($name, $base, $controller, $options)
    {
        $uri = $this->getResourceUri($name).'/exportToExcel';

        $action = $this->getResourceAction($name, $controller, 'exportToExcel', $options);

        return $this->router->get($uri, $action);
    }
}