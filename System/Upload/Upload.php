<?php

namespace Master\Upload;


class Upload {

    
    /**
     * file
     *
     * @var mixed
     */
    private $file;
    
    
    /**
     * name
     *
     * @var mixed
     */
    private $name;

    
    /**
     * size
     *
     * @var mixed
     */
    private $size;

    
    /**
     * directory
     *
     * @var mixed
     */
    private $directory;

    
    /**
     * folder
     *
     * @var mixed
     */
    private $folder;

    
    /**
     * result
     *
     * @var mixed
     */
    private $result;

    
    /**
     * error
     *
     * @var mixed
     */
    private $error;

    
    /**
     * Method __construct
     *
     * @param $directory $directory [explicite description]
     *
     * @return void
     */
    public function __construct($directory = null)
    {
        $this->directory = ($directory) ? $directory : "Public/uploads";
        
        if ( ! file_exists ($this->directory) && ! is_dir( $this->directory ) )
        {

            mkdir($this->directory, 0777);

        }

    }

    
    /**
     * Method setFolder
     *
     * @param string $folder [explicite description]
     *
     * @return void
     */
    public function setFolder(string $folder)
    {

        $this->folder = $folder;
        
    }
    
    /**
     * Method rename_file
     *
     * @return void
     */
    public function rename_file(): void
    {
        $file = $this->name . strchr($this->file["name"], '.');

        if (file_exists($this->directory . DIRECTORY_SEPARATOR . $file))
        {
            $file = $this->name . '-' . time() . '-' . rand(100000,999999) . '-' . uniqid() . '-' . date('Y-m-d') . '-' . date('H:i:s') . strchr($this->file["name"],'.');
        }

        $this->name = $file;

    }

    
    /**
     * Method image
     *
     * @param array $image [explicite description]
     * @param string $name [explicite description]
     * @param int $size [explicite description]
     * @param $validExtensions $validExtensions [explicite description]
     * @param $typeValid $typeValid [explicite description]
     *
     * @return void
     */
    public function image(array $image, string $name = null, int $size = null,$validExtensions = null,$typeValid =null) : void
    {
        $this->file = $image;

        $this->name = $name ?? pathinfo($this->file["name"],PATHINFO_FILENAME);
        
        $this->size = $size ?? 1;
        
        $validExtensions = ($validExtensions) ? $validExtensions : ['png','jpg'];

        $typeValid = ($typeValid) ? $typeValid : ['image/jpeg', 'image/png', 'text/plain', 'audio/mpeg'];

        $extension = pathinfo($this->file["name"], PATHINFO_EXTENSION);

        if (!in_array($extension, $validExtensions))
        {
            $this->error = "A extenssão não é permitida.";
            $this->result = false;
        }

        elseif (!in_array($this->file["type"], $typeValid))
        {
            $this->error = "Tipo inválido.";
            $this->result = false;
        }

        elseif ($this->file["size"] > $this->size * (1024 * 1024))
        {

            $this->error = "Arquivo muito grande";
            $this->result = false;

        }

        else{
            $this->rename_file();
            $this->move_uploaded_file();
        }

    }
    
    /**
     * Method move_uploaded_file
     *
     * @return void
     */
    public function move_uploaded_file() : void
    {
        if (move_uploaded_file($this->file["tmp_name"],$this->directory . DIRECTORY_SEPARATOR . $this->name))
        {
            $this->result = $this->name;
        } else {
            $this->result = false;
            $this->error = "Erro ao mover arquivo";
        }
    }

    
    /**
     * Method getName
     *
     * @return string
     */
    public function getName ():string | bool
    {

        return $this->result;

    }

    
    /**
     * Method getError
     *
     * @return string
     */
    public function getError():string | null
    {

        return $this->error;

    }
    

}