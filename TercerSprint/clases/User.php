<?php
class User {

    private $username;
    private $email;
    private $password;
    private $fotoPerfil;

    // Creamos un array que va a representar a nuestro usuario y lo devolvemos.
    public function __construct(String $username, String $email, String $password, String $fotoPerfil = "")
    {
            $this->setUsername($username);
            $this->setEmail($email);
            $this->setPassword($password);
            $this->setFotoPerfil($fotoPerfil);
    }

    /**
     * Get the value of username
     */ 
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */ 
    public function setUsername(String $username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail(String $email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword(String $password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of fotoPerfil
     */ 
    public function getFotoPerfil()
    {
        return $this->fotoPerfil;
    }

    /**
     * Set the value of fotoPerfil
     *
     * @return  self
     */ 
    public function setFotoPerfil(String $fotoPerfil)
    {
        $this->fotoPerfil = $fotoPerfil;

        return $this;
    }
}

?>