<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserManagementFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\UserManagement;
use App\Transformer\UserTransformer;
class UserManagementController extends AbstractController
{
    /*
     * Api para edición de datos de profile de usario para la versión frontend de Symfony/Twig.
     */
    #[Route('/user', name: 'app_user')]
    public function index(
        Request $request,
        UserPasswordHasherInterface $userPasswordHasher,
        EntityManagerInterface $entityManager,
        UserManagement $userManagement,
    ): Response
    {
        $userId = null;
        $user = new User();
        $form = $this->createForm(UserManagementFormType::class, $user, [
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userDto = UserTransformer::formToDto($form);
            $userDto = $userManagement->addOrUpdate($userDto);
            $userId = $userDto->getId();
        }

        return $this->render('user_management/index.html.twig', [
            'userForm' => $form->createView(),
            'userId' => $userId,
        ]);
    }
}
