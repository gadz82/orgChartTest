<?php

namespace App\Controller;

use App\Entity\NodeTrees;
use App\Exception\BadRequestException;
use App\Exception\NotFoundException;
use App\Exception\RestApiExceptionCastable;
use App\Repository\NodesRepository;

/**
 * Class NodeTreeController
 * @package App\Controller
 */
class NodeTreeController extends Controller
{
    /**
     * @var int
     */
    public static $defaultPageNum = 0;

    /**
     * @var int
     */
    public static $defaultPageSize = 100;

    /**
     * @var string | null
     */
    public static $searchKeyword = null;

    /**
     * Action used to consume the required strategy pipeline
     */
    public function getNodeTree()
    {
        $responseBody = [
            'nodes' => []
        ];

        try {

            // Check if is GET Request
            if (!$this->request->is('GET')) throw new BadRequestException("Invalid Request Method");

            // Check if required params exist
            if ($this->request->hasParams(['node_id', 'language'])) {
                throw new BadRequestException("Missing mandatory params");
            }

            // Validation of node_id param
            if (!filter_var($this->request->getParam('node_id'), FILTER_VALIDATE_INT)) {
                throw new BadRequestException("Missing or Invalid Request Param 'node_id'");
            }

            // Check if param language is contained in the enum
            if (!in_array($this->request->getParam('language'), NodesRepository::getLanguageEnumValues())) {
                throw new BadRequestException("Missing or Invalid Request Param 'language'");
            }

            // search_keyword basic handling
            if ($this->request->hasParam('search_keyword')) {
                if (!is_string($this->request->getParam('search_keyword'))) throw new BadRequestException("Invalid Request Param 'search_keyword'");
                $searchKeyword = urldecode($this->request->getParam('search_keyword'));
            } else {
                $searchKeyword = self::$searchKeyword;
            }

            // page_num check
            if ($this->request->hasParam('page_num')) {
                if (!filter_var($this->request->getParam('page_num'), FILTER_VALIDATE_INT, ['options' => ['min_range' => 0]])) {
                    throw new BadRequestException("Invalid page number requested");
                }
                $pageNum = $this->request->getParam('page_num');
            } else {
                $pageNum = self::$defaultPageNum;
            }


            // page_size check
            if ($this->request->hasParam('page_size')) {
                if (!filter_var($this->request->getParam('page_size'), FILTER_VALIDATE_INT, ['options' => ['min_range' => 0, 'max_range' => 1000]])) {
                    throw new BadRequestException("Invalid page size requested");
                }
                $pageSize = $this->request->getParam('page_size');
            } else {
                $pageSize = self::$defaultPageSize;
            }

            // Model Reader object
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

            /*
             * Using managed Exeception interface due to map Exceptions implementing RestApiExceptionCastable
             * to specific HTTP respunse status codes
             */
            $this->response->setStatusCode($e->getResponseCode());
            $this->response->setContent([
                'nodes' => [],
                'error' => $e->getMessage()
            ]);

        } catch (\Exception $e) {

            /*
             * Generic / Unhandled exceptions
             */
            $this->response->setStatusCode(500);
            $this->response->setContent([
                'nodes' => [],
                'error' => $e->getMessage()
            ]);
        }  catch (\Error $e) {
            /*
             * Code Errors
             */
            $this->response->setStatusCode(505);
            $this->response->setContent([
                'nodes' => [],
                'error' => $e->getMessage()
            ]);
        }

    }


    /**
     * Output
     */
    final public function handle(): void
    {
        $this->response->sendResponse();
    }


}

