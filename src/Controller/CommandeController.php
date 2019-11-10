<?php
// src/Controller/LuckyController.php
namespace App\Controller;
use App\Entity\Client;
use App\Entity\Commande;
use App\Form\CommandeType;
use App\Repository\CommandeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
// use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\RedirectResponse;

class CommandeController extends AbstractController
{
     
    // /**
    //  *@var Environment 
    // */ 
    //   private $twig;
      /**
     *@var CommandeRepository 
    */ 
     private $repository;

   
     public function __construct(CommandeRepository $repository){
        
         $this->repository = $repository ;
        
     }
   
    /**
     * @return Response
     * @param Request $request
     */
  
    public function index(Request $request) :Response
    {
       
       $commande=$this->repository->findAll();
       $Commande = new Commande();
       $form = $this->createForm(CommandeType::class,$Commande ); 
      $form->handleRequest($request);
      
     
      if ($form->isSubmitted() && $form->isValid()){
 
          $this->em->persist($Commande);
          $this->em->flush();
          return $this->redirectToRoute('Commande.index');
          
      }
        dump($commande);
       return $this->render( 'commande/acceuilCommande.html.twig'
       , [
         'Commande'=> $commande,
         'form' => $form->createView()]);
    }
    
    }








       // ...
    //    $Client = new Client();
    //     $form = $this->createForm(ClientType::class, $Client); 
    //    $form->handleRequest($request);
    
    //    if ($form->isSubmitted() && $form->isValid()){

    //        $this->em->persist($Client);
    //        $this->em->flush();
    //        return $this->redirectToRoute('Client.index');
           
    //    }

    //    return $this->render('client/aceuilClient.html.twig', [
    //      'client'=> $commande, 
    //        'form' => $form->createView()]);
    // }

    //  public function index()
    //  {
    //     // $number = random_int(0, 100);
 
    //      return new Response($this->twig ->render('commande/acceuilCommande.html.twig') );
    //  }
    