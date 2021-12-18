<?php


namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use MercurySeries\FlashyBundle\MercurySeriesFlashyBundle;
use MercurySeries\FlashyBundle\FlashyNotifier;

/**
 * @Route("/profile")
 */
class ProfileController extends AbstractController

{
    /**
     * @Route("/", name="profile")
     */
    public function index()
    {
        return $this->render('profile/profile.html.twig');
    }






}
