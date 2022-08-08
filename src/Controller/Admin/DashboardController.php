<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Word;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{

    public function __construct(private AdminUrlGenerator $adminUrlGenerator){


    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $url = $this->adminUrlGenerator->setController(UserCrudController::class)->generateUrl();

        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('ComptAgency ');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::subMenu('Utilisateur', 'fas fa-user')->setSubItems([
            MenuItem::linkToCrud('Show users', 'fas fa-eye', User::class)->setAction(Crud::PAGE_INDEX),
            MenuItem::linkToCrud('Create user', 'fas fa-plus', User::class)->setAction(Crud::PAGE_NEW),
        ]);
        
        yield MenuItem::subMenu('Word', 'fas fa-user')->setSubItems([
            MenuItem::linkToCrud('Show Word', 'fas fa-eye', Word::class)->setAction(Crud::PAGE_INDEX),
            MenuItem::linkToCrud('Create Word', 'fas fa-plus', Word::class)->setAction(Crud::PAGE_NEW),
        ]);
        yield MenuItem::linkToRoute('Quitter le dashboard', 'fas fa-door-open', 'app_home');
        yield MenuItem::linkToLogout('Déconnexion', 'fas fa-sign-out-alt');
    }
}
