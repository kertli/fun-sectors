<?php

namespace App\Controller;

use App\Entity\Person;
use App\Form\SectorType;
use App\Repository\PersonRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(Request $request, PersonRepository $personRepository, ManagerRegistry $doctrine): Response
    {
        $session = $request->getSession();
        $person = null;

        if($session->has('personId')) {
            $person = $personRepository->find($session->get('personId'));
        }

        $form = $this->createForm(SectorType::class, $person);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Person $person */
            $person = $form->getData();

            $entityManager = $doctrine->getManager();
            $entityManager->persist($person);
            $entityManager->flush();

            if($session->has('personId')) {
                $this->addFlash('success', 'Updated submission!');
            } else {
                $session->set('personId', $person->getId());
                $this->addFlash('success', 'New submit successful!!');
            }

            return $this->redirectToRoute('app_home');
        }

        return $this->renderForm('home/index.html.twig', [
            'form' => $form,
        ]);
    }
}
