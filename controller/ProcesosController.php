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
    
    public function indexpdf(){
        session_start();
        $this->View("FormWizard",array());
        
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
    
    public function generapdfnt(){

        $respuesta = new stdClass();
        $nivel2 = new Nivel2Model();
        $clientes = new ClientesModel();
        
        $documento = new DocumentoModel();
        
        $_id_nivel2 = (isset($_REQUEST['id_nivel2']))?$_REQUEST['id_nivel2']:'';
        $_id_nivel1 = (isset($_REQUEST['id_nivel1']))?$_REQUEST['id_nivel1']:'';
        $_id_nivel0 = (isset($_REQUEST['id_nivel0']))?$_REQUEST['id_nivel0']:'';
        $_id_clientes = (isset($_REQUEST['id_clientes']))?$_REQUEST['id_clientes']:'';
        $_num_propuesta = (isset($_REQUEST['num_propuesta']))?$_REQUEST['num_propuesta']:'';
        $_tipo_solicitud = (isset($_REQUEST['tipo_solicitud']))?$_REQUEST['tipo_solicitud']:'';
        
        if($_id_nivel1!='' && $_id_nivel0!='' && $_id_clientes!='' && $_id_nivel2!='' )
        {
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
            
            $rsnivel0 = $nivel2->getCondiciones("*","nivel0","id_nivel0=$_id_nivel0","nivel0.id_nivel0");

            $rsconsecutivos = $nivel2->getCondiciones("*","consecutivos","nombre_consecutivos='BARCODE'","id_consecutivos");
            
            //print_r($rsclientes); echo "<br>";
            //print_r($rsnivel0); echo "<br>";
            //print_r($rsniveles); echo "<br>";
            
            //die("");
            //valores de bd
            
            $identificacion = $rsclientes[0]->identificacion_clientes;
            $numero_solicitud = $_num_propuesta;
            //$nombre_nivel2 =  $rsniveles[0]->nombre_nivel2;
            //$nombre_nivel1 =  $rsniveles[0]->nombre_nivel1;
            $nombre_nivel0 =  $rsnivel0[0]->nombre_nivel0;
            $nombreimagen =  $rsconsecutivos[0]->real_consecutivos;
            $tiposolicitud = $_tipo_solicitud;

            $id_nivel2 =  $rsniveles[0]->id_nivel2;
            $id_nivel1 =  $rsniveles[0]->id_nivel1;
            $id_nivel0 =  $rsnivel0[0]->id_nivel0;
            
            //$code=$identificacion.','.$numero_solicitud.','.$nombre_nivel2.','.$nombre_nivel1.','.$nombre_nivel0;

            $code=$id_nivel2.','.$id_nivel1.','.$id_nivel0.','.$tiposolicitud.','.$identificacion.','.$numero_solicitud;
            
            require dirname(__FILE__).'\..\view\fpdf\fpdf.php';
            include dirname(__FILE__).'\barcode.php';
            
            $pdf = new FPDF();
            $pdf->AddPage();
            $pdf->SetAutoPageBreak(true, 20);

            //para ubicaciones 

            $y = $pdf->GetY();
            //$x = $pdf->GetX();
            $mid_x = $pdf->GetPageWidth() / 2;
            $octavo_y = $pdf->GetPageHeight()/3;
            

            
            $ubicacion =   dirname(__FILE__).'\..\view\images\barcode'.'\\'.$nombreimagen.'.png';
            barcode($ubicacion, $code, 20, 'horizontal', 'code128', true);
            //array('text' => $code, 'drawText' => false)
            $pdf->SetFont('Arial','',15);
            $pdf->SetXY(20, 25);
            $pdf->Cell(0,20, $pdf->Image($ubicacion, $mid_x-50, $pdf->GetY(),100,20,'PNG'),0);
            //$pdf->Image($ubicacion,80,$y,100,0,'PNG');
            //$y = $y+15;

            $pdf->SetFont('Arial','',60);
            //$y = $pdf->GetY();
            $pdf->SetXY(20, $y+90);
            $pdf->MultiCell(0,30, $nombre_nivel0 ,1,'C');
            //$pdf->MultiCell(0,0, $pdf->Text(20,$octavo_y,$nombre_nivel0),0,'C');
            //$pdf->Text($mid_x - ($pdf->GetStringWidth($nombre_nivel0) / 2), $octavo_y, $nombre_nivel0);
            
            $pdf->Output();
            
            
        /* $funcion = "";
            $parametros = "";
            
            $documento->setFuncion=$funcion;
            $documento->getParametros=$parametros;
            $rsrespuesta=$documento->Insert();*/

        }

         
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
        $_num_propuesta = (isset($_REQUEST['num_propuesta']))?$_REQUEST['num_propuesta']:'';
        $_tipo_solicitud = (isset($_REQUEST['tipo_solicitud']))?$_REQUEST['tipo_solicitud']:'';
        
        if($_id_nivel1!='' && $_id_nivel0!='' && $_id_clientes!='' && $_id_nivel2!='' )
        {
            $columnas = "nivel2.nombre_nivel2,
                        nivel2.codigo_nivel2,
                        nivel1.nombre_nivel1,
                        nivel1.codigo_nivel1,
                        nivel2.id_nivel2,
                        nivel1.id_nivel1";
            
            $tablas = "public.nivel1, public.nivel2";
            
            $where = "nivel1.id_nivel2 = nivel2.id_nivel2 AND nivel1.id_nivel1=$_id_nivel1";
            
            $rsniveles = $nivel2->getCondiciones($columnas,$tablas,$where,"nivel1.id_nivel1");
            
            $identificacion="";
            if((int)$_id_clientes>0)
            {
                $rsclientes = $clientes->getBy("id_clientes=$_id_clientes");
                $identificacion = $rsclientes[0]->identificacion_clientes;
            }else{
                $identificacion = (isset($_REQUEST['cedula_clientes']))?$_REQUEST['cedula_clientes']:'';
            }
            
            //$rsnivel0 = $nivel2->getCondiciones("*","nivel0","id_nivel0=$_id_nivel0","nivel0.id_nivel0");
            
            $rsconsecutivos = $nivel2->getCondiciones("*","consecutivos","nombre_consecutivos='BARCODE'","id_consecutivos");
            
            //print_r($rsclientes); echo "<br>";
            //print_r($rsnivel0); echo "<br>";
            //print_r($rsniveles); echo "<br>";
            
            //die("");
            //valores de bd
            
            
            $numero_solicitud = $_num_propuesta;
            //$nombre_nivel2 =  $rsniveles[0]->nombre_nivel2;
            //$nombre_nivel1 =  $rsniveles[0]->nombre_nivel1;
            //$nombre_nivel0 =  $rsnivel0[0]->nombre_nivel0;
            $nombreimagen =  $rsconsecutivos[0]->real_consecutivos;
            $tiposolicitud = strtoupper($_tipo_solicitud);
            
            $id_nivel2 =  $rsniveles[0]->id_nivel2;
            $id_nivel1 =  $rsniveles[0]->id_nivel1;
            //$id_nivel0 =  $rsnivel0[0]->id_nivel0;
            
            //$code=$identificacion.','.$numero_solicitud.','.$nombre_nivel2.','.$nombre_nivel1.','.$nombre_nivel0;
            
           
            
            require dirname(__FILE__).'\..\view\fpdf\fpdf.php';
            //--include dirname(__FILE__).'\barcode.php';
            require dirname(__FILE__)."\phpqrcode\qrlib.php";
            
            
            /*comienza creacion de archivos*/
            
            $nivel0 = new Nivel0Model();
            $rsnivel0=$nivel0->getBy("1=1");
            
            $pdf = new FPDF();  
            
            if(!empty($rsnivel0)){
                if(is_array($rsnivel0)){
                    $i=0;
                    foreach ($rsnivel0 as $res){
                        $pdf->AddPage();
                        $pdf->SetAutoPageBreak(true, 20);
                        
                        //para ubicaciones
                        
                        $y = $pdf->GetY();
                        //$x = $pdf->GetX();
                        $mid_x = $pdf->GetPageWidth() / 2;
                        $octavo_y = $pdf->GetPageHeight()/3;
                        
                        //Declaramos una carpeta temporal para guardar la imagenes generadas                        
                        $dir = dirname(__FILE__).'\..\view\images\qrcode\\';
                        
                        //Si no existe la carpeta la creamos
                        if (!file_exists($dir))
                         mkdir($dir);
                         
                         //Declaramos la ruta y nombre del archivo a generar
                         
                         //se aumente en numero la de nombre
                         $i++;
                         $filename = $dir.$i.'.png';
                         
                         //para el code
                         $id_nivel0=$res->id_nivel0;
                         $nombre_nivel0=$res->nombre_nivel0;
                         $code='SONDA,'.$id_nivel2.','.$id_nivel1.','.$id_nivel0.','.$tiposolicitud.','.$identificacion.','.$numero_solicitud;
                         
                         //Parametros de Condiguraci�n
                         
                         $tama�o = 10; //Tama�o de Pixel
                         $level = 'L'; //Precisi�n Baja
                         $framSize = 3; //Tama�o en blanco
                         $contenido = $code; //Texto
                         
                         
                         
                         //Enviamos los parametros a la Funci�n para generar c�digo QR
                         QRcode::png($contenido, $filename, $level, $tama�o, $framSize);
                         
                         //--$ubicacion =   dirname(__FILE__).'\..\view\images\barcode'.'\\'.$nombreimagen.'.png';
                         //--barcode($ubicacion, $code, 20, 'horizontal', 'code128', true);
                         //array('text' => $code, 'drawText' => false)
                         $pdf->SetFont('Arial','',15);
                         $pdf->SetXY(20, 40);
                         $pdf->Cell(0,20, $pdf->Image($filename, $mid_x-20, $pdf->GetY(),40,40,'PNG'),0);
                         //$pdf->Image($ubicacion,80,$y,100,0,'PNG');
                         //$y = $y+15;
                         
                         $pdf->SetFont('Arial','',50);
                         //$y = $pdf->GetY();
                         $pdf->SetXY(20, $y+90);
                         $pdf->MultiCell(0,30, utf8_decode($nombre_nivel0) ,1,'C');
                         
                    }
                }
            }
            
            
            /*$pdf = new FPDF();
            $pdf->AddPage();
            $pdf->SetAutoPageBreak(true, 20);*/
            
            //para ubicaciones
            
            //**$y = $pdf->GetY();
            //$x = $pdf->GetX();
            //**$mid_x = $pdf->GetPageWidth() / 2;
            //*$octavo_y = $pdf->GetPageHeight()/3;
            
            //Declaramos una carpeta temporal para guardar la imagenes generadas
            //**$dir = dirname(__FILE__).'\..\view\images\qrcode\\';
            
            //Si no existe la carpeta la creamos
            /*if (!file_exists($dir))
                mkdir($dir);
                
                //Declaramos la ruta y nombre del archivo a generar
                $filename = $dir.'test.png';
                
                //Parametros de Condiguraci�n
                
                $tama�o = 10; //Tama�o de Pixel
                $level = 'L'; //Precisi�n Baja
                $framSize = 3; //Tama�o en blanco
                $contenido = $code; //Texto
                
                //Enviamos los parametros a la Funci�n para generar c�digo QR
                QRcode::png($contenido, $filename, $level, $tama�o, $framSize);*/
            
            
            
            //--$ubicacion =   dirname(__FILE__).'\..\view\images\barcode'.'\\'.$nombreimagen.'.png';
            //--barcode($ubicacion, $code, 20, 'horizontal', 'code128', true);
            //array('text' => $code, 'drawText' => false)
            //*$pdf->SetFont('Arial','',15);
            //*$pdf->SetXY(20, 25);
            //*$pdf->Cell(0,20, $pdf->Image($filename, $mid_x-30, $pdf->GetY(),60,60,'PNG'),0);
            //$pdf->Image($ubicacion,80,$y,100,0,'PNG');
            //$y = $y+15;
            
            //***$pdf->SetFont('Arial','',60);
            //$y = $pdf->GetY();
            //*$pdf->SetXY(20, $y+90);
            //**$pdf->MultiCell(0,30, $nombre_nivel0 ,1,'C');
            //$pdf->MultiCell(0,0, $pdf->Text(20,$octavo_y,$nombre_nivel0),0,'C');
            //$pdf->Text($mid_x - ($pdf->GetStringWidth($nombre_nivel0) / 2), $octavo_y, $nombre_nivel0);
            
            $pdf->Output();
            
            
                
            
            /* $funcion = "";
             $parametros = "";
             
             $documento->setFuncion=$funcion;
             $documento->getParametros=$parametros;
             $rsrespuesta=$documento->Insert();*/
            
        }else{
            $this->redirect("Procesos","indexpdf");
        }
        
        
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
    
    public function verqr(){
        
        require dirname(__FILE__)."\phpqrcode\qrlib.php";
        
        //Declaramos una carpeta temporal para guardar la imagenes generadas
        $dir = dirname(__FILE__).'\..\view\images\qrcode\\';
        
        //Si no existe la carpeta la creamos
        if (!file_exists($dir))
            mkdir($dir);
            
            //Declaramos la ruta y nombre del archivo a generar
            $filename = $dir.'test.png';
            
            //Parametros de Condiguraci�n
            
            $tama�o = 10; //Tama�o de Pixel
            $level = 'L'; //Precisi�n Baja
            $framSize = 3; //Tama�o en blanco
            $contenido = "http://codigosdeprogramacion.com"; //Texto
            
            //Enviamos los parametros a la Funci�n para generar c�digo QR
            QRcode::png($contenido, $filename, $level, $tama�o, $framSize);
            
            //Mostramos la imagen generada
            echo '<img src="'.$dir.$filename.'" /><hr/>';
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