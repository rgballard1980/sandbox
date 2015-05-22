<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of file_uploader
 *
 * @author RGBallard
 */
class FileUploader 
{
    function __construct() 
    {
        
    }
    
    public static function view()
    {
        ?>

        <form action='' method="post" enctype="multipart/form-data">
            <input type='file' name='upload_file' /><br>
            <input type="submit" name='submit' value='UPLOAD'/>
        </form>
        
        <?php
								
								return $_FILES;
    }
    
    public static function process_file()
    {
        $excepted_extentions = array('jpg', 'jpeg', 'gif', 'png');
        
        $incoming_file = $_FILES['upload_file'];
        
    }
}
