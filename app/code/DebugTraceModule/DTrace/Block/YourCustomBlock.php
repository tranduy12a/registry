<?php
namespace DebugTraceModule\DTrace\Block;
 
class YourCustomBlock extends \Magento\Framework\View\Element\Template
{ 
    protected $_productRepository;
	protected $_product;
  
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context, 
        \Magento\Catalog\Model\ProductRepository $productRepository,
		\Magento\Catalog\Model\ProductFactory $topicFactory,
        array $data = []
    ) {
		$this->productFactory = $productFactory;
        $this->_productRepository = $productRepository;
        parent::__construct($context, $data);
    }
  
    public function getProductById($id) {
        return $this->_productRepository->getById($id);
    }
  
    public function getProductBySku($sku) {
        return $this->_productRepository->get($sku);
    }

	public function getPriceById($id)
	{
	    //$id = '21'; //Product ID
	    $product = $this->_product->create();
	    $productPriceById = $product->load($id)->getPrice();
	    return $productPriceById;
	}

	public function getPriceBySku($sku)
	{   
	    //$sku = 'testing'; //Product sku
	    $product = $this->_product->create();
	    $productPriceBySku = $product->loadByAttribute('sku', $sku)->getPrice();
	    var_dump($productPriceBySku);die;
	    return $productPriceBySku;
	}
}