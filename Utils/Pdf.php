<?php namespace Utils;

	use Models\Resume as Resume;
	use Models\Student as Student;
	use Utils\Utils as Utils;
	use Config\Config as Config;



	require __DIR__.'/vendor/autoload.php';

	use Spipu\Html2Pdf\Html2Pdf;

	class Pdf{

		//replicada per problema autoloader del html2pdf i el de l'app
		public function mysqlToDate($var){
 			return preg_replace("/([0-9]{4})\-([0-9]{2})\-([0-9]{2})/","$3/$2/$1",$var);
 		}

		public function generate($alumne, $curriculum, $file=""){
			try {
				$default_img = Config::$default_user_image;
			    ob_start();
			    include dirname(__FILE__).'/curriculum.php';
			    $content = ob_get_clean();
			    $html2pdf = new Html2Pdf('P', 'A4', 'es');
			    $html2pdf->setDefaultFont('Arial');
			    $html2pdf->writeHTML($content);
			    if($file){
			    	$html2pdf->Output(ROOT."pdfs/".$alumne->get("id").'.pdf','F');
				}else{
					$html2pdf->Output('curriculum.pdf');
				}
			} catch (Html2PdfException $e) {
			    $formatter = new ExceptionFormatter($e);
			    echo $formatter->getHtmlMessage();
			}
		}


	}

?>