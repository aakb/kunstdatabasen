<?php

/*
 * This file is part of aakb/kunstdatabasen.
 * (c) 2020 ITK Development
 * This source file is subject to the MIT license.
 */

namespace App\Controller;

use App\Entity\Artwork;
use App\Entity\Furniture;
use App\Entity\Item;
use App\Service\ItemService;
use App\Service\TagService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

/**
 * Class BaseController.
 */
class BaseController extends AbstractController
{
    protected $requestStack;
    protected $session;
    protected $itemService;
    protected $tagService;
    protected $uploaderHelper;
    protected $supportMail;

    /**
     * BaseController constructor.
     *
     * @param string                                                     $bindSupportMail
     * @param RequestStack                                               $requestStack
     * @param \Symfony\Component\HttpFoundation\Session\SessionInterface $session
     * @param \App\Service\ItemService                                   $itemService
     * @param \App\Service\TagService                                    $tagService
     * @param \Vich\UploaderBundle\Templating\Helper\UploaderHelper      $uploaderHelper
     */
    public function __construct(string $bindSupportMail, RequestStack $requestStack, SessionInterface $session, ItemService $itemService, TagService $tagService, UploaderHelper $uploaderHelper)
    {
        $this->requestStack = $requestStack;
        $this->session = $session;
        $this->itemService = $itemService;
        $this->tagService = $tagService;
        $this->uploaderHelper = $uploaderHelper;
        $this->supportMail = $bindSupportMail;
    }

    /**
     * Render view.
     *
     * @param string        $view
     * @param array         $parameters
     * @param Response|null $response
     *
     * @return Response
     */
    public function render(string $view, array $parameters = [], Response $response = null): Response
    {
        !isset($parameters['title']) && $parameters['title'] = 'Kunstdatabasen';
        !isset($parameters['brand']) && $parameters['brand'] = 'Aarhus kommunes kunstdatabase';
        !isset($parameters['brandShort']) && $parameters['brandShort'] = 'Kunstdatabasen';

        $user = $this->getUser();
        $parameters['user'] = [
            'username' => $user->getUsername(),
            'email' => $user->getUsername(),
        ];

        $parameters['menuItems'] = [
            [
                'title' => 'menu.artworks',
                'icon' => 'fa-mountain',
                'active' => true,
                'link' => $this->generateUrl('item_list', ['itemType' => 'artwork']),
            ],
            [
                'title' => 'menu.furniture',
                'icon' => 'fa-chair',
                'active' => true,
                'link' => $this->generateUrl('item_list', ['itemType' => 'furniture']),
            ],
        ];

        $this->saveVisited();

        return parent::render($view, $parameters, $response);
    }

    /**
     * Save that the user visited the item to session.
     */
    public function saveVisited()
    {
        // Save latest visited items,artworks.
        $basePath = $this->requestStack->getCurrentRequest()->getPathInfo();
        $match = preg_match('/\/admin\/(item|artwork|furniture)\/(\d+).*/', $basePath, $matches);
        if ($match) {
            $type = strtolower($matches[1]);
            switch ($type) {
                case 'artwork':
                    $type = Artwork::class;
                    break;
                case 'furniture':
                    $type = Furniture::class;
                    break;
                case 'item':
                    $type = Item::class;
                    break;
            }
            $id = $matches[2];

            $this->session->start();
            $visited = $this->session->get('latestVisitedItems', []);

            $key = array_search($id, array_column($visited, 'id'));

            if ($key) {
                array_splice($visited, $key, 1);
            }

            $visited[] = [
                'time' => time(),
                'type' => $type,
                'id' => $id,
            ];

            if (\count($visited) > 5) {
                array_shift($visited);
            }

            $this->session->set('latestVisitedItems', $visited);
        }
    }
}
