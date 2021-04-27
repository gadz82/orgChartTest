<?php

namespace App\Controller;

use App\Entity\NodeTrees;
use App\Exception\BadRequestException;
use App\Exception\NotFoundException;
use App\Exception\RestApiExceptionCastable;
use App\Repository\NodesRepository;

class NodeTreeController extends Controller
{

    public function getNodeTree()
    {
        $responseBody = [
            'nodes' => []
        ];

        try {

            $pageNum = 0;
            $pageSize = 100;
            $searchKeyword = null;

            if (!$this->request->is('GET')) throw new BadRequestException("Invalid Request Method");

            if ($this->request->hasParams(['node_id', 'language'])) {
                throw new BadRequestException("Missing mandatory params");
            }

            if (!filter_var($this->request->getParam('node_id'), FILTER_VALIDATE_INT)) {
                throw new BadRequestException("Missing or Invalid Request Param 'node_id'");
            }

            if (!in_array($this->request->getParam('language'), NodesRepository::getLanguageEnumValues())) {
                throw new BadRequestException("Missing or Invalid Request Param 'language'");
            }

            if ($this->request->hasParam('search_keyword')) {
                if (!is_string($this->request->getParam('search_keyword'))) throw new BadRequestException("Invalid Request Param 'search_keyword'");
                $searchKeyword = $this->request->getParam('search_keyword');
            }

            if ($this->request->hasParam('page_num')) {
                if (!filter_var($this->request->getParam('page_num'), FILTER_VALIDATE_INT, ['options' => ['min_range' => 0]])) {
                    throw new BadRequestException("Invalid page number requested");
                }
                $pageNum = $this->request->getParam('page_num');
            }

            if ($this->request->hasParam('page_size')) {
                if (!filter_var($this->request->getParam('page_size'), FILTER_VALIDATE_INT, ['options' => ['min_range' => 0, 'max_range' => 1000]])) {
                    throw new BadRequestException("Invalid page size requested");
                }
                $pageSize = $this->request->getParam('page_size');
            }

            $nodeRepository = new NodesRepository();

            /**
             * @NodeTrees[] $results
             */
            $results = $nodeRepository->getNodes(
                $this->request->getParam('node_id'),
                $this->request->getParam('language'),
                $pageNum,
                $pageSize,
                $searchKeyword
            );

            if (empty($results)) throw new NotFoundException("Invalid node id");

            $nr = count($results);
            for ($i = 0; $i < $nr; $i++) {
                $responseBody['nodes'][] = [
                    'node_id' => $results[$i]->getIdNode(),
                    'name' => $results[$i]->getNodeTreeNames()[0]->getNodeName(),
                    'children_count' => $results[$i]->getChildCount()
                ];
            }

            $this->response->setContent($responseBody);

        } catch (RestApiExceptionCastable $e) {
            $this->response->setStatusCode($e->getResponseCode());
            $this->response->setContent([
                'nodes' => [],
                'error' => $e->getMessage()
            ]);

        }

    }

    public function handle(): void
    {
        $this->response->sendResponse();
    }


}

