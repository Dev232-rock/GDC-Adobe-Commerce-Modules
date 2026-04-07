<?php

namespace Vendor\CustomRouter\Router;

use Magento\Framework\App\ActionFactory;
use Magento\Framework\App\Request\Http as HttpRequest;
use Magento\Framework\App\RouterInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\App\Action\Forward;

class CustomRouter implements RouterInterface
{
    protected $actionFactory;
    protected $response;

    /**
     * CustomRouter constructor.
     * 
     * @param ActionFactory $actionFactory
     * @param ResponseInterface $response
     */
    public function __construct(
        ActionFactory $actionFactory,
        ResponseInterface $response
    ) {
        $this->actionFactory = $actionFactory;
        $this->response = $response;
    }

    /**
     * Match the custom route
     *
     * @param HttpRequest $request
     * @return \Magento\Framework\App\ActionInterface|null
     */
    public function match(\Magento\Framework\App\RequestInterface $request)
    {
        $identifier = trim($request->getPathInfo(), '/');

        // Example: redirect /mycustomurl to /custom/index/index
        if ($identifier === 'mycustomurl') {
            // Set the module, controller, and action names for the route
            $request->setModuleName('custom');
            $request->setControllerName('index');
            $request->setActionName('index');

            // Return an instance of the Forward action, as expected by Magento's RouterInterface
            return $this->actionFactory->create(Forward::class);
        }

        return null; // Let other routers handle the request
    }
}