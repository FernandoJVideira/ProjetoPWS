<?php

require_once 'controllers/BaseController.php';
require_once 'models/Produto.php';
require_once 'models/Iva.php';

class ProdutoController extends BaseController
{
    public function index()
    {
        $produtos = Produto::all();
        $ivas = Iva::all();

        $this->renderView('produto/index.php', ['produtos' => $produtos, 'ivas' =>  $ivas]);
    }

    public function show($id)
    {
        $produto = Produto::find([$id]);
        if (is_null($produto)) {
            $this->redirectToRoute('home/erro'); //TODO: rework pg erro
        } else {
            $this->renderView('produto/show.php', ['produto' => $produto]);
        }
    }

    public function create()
    {
        $ivas = Iva::all(array('conditions' => array('em_vigor = ?', '1')));
        $this->renderView('produto/create.php', ['ivas' => $ivas]);
    }

    public function store()
    {
        //create new resource (activerecord/model) instance with data from POST
        //your form name fields must match the ones of the table fields
        $produto = new Produto([
            'referencia' => $_POST['referencia'],
            'descricao' => $_POST['descricao'],
            'preco_unid' => $_POST['preco_unid'],
            'quant_stock' => $_POST['quant_stock'],
            'iva_id' => $_POST['iva_id'],
        ]);


        if ($produto->is_valid()) {
            $produto->save();
            $this->redirectToRoute('produto/index');
        } else {
            $this->renderView('produto/create.php', ['produto' => $produto]);
        }
    }

    public function edit($id)
    {
        $produto = Produto::find([$id]);
        if (is_null($produto)) {
            $this->redirectToRoute('home/erro');
        } else {
            //mostrar a vista edit passando os dados por parâmetro
            $this->renderView('produto/edit.php', ['produto' => $produto]);
        }
    }

    public function update($id)
    {
        //find resource (activerecord/model) instance where PK = $id
        //your form name fields must match the ones of the table fields
        $produto = Produto::find([$id]);
        $produto->update_attributes([
            'referencia' => $_POST['referencia'],
            'descricao' => $_POST['descricao'],
            'preco_unid' => $_POST['preco_unid'],
            'quant_stock' => $_POST['quant_stock'],
        ]);

        if ($produto->is_valid()) {
            $produto->save();
            $this->redirectToRoute('produto/index');
        } else {
            $this->renderView('produto/edit.php', ['produtoDetails' => $produto]);
        }
    }

    public function delete($id)
    {
        $produto = Produto::find([$id]);
        $produto->delete();

        $this->redirectToRoute('produto/index');
    }
}
