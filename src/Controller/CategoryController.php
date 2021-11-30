<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Program;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/category", name="category_")
 * @return Response
 */

class CategoryController extends AbstractController
{
    /** 
     * @Route("/", name="index")
     * @return Response
     */

    public function index(): Response
    {
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();

        return $this->render('category/index.html.twig', [
            'categories' => $categories
        ]);
    }
    /**
     * @Route("/{categoryName}", name="show")
     * @return Response
     */

    public function show(string $categoryName)
    {
        $category = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findOneBy(['name' => $categoryName]);

        if (!$category) {
            throw $this->createNotFoundException(
                'There is no ' . $categoryName . ' found in Category table.'
            );
        }


        $programs = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findBy(
                ['category' => $category->getId()],
                ['category' => 'DESC'],
                3,
            );


        return $this->render('category/show.html.twig', [
            'categoryName' => $categoryName, 'programs' => $programs
        ]);
    }
}
