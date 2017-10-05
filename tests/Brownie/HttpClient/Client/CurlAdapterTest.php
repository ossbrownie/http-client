<?php

use Brownie\HttpClient\Client\CurlAdapter;
use Brownie\HttpClient\Request;
use Prophecy\Prophecy\MethodProphecy;

class CurlAdapterTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var CurlAdapter
     */
    protected $curlAdapter;

    protected function setUp()
    {
    }

    protected function tearDown()
    {
        $this->curlAdapter = null;
    }

    public function testHttpRequestOkCheckSSL()
    {
        $this->curlAdapter = new CurlAdapter($this->createCurlAdaptee(0));

        $request = $this->createRequest('http://localhost/endpoint');

        $response = $this->curlAdapter->httpRequest($request);

        $this->assertEquals('Simple text', $response->getBody());
        $this->assertEquals(200, $response->getHttpCode());
        $this->assertEquals(5.5, $response->getRuntime());
        $this->assertEquals('OK', $response->getHttpHeaders()->get('TestHeader'));
        $this->assertEquals('ERR', $response->getHttpHeaders()->get('NoHeader', 'ERR'));
    }

    public function testHttpRequestOkNoCheckSSL()
    {
        $this->curlAdapter = new CurlAdapter($this->createCurlAdaptee(0));

        $request = $this->createRequest('http://localhost/endpoint', true);

        $response = $this->curlAdapter->httpRequest($request);

        $this->assertEquals('Simple text', $response->getBody());
        $this->assertEquals(200, $response->getHttpCode());
        $this->assertEquals(5.5, $response->getRuntime());
        $this->assertEquals('OK', $response->getHttpHeaders()->get('TestHeader'));
        $this->assertEquals('ERR', $response->getHttpHeaders()->get('NoHeader', 'ERR'));
    }

    /**
     * @expectedException     \Brownie\HttpClient\Exception\ClientException
     */
    public function testHttpRequestError()
    {
        $this->curlAdapter = new CurlAdapter($this->createCurlAdaptee(5));

        $request = $this->createRequest('http://localhost/endpoint');

        $response = $this->curlAdapter->httpRequest($request);

        $this->assertEquals('ERR', $response->getBody());
    }

    public function testHttpRequestNoBody()
    {
        $this->curlAdapter = new CurlAdapter($this->createCurlAdaptee(0));

        $request = $this->createRequest('http://localhost/endpoint', false, false);

        $response = $this->curlAdapter->httpRequest($request);

        $this->assertEquals('Simple text', $response->getBody());
        $this->assertEquals(200, $response->getHttpCode());
        $this->assertEquals(5.5, $response->getRuntime());
        $this->assertEquals('OK', $response->getHttpHeaders()->get('TestHeader'));
        $this->assertEquals('ERR', $response->getHttpHeaders()->get('NoHeader', 'ERR'));
    }

    private function createRequest($url, $disableSSLValidation = false, $addBody = true)
    {
        $request = $this
            ->prophesize('Brownie\HttpClient\Request');

        $methodGetMethod = new MethodProphecy(
            $request,
            'getMethod',
            array()
        );

        $methodGetUrl = new MethodProphecy(
            $request,
            'getUrl',
            array()
        );

        $methodGetBody = new MethodProphecy(
            $request,
            'getBody',
            array()
        );

        $methodGetParams = new MethodProphecy(
            $request,
            'getParams',
            array()
        );

        $methodGetBodyFormat = new MethodProphecy(
            $request,
            'getBodyFormat',
            array()
        );

        $methodGetTimeOut = new MethodProphecy(
            $request,
            'getTimeOut',
            array()
        );

        $methodGetHeaders = new MethodProphecy(
            $request,
            'getHeaders',
            array()
        );

        $methodValidate = new MethodProphecy(
            $request,
            'validate',
            array()
        );

        $methodIsDisableSSLValidation = new MethodProphecy(
            $request,
            'isDisableSSLValidation',
            array()
        );

        $request
            ->addMethodProphecy(
                $methodGetMethod->willReturn('PUT')
            );

        $request
            ->addMethodProphecy(
                $methodGetUrl->willReturn($url)
            );

        $request
            ->addMethodProphecy(
                $methodGetBody->willReturn($addBody ? '{"Hello":"World"}' : null)
            );

        $request
            ->addMethodProphecy(
                $methodGetParams->willReturn(array(
                    'page' => 5555
                ))
            );

        $request
            ->addMethodProphecy(
                $methodGetBodyFormat->willReturn(Request::FORMAT_APPLICATION_JSON)
            );

        $request
            ->addMethodProphecy(
                $methodGetTimeOut->willReturn(100)
            );

        $request
            ->addMethodProphecy(
                $methodGetHeaders->willReturn(array(
                    'test' => 'Simple'
                ))
            );

        $request
            ->addMethodProphecy(
                $methodValidate->willReturn(null)
            );

        $request
            ->addMethodProphecy(
                $methodIsDisableSSLValidation->willReturn($disableSSLValidation)
            );

        return $request->reveal();
    }

    private function createCurlAdaptee($curlErrno)
    {
        $curlAdaptee = $this
            ->prophesize('Brownie\HttpClient\Client\CurlAdaptee');

        $methodInit = new MethodProphecy(
            $curlAdaptee,
            'init',
            array('http://localhost/endpoint?page=5555')
        );
        $curlAdaptee
            ->addMethodProphecy(
                $methodInit->willReturn(null)
            );

        $methodSetopt_POSTFIELDS = new MethodProphecy(
            $curlAdaptee,
            'setopt',
            array(null, CURLOPT_POSTFIELDS, '{"Hello":"World"}')
        );
        $curlAdaptee
            ->addMethodProphecy(
                $methodSetopt_POSTFIELDS->willReturn($curlAdaptee)
            );

        $methodSetopt_CUSTOMREQUEST = new MethodProphecy(
            $curlAdaptee,
            'setopt',
            array(null, CURLOPT_CUSTOMREQUEST, 'PUT')
        );
        $curlAdaptee
            ->addMethodProphecy(
                $methodSetopt_CUSTOMREQUEST->willReturn($curlAdaptee)
            );

        $methodSetopt_TIMEOUT = new MethodProphecy(
            $curlAdaptee,
            'setopt',
            array(null, CURLOPT_TIMEOUT, 100)
        );
        $curlAdaptee
            ->addMethodProphecy(
                $methodSetopt_TIMEOUT->willReturn($curlAdaptee)
            );

        $methodSetopt_HEADER = new MethodProphecy(
            $curlAdaptee,
            'setopt',
            array(null, CURLOPT_HEADER, true)
        );
        $curlAdaptee
            ->addMethodProphecy(
                $methodSetopt_HEADER->willReturn($curlAdaptee)
            );

        $methodSetopt_HEADER_SIZE = new MethodProphecy(
            $curlAdaptee,
            'setopt',
            array(null, CURLINFO_HEADER_SIZE, true)
        );
        $curlAdaptee
            ->addMethodProphecy(
                $methodSetopt_HEADER_SIZE->willReturn($curlAdaptee)
            );

        $methodSetopt_NOPROGRESS = new MethodProphecy(
            $curlAdaptee,
            'setopt',
            array(null, CURLOPT_NOPROGRESS, true)
        );
        $curlAdaptee
            ->addMethodProphecy(
                $methodSetopt_NOPROGRESS->willReturn($curlAdaptee)
            );

        $methodSetopt_RETURNTRANSFER = new MethodProphecy(
            $curlAdaptee,
            'setopt',
            array(null, CURLOPT_RETURNTRANSFER, true)
        );
        $curlAdaptee
            ->addMethodProphecy(
                $methodSetopt_RETURNTRANSFER->willReturn($curlAdaptee)
            );

        $methodSetopt_URL = new MethodProphecy(
            $curlAdaptee,
            'setopt',
            array(null, CURLOPT_URL, 'http://localhost/endpoint?page=5555')
        );
        $curlAdaptee
            ->addMethodProphecy(
                $methodSetopt_URL->willReturn($curlAdaptee)
            );

        $methodSetopt_SSL_VERIFYPEER = new MethodProphecy(
            $curlAdaptee,
            'setopt',
            array(null, CURLOPT_SSL_VERIFYPEER, false)
        );
        $curlAdaptee
            ->addMethodProphecy(
                $methodSetopt_SSL_VERIFYPEER->willReturn($curlAdaptee)
            );

        $methodSetopt_SSL_VERIFYHOST = new MethodProphecy(
            $curlAdaptee,
            'setopt',
            array(null, CURLOPT_SSL_VERIFYHOST, false)
        );
        $curlAdaptee
            ->addMethodProphecy(
                $methodSetopt_SSL_VERIFYHOST->willReturn($curlAdaptee)
            );

        $methodGetAgentString = new MethodProphecy(
            $curlAdaptee,
            'getAgentString',
            array()
        );
        $curlAdaptee
            ->addMethodProphecy(
                $methodGetAgentString->willReturn('PHP Curl')
            );

        $methodSetopt_HTTPHEADER1 = new MethodProphecy(
            $curlAdaptee,
            'setopt',
            array(null, CURLOPT_HTTPHEADER, array(
                "Connection: close",
                "Accept-Ranges: bytes",
                "Content-Length: 17",
                "Accept: application/json",
                "Content-Type: application/json; charset=utf-8",
                "User-Agent: PHP Curl",
                "test: Simple"
            ))
        );
        $curlAdaptee
            ->addMethodProphecy(
                $methodSetopt_HTTPHEADER1->willReturn($curlAdaptee)
            );

        $methodSetopt_HTTPHEADER2 = new MethodProphecy(
            $curlAdaptee,
            'setopt',
            array(null, CURLOPT_HTTPHEADER, array(
                "Connection: close",
                "Accept-Ranges: bytes",
                "Content-Length: 0",
                "Accept: application/json",
                "Content-Type: application/json; charset=utf-8",
                "User-Agent: PHP Curl",
                "test: Simple"
            ))
        );
        $curlAdaptee
            ->addMethodProphecy(
                $methodSetopt_HTTPHEADER2->willReturn($curlAdaptee)
            );

        $methodExec = new MethodProphecy(
            $curlAdaptee,
            'exec',
            array(null)
        );
        $curlAdaptee
            ->addMethodProphecy(
                $methodExec->willReturn("HTTP/1.1 200 OK\r\nTestHeader: OK\r\n\r\nSimple text")
            );

        $methodGetinfo_HTTP_CODE = new MethodProphecy(
            $curlAdaptee,
            'getinfo',
            array(null, CURLINFO_HTTP_CODE)
        );
        $curlAdaptee
            ->addMethodProphecy(
                $methodGetinfo_HTTP_CODE->willReturn(200)
            );

        $methodGetinfo_TOTAL_TIME = new MethodProphecy(
            $curlAdaptee,
            'getinfo',
            array(null, CURLINFO_TOTAL_TIME)
        );
        $curlAdaptee
            ->addMethodProphecy(
                $methodGetinfo_TOTAL_TIME->willReturn(5.5)
            );

        $methodGetinfo_HEADER_SIZE = new MethodProphecy(
            $curlAdaptee,
            'getinfo',
            array(null, CURLINFO_HEADER_SIZE)
        );
        $curlAdaptee
            ->addMethodProphecy(
                $methodGetinfo_HEADER_SIZE->willReturn(35)
            );

        $methodErrno = new MethodProphecy(
            $curlAdaptee,
            'errno',
            array(null)
        );
        $curlAdaptee
            ->addMethodProphecy(
                $methodErrno->willReturn($curlErrno)
            );

        $methodError = new MethodProphecy(
            $curlAdaptee,
            'error',
            array(null)
        );
        $curlAdaptee
            ->addMethodProphecy(
                $methodError->willReturn('')
            );

        $methodClose = new MethodProphecy(
            $curlAdaptee,
            'close',
            array(null)
        );
        $curlAdaptee
            ->addMethodProphecy(
                $methodClose->willReturn(null)
            );

        return $curlAdaptee->reveal();
    }
}
