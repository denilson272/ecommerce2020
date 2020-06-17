<?php 
// Tenho que dizer em que namespace a minha classe Page.php pertence para gerenciar telas em HTML
// esta classe esta no name space hcode
namespace Hcode;

// o rain tpl tem a propria classe, para saber que quando chamo new tpl, é da classe page
use Rain\Tpl;

//vendor/hcode/page - minha classe para gerenciar as paginas html
//vendor/tpl - gerenciamento de html
//vendor/slim - gerenciamento de rotas
//vendo/phpmailer - envio de email

class Page {

	private $tpl;
	//objeto que guarda o meu template
	private $options = [];
	// variável $options recebe as opções que vem da rota

	private $defaults = [
		"header"=>true,
		"footer"=>true,
		"data"=>[]
		// data receber os dados da página, titulo e valor por exemplo
	];

// cria-se o metodo construtor primeiro a ser executado e destrutor o ultimo

	public function __construct($opts = array(), $tpl_dir = "/views/"){

		
		$this->options = array_merge($this->defaults, $opts);

		// array chave valor
		$config = array(
			"tpl_dir"       => $_SERVER["DOCUMENT_ROOT"].$tpl_dir, //servidor/vendor/tpl
			"cache_dir"     => $_SERVER["DOCUMENT_ROOT"]."/views-cache/", //páginas de cache
			"debug"         => false
	    );

		Tpl::configure( $config );

		$this->tpl = new Tpl;
		// cria o tpl e depois faz o assign
		// as variaveis vem de acordo com as rotas do slim
		$this->setData($this->options["data"]);

		if ($this->options["header"] === true) $this->tpl->draw("header");
		// header tem em todas as paginas html

	}

	private function setData($data = array())
	// é um array que recebe o data e faz os assigns - data titulo e valor
	{

		foreach ($data as $key => $value) {
			$this->tpl->assign($key, $value);
		}

	}
	// nome do template, dados, retorna html ou joga na tela
	// corpo do html

	public function setTpl($name, $data = array(), $returnHTML = false)
	// é o body do meu htmml o corpo do site, nome do template as variaveis 
	// que vou passar os dados, retorna html ou joga na tela
	{

		$this->setData($data);

		return $this->tpl->draw($name, $returnHTML);
		//passo o  nome do meu template e o retorno do html, parametro de draw

	}

	public function __destruct(){

		if ($this->options["footer"] === true) $this->tpl->draw("footer");
		// faz o draw do footer
		// onde estará o javascript
	}

}

 ?>