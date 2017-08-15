<?php namespace App\Base;

class Controller extends \Karma\Controller
{
    /**
     * @Inject
     * @var Container
     */
    protected $container;

    /**
     * @return array
     */
    public function getParsedBody()
    {
        if($this->container->request->getParam('postman')){
            $data =  $this->container->request->getQueryParams();
            unset($data['postman']);
            return $data;
        }
        return $this->container->request->getParsedBody();
    }
}