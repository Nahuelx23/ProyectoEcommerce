<?php
class User {

    private $username;
    private $email;
    private $password;
    private $fotoPerfil;

    public function __construct(String $username, String $email, String $password, String $fotoPerfil = "")
    {
            $this->setUsername($username);
            $this->setEmail($email);
            $this->setPassword($password);
            $this->setFotoPerfil($fotoPerfil);
    }
   
    public function getUsername()
    {
        return $this->username;
    }
    
    public function setUsername(String $username)
    {
        $this->username = $username;

        return $this;
    }
    
    public function getEmail()
    {
        return $this->email;
    }
     
    public function setEmail(String $email)
    {
        $this->email = $email;

        return $this;
    }
     
    public function getPassword()
    {
        return $this->password;
    }
     
    public function setPassword(String $password)
    {
        $this->password = $password;

        return $this;
    }
     
    public function getFotoPerfil()
    {
        return $this->fotoPerfil;
    }
    
    public function setFotoPerfil(String $fotoPerfil)
    {
        $this->fotoPerfil = $fotoPerfil;

        return $this;
    }
}

?>