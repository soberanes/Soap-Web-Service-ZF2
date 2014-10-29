<?php
namespace Soap\Service;

use Zend\Db\Adapter\Adapter;

class ServiceApi
{
    private static $adapter;
    
    public function __construct(Adapter $adapter) {
        self::$adapter = $adapter;
    }

    /**
     * Retorna una lista de productos
     *
     * @param String $limit
     * @return Array
     */
    public function getProducts($limit){
    	$p = array(
            'title'     => 'Spinning Top',
            'shortdesc' => 'Hours of fun await with this colorful spinning top. Includes flashing colored lights.',
            'price'     => '3.99',
            'quantity'  => $limit
        );
        return $p;
    }
    
    /**
     * Guarda un empleado
     *
     * @param String $json_request
     * @return Int
     */
    public static function addEmployee($json_request){
        $plugin = new \Soap\Controller\Plugin\NavistarPlugin(self::$adapter);
        $employee = json_decode($json_request);
        
        $response = $plugin->saveEmployee($employee);

        return $response;
    }

    /**
     * Retorna hola mundo
     * 
     * @return string
     */
    public static function getHola(){
        return 'hola mundo';
    }

}