<?php
namespace OpenTechiz\Blog\Observer;
use Magento\Framework\Event\ObserverInterface;
class ActiveComment implements ObserverInterface
{
    protected $_postFactory;
    protected $_notiFactory;
    protected $_notiCollectionFactory;
 
    public function __construct(
        \OpenTechiz\Blog\Model\ResourceModel\Notification\CollectionFactory $notiCollectionFactory,
        \OpenTechiz\Blog\Model\PostFactory $postFactory,
        \OpenTechiz\Blog\Model\NotificationFactory $notiFactory
    )
    {
        $this->_notiCollectionFactory = $notiCollectionFactory;
        $this->_postFactory = $postFactory;
        $this->_notiFactory = $notiFactory;
    }
    public function execute(\Magento\Framework\Event\Observer $observer) {
        $comments = $observer->getData('comments');
        foreach ($comments as $comment) {
            $user_id = $comment->getUserId();
            $post_id = $comment->getPostId();
            $comment_id = $comment->getId();
            $isActive = $comment->getStatus();
            // check if status is pending
            if($isActive != 0) return;
            // check if this comment active before
            $notiCheck = $this->_notiCollectionFactory->create()
                ->addFieldToFilter('comment_id', $comment_id);
            if($notiCheck->count()>0) return;
            
            // if user_id = 0 then return
            if($user_id == 0) return;
            // get post info
            $post = $this->_postFactory->create()->load($post_id);
            $postTitle = $post->getTitle();
            $noti = $this->_notiFactory->create();
            $content = "Your comment ID: $comment_id at Post: $postTitle has been approved by Admin";
            $noti->setContent($content);
            $noti->setUserID($user_id);
            $noti->setCommentID($comment_id);
            $noti->setPostID($post_id);
            $noti->save();
        }
        
    }
}