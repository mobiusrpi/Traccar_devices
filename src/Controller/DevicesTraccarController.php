<?php

namespace App\Controller;

use App\Entity\TcDevices;
use App\Form\TcDevicesType;
use App\Repository\TcDevicesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class DevicesTraccarController extends AbstractController
{

    #[Route(path :'/devices', name: 'tc_devices.list', methods:['GET'])]
    public function list(TcDevicesRepository $repository, PaginatorInterface $paginator,   
    Request $request): Response
    {
        $devicesTraccar = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1), 
            20 
        );

        $users = $repository->getUsersFromDevice();
//dd($users);
        return $this->render('pages/tc_devices/list.html.twig', [
             'tc_devices_list' => $devicesTraccar,
             'users' => $users
        ]);
    }

    #[Route('/devices/edit/{id}', name: 'tc_devices.edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TcDevices $tcDevice, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TcDevicesType::class, $tcDevice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('tc_devices.list', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('pages/tc_devices/edit.html.twig', [
            'tc_device' => $tcDevice,
            'form' => $form,
        ]);
    }

}