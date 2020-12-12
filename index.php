<?php
    class InvokeClass {

        public function __invoke() {
            echo '<p>Objeto da classe InvokeClass: Este objeto pode ser executado como uma '
                .'classe!</p>';
        }
    }

    class NormalClass {

        public function normalMethod() {
            echo '<p>Objeto da classe normalMethod: Este objeto não pode ser executado como '
                .'uma classe!</p>';
        }
    }

    Trait upperName {

        public function toUpper() {
            echo '<p>'.strtoupper($this->name).'</p>';
        }
    }

    class Animal {
        use upperName;

        public $name;

        public function __construct($name) {
            $this->name = $name;
        }
    }

    class Car {
        use upperName;

        public $name;

        public function __construct($name) {
            $this->name = $name;
        }
    }

    $array_itens = [
        [
            'id' => 1,
            'name' => 'Eletrônicos',
            'parent_id' => null
        ],
        [
            'id' => 2,
            'name' => 'Video Game',
            'parent_id' => 1
        ],
        [
            'id' => 3,
            'name' => 'Jogo',
            'parent_id' => 2
        ],
        [
            'id' => 4,
            'name' => 'Console',
            'parent_id' => 2
        ],
        [
            'id' => 5,
            'name' => 'Smartphone',
            'parent_id' => 1
        ],
        [
            'id' => 6,
            'name' => 'Fone de ouvido',
            'parent_id' => 5
        ],
        [
            'id' => 7,
            'name' => 'Carregador',
            'parent_id' => 5
        ],
        [
            'id' => 8,
            'name' => 'Roupas',
            'parent_id' => null
        ],
        [
            'id' => 9,
            'name' => 'Feminino',
            'parent_id' => 8
        ],
        [
            'id' => 10,
            'name' => 'Calça',
            'parent_id' => 9
        ],
        [
            'id' => 11,
            'name' => 'Masculino',
            'parent_id' => 8
        ],
        [
            'id' => 12,
            'name' => 'Bermuda',
            'parent_id' => 11
        ],
        [
            'id' => 13,
            'name' => 'Infantil',
            'parent_id' => 8
        ],
        [
            'id' => 14,
            'name' => 'Calça',
            'parent_id' => 13
        ],
        [
            'id' => 15,
            'name' => 'Camiseta',
            'parent_id' => 13
        ],
        [
            'id' => 16,
            'name' => 'Bermuda',
            'parent_id' => 13
        ],
        [
            'id' => 17,
            'name' => 'Livros',
            'parent_id' => null
        ],
        [
            'id' => 18,
            'name' => 'Móveis',
            'parent_id' => null
        ],
        [
            'id' => 19,
            'name' => 'Sofá',
            'parent_id' => 18
        ],
        [
            'id' => 20,
            'name' => 'Mesa',
            'parent_id' => 18
        ]
    ];

    $anonymousFunction = function($array) {
        $list = [];
        echo '<ul class="collection">';
        foreach($array as $parentIndex => $parentItem) {
            if(!$parentItem['parent_id']) {
                $list[$parentItem['name']] = [];
                unset($array[$parentIndex]);
                echo '<li class="collection-item">'.$parentItem['name'].'</li>';
                foreach($array as $firstChildIndex => $firstChildItem) {
                    if((int)$firstChildItem['parent_id'] === (int)$parentItem['id']) {
                        $list[$parentItem['name']][$firstChildItem['name']] = [];
                        unset($array[$firstChildIndex]);
                        echo '<li class="second-level collection-item">'.$firstChildItem['name']
                            .'</li>';
                        foreach($array as $secondChildIndex => $secondChildItem) {
                            if((int)$secondChildItem['parent_id'] === (int)$firstChildItem['id']) {
                                $list[$parentItem['name']][$firstChildItem['name']][] =
                                    $secondChildItem['name'];
                                unset($array[$secondChildIndex]);
                                echo '<li class="third-level collection-item">'
                                    .$secondChildItem['name'].'</li>';
                            }
                        }
                    }
                }
            }
        }
        echo '</ul>';
        unset($array);
        echo '<pre>';
        var_dump($list);
        echo '</pre>';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste Digital Business</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <style>
        .collection-item {
            background-color: #A4B3B4 !important;
        }
        .second-level {
            padding-left: 3em !important;
            background-color: #A4F4B4 !important;
        }
        .third-level {
            padding-left: 6em !important;
            background-color: #B4D4F4 !important;
        }
        article {
            padding: 1em 2em;
            margin-bottom: 1em;
        }
    </style>
    <link rel="icon" href="favicon.ico">
</head>
<body>
    <main class="container">
        <h1>Teste da empresa Digital Business</h1>
        <article  class="z-depth-1">
            <h3>Método __invoke</h3>
            <p>O método mágico _invoke do PHP, ao ser adicionado na declaração de uma classe, permite com que uma instância da mesma possa ser executada como um método.</p>
            <?php
                $invokeClassObject = new InvokeClass();
                $invokeClassObject();
                $normalClassObject = new NormalClass();
                $normalClassObject->normalMethod();
            ?>
        </article>
        <article  class="z-depth-1">
            <h3>Trait</h3>
            <p>Traits são utilizadas para reuso de código, quando não deve-se utilizar o uso de herança através de classes, caso o programador utilize os conceitos de POO corretamente. Por exemplo, no conceito básico de POO, um animal e um carro não podem herdar de uma mesma classe pai, pois não são do mesmo tipo. Mesmo que o PHP permita criar um classe pai com o método toUpper e fazer com que as classes Animal e Car herdem da mesma para utilizar o método, esta não é a utilização correta do conceito de orientação a objetos.</p>
            <?php
                $animal = new Animal('Cachorro');
                $car = new Car('Toyota');
                $animal->toUpper();
                $car->toUpper();
            ?>
        </article>
        <article  class="z-depth-1">
            <h3>Métodos de requisição HTTP</h3>
            <P>Os métodos de requisição HTTP são utuilizados por todos os sistemas WEB e atualmente uma API REST baseia-se nesses métodos.</P>
            <h5>GET</h5>
            <p>Utilizado para solicitar o retorno de informações. Por exemplo: Listar todos os usuários.</p>
            <h5>POST</h5>
            <p>Utilizado para incluir informações. Por exemplo: criar um novo usuário.</p>
            <h5>PUT</h5>
            <p>Utilizado para atualizar informações no servidor. Este método sobrescreve todas as informações de um objeto. Por exemplo: Atualizar informações de um usuário, como nome ou e-mail.</p>
            <h5>DELETE</h5>
            <p>Utilizado para deletar informações. Por exemplo: excluir um usuário.</p>
            <h5>PATCH</h5>
            <p>Utilizado para atualizar informações no servidor. Este método sobrescreve parcialmente informações de um objeto. Por exemplo: Atualizar apenas o nome de um usuário.</p>
        </article>
        <article  class="z-depth-1">
            <h3>Função anônima</h3>
            <?php
                $anonymousFunction($array_itens);
            ?>
        </article>
        <article  class="z-depth-1">
            <h3>Modelagem de dados Streaming de música</h3>
            <a href="music_system.sql" download>Arquivo SQL</a>
            <p>Query para listagem das músicas de uma playlist com o total de músicas:</p>
            <pre>
                SELECT music.name
                FROM music
                LEFT JOIN playlist_music ON playlist_music.music_id = music.id
                LEFT JOIN playlist ON playlist.id = playlist_music.playlist_id
                WHERE playlist.id = (PLAYLIST_ID)
                UNION 
                SELECT COUNT(id)
                FROM playlist_music 
                WHERE playlist_music.playlist_id = (PLAYLIST_ID)
            </pre>
            <p>* Acredito que um count em PHP no resultado da query, na minha opinião, seria mais correto.</p>
        </article>
    </main>
</body>
</html>