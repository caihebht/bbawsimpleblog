<?php
namespace Pluswerk\Simpleblog\Controller;

class PostController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * @var \Pluswerk\Simpleblog\Domain\Repository\PostRepository
     */


    protected $postRepository;

    /**
     * @param \Pluswerk\Simpleblog\Domain\Repository\PostRepository $postRepository
     */

    public function injectPostRepository(\Pluswerk\Simpleblog\Domain\Repository\PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }


    /*
     * Die initialzeAction wird vor jeder speziellen Action aufgerufen, daher können wir hier überprüfen, ob der User eingeloggt ist.
     * das Array $GLOBALS['TSFE']->fe_user->user['uid'] - es ist immer dann gesetzt, wenn ein Webseiten-Benutzer eingeloggt ist.
     */
    public function initializeAction()
    {
        $action = $this->request->getControllerActionName();
// pruefen, ob eine andere Action ausser "show" aufgerufen wurde
        if ($action != 'show' && $action != 'ajax') {
// Redirect zur Login Seite falls nicht eingeloggt
            if (!$GLOBALS['TSFE']->fe_user->user['uid']) {
                $this->redirect(NULL, NULL, NULL, NULL, $this->settings['loginpage']);
            }
        }
    }

    /**
     * @param \Pluswerk\Simpleblog\Domain\Model\Post $post
     * @param \Pluswerk\Simpleblog\Domain\Model\Comment $comment
     */
    public function ajaxAction(
        \Pluswerk\Simpleblog\Domain\Model\Post $post,
        \Pluswerk\Simpleblog\Domain\Model\Comment $comment = NULL)
    {
// Wenn der Kommentar leer ist, wird nicht persistiert
        if ($comment->getComment()=="") return FALSE;
// Datum des Kommentars setzen und den Kommentar zum Post hinzufügen
        $comment->setCommentdate(new \DateTime());
        $post->addComment($comment);
        $this->postRepository->update($post);
        $this->objectManager->get( 'TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager' )->persistAll();
$comments = $post->getComments();
foreach ($comments as $comment){
    $json[$comment->getUid()] = array(
        'comment'=>$comment->getComment(),
        'commentdate' => $comment->getCommentdate()
    );
}
return json_encode($json);
}

    /**
     * @param \Pluswerk\Simpleblog\Domain\Model\Blog $blog
     * @param \Pluswerk\Simpleblog\Domain\Model\Post $post
     */
    public function addFormAction(
        \Pluswerk\Simpleblog\Domain\Model\Blog $blog,
        \Pluswerk\Simpleblog\Domain\Model\Post $post = NULL)
    {
        $this->view->assign('blog',$blog);
        $this->view->assign('post',$post);
        $this->view->assign('tags',$this->objectManager->get('Pluswerk\\Simpleblog\\Domain\\Repository\\TagRepository')->findAll());
    }

    public function addAction(
        \Pluswerk\Simpleblog\Domain\Model\Blog $blog,
        \Pluswerk\Simpleblog\Domain\Model\Post $post)
    {
        // wenn ein eingeloggt User was psotet wird sein Name auch da angezeigt
       $post->setAuthor($this->objectManager->get('Pluswerk\\Simpleblog\\Domain\\Repository\\AuthorRepository')->findByUid( $GLOBALS['TSFE']->fe_user->user['uid']));
//$this->postRepository->add($post);
        $blog->addPost($post);
        $this->objectManager->get('Pluswerk\\Simpleblog\\Domain\\Repository\\BlogRepository')->update($blog);
        $this->redirect('show','Blog',NULL,array('blog'=>$blog));
    }

    /**
     * @param \Pluswerk\Simpleblog\Domain\Model\Blog $blog
     * @param \Pluswerk\Simpleblog\Domain\Model\Post $post
     */
    public function showAction(
        \Pluswerk\Simpleblog\Domain\Model\Blog $blog,
        \Pluswerk\Simpleblog\Domain\Model\Post $post)
    {
        $this->view->assign('blog',$blog);
        $this->view->assign('post',$post);
    }

    /**
     * @param \Pluswerk\Simpleblog\Domain\Model\Blog $blog
     * @param \Pluswerk\Simpleblog\Domain\Model\Post $post
     */
    public function updateFormAction(
        \Pluswerk\Simpleblog\Domain\Model\Blog $blog,
        \Pluswerk\Simpleblog\Domain\Model\Post $post)
    {
        $this->view->assign('blog',$blog);
        $this->view->assign('post',$post);
        $this->view->assign('tags',$this->objectManager->get('Pluswerk\\Simpleblog\\Domain\\Repository\\TagRepository')->findAll());
    }
    /**
     * @param \Pluswerk\Simpleblog\Domain\Model\Blog $blog
     * @param \Pluswerk\Simpleblog\Domain\Model\Post $post
     */
    public function updateAction(
        \Pluswerk\Simpleblog\Domain\Model\Blog $blog,
        \Pluswerk\Simpleblog\Domain\Model\Post $post)
    {
        $this->postRepository->update($post);
        $this->redirect('show','Blog',NULL,array('blog'=>$blog));
    }

    /**
     * @param \Pluswerk\Simpleblog\Domain\Model\Blog $blog
     * @param \Pluswerk\Simpleblog\Domain\Model\Post $post
     */
    public function deleteConfirmAction(
        \Pluswerk\Simpleblog\Domain\Model\Blog $blog,
        \Pluswerk\Simpleblog\Domain\Model\Post $post)
    {
        $this->view->assign('blog',$blog);
        $this->view->assign('post',$post);
    }
    /**
     * @param \Pluswerk\Simpleblog\Domain\Model\Blog $blog
     * @param \Pluswerk\Simpleblog\Domain\Model\Post $post
     */
    public function deleteAction(
        \Pluswerk\Simpleblog\Domain\Model\Blog $blog,
        \Pluswerk\Simpleblog\Domain\Model\Post $post)
    {
        $blog->removePost($post); // die Relation zwischen Blog und gelöschte Post wird eigentlich schon von Extbase automatische aufgehoben
        $this->objectManager->get('Pluswerk\\Simpleblog\\Domain\\Repository\\BlogRepository')->update($blog);
        $this->postRepository->remove($post);
        $this->redirect('show','Blog',NULL,array('blog'=>$blog));
    }




}