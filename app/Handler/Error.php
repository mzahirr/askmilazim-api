<?php namespace App\Handler;

use App\Exception\BadRequestException;
use App\Exception\UnauthorizedException;
use App\Service\UtilService;
use DI\NotFoundException;
use Psr\Http\Message\ResponseInterface;
use Slim\Handlers\AbstractError;
use Slim\Http\Body;
use Slim\Http\Request;
use Slim\Http\Response;
use UnexpectedValueException;

class Error extends AbstractError
{
    /**
     * @Inject
     * @var UtilService
     */
    private $utilService;
    /**
     * @param Request $request
     * @param Response $response
     * @param \Exception $exception
     *
     * @return ResponseInterface
     * @throws UnexpectedValueException
     */
    public function __invoke(Request $request, Response $response, \Exception $exception)
    {
        if ($exception instanceof BadRequestException) {
            return $this->utilService->withCors($request, $response)->withJson([
                'message' => $exception->getMessage()
            ], 400);
        }

        if ($exception instanceof NotFoundException) {
            return $response->withJson([
                'message' => $exception->getMessage()
            ], 404);
        }

        if ($exception instanceof UnauthorizedException) {
            return $response->withJson([
                'message' => $exception->getMessage()
            ], 401);
        }

        if ($exception instanceof \Exception) {

            // @todo add log, kritik

            return $response->withJson([
                'message' => $exception->getMessage()
            ], 500);
        }

        $contentType = $this->determineContentType($request);
        switch ($contentType) {
            case 'application/json':
                $output = $this->renderJsonErrorMessage($exception);
                break;

            case 'text/xml':
            case 'application/xml':
                $output = $this->renderXmlErrorMessage($exception);
                break;

            case 'text/html':
                $output = $this->renderHtmlErrorMessage($exception);
                break;

            default:
                throw new UnexpectedValueException('Cannot render unknown content type ' . $contentType);
        }

        $this->writeToErrorLog($exception);

        $body = new Body(fopen('php://temp', 'r+'));
        $body->write($output);

        return $response
            ->withStatus(500)
            ->withHeader('Content-type', $contentType)
            ->withBody($body);
    }

    /**
     * Render HTML error page
     *
     * @param  \Exception $exception
     *
     * @return string
     */
    protected function renderHtmlErrorMessage(\Exception $exception)
    {
        $title = 'Slim Application Error';

        if ($this->displayErrorDetails) {
            $html = '<p>The application could not run because of the following error:</p>';
            $html .= '<h2>Details</h2>';
            $html .= $this->renderHtmlException($exception);

            while ($exception = $exception->getPrevious()) {
                $html .= '<h2>Previous exception</h2>';
                $html .= $this->renderHtmlException($exception);
            }
        } else {
            $html = '<p>A website error has occurred. Sorry for the temporary inconvenience.</p>';
        }

        $output = sprintf(
            "<html><head><meta http-equiv='Content-Type' content='text/html; charset=utf-8'>" .
            "<title>%s</title><style>body{margin:0;padding:30px;font:12px/1.5 Helvetica,Arial,Verdana," .
            "sans-serif;}h1{margin:0;font-size:48px;font-weight:normal;line-height:48px;}strong{" .
            "display:inline-block;width:65px;}</style></head><body><h1>%s</h1>%s</body></html>",
            $title,
            $title,
            $html
        );

        return $output;
    }

    /**
     * Render exception as HTML.
     *
     * @param \Exception $exception
     *
     * @return string
     */
    protected function renderHtmlException(\Exception $exception)
    {
        $html = sprintf('<div><strong>Type:</strong> %s</div>', get_class($exception));

        if (($code = $exception->getCode())) {
            $html .= sprintf('<div><strong>Code:</strong> %s</div>', $code);
        }

        if (($message = $exception->getMessage())) {
            $html .= sprintf('<div><strong>Message:</strong> %s</div>', htmlentities($message));
        }

        if (($file = $exception->getFile())) {
            $html .= sprintf('<div><strong>File:</strong> %s</div>', $file);
        }

        if (($line = $exception->getLine())) {
            $html .= sprintf('<div><strong>Line:</strong> %s</div>', $line);
        }

        if (($trace = $exception->getTraceAsString())) {
            $html .= '<h2>Trace</h2>';
            $html .= sprintf('<pre>%s</pre>', htmlentities($trace));
        }

        return $html;
    }

    /**
     * Render JSON error
     *
     * @param \Exception $exception
     *
     * @return string
     */
    protected function renderJsonErrorMessage(\Exception $exception)
    {
        $error = [
            'message' => 'Slim Application Error',
        ];

        if ($this->displayErrorDetails) {
            $error['exception'] = [];

            do {
                $error['exception'][] = [
                    'type' => get_class($exception),
                    'code' => $exception->getCode(),
                    'message' => $exception->getMessage(),
                    'file' => $exception->getFile(),
                    'line' => $exception->getLine(),
                    'trace' => explode("\n", $exception->getTraceAsString()),
                ];
            } while ($exception = $exception->getPrevious());
        }

        return json_encode($error, JSON_PRETTY_PRINT);
    }

    /**
     * Render XML error
     *
     * @param \Exception $exception
     *
     * @return string
     */
    protected function renderXmlErrorMessage(\Exception $exception)
    {
        $xml = "<error>\n  <message>Slim Application Error</message>\n";
        if ($this->displayErrorDetails) {
            do {
                $xml .= "  <exception>\n";
                $xml .= "    <type>" . get_class($exception) . "</type>\n";
                $xml .= "    <code>" . $exception->getCode() . "</code>\n";
                $xml .= "    <message>" . $this->createCdataSection($exception->getMessage()) . "</message>\n";
                $xml .= "    <file>" . $exception->getFile() . "</file>\n";
                $xml .= "    <line>" . $exception->getLine() . "</line>\n";
                $xml .= "    <trace>" . $this->createCdataSection($exception->getTraceAsString()) . "</trace>\n";
                $xml .= "  </exception>\n";
            } while ($exception = $exception->getPrevious());
        }
        $xml .= "</error>";

        return $xml;
    }

    /**
     * Returns a CDATA section with the given content.
     *
     * @param  string $content
     * @return string
     */
    private function createCdataSection($content)
    {
        return sprintf('<![CDATA[%s]]>', str_replace(']]>', ']]]]><![CDATA[>', $content));
    }
}
