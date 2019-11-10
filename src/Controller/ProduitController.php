<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use App\Entity\Produit;
use App\Entity\Categorie;
use App\Repository\ProduitRepository;
use App\Form\ProduitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ProduitController extends AbstractController
{
     
     /**
     *@var ProduitRepository $repository
    */ 
    private $repository;

   
    public function __construct(ProduitRepository $repository,ObjectManager $em){
       
        $this->repository = $repository ;
        $this->em = $em ;
    }


   /**
     * @return Response
     * @param Request $request
     */
  
   public function index(Request $request ) :Response
   {
   
      $Produit=$this->repository->findAll();
      $produit = new Produit();
      $form = $this->createForm(ProduitType::class, $produit); 
     $form->handleRequest($request);
     
    
     if ($form->isSubmitted() && $form->isValid()){

         $this->em->persist($produit);
         $this->em->flush();
         return $this->redirectToRoute('Produit.index');
         
     }
     
      dump($Produit);
      return $this->render('Produit/acceuilProduit.html.twig', [
          'Produit'=> $Produit,
          'form' => $form->createView()]);
   }

//    /**
//     * @Route("/edit/{id}" , name="Produit.edit")
//     * @param Produit $Produit
//     *@param Request $request
//     */
   
//    public function edit(Client $Produit,Request $request){

//     $form = $this->createForm(ProduitType::class, $client); 

//     $form->handleRequest($request);
      
     
//     if ($form->isSubmitted() && $form->isValid()){
//         $this->em->flush();
//         return $this->redirectToRoute('Produit.index');
        
//     }

//     return $this->render('Produit/editProduit.html.twig', [
//       'Produit'=> $Produit, 
//         'form' => $form->createView()]);

//    }

//    /**
//     * @Route("/Client/enregistrer/{id}", name="Produit.delete", methods="DELETE")
//      * @param Produit $Produit
//      * @param Request $request
//     */
   
//    public function delete(Produit $Produit, Request $request )
//    {
//       //  $client= $this->getDoctrine()->getRepository(Client::class)->find($id);
//         $entityManager = $this->getDoctrine()->getManager();
//       //  if($this->isCsrfTokenValid('delete' . $client->getId(), $request->get('_token')))
//       //   {
//           $entityManager->remove($Produit);
//           $entityManager->flush();
//           //  return new Response("suppression avec succées !!!!");
//         // }

     
//   //    $this->em->remove($Produit);
//   //    $this->em->flush();
//  return $this->redirectToRoute('Produit.index');

// // return new Response("suppression avec succées !!!!");


//    }
    }