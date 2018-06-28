<?php
/**
 * Created by PhpStorm.
 * User: Etudiant
 * Date: 27/06/2018
 * Time: 16:59
 */

namespace App\Controller;



use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Symfony\Component\HttpFoundation\Response;

class MainController extends Controller
{

    /**
     * @Route("/", name="home")
     */
    public function home() {
        $description = 'Share your alcoholic passions and move your city! BeerTime helps you meet people close to your favorite pub';
        return $this->render('main/home.html.twig', [
           'title' => 'BeerTime',
            'description' => $description
        ]);
    }

}