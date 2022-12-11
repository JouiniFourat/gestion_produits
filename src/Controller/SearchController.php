<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ClientRepository;
use App\Repository\PointVenteRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

class SearchController extends AbstractController
{
    #[Route('/search', name: 'app_search')]
    public function index(ClientRepository $clientRepository): Response
    {
        $clients = $clientRepository->findAll();
        return $this->render('search/index.html.twig', [
            'clients' => $clients,
        ]);
    }

    #[Route('/results', name: 'app_results')]
    public function showResults(): Response
    {
        return new Response('Hi results', 200);
    }

    #[Route('/pvs', name: 'app_pvs')]
    public function getPointVente(SerializerInterface $serializer, Request $request, ClientRepository $clientRepository, PointVenteRepository $pointVenteRepository): JsonResponse
    {
        $idClient = $request->query->get('clientid');
        $client = $clientRepository->findById($idClient)[0];
        $pointsVentes = $client->getPointVentes();
        $data = $serializer->serialize($pointsVentes,'json', ['groups' => ['pvs', 'client']]);
        return new JsonResponse(['resp' => $data], 200);
    }
}
