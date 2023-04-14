<?php
namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use ProxyManager\ProxyGenerator\ValueHolder\MethodGenerator\Constructor;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AbstractBaseController extends AbstractController{
    
    protected EntityManagerInterface $manager;
    protected SessionInterface $session;
    protected Request $request;
     /**
     *
     * @param EntityManagerInterface       $manager
     * @param SessionInterface             $session
     * @param Request                      $request
     */
    public function _Construct(EntityManagerInterface $manager , SessionInterface $session , Request $request){
        $this->manager = $manager;
        $this->session = $session;
        $this->request = $request;
    }
    

}