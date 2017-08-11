<?php

declare(strict_types=1);

namespace Billogram\Api;

use Billogram\Model\Report\ReportCollection;
use Billogram\Model\Report\Report as Model;

class Report extends HttpApi
{
    /**
     * @param string $fileName
     *
     * @return string|array
     *
     * @see https://billogram.com/api/documentation#reports
     */
    public function fetch(string $fileName)
    {
        $response = $this->httpGet('/report/'.$fileName);
        if (!$this->hydrator) {
            return $response;
        }
        // Use any valid status code here
        if ($response->getStatusCode() !== 200) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, Model::class);
    }

    /**
     * @param array $param
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     *
     * @see https://billogram.com/api/documentation#reports
     */
    public function search(array $param = [])
    {
        $param = array_merge(['page' => 1, 'page_size' => 100], $param);
        $response = $this->httpGet('/report', $param);
        if (!$this->hydrator) {
            return $response;
        }
        // Use any valid status code here
        if ($response->getStatusCode() !== 200) {
            $this->handleErrors($response);
        }

        return $this->hydrator->hydrate($response, ReportCollection::class);
    }
}
