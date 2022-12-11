<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ClientRepository;
use App\Repository\InventoryRepository;
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

    #[Route('/pvs', name: 'app_pvs')]
    public function getPointVente(SerializerInterface $serializer, Request $request, ClientRepository $clientRepository, PointVenteRepository $pointVenteRepository): JsonResponse
    {
        $idClient = $request->query->get('clientid');
        $client = $clientRepository->findById($idClient)[0];
        $pointsVentes = $client->getPointVentes();
        $data = $serializer->serialize($pointsVentes,'json', ['groups' => ['pvs', 'client']]);
        return new JsonResponse(['resp' => $data], 200);
    }

    #[Route('/results', name: 'app_results')]
    public function showResults(Request $request, InventoryRepository $inventoryRepository, PointVenteRepository $pointVenteRepository, ClientRepository $clientRepository): Response
    {
        $client = $request->get('client');
        $pv = $request->get('point_vente');
        $du = $request->get('date_du');
        $au = $request->get('date_au');
        /**
         * $mode 
         * if = 1 : all point de vente
         * if = 2 : specific point de vente
         */
        $pv === "" ? $mode = 1 : $mode = 2;
        //get inventories
        if ($mode == 1)
        {
            //pass all inventories of that client as array
            $pvsClient = $clientRepository->find($client)->getPointVentes();
            $invs = $inventoryRepository->findAllVisits($pvsClient,$du,$au);
        }
        if ($mode == 2)
        {
            //pass pv as object
            $pvObj = $pointVenteRepository->find($pv);
            $invs = $inventoryRepository->findVisitsByPv($pvObj,$du,$au);
        }
        //dd($invs);
        return $this->render('results/index.html.twig', [
            'invs' => $invs,
        ]);
    }
}
