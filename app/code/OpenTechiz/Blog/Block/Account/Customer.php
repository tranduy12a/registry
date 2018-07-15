<?php
namespace OpenTechiz\Blog\Block\Account;
use OpenTechiz\Blog\Api\Data\NotificationInterface;
use OpenTechiz\Blog\Model\ResourceModel\Notification\Collection as NotificationCollection;
class Customer extends \Magento\Framework\View\Element\Template
{
  
    protected $customerSession;
    protected $_notiFactory;
    protected $_notiCollectionFactory;
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Model\Session $customerSession,
        \OpenTechiz\Blog\Model\ResourceModel\Notification\CollectionFactory $notiCollectionFactory,
        \OpenTechiz\Blog\Model\NotificationFactory $notiFactory,
        array $data = [])
    {
        parent::__construct($context, $data);
        $this->customerSession = $customerSession;
        $this->_notiCollectionFactory = $notiCollectionFactory;
        $this->_notiFactory = $notiFactory;
    }
    
    public function checkLogin()
    {
        if($this->customerSession->isLoggedIn())
            return 1;
        else
            return 0;
    }
    public function getNotification()
    {
        if(!$this->hasData('noti'))
        {
            $user_id = $this->customerSession->getCustomer()->getId();
            $noti = $this->_notiCollectionFactory->create()
             ->addFilter('user_id', $user_id)
             ->addOrder(
                    NotificationInterface::CREATION_TIME,
                    NotificationCollection::SORT_ORDER_DESC
                );
            $this->setData('noti', $noti);
        }
        return $this->getData('noti');
    }
}