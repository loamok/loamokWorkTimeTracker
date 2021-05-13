<?php
namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Config\Exception\FileLocatorFileNotFoundException;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class FrontTokenController extends AbstractController {
    
    /**
     * @Route("/get_my_token", options = { "expose" = true }, name="app_front_token")
     * @IsGranted("ROLE_USER")
     */
    public function GetMyTokenAction(UserInterface $user, JWTTokenManagerInterface $JWTManager) {
        $dir = [realpath(__DIR__ . "/../../config/jwt/")];
        $locator = new FileLocator($dir);
        
        try {
            $filePath = $locator->locate("public.pem", null, false);
        } catch (FileLocatorFileNotFoundException $e) {
            $filePath = null;
        }
        
        return $this->json(['token' => $JWTManager->create($user), 'pem' => !is_null($filePath) ? file_get_contents($filePath[0]) : $dir]);
    }
}
