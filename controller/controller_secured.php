<?php
class controller_secured{
    static function start(){
        if(session_status()==PHP_SESSION_NONE){
            session_start();
            
            if(isset($_SESSION['tiempo']) ) {

                
                $inactivo = 600;
        
                $vida_session = time() - $_SESSION['tiempo'];
        
                 
                    if($vida_session > $inactivo)
                    {
                        
                 
                        session_destroy();              
                        
                        header("Location:".URL_BASE.'/login');
        
                        DIE();
                    }
                    $_SESSION['tiempo'] = time();
            }
            
        }
    }
    
    function verify_user($user,$pass,$dbuser)
    {   
        $this->start();
        if (password_verify($pass,$dbuser->password)){
            
           $_SESSION['user']=$user;
           $_SESSION['tiempo'] = time();
           $_SESSION['loged']=true;     
    }else{
        $_SESSION['loged']=false; 
    }
   
    }
    function wall(){
        $this->start();
        if(!isset($_SESSION['loged'])){
            header('location:'.URL_BASE.'/login');
            DIE();
        }
    }
    function get_loged(){
        $this->start();
        if(!isset($_SESSION['loged'])){
            return false;
        }else{
            return $_SESSION['loged'];
        } 
    }
    
    function destroy(){
        $this->start();
        session_destroy();
    }
}
?>