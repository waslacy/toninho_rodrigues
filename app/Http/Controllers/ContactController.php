<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendContact;

class ContactController extends Controller
{
    public function sendContact(Request $request){
        try{
            $data = array(
                'name' => $request->nome,
                'email' => $request->email,
                'phone' => $request->telefone,
                'message' => $request->mensagem
            );

            Mail::to('toninhorsousa@gmail.com')
            ->send(new SendContact($data));

            session()->flash('ok', 'E-mail enviado com sucesso!');
        } catch(\Exception $e){
            session()->flash('erro', "Algo deu errado: {$e->getMessage()}");
        } finally{
            return redirect()->back();
        }
    }
}
