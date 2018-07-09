<?php
namespace OpenTechiz\Blog\Controller\Comment;
use \Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;
class Save extends Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_resultJsonFactory;
    protected $_inlineTranslation;
//    protected $_resultPageFactory;
    function __construct(
        \Magento\Framework\App\Action\Context $context,
        JsonFactory $resultJsonFactory,
        \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation,
        \OpenTechiz\Blog\Model\Post $post
    )
    {
        $this->_inlineTranslation = $inlineTranslation;
        $this->resultJsonFactory = $resultJsonFactory;
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
        }
        return $result;
    }
}