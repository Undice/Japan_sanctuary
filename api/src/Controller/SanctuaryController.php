<?php

namespace App\Controller;

use App\Entity\Sanctuary;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SanctuaryController extends AbstractController
{
    // Création d'un Sanctuary
    #[Route('/api/sanctuary', name: 'create_sanctuary', methods: ['POST'])]
public function createSanctuary(Request $request, EntityManagerInterface $entityManager): Response
{
    // Décodage des données JSON reçues dans la requête
    $data = json_decode($request->getContent(), true);

    // Vérifiez si $data est null ou si le JSON est mal formé
    if ($data === null) {
        return new Response('Invalid JSON format', Response::HTTP_BAD_REQUEST);
    }

    // Vérifiez que toutes les clés obligatoires sont présentes
    $requiredFields = ['name', 'description', 'date_fondation', 'entry_price', 'latitude', 'longitude', 'email_contact', 'photo', 'creator_id'];
    foreach ($requiredFields as $field) {
        if (!isset($data[$field])) {
            return new Response("Missing required field: $field", Response::HTTP_BAD_REQUEST);
        }
    }

    // Vérifiez que l'utilisateur existe
    $creator = $entityManager->getRepository(User::class)->find($data['creator_id']);
    if (!$creator) {
        return new Response('Creator not found', Response::HTTP_NOT_FOUND);
    }

    // Créer un nouvel objet Sanctuary
    $sanctuary = new Sanctuary();
    $sanctuary->setName($data['name']);
    $sanctuary->setDescription($data['description']);
    $sanctuary->setDateFondation(new \DateTime($data['date_fondation']));
    $sanctuary->setEntryPrice($data['entry_price']);
    $sanctuary->setLatitude($data['latitude']);
    $sanctuary->setLongitude($data['longitude']);
    $sanctuary->setEmailContact($data['email_contact']);
    $sanctuary->setPhoto($data['photo']);
    $sanctuary->setCreator($creator);

    // Persister l'objet Sanctuary dans la base de données
    $entityManager->persist($sanctuary);
    $entityManager->flush();

    // Retourner une réponse JSON avec l'objet Sanctuary créé
    return $this->json([
        'status' => 'Sanctuary created successfully',
        'sanctuary' => $sanctuary
    ], Response::HTTP_CREATED, [], ['groups' => 'sanctuary_read']);
}

    // Récupérer tous les sanctuaires
    #[Route('/api/sanctuary', name: 'get_all_sanctuary', methods: ['GET'])]
    public function getAllSanctuaries(EntityManagerInterface $entityManager): Response
    {
        $sanctuaries = $entityManager->getRepository(Sanctuary::class)->findAll();
        return $this->json($sanctuaries, Response::HTTP_OK, [], ['groups' => 'sanctuary_read']);
    }

    // Récupérer un Sanctuary par ID
    #[Route('/api/sanctuary/{id}', name: 'get_sanctuary', methods: ['GET'])]
    public function getSanctuary($id, EntityManagerInterface $entityManager): Response
    {
        $sanctuary = $entityManager->getRepository(Sanctuary::class)->find($id);

        if (!$sanctuary) {
            return new Response('Sanctuary not found', Response::HTTP_NOT_FOUND);
        }

        return $this->json($sanctuary, Response::HTTP_OK, [], ['groups' => 'sanctuary_read']);
    }

    // Modifier un Sanctuary par ID
    #[Route('/api/sanctuary/{id}', name: 'edit_sanctuary', methods: ['PUT'])]
    public function editSanctuary($id, Request $request, EntityManagerInterface $entityManager): Response
    {
        $sanctuary = $entityManager->getRepository(Sanctuary::class)->find($id);

        if (!$sanctuary) {
            return new Response('Sanctuary not found', Response::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);

        // Mise à jour des données du Sanctuary
        $sanctuary->setName($data['name'] ?? $sanctuary->getName());
        $sanctuary->setDescription($data['description'] ?? $sanctuary->getDescription());
        $sanctuary->setDateFondation(isset($data['date_fondation']) ? new \DateTime($data['date_fondation']) : $sanctuary->getDateFondation());
        $sanctuary->setEntryPrice($data['entry_price'] ?? $sanctuary->getEntryPrice());
        $sanctuary->setLatitude($data['latitude'] ?? $sanctuary->getLatitude());
        $sanctuary->setLongitude($data['longitude'] ?? $sanctuary->getLongitude());
        $sanctuary->setEmailContact($data['email_contact'] ?? $sanctuary->getEmailContact());
        $sanctuary->setPhoto($data['photo'] ?? $sanctuary->getPhoto());

        // Sauvegarde des modifications dans la base de données
        $entityManager->flush();

        return $this->json([
            'status' => 'Sanctuary updated successfully',
            'sanctuary' => $sanctuary
        ], Response::HTTP_OK, [], ['groups' => 'sanctuary_read']);
    }

    // Supprimer un Sanctuary par ID
    #[Route('/api/sanctuary/{id}', name: 'delete_sanctuary', methods: ['DELETE'])]
    public function deleteSanctuary($id, EntityManagerInterface $entityManager): Response
    {
        $sanctuary = $entityManager->getRepository(Sanctuary::class)->find($id);

        if (!$sanctuary) {
            return new Response('Sanctuary not found', Response::HTTP_NOT_FOUND);
        }

        // Supprimer le Sanctuary de la base de données
        $entityManager->remove($sanctuary);
        $entityManager->flush();

        return new Response('Sanctuary deleted successfully', Response::HTTP_NO_CONTENT);
    }
}