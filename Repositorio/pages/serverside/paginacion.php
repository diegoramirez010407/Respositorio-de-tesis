<?php
function paginacion($pagina, $total_paginas, $adyacentes)
{
	$anterior = "&lsaquo; Anterior";
	// arrow &rsaquo;
	$siguiente = "Siguiente";
	$salida = '<div class="col-md-10 my-3 d-flex justify-content-center"><div class="pagination">';

	// Anterior

	// if ($pagina == 1) {
	// 	$salida .= "<li class='disabled' style='margin: 0 4em;'><span><a>$anterior</a></span></li>";
	// } else if ($pagina == 2) {
	// 	$salida .= "<li style='margin: 0 4em;'><span><a href='javascript:void(0);' onclick='load(1)'>$anterior</a></span></li>";
	// } else {
	// 	$salida .= "<li style='margin: 0 4em;'><span><a href='javascript:void(0);' onclick='load(" . ($pagina - 1) . ")'>$anterior</a></span></li>";
	// }
	/*
	// primera página
	if ($pagina > ($adyacentes + 1)) {
		$salida .= "<li style='margin: 0 2em;'><a href='javascript:void(0);' onclick='load(1)'>1</a></li>";
	}
	// intervalo de páginas
	if ($pagina > ($adyacentes + 2)) {
		$salida .= "<li style='margin: 0 2em;'><a>...</a></li>";
	}

	// paginas

	$pmin = ($pagina > $adyacentes) ? ($pagina - $adyacentes) : 1;
	$pmax = ($pagina < ($total_paginas - $adyacentes)) ? ($pagina + $adyacentes) : $total_paginas;
	for ($i = $pmin; $i <= $pmax; $i++) {
		if ($i == $pagina) {
			$salida .= "<li class='active' style='display:none'><a>$i</a></li>";
		} else if ($i == 1) {
			$salida .= "<li style='display:none'><a href='javascript:void(0);' onclick='load(1)'>$i</a></li>";
		} else {
			$salida .= "<li style='display:none'><a href='javascript:void(0);' onclick='load(" . $i . ")'>$i</a></li>";
		}
	}

	// intervalo de páginas

	if ($pagina < ($total_paginas - $adyacentes - 1)) {
		$salida .= "<li style='display:none'><a>...</a></li>";
	}*/

	// última página

	// if ($pagina < ($total_paginas - $adyacentes)) {
	// 	$salida .= "<li style='display:none'><a href='javascript:void(0);' onclick='load($total_paginas)'>$total_paginas</a></li>";
	// }

	// Siguiente

	if ($pagina < $total_paginas) {
		$salida .= "<button type='button' class='btn btn-primary' onclick='load(" . ($pagina + 1) . ")' id='btnHola2' value='siguiente'>$siguiente</button>";
	} else {
		$salida .= "<button type='button' class='btn btn-primary' class='disabled' style='display: none;'>$siguiente</button>";
	}

	$salida .= "</div>";

	if ($pagina == 10) {
		$salida .= '<div>
		<button type="button" id="btnEnviarRespuestas" onclick="card()" class="btn btn-primary btn-block" value="Enviar">Enviar</button>
	</div>';
	}

	$salida .= "</div>";

	return $salida;
}
