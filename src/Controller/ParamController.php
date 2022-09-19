<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/param')]
class ParamController {

    #url like this: http://example.com/query?param1=value&param2=value
    #[Route('/query', name: 'get-query-params', methods: ['GET'])]
    public function getQueryParams(Request $request): Response {

        $name = $request->query->get(key: 'name');
        $email = $request->query->get(key: 'email');

        return new JsonResponse([
            'name' => $name,
            'email' => $email
        ]);
    }

    #url like this: http://example.com/attribute1/ attribute2
    #[Route('/attributes', name: 'get-attributes', methods: ['GET'])]
    public function getFromAttributes(Request $request): Response {
        $name = $request->attributes->get(key: 'name');
        $email = $request->attributes->get(key: 'email');

        return new JsonResponse([
            'name' => $name,   
            'email' => $email
        ]);
    }

    #[Route('/attributes', name: 'get-attributes', methods: ['GET'])]
    public function getFromBody(Request $request): Response {
        
        $request->request =  new ParameterBag(json_decode($request->getContent(), associative: true));

        return new JsonResponse([
            'name' => $request->request->get('name'),
            'email' => $request->request->get('email')
        ]);
    }
}

?>