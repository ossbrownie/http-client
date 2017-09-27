<?php
/**
 * @category    Brownie/HttpClient
 * @author      Brownie <oss.brownie@gmail.com>
 * @license     http://www.gnu.org/copyleft/lesser.html
 */

namespace Brownie\HttpClient;

use Brownie\HttpClient\Exception\ClientException;

/**
 * HTTP client interface.
 */
interface Client
{

    /**
     * Performs a network request.
     * Returns the response.
     *
     * @param Request       $request    HTTP request params.
     *
     * @throws ClientException
     *
     * @return Response
     */
    public function httpRequest(Request $request);
}
