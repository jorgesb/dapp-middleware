<?php

namespace App\Controller;

use App\Service\OptActionService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ConsentTrackingController
 * @Route("/rest/v1")
 */
class ConsentTrackingController extends Controller
{
    /**
     * @var OptActionService
     */
    protected $optActionService;

    public function __construct(OptActionService $optActionService)
    {
        $this->optActionService = $optActionService;
    }

    /**
     * @Route("/consent/tracking", name="consent_tracking")
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ConsentTrackingController.php',
        ]);
    }

    /**
     * @Route("/consent/tracking/add", name="add_consent_tracking")
     *
     * @param Request $request
     *
     * @return JsonResponse
     *
     */
    public function addOptAction(Request $request)
    {
        $result = $this->optActionService->addOptAction($request->request->all());
        return new JsonResponse($result);
    }

    /**
     * @Route("/consent/tracking/{id}", name="get_consent_tracking")
     * @param int $id
     *
     * @return JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getOptAction($id)
    {
        $result = $this->optActionService->getOptAction($id);
        return new JsonResponse($result);
    }

    /**
     * @Route("/consent/tracking/urn/{urn}", name="get_consent_tracking_by_urn")
     * @param int $urn
     *
     * @return JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getOptActionByUrn($urn)
    {
        $result = $this->optActionService->getOptActionsByUrn($urn);
        return new JsonResponse($result);
    }

    /**
     * @Route("/consent/tracking/opt/{opt}", name="get_consent_tracking_by_opt")
     * @param int $opt
     *
     * @return JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getOptActionByOpt($opt)
    {
        $result = $this->optActionService->getOptActionsByOptId($opt);
        return new JsonResponse($result);
    }
}
