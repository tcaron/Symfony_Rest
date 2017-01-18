<?php 

namespace AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest; // alias pour toutes les annotations
use AppBundle\Form\PlaceType;
use AppBundle\Entity\Place;

class PlaceController extends Controller{

 

      /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/places")
     */
    public function postPlacesAction(Request $request)
    { 
        

      //enregistrer la ressource

      $place = new Place();
      
    // avec formulaire

      $form = $this->createForm(PlaceType::class,$place);
      $form->submit($request->request->all()); // on valide les données

      if ($form->isValid()){
        $em = $this->getDoctrine()->getManager();
        $em->persist($place);
        $em->flush();
        return $place;}

      else {return $form;}

      // sans formulaire 
      //$place->setName($request->get('name'))
      //      ->setAddress($request->get('address'));

     

      

        //return [   
         // quand body listener est activié dans config.yml
          //  [
               // $request->get('name'),
              // $request->get('address')
            // ]

          // quand body listener est activié dans config.yml ou quand on utilise pas Fos Rest Bundle
           // 'payload' => json_decode($request->getContent(),true)   
        //];

    }




}