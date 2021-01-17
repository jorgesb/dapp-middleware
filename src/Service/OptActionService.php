<?php
/**
 * OptActionService.php
 *
 * @author    Cocomore <info@cocomore.com>
 * @copyright 1997-2018 Cocomore AG
 */

namespace App\Service;

use App\Entity\OptAction;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use App\Repository\OptActionRepository;

class OptActionService
{
    /**
     * @var OptActionRepository
     */
    protected $optActionRepo;

    /**
     * @var BlockchainConnector
     */
    protected $connector;

    /**
     * @var EntityManagerInterface
     */
    protected $em;

    public function __construct(
        OptActionRepository $optActionRepo,
        BlockchainConnector $connector,
        EntityManagerInterface $em
    ) {
        $this->optActionRepo = $optActionRepo;
        $this->connector = $connector;
        $this->em = $em;
    }

    /**
     * @param array $requestData
     */
    public function addOptAction(array $requestData)
    {
        // TODO: Handle transaction if something goes wrong on blockchain, delete entity
        try {
            $optAction = new OptAction();
            $optAction
                ->setUrn($requestData['urn'])
                ->setOptId($requestData['optId'])
                ->setAction($requestData['action']);
            $this->em->persist($optAction);
            $this->em->flush();
        } catch (Exception $e) {
            return $e->getMessage();
        }

        $requestData['id'] = $optAction->getId();

        return $this->connector->add($requestData);

    }

    /**
     * @param int $id
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getOptAction($id)
    {
        $result = [];
        // First check if we have any record with that id
        if ($this->optActionRepo->find($id)) {
            $block = json_decode($this->connector->get($id));

            if (isset($block->success) && $block->success) {
                $result[$id] = $block->message;
            }
        }

        return $result;
    }

    /**
     * @param int $urn
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getOptActionsByUrn($urn)
    {
        $result = [];
        $optActions = $this->optActionRepo->findBy(['urn' => $urn]);

        foreach ($optActions as $optAction) {
            $block = json_decode($this->connector->get($optAction->getId()));

            if (isset($block->success) && $block->success) {
                $result[$optAction->getId()] = $block->message;
            }
        }

        return $result;
    }

    /**
     * @param int $optId
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getOptActionsByOptId($optId)
    {
        $result = [];
        $optActions = $this->optActionRepo->findBy(['opt_id' => $optId]);

        foreach ($optActions as $optAction) {
            $block = json_decode($this->connector->get($optAction->getId()));

            if (isset($block->success) && $block->success) {
                $result[$optAction->getId()] = $block->message;
            }
        }

        return $result;
    }
}