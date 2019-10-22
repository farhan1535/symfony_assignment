<?php

namespace AppBundle\Controller;

use AppBundle\Form\editUser;
use Symfony\Component\HttpFoundation\Session\Session;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Form\CreateUser;

/**
 * Class AddUserController
 * @package AppBundle\Controller
 */
class AddUserController extends Controller
{
    public function userAction()
    {
        $session = new Session();
        if ($session->get('isAlive') == 'true') {
            $userService = $this->get('user_service');
            $userObjects = $userService->getUserInfo();
            return $this->render('user/listing.html.twig', [
                'users' => $userObjects,
            ]);
        } else {
            return $this->render('security/login.html.twig');
        }
    }

    /**
     * @Route("/create", name="create_user")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function createAction(Request $request)
    {
        $logger = $this->get('logger');
        $logger->error('create use action called');
        $session = new Session();
        if ($session->get('isAlive') == 'true') {
            $user = new User();
            $form = $this->createForm(CreateUser::class, $user);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $task = $form->getData();
                $user->setUsername($task->getUsername());
                $user->setAge($task->getAge());
                $user->setPlainPassword($task->getPassword());
                $user->setPhoneNo($task->getPhoneNo());
                $user->setGender($task->getGender());
                $user->setEnabled(true);
                $user->addRole('ROLE_MYPROJECT_USER');
                $date = new \DateTime("now");
                $user->setCreated($date);
                $userService = $this->get('user_service');
                $check = $userService->setUserInfo($user);
                $userService = $this->get('user_service');
                $userObjects = $userService->getUserInfo();
                if ($check == true) {
                    $this->addFlash("success", "user has been inserted successfully");
                    return $this->render('user/listing.html.twig', [
                        'users' => $userObjects,
                    ]);
                } else {
                    $this->addFlash("error", "there is an error in user information");
                    return $this->render('user/listing.html.twig', [
                        'users' => $userObjects,
                    ]);
                }
            }
            return $this->render('user/create_user.html.twig', [
                'form' => $form->createView(),
            ]);
        } else {
            return $this->render('security/login.html.twig');
        }
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function editAction(Request $request)
    {
        $id = $request->query->get('id');
        $userService = $this->get('user_service');
        $userObject = $userService->findById($id);
        $form = $this->createForm(editUser::class, $userObject);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $userService = $this->get('user_service');
            $userService->editUserInfo($userObject);
            $this->addFlash('success', 'user has been edited successfully!');
            return $this->redirectToRoute('listing');
        }
        return $this->render('user/edit_user.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     */
    public function deleteAction(Request $request)
    {
        $id = $request->query->get('id');
        $userService = $this->get('user_service');
        $userService->removeById($id);
        $this->addFlash('success', 'user has been deleted successfully!');
        return $this->redirectToRoute('listing');
    }
}