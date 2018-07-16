<?php
namespace OpenTechiz\Blog\Model;
use OpenTechiz\Blog\Api\Data\NotificationInterface;
class Notification extends \Magento\Framework\Model\AbstractModel implements NotificationInterface
{
	function _construct()
	{
		$this->_init('OpenTechiz\Blog\Model\ResourceModel\Notification');
	}
	
    
    function getID(){
        return $this->getData(self::NOTI_ID);
    }
    function getContent(){
        return $this->getData(self::CONTENT);
    }
    function getPostID(){
        return $this->getData(self::POST_ID);
    }
    function getUserID(){
        return $this->getData(self::USER_ID);
    }
    function getCommentID(){
        return $this->getData(self::COMMENT_ID);
    }
    function isViewed(){
        return $this->getData(self::IS_VIEWED);
    }
    function getCreationTime(){
        return $this->getData(self::CREATION_TIME);
    }
    
    function setID($id){
        $this->setData(self::NOTI_ID,$id);
        return $this;
    }
    /**
     * @{initialize}
     */
    function setUserID($userID){
        $this->setData(self::USER_ID,$userID);
        return $this;
    }
    function setContent($content){
        $this->setData(self::CONTENT,$content);
        return $this;
    }
    /**
     * @{initialize}
     */
    function setPostID($postId){
        $this->setData(self::POST_ID,$postId);
        return $this;
    }
    function setCommentID($commentID){
        $this->setData(self::COMMENT_ID, $commentID);
        return $this;
    }
    function setIsViewed($isViewed){
        $this->setData(self::IS_VIEWED,$isViewed);
        return $this;
    }
    function setCreationTime($creatTime){
        $this->setData(self::CREATION_TIME,$creatTime);
        return $this;
    }
}