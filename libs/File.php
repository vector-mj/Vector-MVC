<?php
class File{
    private $ext=[];
    private $size;
    private $path;
    private $Error;
    private $fileUploaded = false;
    public function __construct($ext=[],$maxSizeMb,$path){
        $this->ext = $ext;
        $this->size = $maxSizeMb*1000000;
        $this->path = $path;
        !is_dir($this->path)?mkdir($this->path,null,true):null;
    }
    public function setSize($size){
        $this->size = $size;
    }
    public function getSize(){
        return $this->size;
    }
    public function setPath($path){
        $this->path = $path;
    }
    public function getPath(){
        return $this->path;
    }
    public function setext($ext=[]){
        $this->ext = $ext;
    }
    public function showError(){
        return $this->Error;
    }
    public function UploadFile($file,$name,$maxSizeMb){
        if($file['name']!=''){
            $this->size = $maxSizeMb*1000000;
            !is_dir($this->path)?mkdir($this->path,null,true):null;
            @$fileExt=end((explode('.',$file['name'])));
            if(in_array($fileExt,$this->ext)){
                if($file['size']<=$this->size){
                    $this->fileUploaded=move_uploaded_file($file['tmp_name'],(rtrim($this->path,'/')).'/'.$name.'.'.$fileExt);
                }else{
                    $this->Error="File size is not valid";
                    return false;
                }
            }else{
                $this->Error="File extension is not valid";
                return false;
            }
        }
    }
    public function DeleteFile($path,$fileName,$clearDir=false){
        file_exists(rtrim($path,'/').'/'.$fileName)?unlink(rtrim($path,'/').'/'.$fileName):null;
        $pattern = rtrim($path,'/').'/*';
        $clearDir?array_map('unlink',glob($pattern)):null;
    }
    public function RemoveDir($path){
        if(is_dir($path)){
            $pattern = rtrim($path,'/').'/*';
            array_map('unlink',glob($pattern));
            rmdir($path);
        }
    }
}
?>