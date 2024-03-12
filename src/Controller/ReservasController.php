<?php

namespace App\Controller;

use App\Entity\Reservas;
use App\Form\ReservasType;
use App\Repository\ReservasRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Util\Json;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

#[Route('/reservas')]
class ReservasController extends AbstractController
{
    #[Route('/', name: 'app_reservas_index', methods: ['GET'])]
    public function index(ReservasRepository $reservasRepository): Response
    {
        return $this->render('reservas/index.html.twig', [
            'reservas' => $reservasRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_reservas_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $reserva = new Reservas();
        $form = $this->createForm(ReservasType::class, $reserva);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reserva);
            $entityManager->flush();

            return $this->redirectToRoute('app_reservas_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reservas/new.html.twig', [
            'reserva' => $reserva,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reservas_show', methods: ['GET'])]
    public function show(Reservas $reserva): Response
    {
        return $this->render('reservas/show.html.twig', [
            'reserva' => $reserva,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_reservas_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Reservas $reserva, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReservasType::class, $reserva);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_reservas_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reservas/edit.html.twig', [
            'reserva' => $reserva,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reservas_delete', methods: ['POST'])]
    public function delete(Request $request, Reservas $reserva, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $reserva->getId(), $request->request->get('_token'))) {
            $entityManager->remove($reserva);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_reservas_index', [], Response::HTTP_SEE_OTHER);
    }

    //Consultas personalizadas con JSON
    #[Route('/Json{id}', name: 'app_reservas_showJson')]
    public function showJSON(EntityManagerInterface $entityManager, int $id_Usuario): JsonResponse
    {
        //http://127.0.0.1:8000/reservas/Json5

        // Obtener la reserva por su ID
        $reserva = $entityManager->getRepository(Reservas::class)->findUsuariosByEstado($id_Usuario);

        // Comprobar si se encontró la reserva
        if (!$reserva) {
            throw $this->createNotFoundException('Reserva no encontrada');
        }

        // Construir el objeto JSON con los campos necesarios
        $jsonReserva = [
            'nombre_usuario' => $reserva->getIdUsuario()->getNombreUsuario(),
            'email' => $reserva->getIdUsuario()->getEmail(),
            'estado' => $reserva->getEstado(),
            'fecha_checkin' => $reserva->getFechaCheckin()->format('Y-m-d'),
            'fecha_checkout' => $reserva->getFechaCheckout()->format('Y-m-d'),
        ];

        // Devolver la respuesta JSON
        return new JsonResponse($jsonReserva);
    }

    #[Route('/Json2_{id}', name: 'app_reservas_showJson2')]
    public function showJSON2(EntityManagerInterface $entityManager): JsonResponse
    {
        //http://127.0.0.1:8000/reservas/Json2_5

        $reserva = $entityManager->getRepository(Reservas::class)->findUsuariosAndReservas();

        $jsonReserva = [
            'nombre_usuario' => $reserva->getIdUsuario()->getNombreUsuario(),
            'email' => $reserva->getIdUsuario()->getEmail(),
            'estado' => $reserva->getEstado(),
            'fecha_checkin' => $reserva->getFechaCheckin()->format('Y-m-d'),
            'fecha_checkout' => $reserva->getFechaCheckout()->format('Y-m-d'),
        ];

        return $this->json($jsonReserva);
    }
}
