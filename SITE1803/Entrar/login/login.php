<?php
session_start();
require 'Contato.class.php';

$conecta = $contato = new Contato();

if( !$conecta ){
    echo "<h1>Erro ao conectar ao banco de dados</h1>";
    //exit;
}else{
    if( isset($_POST['nome'])){
        $nome  = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        //echo $nome . " - " . $email . " - " . $senha;
        if( isset($_POST['btnEntrar'])){
            $user = $contato->chkUser($email);
            if($user){
               $user = $contato->chkUserPass($email, $senha); 
               if($user){
                   $_SESSION['email'] = $email;
                   $_SESSION['nome']  = $nome;
                   header("location:pagina2.php");
               }
               else{
                   echo"<script>
                            alert('Usuario ou Senha invalidos')
                        </script>";
               }
            }else{
                echo "<script>
                        alert('Usuario nao cadastrado. Crie uma conta')
                    </script>";
            }

        }else{
            if( isset($_POST['btnCadastrar'])){
                $contato->insertUser($nome, $email, $senha);
            }else{
                exit;
            }
        }
    }

}
