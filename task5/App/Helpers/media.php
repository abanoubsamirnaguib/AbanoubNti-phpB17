<?php
namespace App\Helpers;

class media {
    private array $file;
    private array $errors = [];
    private string $fileType;
    private string $fileExtension;
    public string $newFileName;
    public string $newFilePath;
    public function __construct(array $file) {
        $this->file = $file;
        $typeArray = explode('/',$file['type']);
        $this->fileType = $typeArray[0]; 
        $this->fileExtension = $typeArray[1]; 
    }

    public function getfileType()
    {
        return $this->fileType;
    }
    public function getfileExtension()
    {
        return $this->fileExtension;
    }

    public function size(int $maxSize) :self
    {
        if($this->file['size'] > $maxSize){
            $this->errors[$this->fileType][__FUNCTION__] = "Maximum Size Must Be Less Than {$maxSize} Bytes";
        }
        return $this;
    }
    public function extension(string $avalExtensions) :self
    {
        if(!in_array($this->fileExtension,explode(',',$avalExtensions))){
            $this->errors[$this->fileType][__FUNCTION__] = "Available Extensions Are {$avalExtensions}";
        }
        return $this;
    }

    public function getError(string $key) :?string
    {
        if(isset($this->errors[$this->fileType][$key])){
            return self::template($this->errors[$this->fileType][$key]);
        }
        return null;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function upload(string $pathTo) :bool
    {
        $this->newFileName = uniqid() .'.' . $this->fileExtension; //123a2sa1da2sd.jpeg
        $this->newFilePath = $pathTo . $this->newFileName;
        return move_uploaded_file($this->file['tmp_name'],$this->newFilePath);
    }

    public static function template(string $value)
    {
        return "<p class='text-danger font-weight-bold'>{$value}</p>";
    }

    public static function delete(string $Path) :bool
    {
       if(file_exists($Path)){
            unlink($Path);
            return true;
       }
       return false;
    }
}


