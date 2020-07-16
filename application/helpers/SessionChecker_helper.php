<?php
                 
    function sesion_requerida()
    {
        if(isset($_SESSION['id']))
        {

        }
        else if(!isset($_SESSION['id']))
        {
            redirect((base_url()).'seguridad');
        }
    } 

    function no_sesion_requerida()
    {
        if(isset($_SESSION['id']))
        {
            redirect(base_url());
        }
        else if(!isset($_SESSION['id']))
        {
            
        }
    }
    
    function rol_admin_requerido()
    {
        if(isset($_SESSION['id']))
        {
            if($_SESSION['rol'] == 1)
            {

            }
            else
            {
                redirect(base_url());
            }
        }
        else
        {
            redirect((base_url()).'seguridad');
        }
    }

    function isAdmin()
    {
        if(isset($_SESSION['id']))
        {
            if($_SESSION['rol'] == 1)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }

?>