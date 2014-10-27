<?php

use Frases\Transformers\FraseTransformer;

class FrasesApiController extends ApiController {

    const MESSAGE_NOT_FOUND = 'Frase inexistente';

    const MESSAGE_CREATE = 'Frase creada';

    const LIMIT_PAGINATE = 10;

    private $autor;

    private $texto;

    private $validationFields;

    private $validationRules;

    private $validationMessages;

    private $messageValidateFail = 'Los parametros fallaron la validacion para la creacion de una frase.';

    private $idFrase;

    protected $messageError = 'Error al generar un nueva frase.';

    protected $model;

    protected $fraseTransformer;


    function __construct(
        Frase $model,
        FraseTransformer $contactoTransformer
    )
    {
        $this->model = $model;
        $this->fraseTransformer = $contactoTransformer;
    }

    public function getAutor()
    {
        return $this->autor;
    }

    public function setAutor($autor)
    {
        $this->autor = $autor;
    }

    public function getTexto()
    {
        return $this->texto;
    }

    public function setTexto($texto)
    {
        $this->texto = $texto;
    }

    public function getValidationFields()
    {
        return $this->validationFields;
    }

    public function getValidationRules()
    {
        return $this->validationRules;
    }

    public function setValidationFields($validationFields)
    {
        $this->validationFields = $validationFields;
    }

    public function setValidationRules($validationRules)
    {
        $this->validationRules = $validationRules;
    }

    public function getValidationMessages()
    {
        return $this->validationMessages;
    }

    public function setValidationMessages($validationMessages)
    {
        $this->validationMessages = $validationMessages;
    }

    public function getMessageValidateFail()
    {
        return $this->messageValidateFail;
    }

    public function setMessageValidateFail($messageValidateFail)
    {
        $this->messageValidateFail = $messageValidateFail;
    }

    public function getMessageError()
    {
        return $this->messageError;
    }

    public function setMessageError($messageError)
    {
        $this->messageError = $messageError;
    }

    public function getIdFrase()
    {
        return $this->idFrase;
    }

    public function setIdFrase($idFrase)
    {
        $this->idFrase = $idFrase;
    }

    public function index()
    {
        $frase = $this->model->all();
        return $this->respond([
            'data' => $this->fraseTransformer->transformCollection($frase->all()),
        ]);
    }

    public function store()
    {
        $this->fillFieldsForCreateProcess();

        if(!$this->dataIsValidForCreateProcess()) return $this->responseValidateFail() ;

        if(!$this->createProcess()) return $this->responseCreationError();

        return $this->responseCreationOk();
    }

    public function show($id)
    {
        $frase = $this->model->find($id);

        if (!$frase) return $this->respondNotFound(self::MESSAGE_NOT_FOUND);

        $type = Input::get('type');

        if($this->isFull($type)) $this->setType($type);

        return $this->respond(['data' => $this->fraseTransformer->transform($frase)]);
    }

    private function createProcess()
    {
        if(!$this->createFrase()) return false;

        return true;
    }

    private function createFrase()
    {
        $idFrase = $this->fillFrase()->saveFrase();

        if($this->isEmpty($idFrase)) return false;

        $this->setIdFrase($idFrase);

        return true;
    }

    private function responseCreationError()
    {
        $message = $this->getMessageError();
        return $this->setStatusCode($this::HTTP_UNPROCESSABLE_ENTITY)->respondWithError($message);
    }

    private function responseValidateFail()
    {
        $message = $this->getMessageValidateFail();

        return $this->setStatusCode($this::HTTP_UNPROCESSABLE_ENTITY)->respondWithError($message);
    }

    private function responseCreationOk()
    {
        return $this->respondCreated(self::MESSAGE_CREATE, $this->getIdFrase());
    }

    private function isFull($value)
    {
        return !empty($value);
    }

    private function existsInArray($index, $array)
    {
        return array_key_exists($index, $array);
    }

    private function fillFrase()
    {
        $this->model->autor = $this->getAutor();
        $this->model->texto = $this->getTexto();
        return $this;
    }

    private function isEmpty($value)
    {
        return empty($value);
    }

    public function dataIsValidForCreateProcess()
    {
        $this->prepareValidationForm();

        return $this->validationFormProcess();
    }

    public function prepareValidationForm()
    {
        $this->setValidationMessages([
            'required' => 'El :attribute es requerido.',
        ]);

        $this->setValidationFields([
            'autor' => $this->getAutor(),
            'texto' => $this->getTexto(),
        ]);

        $this->setValidationRules([
            'autor' => 'required',
            'texto' => 'required',
        ]);
    }

    public function validationFormProcess()
    {
        $validationFields = $this->getValidationFields();
        $validationRules = $this->getValidationRules();
        $validationMessages = $this->getValidationMessages();

        $validator = Validator::make($validationFields, $validationRules, $validationMessages);

        if ($validator->passes()) return true;

        $this->setMessageValidateFail($validator->getMessageBag()->toArray());

        return false;
    }

    private function fillFieldsForCreateProcess()
    {
        $this->setAutor(Input::get('autor',''));
        $this->setTexto(Input::get('texto',''));
    }

    private function saveFrase()
    {
        $this->model->save();

        $id = $this->model->id;

        if($this->isEmpty($id)) return '';

        return $id;
    }

}