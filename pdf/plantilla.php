<?php 

	require 'fpdf/fpdf.php';

	/**
	* Clase Para los Catálogo de Clientes
	*/
	class PDF extends FPDF{
		
		function Header(){

			$this->Image('images/stars.png', 5, 5, 30);
			$this->SetFont('Arial','B',15);
			$this->Cell(30);
			$this->Cell(120,10,utf8_decode( 'Catálogo De Clientes'),0,0,'C');
			$this->SetFont('Arial','B',10);
			$this->Cell(50, 10, 'Hoy: '.date('d/m/Y').'', 0);
			$this->Ln(20);
		}

		function Footer(){

			$this->SetY(-15);
			$this->SetFont('Arial','I', 8);
			$this->Cell(0,10, 'Pagina '.$this->PageNo().'/{nb}',0,0,'C' );
		}
		
	}


	/**
	* Reporte de Clientes Activos  
	*/
	class Activos extends FPDF{
		
		function Header(){

			$this->Image('images/stars.png', 5, 5, 30);
			$this->SetFont('Arial','B',15);
			$this->Cell(30);
			$this->Cell(120,10,utf8_decode( 'Clientes Activos'),0,0,'C');
			$this->SetFont('Arial','B',10);
			$this->Cell(50, 10, 'Hoy: '.date('d/m/Y').'', 0);
			$this->Ln(20);
		}

		function Footer(){

			$this->SetY(-15);
			$this->SetFont('Arial','I', 8);
			$this->Cell(0,10, 'Pagina '.$this->PageNo().'/{nb}',0,0,'C' );
		}
	}

	/**
	* Reporte de Clientes Inactivos  
	*/
	class Inactivos extends FPDF{
		
		function Header(){

			$this->Image('images/stars.png', 5, 5, 30);
			$this->SetFont('Arial','B',15);
			$this->Cell(30);
			$this->Cell(120,10,utf8_decode( 'Clientes Inactivos'),0,0,'C');
			$this->SetFont('Arial','B',10);
			$this->Cell(50, 10, 'Hoy: '.date('d/m/Y').'', 0);
			$this->Ln(20);
		}

		function Footer(){

			$this->SetY(-15);
			$this->SetFont('Arial','I', 8);
			$this->Cell(0,10, 'Pagina '.$this->PageNo().'/{nb}',0,0,'C' );
		}
	}

	/**
	* Reporte de Clientes Cat Oro  
	*/
	class Oro extends FPDF{
		
		function Header(){

			$this->Image('images/stars.png', 5, 5, 30);
			$this->SetFont('Arial','B',15);
			$this->Cell(30);
			$this->Cell(120,10,utf8_decode( 'Clientes Categoria Oro'),0,0,'C');
			$this->SetFont('Arial','B',10);
			$this->Cell(50, 10, 'Hoy: '.date('d/m/Y').'', 0);
			$this->Ln(20);
		}

		function Footer(){

			$this->SetY(-15);
			$this->SetFont('Arial','I', 8);
			$this->Cell(0,10, 'Pagina '.$this->PageNo().'/{nb}',0,0,'C' );
		}
	}

	/**
	* Reporte de Clientes Cat Plata
	*/
	class Plata extends FPDF{
		
		function Header(){

			$this->Image('images/stars.png', 5, 5, 30);
			$this->SetFont('Arial','B',15);
			$this->Cell(30);
			$this->Cell(120,10,utf8_decode( 'Clientes Categoria Plata'),0,0,'C');
			$this->SetFont('Arial','B',10);
			$this->Cell(50, 10, 'Hoy: '.date('d/m/Y').'', 0);
			$this->Ln(20);
		}

		function Footer(){

			$this->SetY(-15);
			$this->SetFont('Arial','I', 8);
			$this->Cell(0,10, 'Pagina '.$this->PageNo().'/{nb}',0,0,'C' );
		}
	}

	/**
	* Reporte de Clientes Cat Bronce
	*/
	class Bronce extends FPDF{
		
		function Header(){

			$this->Image('images/stars.png', 5, 5, 30);
			$this->SetFont('Arial','B',15);
			$this->Cell(30);
			$this->Cell(120,10,utf8_decode( 'Clientes Categoria Bronce'),0,0,'C');
			$this->SetFont('Arial','B',10);
			$this->Cell(50, 10, 'Hoy: '.date('d/m/Y').'', 0);
			$this->Ln(20);
		}

		function Footer(){

			$this->SetY(-15);
			$this->SetFont('Arial','I', 8);
			$this->Cell(0,10, 'Pagina '.$this->PageNo().'/{nb}',0,0,'C' );
		}
	}

	/**
	* Reporte de Ctalogo de Productos
	*/
	class Productos extends FPDF{
		
		function Header(){

			$this->Image('images/stars.png', 5, 5, 30);
			$this->SetFont('Arial','B',15);
			$this->Cell(30);
			$this->Cell(120,10,utf8_decode( 'Catálogo de Productos'),0,0,'C');
			$this->SetFont('Arial','B',10);
			$this->Cell(50, 10, 'Hoy: '.date('d/m/Y').'', 0);
			$this->Ln(20);

			$this->SetFillColor(232,232,232);
			$this->SetFont('Arial','B',12);
			$this->Cell(25,6,'Cod Barras',1,0,'C',1);
			$this->Cell(80,6,'Nombre',1,0,'C',1);
			$this->Cell(70,6,'Marca',1,0,'C',1);
			$this->Cell(20,6,utf8_decode('Género'),1,0,'C',1);
			$this->Cell(20,6,'Stock',1,0,'C',1);
			$this->Cell(30,6,'Estatus',1,1,'C',1);
		}

		function Footer(){

			$this->SetY(-15);
			$this->SetFont('Arial','I', 8);
			$this->Cell(0,10, 'Pagina '.$this->PageNo().'/{nb}',0,0,'C' );
		}
	}

	/**
	* Reporte de Lista de Precios
	*/
	class Lista extends FPDF{
		
		function Header(){

			$this->Image('images/stars.png', 5, 5, 30);
			$this->SetFont('Arial','B',15);
			$this->Cell(30);
			$this->Cell(120,10,utf8_decode( 'Lista de Precios de Productos'),0,0,'C');
			$this->SetFont('Arial','B',10);
			$this->Cell(50, 10, 'Hoy: '.date('d/m/Y').'', 0);
			$this->Ln(20);

			$this->SetFillColor(232,232,232);
			$this->SetFont('Arial','B',12);
			$this->Cell(175,6,'',0);
			$this->Cell(75,6,"Precios",1,1,'C',1);
			$this->Cell(25,6,'Cod Barras',1,0,'C',1);
			$this->Cell(80,6,'Nombre',1,0,'C',1);
			$this->Cell(70,6,'Marca',1,0,'C',1);
			$this->Cell(25,6,'Oro',1,0,'C',1);
			$this->Cell(25,6,'Plata',1,0,'C',1);
			$this->Cell(25,6,'Bronce',1,1,'C',1);
		}

		function Footer(){

			$this->SetY(-15);
			$this->SetFont('Arial','I', 8);
			$this->Cell(0,10, 'Pagina '.$this->PageNo().'/{nb}',0,0,'C' );
		}
	}

	/**
	* Reporte de Utilidad de Productos
	*/
	class Utilidad extends FPDF{
		
		function Header(){

			$this->Image('images/stars.png', 5, 5, 30);
			$this->SetFont('Arial','B',15);
			$this->Cell(30);
			$this->Cell(120,10,utf8_decode( 'Utilidad de Productos'),0,0,'C');
			$this->SetFont('Arial','B',10);
			$this->Cell(50, 10, 'Hoy: '.date('d/m/Y').'', 0);
			$this->Ln(20);

			$this->SetFillColor(232,232,232);
			$this->SetFont('Arial','B',11);
			$this->Cell(148,6,'',0);
			$this->Cell(40,6,"Oro",1,0,'C',1);
			$this->Cell(40,6,"Plata",1,0,'C',1);
			$this->Cell(40,6,"Bronce",1,1,'C',1);
			$this->SetFont('Arial','B',8);
			$this->Cell(18,6,'Cod Barras',1,0,'L',1);
			$this->SetFont('Arial','B',11);
			$this->Cell(60,6,'Nombre',1,0,'C',1);
			$this->Cell(50,6,'Marca',1,0,'C',1);
			$this->Cell(20,6,'Costo',1,0,'C',1);
			$this->Cell(20,6,'Precio',1,0,'C',1);
			$this->Cell(20,6,'Utilidad',1,0,'C',1);
			$this->Cell(20,6,'Precio',1,0,'C',1);
			$this->Cell(20,6,'Utilidad',1,0,'C',1);
			$this->Cell(20,6,'Precio',1,0,'C',1);
			$this->Cell(20,6,'Utilidad',1,1,'C',1);
		}

		function Footer(){

			$this->SetY(-15);
			$this->SetFont('Arial','I', 8);
			$this->Cell(0,10, 'Pagina '.$this->PageNo().'/{nb}',0,0,'C' );
		}
	}

	/**
	* Reporte de Utilidad de Productos
	*/
	class Hombre extends FPDF{
		
		function Header(){

			$this->Image('images/stars.png', 5, 5, 30);
			$this->SetFont('Arial','B',15);
			$this->Cell(30);
			$this->Cell(120,10,utf8_decode( 'Productos Caballero'),0,0,'C');
			$this->SetFont('Arial','B',10);
			$this->Cell(50, 10, 'Hoy: '.date('d/m/Y').'', 0);
			$this->Ln(20);
		}

		function Footer(){

			$this->SetY(-15);
			$this->SetFont('Arial','I', 8);
			$this->Cell(0,10, 'Pagina '.$this->PageNo().'/{nb}',0,0,'C' );
		}
	}

	class Mujer extends FPDF{
		
		function Header(){

			$this->Image('images/stars.png', 5, 5, 30);
			$this->SetFont('Arial','B',15);
			$this->Cell(30);
			$this->Cell(120,10,utf8_decode( 'Productos Dama'),0,0,'C');
			$this->SetFont('Arial','B',10);
			$this->Cell(50, 10, 'Hoy: '.date('d/m/Y').'', 0);
			$this->Ln(20);
		}

		function Footer(){

			$this->SetY(-15);
			$this->SetFont('Arial','I', 8);
			$this->Cell(0,10, 'Pagina '.$this->PageNo().'/{nb}',0,0,'C' );
		}
	}

	class Nino extends FPDF{
		
		function Header(){

			$this->Image('images/stars.png', 5, 5, 30);
			$this->SetFont('Arial','B',15);
			$this->Cell(30);
			$this->Cell(120,10,utf8_decode( 'Productos Niño'),0,0,'C');
			$this->SetFont('Arial','B',10);
			$this->Cell(50, 10, 'Hoy: '.date('d/m/Y').'', 0);
			$this->Ln(20);
		}

		function Footer(){

			$this->SetY(-15);
			$this->SetFont('Arial','I', 8);
			$this->Cell(0,10, 'Pagina '.$this->PageNo().'/{nb}',0,0,'C' );
		}
	}

	class Nina extends FPDF{
		
		function Header(){

			$this->Image('images/stars.png', 5, 5, 30);
			$this->SetFont('Arial','B',15);
			$this->Cell(30);
			$this->Cell(120,10,utf8_decode( 'Productos Niña'),0,0,'C');
			$this->SetFont('Arial','B',10);
			$this->Cell(50, 10, 'Hoy: '.date('d/m/Y').'', 0);
			$this->Ln(20);
		}

		function Footer(){

			$this->SetY(-15);
			$this->SetFont('Arial','I', 8);
			$this->Cell(0,10, 'Pagina '.$this->PageNo().'/{nb}',0,0,'C' );
		}
	}

	class VentaDiario extends FPDF{
		
		function Header(){

			$this->Image('images/stars.png', 5, 5, 30);
			$this->SetFont('Arial','B',15);
			$this->Cell(30);
			$this->Cell(120,10,utf8_decode( 'Ventas Diario'),0,0,'C');
			$this->SetFont('Arial','B',10);
			$this->Cell(50, 10, 'Hoy: '.date('d/m/Y').'', 0);
			$this->Ln(20);


			$this->SetFillColor(232,232,232);
			$this->SetFont('Arial','B',10);
			$this->Cell(15,6,'Folio',1,0,'C',1);
			$this->Cell(15,6,'Cod Cte',1,0,'C',1);
			$this->Cell(60,6,'Nombre Cte.',1,0,'C',1);
			$this->Cell(25,6,'Fcha. Vta',1,0,'C',1);
			$this->Cell(17,6,'Pago',1,0,'C',1);
			$this->Cell(35,6,'Sub Total',1,0,'C',1);
			$this->Cell(20,6,'Descuento',1,0,'C',1);
			$this->Cell(35,6,'Total',1,0,'C',1);
			$this->SetFont('Arial','B',8);
			$this->Cell(20,6,'Fcha. Liquidar',1,0,'C',1);
			$this->SetFont('Arial','B',10);
			$this->Cell(30,6,'Usuario',1,1,'C',1);
		}

		function Footer(){

			$this->SetY(-15);
			$this->SetFont('Arial','I', 8);
			$this->Cell(0,10, 'Pagina '.$this->PageNo().'/{nb}',0,0,'C' );
		}
	}

	class VentaxFexhas extends FPDF{
		
		function Header(){

			$this->Image('images/stars.png', 5, 5, 30);
			$this->SetFont('Arial','B',15);
			$this->Cell(30);
			$this->Cell(120,10,utf8_decode( 'Ventas'),0,0,'C');
			$this->SetFont('Arial','B',10);
			$this->Ln(20);
		}

		function Footer(){

			$this->SetY(-15);
			$this->SetFont('Arial','I', 8);
			$this->Cell(0,10, 'Pagina '.$this->PageNo().'/{nb}',0,0,'C' );
		}
	}


	class ConsigDiario extends FPDF{
		
		function Header(){

			$this->Image('images/stars.png', 5, 5, 30);
			$this->SetFont('Arial','B',15);
			$this->Cell(30);
			$this->Cell(120,10,utf8_decode( 'Consignación Diario'),0,0,'C');
			$this->SetFont('Arial','B',10);
			$this->Cell(50, 10, 'Hoy: '.date('d/m/Y').'', 0);
			$this->Ln(20);

			$this->SetFillColor(232,232,232);
			$this->SetFont('Arial','B',10);
			$this->Cell(15,6,'Folio',1,0,'C',1);
			$this->Cell(15,6,'Cod Cte',1,0,'C',1);
			$this->Cell(60,6,'Nombre Cte.',1,0,'C',1);
			$this->Cell(25,6,'Fcha. Consig',1,0,'C',1);
			$this->Cell(17,6,'Pago',1,0,'C',1);
			$this->Cell(35,6,'Sub Total',1,0,'C',1);
			$this->Cell(20,6,'Descuento',1,0,'C',1);
			$this->Cell(35,6,'Total',1,0,'C',1);
			$this->SetFont('Arial','B',8);
			$this->Cell(20,6,'Fcha. Liquidar',1,0,'C',1);
			$this->SetFont('Arial','B',10);
			$this->Cell(30,6,'Usuario',1,1,'C',1);
		}

		function Footer(){

			$this->SetY(-15);
			$this->SetFont('Arial','I', 8);
			$this->Cell(0,10, 'Pagina '.$this->PageNo().'/{nb}',0,0,'C' );
		}
	}

	class ConsigSaldo extends FPDF{
		
		function Header(){

			$this->Image('images/stars.png', 5, 5, 30);
			$this->SetFont('Arial','B',15);
			$this->Cell(30);
			$this->Cell(120,10,utf8_decode( 'Consignaciónes con Saldo Pendiente'),0,0,'C');
			$this->SetFont('Arial','B',10);
			$this->Cell(50, 10, 'Hoy: '.date('d/m/Y').'', 0);
			$this->Ln(20);


			$this->SetFillColor(232,232,232);
			$this->SetFont('Arial','B',10);
			$this->Cell(25,6,'Fcha. Consig',1,0,'C',1);
			$this->Cell(15,6,'Folio',1,0,'C',1);
			$this->Cell(15,6,'Cod Cte',1,0,'C',1);
			$this->Cell(70,6,'Nombre Cte.',1,0,'C',1);
			$this->Cell(30,6,'Total',1,0,'C',1);
			$this->Cell(30,6,'Pago',1,0,'C',1);
			$this->Cell(30,6,'Saldo',1,0,'C',1);
			$this->Cell(35,6,'Fcha. Liquidar',1,1,'C',1);
	
		}

		function Footer(){

			$this->SetY(-15);
			$this->SetFont('Arial','I', 8);
			$this->Cell(0,10, 'Pagina '.$this->PageNo().'/{nb}',0,0,'C' );
		}
	}

	class Gastos extends FPDF{
		
		function Header(){

			$this->Image('images/stars.png', 5, 5, 30);
			$this->SetFont('Arial','B',15);
			$this->Cell(30);
			$this->Cell(120,10,utf8_decode( 'Historial de Gastos'),0,0,'C');
			$this->SetFont('Arial','B',10);
			$this->Cell(50, 10, 'Hoy: '.date('d/m/Y').'', 0);
			$this->Ln(20);

			$this->SetFillColor(232,232,232);
			$this->SetFont('Arial','B',12);
			$this->Cell(15,6,'Folio',1,0,'C',1);
			$this->Cell(20,6,'Fecha',1,0,'C',1);
			$this->Cell(120,6,'Concepto',1,0,'C',1);
			$this->Cell(30,6,'Monto',1,0,'C',1);
			$this->Cell(30,6,'Usuario',1,1,'C',1);
		}

		function Footer(){

			$this->SetY(-15);
			$this->SetFont('Arial','I', 8);
			$this->Cell(0,10, 'Pagina '.$this->PageNo().'/{nb}',0,0,'C' );
		}
	}


?>