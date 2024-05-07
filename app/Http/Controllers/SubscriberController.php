<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Subscriber;

class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $r)
    {

        $data = $r->validate([
            'user_subscriber_id' => 'required|integer',
            'user_channel_id' => 'required|integer'
        ]);

        $validateRegister = Subscriber::where($data)->first();

        if ($validateRegister) {

            return json_encode([
                'response' => false,
                'message' => 'Inscrição já existente!'
            ]);

        }

        $subscriber = new Subscriber($data);

        if ($subscriber->save()) {

            return json_encode([
                'response' => true,
                'message' => 'Nova inscrição inserida com sucesso!'
            ]);

        } else {

            return json_encode([
                'response' => false,
                'message' => 'Eita, algo deu errado...'
            ]);

        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $r)
    {
        $data = $r->validate([
            'user_subscriber_id' => 'required|integer',
            'user_channel_id' => 'required|integer'
        ]);

        $subscriber = Subscriber::where($data)->first();

        if (!$subscriber) {
            
            return json_encode([
                'response' => false,
                'message' => 'Registro não encontrado'
            ]);

        }

        $resultDelete = $subscriber->delete();

        if ($resultDelete) {

            return json_encode([
                'response' => true,
                'message' => 'Inscrição removida com sucesso!'
            ]);

        } else {

            return json_encode([
                'response' => false,
                'message' => 'Erro ao deletar registro...'
            ]);

        }

    }
}
