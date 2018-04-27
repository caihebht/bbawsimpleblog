<?php
namespace Pluswerk\Simpleblog\Controller;

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
 * BlogController
 */
class BlogController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * blogRepository
     *
     * @var \Pluswerk\Simpleblog\Domain\Repository\BlogRepository
     * @inject
     */
    protected $blogRepository = null;

    /**
     * @param \Pluswerk\Simpleblog\Domain\Repository\BlogRepository $blogRepository
     */

    public function injectBlogRepository(\Pluswerk\Simpleblog\Domain\Repository\BlogRepository $blogRepository)
{
    $this->blogRepository = $blogRepository;
}



    /**
     * @param \Pluswerk\Simpleblog\Domain\Model\Blog $blog
     */
    public function addFormAction(\Pluswerk\Simpleblog\Domain\Model\Blog $blog = NULL)
    {
        $this->view->assign('blog',$blog);
    }
    /*
     * @param string $actionName Name of the action to forward to
     * add action - add a blog to the repository
     * @param \Pluswerk\Simpleblog\Domain\Model\Blog $blog
     * @validate $blog \Pluswerk.Simpleblog:AutocompleteValidator(property=titel)
     */
    public function addAction(\Pluswerk\Simpleblog\Domain\Model\Blog $blog)
{
    $this->addFlashMessage(
        '" '.$blog->getTitle().' " created successfully!',
        'Status',
        \TYPO3\CMS\Core\Messaging\AbstractMessage::OK,TRUE);
    $this->blogRepository->add($blog);
    $this->redirect('list');
    //Die Methode $this->redirect() schließlich startet einen (komplett) neuen Request auf die Action list. Dies
    //ist ein HTTP-Request, das heißt die Seite lädt komplett neu und ändert dabei auch die URL.
}

    /**
     * @param \Pluswerk\Simpleblog\Domain\Model\Blog $blog
     */
    public function showAction(\Pluswerk\Simpleblog\Domain\Model\Blog $blog)
    {
        $this->view->assign('blog',$blog);
    }

    /**
     * @param \Pluswerk\Simpleblog\Domain\Model\Blog $blog
     */
    public function updateFormAction(\Pluswerk\Simpleblog\Domain\Model\Blog $blog = NULL)
    {
        $this->view->assign('blog',$blog);
    }
    /**
     * @param \Pluswerk\Simpleblog\Domain\Model\Blog $blog
     */
    public function updateAction(\Pluswerk\Simpleblog\Domain\Model\Blog $blog)
    {
        $this->blogRepository->update($blog);
        $this->redirect('list');
    }

    /**
     * @param \Pluswerk\Simpleblog\Domain\Model\Blog $blog
     */
    public function deleteConfirmAction(\Pluswerk\Simpleblog\Domain\Model\Blog $blog)
    {
        $this->view->assign('blog',$blog);
    }

    /**
     * @param \Pluswerk\Simpleblog\Domain\Model\Blog $blog
     */
    public function deleteAction(\Pluswerk\Simpleblog\Domain\Model\Blog $blog)
    {
        $this->blogRepository->remove($blog);
        $this->redirect('list');
    }
    /**
     * action list
     *
     * @return void
     */
    public function listAction()
{
    if($this->request->hasArgument('search')){
        $search = $this->request->getArgument('search');
    }

    $limit = ($this->settings['blog']['max']) ?: NULL;

    $this->view->assign('blogs', $this->blogRepository->findSearchForm($search,$limit));
    $this->view->assign('search',$search);

    }
}
