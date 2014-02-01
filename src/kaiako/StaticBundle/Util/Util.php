<?php

namespace eurotransportcar\StaticBundle\Util;
use \DateTime;

class Util
{
    static public function getSlug($cadena, $separador = '-')
    {
        $slug = iconv('UTF-8', 'ASCII//TRANSLIT', $cadena);
        $slug = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $slug);
        $slug = strtolower(trim($slug, $separador));
        $slug = preg_replace("/[\/_|+ -]+/", $separador, $slug);
        return $slug;
    }
    
    /*
     * Si el campo recibido no es null, lo devuelve. Si no, devuelve null
     */
    static public function valueOrNull($field)
    {
        if ($field != "")
            return $field;  
        else
            return null;
    }
    
    /*
     * Si el campo recibido no es null, lo devuelve formateado en fecha. Si no, devuelve null
     */
    static public function dateOrNull($field)
    {
        if ($field != "")
            return DateTime::createFromFormat('d/m/Y H:i', $field); 
        else
            return null;
    }    
}