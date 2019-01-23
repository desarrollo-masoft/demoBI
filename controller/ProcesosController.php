<?php
class ProcesosController extends ControladorBase{
    
    public function __construct() {
        parent::__construct();
    }

    public function index(){
        session_start();
        $this->View("Procesos",array());
        
    }
    
    public function generarCode(){
        
        include dirname(__FILE__).'\pdf417.php';
        
        $pdf417 = new PDF417("Danny",1,2);
        
        echo dirname(__FILE__); echo '<br>';
        
        echo (defined('__FILE__') ? '__FILE__ is defined' : '__FILE__ is NOT defined' . PHP_EOL); 
        
        //$
        
    }
    
    public function generacb(){
        
        
    }
    
    public function verwizard(){
        session_start();
        $this->View("FormWizard",array());
    }
    
    public function verwizard2(){
        session_start();
        $this->View("FormWizard2",array());
    }
    
    public function buscanivel2(){
        
        $nivel2 = new Nivel2Model();
        
        $nombre_nivel = (isset($_REQUEST['nombre_nivel']))?$_REQUEST['nombre_nivel']:'';
        
        $respuesta =new stdClass();
        
        if($nombre_nivel!=''){
            
            $nombre_nivel = strtoupper($nombre_nivel);
            
            $where = "nombre_nivel2='$nombre_nivel'";
            
            $resulset = $nivel2->getCondiciones("*","nivel2",$where,"nombre_nivel2");
            
            if(!empty($resulset)){
                if(is_array($resulset)){
                    if(count($resulset)>0){
                        $respuesta=$resulset;
                    }
                }
                
            }
        }
        
        echo json_encode($respuesta);
        
    }
    
    public function buscanivel1(){
        
        $nivel2 = new Nivel2Model();
        
        $nombre_nivel = (isset($_REQUEST['nombre_nivel']))?$_REQUEST['nombre_nivel']:'';
        $_id_nivel2 = (isset($_REQUEST['codigo_nivel2']))?$_REQUEST['codigo_nivel2']:'';
        
        $respuesta =new stdClass();
        
        
        if($nombre_nivel!=''){
            
            $nombre_nivel = strtoupper($nombre_nivel);
            
            $where = "nombre_nivel1='$nombre_nivel' AND id_nivel2='$_id_nivel2'";
            
            $resulset = $nivel2->getCondiciones("*","nivel1",$where,"nombre_nivel1");
            
            if(!empty($resulset)){
                if(is_array($resulset)){
                    if(count($resulset)>0){
                        $respuesta=$resulset;
                    }
                }
                
            }
        }
        
        echo json_encode($respuesta);
        
    }
    
    public function buscanivel0(){
        
        $nivel2 = new Nivel2Model();
        
        $nombre_nivel = (isset($_REQUEST['nombre_nivel']))?$_REQUEST['nombre_nivel']:'';
                
        $respuesta =new stdClass();
        
        
        if($nombre_nivel!=''){
            
            $nombre_nivel = strtoupper($nombre_nivel);
            
            $where = "nombre_nivel0='$nombre_nivel' ";
            
            $resulset = $nivel2->getCondiciones("*","nivel0",$where,"nombre_nivel0");
            
            if(!empty($resulset)){
                if(is_array($resulset)){
                    if(count($resulset)>0){
                        $respuesta=$resulset;
                    }
                }
                
            }
        }
        
        echo json_encode($respuesta);
        
    }
    
    public function generapdf(){
        $respuesta = new stdClass();
        $nivel2 = new Nivel2Model();
        $clientes = new ClientesModel();
        
        $documento = new DocumentoModel();
        
        $_id_nivel2 = (isset($_REQUEST['id_nivel2']))?$_REQUEST['id_nivel2']:'';
        $_id_nivel1 = (isset($_REQUEST['id_nivel1']))?$_REQUEST['id_nivel1']:'';
        $_id_nivel0 = (isset($_REQUEST['id_nivel0']))?$_REQUEST['id_nivel0']:'';
        $_id_clientes = (isset($_REQUEST['id_clientes']))?$_REQUEST['id_clientes']:'';
        
        $columnas = "nivel2.nombre_nivel2,
                    nivel2.codigo_nivel2,
                    nivel1.nombre_nivel1,
                    nivel1.codigo_nivel1,
                    nivel2.id_nivel2,
                    nivel1.id_nivel1";
        
        $tablas = "public.nivel1, public.nivel2";
        
        $where = "nivel1.id_nivel2 = nivel2.id_nivel2 AND nivel1.id_nivel1=$_id_nivel1";
        
        $rsniveles = $nivel2->getCondiciones($columnas,$tablas,$where,"nivel1.id_nivel1");
        
        $rsclientes = $clientes->getBy("id_clientes=$_id_clientes");
        
        $rsnivel0 = $nivel2->getCondiciones("*","nivel0","id_nivel0=$_id_nivel0","nivel1.id_nivel1");
        
        
        //valores de bd
        
        $identificacion = $rsclientes[0]->identificacion_clientes;
        $numero_solicitud = "";
        $nombre_nivel2 =  $rsniveles[0]->nombre_nivel2;
        $nombre_nivel1 =  $rsniveles[0]->nombre_nivel1;
        $nombre_nivel0 =  $rsnivel0[0]->nombre_nivel0;
        
        $code=$identificacion.','.$numero_solicitud.','.$nombre_nivel2.','.$nombre_nivel1.','.$nombre_nivel0;
        
        require dirname(__FILE__).'\..\view\fpdf\fpdf.php';
        include dirname(__FILE__).'\barcode.php';
        
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetAutoPageBreak(true, 20);
        $y = $pdf->GetY();
        
        $ubicacion =   dirname(__FILE__).'\..\view\images\codebar'.'\\'.$i.'.png';
        barcode($ubicacion, $code, 20, 'horizontal', 'code128', true);
        $pdf->Image($ubicacion,10,$y,50,0,'PNG');
        $y = $y+15;
        
        $pdf->Output();
        
        
       /* $funcion = "";
        $parametros = "";
        
        $documento->setFuncion=$funcion;
        $documento->getParametros=$parametros;
        $rsrespuesta=$documento->Insert();*/

         
    }
    
    public function vercode(){
        
        //echo dirname(__FILE__).'\..\view\fpdf\fpdf.php';
        
        require dirname(__FILE__).'\..\view\fpdf\fpdf.php';
        include dirname(__FILE__).'\barcode.php'; 
        
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetAutoPageBreak(true, 20);
        $y = $pdf->GetY();
        
        $clientes = new ClientesModel();
       
        $resultset = $clientes->getCondiciones("*","clientes","1=1","id_clientes");
        
        $i=0;
        
        foreach ($resultset as $res){
            $i++;
            $code = $res->nombres_clientes;
            $ubicacion =   dirname(__FILE__).'\..\view\images\codebar'.'\\'.$i.'.png';
            barcode($ubicacion, $code, 20, 'horizontal', 'code128', true);
            $pdf->Image($ubicacion,10,$y,50,0,'PNG');
            $y = $y+15;
        }
        
        
        $pdf->Output();
    }
    
    public function verdata(){
        
        //echo dirname(__FILE__).'\..\view\fpdf\fpdf.php';
       
        
        $clientes = new ClientesModel();
        
        $resultset = $clientes->getCondiciones("*","clientes","1=1","id_clientes");
        
        $i=0;
        
        foreach ($resultset as $res){
            $i++;
            $code = $res->nombres_clientes;
            $ubicacion =   dirname(__FILE__).'\..\view\images'.'\\'.$i.'.png';
            
        echo $ubicacion;
        
        }
        
       
    }

}
?>