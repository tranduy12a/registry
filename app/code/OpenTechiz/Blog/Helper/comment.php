<?php namespace OpenTechiz\Blog\Helper;
use Magento\Framework\App\Action\Action;
class Post extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * @var \OpenTechiz\Blog\Model\Post
     */
    protected $_comment;
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;
    /**
     * Constructor
     *
     * @param \Magento\Framework\App\Helper\Context $context
     * @param \OpenTechiz\Blog\Model\Post $comment
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \OpenTechiz\Blog\Model\Post $comment,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    )
    {
        $this->_comment = $comment;
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }
    /**
     * Return a blog comment from given comment id.
     *
     * @param Action $action
     * @param null $commentId
     * @return \Magento\Framework\View\Result\Page|bool
     */
    public function prepareResultPost(Action $action, $commentId = null)
    {
        if ($commentId !== null && $commentId !== $this->_comment->getId()) {
            $delimiterPosition = strrpos($commentId, '|');
            if ($delimiterPosition) {
                $commentId = substr($commentId, 0, $delimiterPosition);
            }
            if (!$this->_comment->load($commentId)) {
                return false;
            }
        }
        if (!$this->_comment->getId()) {
            return false;
        }
        /** @var \Magento\Framework\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        // We can add our own custom page handles for layout easily.
        $resultPage->addHandle('blog_comment_view');
        // This will generate a layout handle like: blog_comment_view_id_1
        // giving us a unique handle to target specific blog comments if we wish to.
        $resultPage->addPageLayoutHandles(['id' => $this->_comment->getId()]);
        // Magento is event driven after all, lets remember to dispatch our own, to help people
        // who might want to add additional functionality, or filter the comments somehow!
        $this->_eventManager->dispatch(
            'opentechiz_blog_comment_render',
            ['comment' => $this->_comment, 'controller_action' => $action]
        );
        return $resultPage;
    }
}