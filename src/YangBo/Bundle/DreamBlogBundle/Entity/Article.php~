<?php

namespace YangBo\Bundle\DreamBlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 */
class Article
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $content;

    /**
     * @var string
     */
    private $cover_image;


    /**
     * @var integer
     */
    private $page_view_count=0;

    /**
     * @var \DateTime
     */
    private $updated_at;

    /**
     * @var \DateTime
     */
    private $created_at;

    /**
     * @var \YangBo\Bundle\DreamBlogBundle\Entity\User
     */
    private $user;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $categories;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
        //$this->getIsRecommend() === null ? $this->setIsRecommend(true) : $this->getIsRecommend();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Article
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Article
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }
    
    /**
     * Set page_view_count
     *
     * @param integer $pageViewCount
     * @return Article
     */
    public function setPageViewCount($pageViewCount)
    {
        $this->page_view_count = $pageViewCount;

        return $this;
    }

    /**
     * Get page_view_count
     *
     * @return integer 
     */
    public function getPageViewCount()
    {
        return $this->page_view_count;
    }

    /**
     * Set updated_at
     *
     * @param \DateTime $updatedAt
     * @return Article
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;

        return $this;
    }

    /**
     * Get updated_at
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Article
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set user
     *
     * @param \YangBo\Bundle\DreamBlogBundle\Entity\User $user
     * @return Article
     */
    public function setUser(\YangBo\Bundle\DreamBlogBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \YangBo\Bundle\DreamBlogBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add categories
     *
     * @param \YangBo\Bundle\DreamBlogBundle\Entity\Category $categories
     * @return Article
     */
    public function addCategory(\YangBo\Bundle\DreamBlogBundle\Entity\Category $categories)
    {
        $this->categories[] = $categories;

        return $this;
    }

    /**
     * Remove categories
     *
     * @param \YangBo\Bundle\DreamBlogBundle\Entity\Category $categories
     */
    public function removeCategory(\YangBo\Bundle\DreamBlogBundle\Entity\Category $categories)
    {
        $this->categories->removeElement($categories);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtOnPrepersist()
    {
        // Add your code here
        if (null === $this->getCreatedAt()) {
            $this->setCreatedAt(new \DateTime());
        }
    }
    
    /**
     * @var boolean
     */
    private $is_recommend = false;


    /**
     * Set is_recommend
     *
     * @param boolean $isRecommend
     * @return Article
     */
    public function setIsRecommend($isRecommend)
    {
        $this->is_recommend = $isRecommend;

        return $this;
    }

    /**
     * Get is_recommend
     *
     * @return boolean 
     */
    public function getIsRecommend()
    {
        return $this->is_recommend;
    }


    /**
     * Set cover_image
     *
     * @param string $coverImage
     * @return Article
     */
    public function setCoverImage($coverImage)
    {
        $this->cover_image = $coverImage;

        return $this;
    }

    /**
     * Get cover_image
     *
     * @return string 
     */
    public function getCoverImage()
    {
        return $this->cover_image;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $tags;


    /**
     * Add tags
     *
     * @param \YangBo\Bundle\DreamBlogBundle\Entity\Tag $tags
     * @return Article
     */
    public function addTag(\YangBo\Bundle\DreamBlogBundle\Entity\Tag $tags)
    {
        $this->tags[] = $tags;

        return $this;
    }

    /**
     * Remove tags
     *
     * @param \YangBo\Bundle\DreamBlogBundle\Entity\Tag $tags
     */
    public function removeTag(\YangBo\Bundle\DreamBlogBundle\Entity\Tag $tags)
    {
        $this->tags->removeElement($tags);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTags()
    {
        return $this->tags;
    }
}
