<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

class PrimeNumberController extends Controller
{
    /**
     * @Route("/show")
     */
    public function showAction()
    {
        return $this->render('primenumber/index.html.twig', array(
            // ...
        ));
    }


    /**
     * @Route("/prime-number/image/{number}", name="prime_number_image")
     * @Method("GET")
     */
    public function primeNumberImageAction(Request $request, $number)
    {

    	$fs = new Filesystem();
    	$path = $this->getParameter('numbers_path') . $number . '.jpg';
    	$baseurl = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath();
    	$url = $baseurl . '/build/images/numbers/' . $number .  '.jpg';

        return $this->json(array( 
        	'exists' => $fs->exists($path),
        	'number' => $number,
        	'path' => $path,
        	'url' => $url
        ));
    }

}
