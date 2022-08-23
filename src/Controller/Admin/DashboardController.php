<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\Employer;
use App\Entity\Entreprise;
use App\Entity\Messages;
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
        yield MenuItem::subMenu('Messages', 'fas fa-user')->setSubItems([
            MenuItem::linkToCrud('Show messages', 'fas fa-eye', Messages::class)->setAction(Crud::PAGE_INDEX),
            MenuItem::linkToCrud('Create message', 'fas fa-plus', Messages::class)->setAction(Crud::PAGE_NEW),
        ]);

        yield MenuItem::subMenu('Utilisateur', 'fas fa-user')->setSubItems([
            MenuItem::linkToCrud('Show users', 'fas fa-eye', User::class)->setAction(Crud::PAGE_INDEX),
            MenuItem::linkToCrud('Create user', 'fas fa-plus', User::class)->setAction(Crud::PAGE_NEW),
        ]);
        
        yield MenuItem::subMenu('Entreprise', 'fas fa-user')->setSubItems([
            MenuItem::linkToCrud('Show entreprises', 'fas fa-eye', Entreprise::class)->setAction(Crud::PAGE_INDEX),
            MenuItem::linkToCrud('Create entreprise', 'fas fa-plus', Entreprise::class)->setAction(Crud::PAGE_NEW),
        ]);

        yield MenuItem::subMenu('Article', 'fas fa-user')->setSubItems([
            MenuItem::linkToCrud('Show articles', 'fas fa-eye', Article::class)->setAction(Crud::PAGE_INDEX),
            MenuItem::linkToCrud('Create article', 'fas fa-plus', Article::class)->setAction(Crud::PAGE_NEW),
        ]);

        yield MenuItem::subMenu('Employer', 'fas fa-user')->setSubItems([
            MenuItem::linkToCrud('Show employers', 'fas fa-eye', Employer::class)->setAction(Crud::PAGE_INDEX),
            MenuItem::linkToCrud('Create employer', 'fas fa-plus', Employer::class)->setAction(Crud::PAGE_NEW),
        ]);
        
        yield MenuItem::subMenu('Word', 'fas fa-user')->setSubItems([
            MenuItem::linkToCrud('Show Word', 'fas fa-eye', Word::class)->setAction(Crud::PAGE_INDEX),
            MenuItem::linkToCrud('Create Word', 'fas fa-plus', Word::class)->setAction(Crud::PAGE_NEW),
        ]);
        yield MenuItem::linkToRoute('Quitter le dashboard', 'fas fa-door-open', 'app_home');
        yield MenuItem::linkToLogout('Déconnexion', 'fas fa-sign-out-alt');
    }
}
