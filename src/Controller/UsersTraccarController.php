<?php

namespace App\Controller;

use App\Repository\TcUsersRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class UsersTraccarController extends AbstractController
{

    #[Route(path :'/users', name: 'tc_users.list', methods:['GET'])]
    public function list(TcUsersRepository $repository, PaginatorInterface $paginator,   
    Request $request): Response
    {
        $pagination = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1), 
            20 
        );

        return $this->render('pages/tc_users/list.html.twig', [
             'pagination' => $pagination
        ]);
    }
}