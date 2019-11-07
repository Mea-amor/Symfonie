<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use App\Entity\Client;
use App\Repository\ClientRepository;
use App\Form\ClientType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\RedirectResponse;


class ClientController extends AbstractController
{
     
    

      /**
     *@param ClientRepository $repository
    */ 
     private $repository;

   
      public function __construct(ClientRepository $repository,ObjectManager $em){
         
          $this->repository = $repository ;
          $this->em = $em ;
      }


      /**
     *@param Request $request
    */ 

     public function index( Request $request ) 
     {
        
        $client=$this->repository->findAll();
        // ...
        $Client = new Client();
         $form = $this->createForm(ClientType::class, $Client); 
        $form->handleRequest($request);
        
       
        if ($form->isSubmitted() && $form->isValid()){

            $this->em->persist($Client);
            $this->em->flush();
            return $this->redirectToRoute('Client.index');
            
        }

        return $this->render('client/aceuilClient.html.twig', [
          'client'=> $client, 
            'form' => $form->createView()]);
     }

     /**
      * @Route("/edit/{id}" , name="client.edit")
      * @param Client $client
      *@param Request $request
      */
     
     public function edit(Client $client,Request $request){

      $form = $this->createForm(ClientType::class, $client); 

      $form->handleRequest($request);
        
       
      if ($form->isSubmitted() && $form->isValid()){
          $this->em->flush();
          return $this->redirectToRoute('Client.index');
          
      }

      return $this->render('client/editClient.html.twig', [
        'client'=> $client, 
          'form' => $form->createView()]);

     }

     /**
      * @Route("/Client/enregistrer/{id}", name="client.delete", methods="DELETE")
       * @param Client $client
       * @param Request $request
      */
     
     public function delete(Client $client, Request $request )
     {
        //  $client= $this->getDoctrine()->getRepository(Client::class)->find($id);
          $entityManager = $this->getDoctrine()->getManager();
        //  if($this->isCsrfTokenValid('delete' . $client->getId(), $request->get('_token')))
        //   {
            $entityManager->remove($client);
            $entityManager->flush();
            //  return new Response("suppression avec succées !!!!");
          // }

       
    //    $this->em->remove($client);
    //    $this->em->flush();
   return $this->redirectToRoute('Client.index');
  
// return new Response("suppression avec succées !!!!");


     }

    }