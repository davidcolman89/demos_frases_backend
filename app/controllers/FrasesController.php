<?php

class FrasesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /frases
	 *
	 * @return Response
	 */
	public function index()
	{
		$frases = Frase::all();
        return View::make('listados.frases.listado')->with(compact('frases'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /frases/create
	 *
	 * @return Response
	 */
	public function create()
	{
        $formData = array('route' => 'frases.store', 'method' => 'POST');
		return View::make("formularios.frases.create")->with(compact('frase','formData'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /frases
	 *
	 * @return Response
	 */
	public function store()
	{
        $data = Input::all();
        $frase = new Frase();
        $frase->fill($data);
        $frase->save();

        return Redirect::route('frases.index');
	}

	/**
	 * Display the specified resource.
	 * GET /frases/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /frases/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /frases/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /frases/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}