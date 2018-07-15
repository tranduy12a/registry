<?php
namespace OpenTechiz\Blog\Block;
use OpenTechiz\Blog\Api\Data\CommentInterface;
use OpenTechiz\Blog\Model\ResourceModel\Comment\Collection as CommentCollection;
class CommentList extends \Magento\Framework\View\Element\Template implements
    \Magento\Framework\DataObject\IdentityInterface
{
    /**
     * @var \OpenTechiz\Blog\Model\ResourceModel\Comment\CollectionFactory
     */
    protected $_request;
    protected $_commentCollectionFactory; 

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \OpenTechiz\Blog\Model\ResourceModel\Comment\CollectionFactory $commentCollectionFactory,\Magento\Framework\App\RequestInterface $request,
        \OpenTechiz\Blog\Model\NotificationFactory $notiFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_request = $request;
        $this->_commentCollectionFactory = $commentCollectionFactory;
    }
    /**
     * @return \OpenTechiz\Blog\Model\ResourceModel\Comment\Collection
     */

    public function getPostID()
    {
        return $this->_request->getParam('post_id', false);
    }

    public function getComments()
    {
        $post_id = $this->getPostID();
        if (!$this->hasData('comments')) {
            $comments = $this->_commentCollectionFactory
                ->create()
                ->addFilter('post_id', $post_id)
                ->addOrder(
                    CommentInterface::CREATION_TIME,
                    CommentCollection::SORT_ORDER_DESC
                );
            $this->setData('comments', $comments);
        }
        return $this->getData('comments');
    }
    /**
     * Return identifiers for produced content
     *
     * @return array
     */
    public function getIdentities()
    {
        return [\OpenTechiz\Blog\Model\Comment::CACHE_TAG . '_' . 'list'];
    }
}