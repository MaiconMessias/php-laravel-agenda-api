<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PessoaController extends Controller {

    private $url = "https://localhost:5001/";
    private $headers = [
        'Content-Type: application/json'
    ];

    public function index(){
        return view('dados');
    }

    public function enviar(Request $request){
        
        $pessoa = new \App\Models\Pessoa();   
        if ($request->id == null) {
            $url = $this->url . "api/Pessoa";            
            $metodo = 'POST';
        } else {   
            $metodo = 'PUT';
            $pessoa->id = $request->get('id');            
            $url = $this->url . "api/Pessoa/" . $request->get('id');
        }

        $pessoa->nome = $request->get('nome');
        $pessoa->cpf = $request->get('cpf');
        $pessoa->endereco = $request->get('endereco');

        
        $ch = curl_init($url);
        curl_setopt_array($ch,[
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTPHEADER => $this->headers,
            CURLOPT_POSTFIELDS => json_encode($pessoa),
            CURLOPT_CUSTOMREQUEST => $metodo
        ]);

        curl_exec($ch);
        curl_close($ch);

        return redirect('/lista');
    }

    public function lista(){

        $url = $this->url . "api/Pessoa";
        $ch = curl_init($url);
        curl_setopt_array($ch,[
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false
        ]);
        $pessoas = json_decode(curl_exec($ch));
        curl_close($ch);
        return view('lista', array('pessoas' => $pessoas));
    }


    public function deletar($id){
        
        $url = $this->url . "api/Pessoa/" . $id;
        $ch = curl_init($url);
        curl_setopt_array($ch,[
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_CUSTOMREQUEST => 'DELETE'
        ]);
        curl_exec($ch);
        curl_close($ch);

        return redirect('/lista');
    }


    public function editar($id){

        $url = $this->url . "api/Pessoa/" . $id;
        $ch = curl_init($url);
        curl_setopt_array($ch,[
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_CUSTOMREQUEST => 'GET'
        ]);
        $pessoa = json_decode(curl_exec($ch));
        curl_close($ch);

        return view('editar', array('pessoa' => $pessoa));
    }

    public function paginaPrincipal(){
        return redirect('/lista');
    }

}
