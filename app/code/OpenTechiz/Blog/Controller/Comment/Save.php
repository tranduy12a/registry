<?php
namespace OpenTechiz\Blog\Controller\Comment;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
class Save extends \Magento\Framework\App\Action\Action
{
    protected $resultJsonFactory; 
     protected $_inlineTranslation;
     protected $_transportBuilder;
     protected $scopeConfig;
    public function __construct(Context $context , 
                               JsonFactory $resultJsonFactory,
                               \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation,
                               \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder,
                               \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    )
    {
        $this->_inlineTranslation = $inlineTranslation;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->_transportBuilder = $transportBuilder;
        $this->scopeConfig = $scopeConfig;
        return parent::__construct($context);
    }
    public function execute()
    {
       $errors = false;
       $message = "";
       $postData = $this->getRequest()->getPostValue();
       if(!$postData)
       {
            $errors = true;
       }
       $this->_inlineTranslation->suspend();
       $postObject = new \Magento\Framework\DataObject();
        $postObject->setData($postData);
         if (!\Zend_Validate::is(trim($postData['content']), 'NotEmpty')) {
                $errors = true;
            }
          if (!\Zend_Validate::is(trim($postData['email']), 'EmailAddress')) {
                $errors = true;
            }
        $result = $this->resultJsonFactory->create();
        if($errors)
        {
            $message = "Wrong input field";
            $result->setData(['result' => 'fail', 'message' => $message]);
        }
        else
        {
            $message = "submit success";
              // Retrieve your form data
            $email = $postData['email'];
            $author   = $postData['user_id'];
            $content    = $postData['content'];
            $post_id = $postData['post_id'];
            $comment = $this->_objectManager->create('OpenTechiz\Blog\Model\Comment');
            $comment->setEmail($email);
            $comment->setUserId($author);
            $comment->setContent($content);
            $comment->setPostId($post_id);
            $comment->setStatus(0);
            $comment->setPending(0);
            $comment->setDeny(0);
            $comment->save();
            $result->setData(['result' => 'success', 'message' => $message]);
            //send email to user 
            $sender = array('email' => "tranduyptitt@gmail.com", 'name' => 'Mywebsite');
            $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
            $transport = $this->_transportBuilder->setTemplateIdentifier($this->scopeConfig->getValue('blog/general/template', $storeScope))
            ->setTemplateOptions(
                    [
                            'area' =>  \Magento\Framework\App\Area::AREA_FRONTEND,
                            'store' => \Magento\Store\Model\Store::DEFAULT_STORE_ID,
                    ]
                    )
                    ->setTemplateVars(['name' => $postData['content']])
                    ->setFrom($sender)
                    ->addTo($postData['email']) //send to 
                    ->getTransport()
                    ->sendMessage();
        }
        return $result;
    }
}