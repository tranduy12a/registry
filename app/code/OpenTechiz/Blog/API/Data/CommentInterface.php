<?php
namespace OpenTechiz\Blog\Api\Data;
interface CommentInterface
{
    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const COMMENT_ID       = 'comment_id';
    const CONTENT       = 'content';
    const USER_ID         = 'user_id';
    const POST_ID         = 'post_id';
    const STATUS         = 'status';
    const CREATION_TIME = 'creation_time';
    const UPDATE_TIME   = 'update_time';
 

    function getID();
    function getContent();
    function getUserId();
    function getPostID();
    function getStatus();
    function getCreationTime();
    function getUpdateTime();

    function setID($id);
    function setContent($content);
    function setUserId($user_id);
    function setPostID($postID);
    function setStatus($status);
    function setCreationTime($creatTime);
    function setUpdateTime($creatTime);

    
}