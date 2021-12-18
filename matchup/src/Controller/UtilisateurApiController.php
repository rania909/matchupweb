<?php


namespace App\Controller;


use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class UtilisateurApiController extends AbstractController
{

    /**
     * @Route("api/signup", name="app_registerjson")
     */
    public function  signupAction(Request  $request, UserPasswordEncoderInterface $passwordEncoder) {

        $email = $request->query->get("email");
        $nom = $request->query->get("nom");
        $prenom = $request->query->get("prenom");
        $mdp = $request->query->get("mdp");
        $adresse = $request->query->get("adresse");
        $age = $request->query->get("age");
        $genre = $request->query->get("genre");
        $roles= $request->query->get("roles");


        //control al email lazm @
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return new Response("email invalid.");
        }
        $user = new User();
        $user->setNom($nom);
        $user->setEmail($email);
        $pass = $passwordEncoder->encodePassword(
            $user,
            $mdp
        );


       // $user->setNom($nom);
        $user->setPrenom($prenom);
        $user->setMdp($mdp);
        $user->setAge($age);
        $user->setIsVerified(true);
        $user->setAdresse($adresse);
        $user->setGenre($genre);

       // $user->setDateNaissance(new \DateTime($dateNassiance));
        $user->setRoles(["ROLE_UTI"]);//aleh array khater roles par defaut fi security  type ta3ha array

        try {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return new JsonResponse("success",200);//200 ya3ni http result ta3 server OK
        }catch (\Exception $ex) {
            return new Response("execption ".$ex->getMessage());
        }
    }


    /**
     * @Route("api/signin", name="app_loginjson")
     */

    public function signinAction(Request $request) {
        $email = $request->query->get("email");
        $mdp= $request->query->get("mdp");

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->findOneBy(['email'=>$email]);//bch nlawj ala user b username ta3o fi base s'il existe njibo
        //ken l9ito f base

        if($user){
            //lazm n9arn password zeda madamo crypté nesta3mlo password_verify
            if($mdp = $em->getRepository(User::class)->findOneBy(['mdp'=>$mdp])) {
                $serializer = new Serializer([new ObjectNormalizer()]);
                $formatted = $serializer->normalize($user);
                return new JsonResponse($formatted);
            }
            else {
                return new Response("passowrd not found");
            }
        }
        else {
            return new Response("failed");//ya3ni username/pass mch s7a7

        }
    }


    /**
     * @Route("api/ediUser", name="app_gestion_profilejson")
     */

    public function editUser(Request $request, UserPasswordEncoderInterface $passwordEncoder) {
        $id = $request->get("id");//kima query->get wala get directement c la meme chose
        $username = $request->query->get("username");
        $password = $request->query->get("password");
        $email = $request->query->get("email");
        $em=$this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->find($id);
        //bon l modification bch na3mlouha bel image ya3ni kif tbadl profile ta3ik tzid image
        if($request->files->get("photo")!= null) {

            $file = $request->files->get("photo");//njib image fi url
            $fileName = $file->getClientOriginalName();//nom ta3ha

            //taw na5ouha w n7otaha fi dossier upload ely tet7t fih les images en principe te7t public folder
            $file->move(
                $fileName
            );
            $user->setPhoto($fileName);
        }


        $user->setUsername($username);
        $user->setPassword(
            $passwordEncoder->encodePassword(
                $user,
                $password
            )
        );

        $user->setEmail($email);
        $user->setIsVerified(true);//par défaut user lazm ykoun enabled.



        try {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return new JsonResponse("success",200);//200 ya3ni http result ta3 server OK
        }catch (\Exception $ex) {
            return new Response("fail ".$ex->getMessage());
        }

    }

    /**
     * @Route("api/getmdpByEmail", name="app_mdpjson")
     */
    public function getmdpByEmail(Request $request){
$email=$request->get('email');
$user =$this->getDoctrine()->getManager()->getRepository(User::class)->findOneBy(['email'=>$email]);
if($user){
    $mdp=$user->getPassword();
    $serializer=new Serializer([new ObjectNormalizer()]);
    $formatted=$serializer->normalize($mdp);
    return new JsonResponse($formatted);
}
return new Response("user not found");
    }
}