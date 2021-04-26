<?php

namespace App\Controller;

use App\Entity\NodeTrees;
use App\Exception\RequestException;
use App\Repository\NodesRepository;

class NodeTreeController extends Controller
{

    public function getNodeTree()
    {
        try {

            if (!$this->request->is('GET')) throw new RequestException("Invalid Request Method", RequestException::$unsupportedRequest);

            if (
                !$this->request->hasParam('node_id') ||
                !filter_var($this->request->getParam('page_size'), FILTER_VALIDATE_INT)
            ) {
                throw new RequestException("Missing or Invalid Request Param 'node_id'", RequestException::$badRequest);
            }

            if (
                !$this->request->hasParam('language') ||
                !in_array($this->request->getParam('language'), NodesRepository::getLanguageEnumValues())
            ) {
                throw new RequestException("Missing or Invalid Request Param 'language'", RequestException::$badRequest);
            }

            if ($this->request->hasParam('search_keyword')) {
                if (!is_string($this->request->getParam('search_keyword'))) throw new RequestException("Invalid Request Param 'search_keyword'", RequestException::$badRequest);
            }

            if ($this->request->hasParam('page_num')) {
                if (!filter_var($this->request->getParam('page_size'), FILTER_VALIDATE_INT, ['options' => ['min_range' => 0]])) {
                    throw new RequestException("Invalid Request Param 'page_num'", RequestException::$badRequest);
                }
            }

            if ($this->request->hasParam('page_size')) {
                if (!filter_var($this->request->getParam('page_size'), FILTER_VALIDATE_INT, ['options' => ['min_range' => 0, 'max_range' => 1000]])) {
                    throw new RequestException("Invalid Request Param 'page_size'", RequestException::$badRequest);
                }
            }

            $nodeRepository = new NodesRepository();

            /**
             * @var NodeTrees[] $results ;
             */
            $results = $nodeRepository->getNodes(
                $this->request->getParam('node_id'),
                $this->request->getParam('language'),
                $this->request->getParam('search_keyword'),
                $this->request->getParam('page_num'),
                $this->request->getParam('page_size')
            );


        } catch (RequestException $e) {

        }

    }


}

