<?php

namespace App\Controller;

use App\Repository\Tc_devicesRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class DevicesTraccarController extends AbstractController
{

    #[Route(path :'/devices', name: 'tc_devices.list', methods:['GET'])]
    public function list(Tc_devicesRepository $repository, PaginatorInterface $paginator,   
    Request $request): Response
    {
        $devicesTraccar = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1), 
            20 
        );

        return $this->render('pages/tc_devices/list.html.twig', [
             'tc_devices_list' => $devicesTraccar
        ]);
    }
}