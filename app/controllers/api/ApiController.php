<?php
use Illuminate\Http\Response as IlluminateResponse;

/**
 * Created by PhpStorm.
 * User: david
 * Date: 9/9/14
 * Time: 11:35 AM
 */
class ApiController extends \BaseController
{
    const RESPONSE_TYPE_JSON = 'json';

    /**
     * Respuesta 422 Entidad no procesada
     */
    const HTTP_UNPROCESSABLE_ENTITY = IlluminateResponse::HTTP_UNPROCESSABLE_ENTITY;

    /**
     * Respuesta 404 Not Found
     */
    const HTTP_NOT_FOUND =  IlluminateResponse::HTTP_NOT_FOUND;

    /**
     * Respuesta 500 Error Interno
     */
    const HTTP_INTERNAL_SERVER_ERROR =  IlluminateResponse::HTTP_INTERNAL_SERVER_ERROR;

    /**
     * Respuesta 200 Ok!
     */
    const HTTP_OK = IlluminateResponse::HTTP_OK;

    /**
     * Respuesta 201 Registro Creado
     */
    const HTTP_CREATED = IlluminateResponse::HTTP_CREATED;

    /**
     * Contiene los estados del protocolo HTTP
     * Por default se setea en el estado 200
     * @var int
     */
    protected $statusCode = IlluminateResponse::HTTP_OK;

    protected $type = self::RESPONSE_TYPE_JSON;

    protected $typesResponse = ['json','xml'];

    function __construct()
    {
        $type = Input::get('type','json');
        $this->type = (array_key_exists($type, $this->typesResponse)) ? $type :'json';
    }


    /**
     * @param mixed $type
     * @return $this
     */
    public function setType($type)
    {
        $isTypeNotNull = !empty($type);
        $this->type = ($isTypeNotNull) ? $type: self::RESPONSE_TYPE_JSON;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }
    /**
     * @param mixed $statusCode
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param string $message
     * @return mixed
     */
    public function respondNotFound($message = 'Not Found!')
    {
        return $this->setStatusCode(static::HTTP_NOT_FOUND)->respondWithError($message);
    }

    /**
     * @param string $message
     * @return mixed
     */
    public function respondInternalError($message = 'Internal Error!')
    {
        return $this->setStatusCode(static::HTTP_INTERNAL_SERVER_ERROR)->respondWithError($message);
    }

    /**
     * @param $data
     * @param array $headers
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respond($data,$headers = [])
    {
        $type  =  $this->getType();
        $resp  = Response::$type($data, $this->getStatusCode(), $headers);
        return $resp;

    }

    /**
     * @param $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondWithError($message)
    {
        return $this->respond([
            'error' => [
                'message' => $message,
                'status_code' => $this->getStatusCode()
            ]
        ]);
    }

    /**
     * @param Paginator $items
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithPagination($items, $data)
    {
        $data = array_merge($data, [
            'paginator' => [
                'total_count' => $items->getTotal(),
                'total_pages' => ceil($items->getTotal()  / $items->getPerPage()),
                'current_page' => $items->getCurrentPage(),
                'limit' => $items->getPerPage(),
            ],
            'error' => false,
        ]);

        return $this->respond($data);

    }

    /**
     * @param $message
     * @param null $itemId
     * @return mixed
     */
    protected function respondCreated($message, $itemId = null)
    {
        $data = [
            'error' => false,
            'message' => $message,
            'last_insert_id' => $itemId,
        ];

        return $this->setStatusCode(static::HTTP_CREATED)->respond($data);
    }

} 