<?php

namespace App\Controller\Admin;

use App\Entity\ArticleMagasin;
use App\Entity\Entretien;
use App\Entity\Equipement;
use App\Entity\Fournisseur;
use App\Entity\Intervation;
use App\Entity\Ligne;
use App\Entity\Panne;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class AdminDashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        //return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        $adminUrlGenerator = $this->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(UserCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        //return $this->render('home/index.html.twig');

        /** the action, if user is connected, and if his role is admin, return to connexion page!!! */
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Gmao Project');
    }

    public function configureMenuItems(): iterable
    {
        //yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
        return [
            MenuItem::linkToDashboard('Administration générale', 'fa fa-home'),

            MenuItem::section('Utilisateurs'),
            //MenuItem::linkToCrud('Comments', 'fa fa-comment', Comment::class),
            MenuItem::linkToCrud('Utilisateurs', 'fa fa-user', User::class),

            MenuItem::section('GMAO'),
            MenuItem::linkToCrud('Intervations', 'fa fa-file-text', Intervation::class),
            MenuItem::linkToCrud('Entretients', 'fa fa-file-text', Entretien::class),
            MenuItem::linkToCrud('Pannes', 'fa fa-tags', Panne::class),
            MenuItem::linkToCrud('Equipements', 'fa fa-file-text', Equipement::class),
            MenuItem::linkToCrud('Ligne de production', 'fa fa-file-text', Ligne::class),

            MenuItem::section('Gestion des articles'),
            MenuItem::linkToCrud('Articles', 'fa fa-file-text', ArticleMagasin::class),
            MenuItem::linkToCrud('Fournisseur', 'fa fa-file-text', Fournisseur::class),

        ];
    }

}
