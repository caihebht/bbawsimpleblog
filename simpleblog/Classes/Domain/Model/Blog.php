<?php
namespace Pluswerk\Simpleblog\Domain\Model;

/***
 *
 * This file is part of the "Simple Blog Extension" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2018 Cai He <heica2222@hotmail.de>, bbaw
 *
 ***/

/**
 * Blogs
 */
class Blog extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * title
     *
     * @var string
     * @validate NotEmpty, Text, Pluswerk.Simpleblog:WordValidator(max=7)
     */
    protected $title = '';

    /**
     * description
     *
     * @var string
     */
    protected $description = '';

    /**
     * Picture of the blog
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     * @cascade remove
     */
    protected $imgae = null;

    /**
     * Blog posts
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Pluswerk\Simpleblog\Domain\Model\Post>
     * @cascade remove
     * @lazy
     */
    protected $posts = null;

    /**
     * Returns the title
     *
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets the title
     *
     * @param string $title
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Returns the description
     *
     * @return string $description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Sets the description
     *
     * @param string $description
     * @return void
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Returns the imgae
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $imgae
     */
    public function getImgae()
    {
        return $this->imgae;
    }

    /**
     * Sets the imgae
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $imgae
     * @return void
     */
    public function setImgae(\TYPO3\CMS\Extbase\Domain\Model\FileReference $imgae)
    {
        $this->imgae = $imgae;
    }

    /**
     * __construct
     */
    public function __construct()
    {
        //Do not remove the next line: It would break the functionality
        $this->initStorageObjects();
    }

    /**
     * Initializes all ObjectStorage properties
     * Do not modify this method!
     * It will be rewritten on each save in the extension builder
     * You may modify the constructor of this class instead
     *
     * @return void
     */
    protected function initStorageObjects()
    {
        $this->posts = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Adds a Post
     *
     * @param \Pluswerk\Simpleblog\Domain\Model\Post $post
     * @return void
     */
    public function addPost(\Pluswerk\Simpleblog\Domain\Model\Post $post)
    {
        $this->posts->attach($post);
    }

    /**
     * Removes a Post
     *
     * @param \Pluswerk\Simpleblog\Domain\Model\Post $postToRemove The Post to be removed
     * @return void
     */
    public function removePost(\Pluswerk\Simpleblog\Domain\Model\Post $postToRemove)
    {
        $this->posts->detach($postToRemove);
    }

    /**
     * Returns the posts
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Pluswerk\Simpleblog\Domain\Model\Post> $posts
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * Sets the posts
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Pluswerk\Simpleblog\Domain\Model\Post> $posts
     * @return void
     */
    public function setPosts(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $posts)
    {
        $this->posts = $posts;
    }
}
