<?php
namespace OpenTechiz\Blog\Controller;

Class Router implements \Magento\FrameWork\App\RouterInterface
{
	protected $actionFactory;
	protected $_eventManager;
	protected $_postFactory;
	public function __construct(
		\Magento\FrameWork\App\ActionFactory $actionFactory,
		OpenTechiz\Blog\Model\PostFactory $postFactory,
		)
	{
		$this->$actionFactory = $actionFactory;
		$this->$_pageFactory = $postFactory;
	}

	public function match(\Magento\FrameWork\App\RequestInterface $request)
	{
		$url_key = trim($request->getPathInfo(), '/blog/');
		$url_key = rtrim($url_key, '/');

		$post = $this->_pageFactory->create();
		$post_id = $post->checkUrlKey($url_key);
		if(!$post_id) {
			return null;
		}

		$request->setModuleName('opentech')->setControllerName('view')->setActionName('index')->setParam('post_id', $post_id);
		$request->setAlias(\Magento\FrameWork\Url::REWRITE_REQUEST_PATH_ALIAS, $url_key);
		return $this->actionFactory->create('\Magento\FrameWork\App\Action\Forward');
	}


}