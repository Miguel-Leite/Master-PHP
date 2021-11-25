## Instalação do framework Master PHP

<p>
A instalação do framework Master PHP é muito simples, depois de ter feito o download acessa a pasta do projecto (Master PHP ou seja o nome que você renomeou) em seguida acessa a pasta <i style="color: aqua;">App > Config</i>, depois de ter acessa a pasta abri arquivo App para você poder fazer a configuração do seu projecto.
</p>

```php


/**
 * Method App
 *
 * @return array
 */


function App():array
{

    return [




        "APP_NAME" => "master",





        "BASE_URL" => "http://localhost/master/",





        "TIMEZONE" => "UTF",







        "SECRET_KEY" => "",









        "CSRF_NAME" => "csrf_master",
        






        "CSRF_USE" => false,






        

        "CSRF_GENERIC" => false

        
    ];


```

## COMO DEFINIR UMA ROTA

<p>

Para definir uma rota do especifica ou seja uma rota exacta no Framework Master é muito simples:
<br/>
Abri o arquivo php com nome Router.php que encontra na pasta <i> App/Config </i>, em seguida verás uma função
declarada que está develvendo um array, é nesse mesmo array onde vás poder declarar as suas rota da sua applicação.

Temos aqui um exemplo abaixo de como declarar os seguintes tipo de rotas:
<br>

<ul>
    <li> https://domain.com/ </li> 
    <li> https://domain.com/home/sobre </li>
    <li> https://domain.com/user/1/name/miguel </li>
    <li> https://domain.com/user/update/1 </li>
</ul>

</p>

```php
function setRouters():array{

    return [


        /* DEFINE HERE YOUR ROUTER
        |
        |
        |
        | class and method: Home:index
        |
        |
        |
        | url: home
        | get("Home::index","home")
        | http://domain.com/home
        |
        |
        |
        | [a-z] => string
        | [a-z0-9] => string and int
        | [0-9] => int
    
         */


        "DEFAULT_CONTROLLER" => default_controller("Home"),



        "DEFAULT_METHOD" => default_method("index"),




    
        "ROUTERS" => [
            
            "/" => "Home::index",
            "/home/sobre" => "Home::sobre",
            "/sobre/[0-9]+/name/[a-z]+" => "User::show",
            "/user/update/[0-9]+/" => "User::update",
        ]
    
            
    
    ];
```


### Validação no formulário

<p>

Para criar validações nos dados que venhem do formulário com Framework Master é muito simples e rá rápido.
Antes de tudo é muito bom que tenhas o conhecimento que com o Framework Master existe duas maneira efectuar a validação dos dados que venhem do formulário.

O Framework Master contém uma classe pronta para válidação, porém também existe um arquivo de funções que também são validações do formulário.

Neste primeiro exemplo vou mostrar com efectuar validações no formulário usando a classe Validator.php que é uma classe pronto para validação.

</p>


```php



if($this->requestMethod == "POST")
{
    $validate = Validator::validate(function(){

        return Validator::required('name','email','password')

        ->email('email')

        ->sanitize("name:s","email:s","password:s")

        ->unique("email",User::class);

    });

    if(Validator::failed()){
        Redirect::back();
    }

    dump($validate);
}



?>

```

<br/>
<p>
No exemplo acima vimos como efectuar uma validação no formulário usando a classe Validator do Framework Master, neste exemplo exemplo verás como usar funções de validação.
</p>
<br/>

