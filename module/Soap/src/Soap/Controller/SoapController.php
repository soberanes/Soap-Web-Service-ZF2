<?php
namespace Soap\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Soap\Client;
use Zend\Soap\Server;
use Zend\Soap\AutoDiscover;
use Zend\View\Model\ViewModel;
use Soapserver\Service\ServiceApi as ServiceApi;

class SoapController extends AbstractActionController
{
    private $_URI;
    private $_WSDL_URI;

	function pre_dump($arg){
		echo "<pre>";var_dump($arg);die;
	}

	function indexAction(){
        ini_set("soap.wsdl_cache_enabled", "0");
        $basePath = $this->getRequest()->getBasePath();
        $autodiscover = new AutoDiscover();
        $autodiscover->setClass('Soap\Service\ServiceApi')
                     ->setUri(
                 'http://'.$_SERVER['SERVER_NAME'].$basePath.'/soapserver/soap')
                     ->setServiceName('ServiceApi');
        $wsdl = $autodiscover->generate();
        $autodiscover->handle();
        return $this->response;
        
        // this is required to strip out the layout, otherwise not nice results!
        // $result = new ViewModel();
        // $result->setTerminal(true);
         
        // return $result;
	}

    public function soapAction(){
        ini_set("soap.wsdl_cache_enabled", "0");
        $basePath = $this->getRequest()->getBasePath();
        $options=array('cache_wsdl' => 0);
        $server = new Server(
           'http://'.$_SERVER['SERVER_NAME'].$basePath.'/soapserver', $options);
        $server->setClass('Soap\Service\ServiceApi');
        $server->setObject(new \Soap\Service\ServiceApi($this->getServiceLocator()->get('db')));
        
        $server->handle();
        return $this->response;
    }

    //Cliente SOAP
    public function clientsoapAction(){
        $options = array('compression' => SOAP_COMPRESSION_ACCEPT,'cache_wsdl' => 0,'soap_version'   => SOAP_1_2);
        $url = 'http://localhost/soap/public/soapserver';
        $client = new Client($url,$options);

        $json_request = '{
                            "username": "psoberanes",
                            "email": "paulsoberanes@gmail.com",
                            "password": "123456",
                            "company": "Navistar",
                            "lastname": "Soberanes",
                            "firstname": "Paul",
                            "phone1": "-",
                            "phone2": "-",
                            "fax": "-",
                            "address_type": "BT",
                            "address1": "la calma",
                            "address2": "-",
                            "city": "zapopan",
                            "state": "10",
                            "country": "155",
                            "zipcode": "45080"
                        }';

        //$result = $client->getProducts(11);
        $result = $client->addEmployee($json_request);

        echo "<pre>";
        var_dump($result);
        return $this->response;
    }

}