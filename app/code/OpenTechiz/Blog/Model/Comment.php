<?php 
namespace OpenTechiz\Blog\Model;
use OpenTechiz\Blog\API\Data\CommentInterface;
use Magento\Framework\DataObject\IdentityInterface;
class Comment  extends \Magento\Framework\Model\AbstractModel implements CommentInterface, IdentityInterface
{
    /**#@+
     * Comment's Statuses
     */
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;
    const STATUS_PENDING = 2;

    /**#@-*/
    /**
     * CMS page cache tag
     */
    const CACHE_TAG = 'blog_comment';
    /**
     * @var string
     */
    protected $_cacheTag = 'blog_comment';
    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'blog_comment';
    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $_urlBuilder;

    function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\UrlInterface $urlBuilder,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = [])
    {
        $this->_urlBuilder = $urlBuilder;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('OpenTechiz\Blog\Model\ResourceModel\Comment');
    }

    public function checkUrlKey($url_key)
    {
        return $this->_getResource()->checkUrlKey($url_key);
    }
    
    public function getAvailableStatuses()
    {
        return [self::STATUS_ENABLED => __('Enabled'), self::STATUS_DISABLED => __('Disabled'),self::STATUS_PENDING => __('Pending')];
    }
   
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
    function getID(){
        return $this->getData(self::COMMENT_ID);
    }
    
    function setID($id){
        $this->setData(self::COMMENT_ID,$id);
        return $this;
    }
    public function getPostId()
    {
        return $this->getData(self::POST_ID);
    }
    
    public function getUserId()
    {
        return $this->getData(self::USER_ID);
    }
    
    public function getStatus()
    {
        return $this->getData(self::STATUS);
    }
    
    public function getContent()
    {
        return $this->getData(self::CONTENT);
    }
    
    public function getCreationTime()
    {
        return $this->getData(self::CREATION_TIME);
    }
    
    public function getUpdateTime()
    {
        return $this->getData(self::UPDATE_TIME);
    }
        
    public function setPostId($id)
    {
        return $this->setData(self::POST_ID, $id);
    }
    
    public function setUserId($title)
    {
        return $this->setData(self::USER_ID, $title);
    }
    
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }

    public function setContent($content)
    {
        return $this->setData(self::CONTENT, $content);
    }
    
    public function setCreationTime($creation_time)
    {
        return $this->setData(self::CREATION_TIME, $creation_time);
    }
    
    public function setUpdateTime($update_time)
    {
        return $this->setData(self::UPDATE_TIME, $update_time);
    }


}