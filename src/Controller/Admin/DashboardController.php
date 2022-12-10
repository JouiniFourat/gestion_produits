<?php

namespace App\Controller\Admin;

use App\Entity\Visite;
use App\Entity\Client;
use App\Entity\Inventory;
use App\Entity\PointVente;
use App\Entity\Produit;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render("/dashboard/index.html.twig");
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Gestion Produits');
    }

    public function configureMenuItems(): iterable
    {
        return [
        MenuItem::linkToDashboard('Dashboard', 'fa fa-home'),
        MenuItem::linkToCrud('Clients', 'fas fa-list', Client::class),
        MenuItem::linkToCrud('Points de vente', 'fas fa-list', PointVente::class),
        MenuItem::linkToCrud('Produits', 'fas fa-list', Produit::class),
        MenuItem::linkToCrud('Visites', 'fas fa-list', Visite::class),
        MenuItem::linkToCrud('Inventaires', 'fas fa-list', Inventory::class),
        ];

    }
}
