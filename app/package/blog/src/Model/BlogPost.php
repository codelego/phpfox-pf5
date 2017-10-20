<?php

namespace Neutron\Blog\Model;

use Phpfox\Db\DbModel;

class BlogPost extends DbModel
{
    public function getModelId(){return 'blog_post';}

    public function getId(){return (int) $this->__get('blog_id');}
    public function setId($value){$this->__set('blog_id', $value);}
    
    public function getTitle(){return $this->__get('title');}
    public function setTitle($value){$this->__set('title', $value);}
    
    public function getContent(){return $this->__get('content');}
    public function setContent($value){$this->__set('content', $value);}
    
    public function getParentType(){return $this->__get('parent_type');}
    public function setParentType($value){$this->__set('parent_type', $value);}
    
    public function getDescription(){return $this->__get('description');}
    public function setDescription($value){$this->__set('description', $value);}
    
    public function getParentId(){return (int) $this->__get('parent_id');}
    public function setParentId($value){$this->__set('parent_id', $value);}
    
    public function getCategoryId(){return (int) $this->__get('category_id');}
    public function setCategoryId($value){$this->__set('category_id', $value);}
    
    public function getCreatedAt(){return $this->__get('created_at');}
    public function setCreatedAt($value){$this->__set('created_at', $value);}
    
    public function getUpdatedAt(){return $this->__get('updated_at');}
    public function setUpdatedAt($value){$this->__set('updated_at', $value);}
    
    public function getPosterType(){return $this->__get('poster_type');}
    public function setPosterType($value){$this->__set('poster_type', $value);}
    
    public function getPosterId(){return (int) $this->__get('poster_id');}
    public function setPosterId($value){$this->__set('poster_id', $value);}
    
    public function getPublishAt(){return $this->__get('publish_at');}
    public function setPublishAt($value){$this->__set('publish_at', $value);}
    
    public function getViewCount(){return (int) $this->__get('view_count');}
    public function setViewCount($value){$this->__set('view_count', $value);}
    
    public function getCommentCount(){return (int) $this->__get('comment_count');}
    public function setCommentCount($value){$this->__set('comment_count', $value);}
    
    public function getPrivacyId(){return (int) $this->__get('privacy_id');}
    public function setPrivacyId($value){$this->__set('privacy_id', $value);}
    
    public function getStatusId(){return (int) $this->__get('status_id');}
    public function setStatusId($value){$this->__set('status_id', $value);}
    
    public function isApproved(){return $this->__get('is_approved') ?1:0;}
    public function setApproved($value){$this->__set('is_approved',$value?1:0);}
    
    public function isFeatured(){return $this->__get('is_featured') ?1:0;}
    public function setFeatured($value){$this->__set('is_featured',$value?1:0);}
    
    public function getUserId(){return (int) $this->__get('user_id');}
    public function setUserId($value){$this->__set('user_id', $value);}
    
}