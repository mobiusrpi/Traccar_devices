<?php

namespace App\Controller;

use App\Repository\Tc_usersRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class UsersTraccarController extends AbstractController
{

    #[Route(path :'/users', name: 'tc_users.list', methods:['GET'])]
    public function list(Tc_usersRepository $repository, PaginatorInterface $paginator,   
    Request $request): Response
    {
        $usersTraccar = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1), 
            20 
        );

        return $this->render('pages/tc_users/list.html.twig', [
             'tc_users_list' => $usersTraccar
        ]);
    }
}