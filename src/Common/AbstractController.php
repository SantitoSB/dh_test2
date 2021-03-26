<?php

namespace App\Common;

use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Views\Twig;

abstract class AbstractController
{
    /**
     * @var ContainerInterface
     */
    private ContainerInterface $container;

    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $em;


    public function __construct(ContainerInterface $container, EntityManagerInterface $em)
    {
        $this->container = $container;
        $this->em        = $em;
    }

    /**
     * @return EntityManagerInterface
     */
    public function getEntityManager(): EntityManagerInterface
    {
        return $this->em;
    }

    /**
     * @return ContainerInterface
     */
    public function getContainer(): ContainerInterface
    {
        return $this->container;
    }

    /**
     * @param string $template
     * @param array  $data
     *
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     * @return string
     */
    public function render(string $template, array $data = []): string
    {
        /** @var Twig $render */
        $render = $this->container->get('render');

        return $render->fetch($template, $data);
    }

    /**
     * @param ResponseInterface $response
     * @param string            $template
     * @param array             $data
     *
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     * @return ResponseInterface
     */
    public function renderWithResponse(ResponseInterface $response, string $template, array $data = []): ResponseInterface
    {
        /** @var Twig $render */
        $render = $this->container->get('render');

        return $render->render($response, $template, $data);
    }
}