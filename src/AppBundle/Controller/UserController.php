<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Symfony\Component\HttpFoundation\Session\Session;

class UserController extends Controller {

    private $session;

    public function __construct() {
        $this->session = new Session();
    }

    public function loginAction(Request $request) {
        $status = null;
        $idstatus = null;
        $authenticationUtils = $this->get("security.authentication_utils");
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUserName = $authenticationUtils->getLastUsername();

        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {

                $em = $this->getDoctrine()->getManager();
                $user_repo = $em->getRepository("AppBundle:User");
                $user = $user_repo->findOneBy(array("email" => $form->get("email")->getData()));
                if (count($user) == 0) {
                    $user = new User();
                    $user->setName($form->get("name")->getData());
                    $user->setSurname($form->get("surname")->getData());
                    $user->setEmail($form->get("email")->getData());
                    //$user->setPassword($form->get("password")->getData());

                    $factory = $this->get("security.encoder_factory");
                    $encoder = $factory->getEncoder($user);
                    $password = $encoder->encodePassword($form->get("password")->getData(), $user);
                    $user->setPassword($password);

                    $user->setRole("ROLE_USER");
                    $user->setImagen(null);
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($user);
                    $flush = $em->flush();
                    if ($flush == null) {
                        $status = "El usuario se ha registrado con exito";
                        $idstatus = 2;
                    } else {
                        $status = "El usuario NO SE CREO";
                        $idstatus = 1;
                    }
                }
                else{
                    $status = "El usuario con este correo ya existe";
                    $idstatus = 1;
                }
            } else {
                $status = "No se ha registrado correctamente";
                $idstatus = 1;
            }
            $this->session->getFlashBag()->add("status", $status);
            $this->session->getFlashBag()->add("idstatus", $idstatus);
        }

        return $this->render("User/login.html.twig", array(
                    "error" => $error, "lastUserName" => $lastUserName,
                    "form" => $form->createView()
        ));
    }

}
