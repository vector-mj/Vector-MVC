<?php
class Database{
    private $Log='connected';
    private $isConnect = true;
    private $connection;
    private $allPages;
    private $allItems;
    public function __construct($host=DB_HOST,$dbname=DB_NAME,$username=DB_USER,$password=DB_PASSWORD){
        try{
            $dsn = 'mysql:host='.$host.';dbname='.DB_NAME.';charset=utf8';
            $this->connection = new PDO($dsn,$username,$password,array(PDO::ATTR_EMULATE_PREPARES=>false,PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        }catch(PDOException $e){
            $this->Log = $e->getMessage();
            $this->isConnect = false;
        }
        return $this->connection;
    }
    public function getLog(){
        return $this->Log;
    }
    public function isConnect(){
        return $this->isConnect;
    }
    public function getAllpage(){
        return $this->allPages;
    }
    public function getAllItems(){
        return $this->allItems;
    }
    public function getConnection(){
        return $this->connection;
    }
    public function Select($table,$params=['*'],$where=null){
        if($this->isConnect){
            count($params)>1?$_params = implode(',',$params):$_params=$params[0];
            $query = "SELECT $_params From $table ";
            if($where != null){
                $sates=[];
                foreach($where as $index=>$value){
                    $sates[]="$index='$value'";
                }
                $_where=implode(' AND ',$sates);
                $query.="WHERE $_where";
            }
            try{
                $sth = $this->connection->prepare($query)?$this->connection->prepare($query):null;
                $sth->execute();
                $res = $sth->fetchAll();
                return $res;
            }catch(PDOException $e){
                return $e->getMessage();
            }
        }
    }
    public function Insert($table,$params=['*'],$values){
        if($this->isConnect){
            count($params)>1?$_params = implode(',',$params):$_params=$params[0];
            $_params ="($_params)";
            $query = "INSERT INTO $table $_params VALUES ";
            if($values != null){
                $sates=[];
                foreach($values as $value){
                    $value!=null?$sates[]="'$value'":$sates[]="null";
                }
                $_where=implode(' , ',$sates);
                $query.="($_where)";
            }
            try{
                $sth = $this->connection->prepare($query)?$this->connection->prepare($query):null;
                $sth->execute();
                $res = $sth->fetchAll();
                return $res;
            }catch(PDOException $e){
                return $e->getMessage();
            }
        }
    }
    public function Update($table,$params=[],$where=[]){
        if($this->isConnect){
            count($params)>1?$_params = implode(',',$params):$_params=$params[0];
            $query = "UPDATE $table SET ";
            if($params != null){
                $sates=[];
                foreach($params as $index=>$value){
                    $sates[]="$index='$value'";
                }
                $params=implode(' , ',$sates);
                $query.=" $params";
            }
            if($where != null){
                $sates=[];
                foreach($where as $index=>$value){
                    $sates[]="$index='$value'";
                }
                $_where=implode(' AND ',$sates);
                $query.=" WHERE $_where";
            }
            try{
                $sth = $this->connection->prepare($query)?$this->connection->prepare($query):null;
                $sth->execute();
                $res = $sth->fetchAll();
                return $res;
            }catch(PDOException $e){
                return $e->getMessage();
            }
        }
    }
    public function Delete($table,$where){
        if($this->isConnect){
            $query = "DELETE From $table ";
            if($where != null){
                $sates=[];
                foreach($where as $index=>$value){
                    $sates[]="$index='$value'";
                }
                $_where=implode(' AND ',$sates);
                $query.="WHERE $_where";
            }
            try{
                $sth = $this->connection->prepare($query)?$this->connection->prepare($query):null;
                $sth->execute();
                $res = $sth->fetchAll();
                return $res;
            }catch(PDOException $e){
                return $e->getMessage();
            }
        }
    }
    public function pagiNation($table,$page=2,$items=3){
        $sql = "SELECT COUNT(*) FROM $table";
        $stm = $this->connection->prepare($sql);
        $stm->execute();
        $this->allItems=$stm->fetchAll()[0][0];
        $this->allPages=ceil($this->allItems/$items);
        if($page*$items>$this->allItems){
            $_offset=($page*$items)-$items;
            $items=$this->allItems%$items;
        }else{
            $_offset=($page*$items);
        }
        // $_offset=($page*$items)-$items;
        $stml = $this->connection->prepare("SELECT * FROM $table LIMIT $_offset,$items");
        $stml->execute(); 
        return json_encode($stml->fetchAll());
    }
}
?>