<?php
namespace DebugTraceModule\DTrace\Plugin;
use Magento\Theme\Block\Html\Footer;
class InjectVariablesIntoBlocks
{
    protected $customerSession;
    protected $_productRepository;
    protected $_product;

    public function __construct(
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Catalog\Model\ProductRepository $productRepository,
        \Magento\Catalog\Model\ProductFactory $topicFactory
    )
    {
        $this->_product = $topicFactory;
        $this->customerSession = $customerSession;
    }
    public function beforeToHtml(Footer $subject)
    {
        if ($subject->getNameInLayout() !== 'absolute_footer') {
            return;
        }
        // $product = $this->_product->create();
        // $productPriceBySku = $product->loadByAttribute('sku', $sku)->getPrice();


        $subject->setTemplate('DebugTraceModule_DTrace::absolute_footer.phtml');
        $subject->assign('customer', $this->customerSession->getCustomer());
       //$subject->assign('product_Factoryy', $productPriceBySku);
    }

} 