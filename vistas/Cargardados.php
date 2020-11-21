<?php
session_start();
 $iniciadoU=$_SESSAO['usuario'];
  $idAdmin=$_SESSAO['idadmin'];
    $senha=$_SESSAO['senha'];
if($iniciadoU==null||$iniciadoU==''){
  header("Location:../sessoes.html");
}   
$tabela=$_POST['tabela'];
include('../bd/conexionbd.php');
    if (!$conexion) 
	{
      die('Falha na conexão com o banco de dados: ' . mysqli_error($conexion));
    }
switch ($tabela) 
    {
    case 'IMAGENS':
       imagens($conexion);
        break;
    case 'PIZZAS':
        pizzas($conexion);
        break;
    case 'MENU':
        menu($conexion);
        break;
	case 'ADMIN':
        admin($conexion);
        break;
    default:
        echo "esta regra é por padrão";
    };
function imagens($conexion){
    $sql="SELECT * FROM IMAGENS";
    $result = mysqli_query($conexion,$sql);
echo'<div class="container" style="margin-bottom: 128px;">		
 <div class="row">
 <h5 class="center-align">IMÁGENES</h5>
		<a id="btn-modal" class="btn-floating btn-large waves-effect waves-light green"><i class="tccpizza tccpizza-plus"></i></a> 
<div class="col s12">		
<table class="responsive-table">
    <thead>
        <tr>
            <th>CHAVE IMAGEN</th>
            <th>NOME</th>
			 <th>IMAGEN</th>
			  <th>OPCIONES</th>
        </tr>
    </thead>
    <tbody>';
	 while($row = mysqli_fetch_array($result)) 
                {
      echo'<tr><font></font>
            <td>'.$row['ChaveImg'].'</td>
            <td>'.$row['Nome'].'</td>
			<td><img src="./assets/img/'.$row['Nome'].'" alt="" style="max-width: 30%;max-height: 30%;"></td>
			  <td><button class="waves-effect waves-light red btn" id="btnEliminarImg" data-id="'. $row['ChaveImg'] .'"><i class="tccpizza tccpizza-minus"></i></button></td>
			  <td><button class="waves-effect waves-light btn" id="btnEditarImg" data-id="'. $row['ChaveImg'] .'" value="'.$row['Nome'].'"><i class="tccpizza tccpizza-edit"></i></button></td>
        </tr>';
       }
  echo'</tbody>
</table>
</div>
</div>
</div>';	
	echo'<!---------Modal guardar IMAGENS---------->
         <div id="modalGI" class="modal modal-fixed-footer">
          <div class="modal-content">
            
            <!--Input fields-->
<div class="container">
	<div class="row">
		<h4 class="center-align">Elige una imagen o arrastrala</h4>
		<form autocomplete="off" class="col s12" id="form-subir" enctype="multipart/form-data">
			<div class="row">
			<div class="file-field input-field col s12">
				<div class="btn">
					<span>Archivo</span>
					<input type="file" name="files" id="files">
				</div>
				<div class="file-path-wrapper">
					<input id="nome-img" class="file-path validate" type="text" required>
				</div>
                 <br/>
                   <button  id="btnValidar" type="submit" class="modal-action waves-effect waves-light btn" value="">Guardar</button>
             <output class="col s12" id="list"></output>
			</div>
		</div>
		 
		</form>
	</div>
</div>
          </div>
          <div class="modal-footer">
           <td>
            <a id="btnCancelar" class="
            modal-action waves-effect waves-light red btn">Cancelar</a>
            </td>
			
          </div>
        </div>
        <!---------Fin modal---------->';
	echo'<!---------Modal Actualizar IMAGENS---------->
         <div id="modalAI" class="modal modal-fixed-footer">
          <div class="modal-content">
            
            <!--Input fields-->
<div class="container">
	<div class="row">
		<h4 class="center-align">Elige una imagen o arrastrala</h4>
		<form autocomplete="off" class="col s12" id="form-actualizar">
			<div class="row">
			<div class="file-field input-field col s12">
				<div class="btn">
					<span>Archivo</span>
					<input type="file" name="archivo">
				</div>
				<div class="file-path-wrapper">
					<input id="nome-imga" class="file-path validate" type="text" name="nomeimg">
					<input id="id" type="text" name="id" style="display:none">
					<input id="eliminar" type="text" name="eliminar" style="display:none">
					<input id="tabela" type="text" name="tabela" style="display:none">
				</div>
			</div>
		</div>
		
		<td>
           <input type="submit" class="modal-action waves-effect waves-light btn" value="Actualizar">
        </td>
		
		</form>
	</div>
</div>
          </div>
          <div class="modal-footer">
           <td>
            <a href="#!" class="
            modal-action modal-close waves-effect waves-light red btn">Cancelar</a>
            </td>
          </div>
        </div>
        <!---------Fin modal---------->
		';
	echo '
	<script src="./js/controladorAjax.js"></script>';

mysqli_close($conexion);  
};

function PIZZAS($conexion){
      
	$sql="SELECT PIZZAS.IdPizza,PIZZAS.ChavePizza,PIZZAS.Nome,PIZZAS.Quantidade,PIZZAS.Precio,IMAGENS.Nome AS 'NomeP',IMAGENS.ChaveImg AS 'ChaveImg',PIZZAS.IdMenu,MENU.Dia FROM PIZZAS,IMAGENS,MENU WHERE PIZZAS.Imagen=IMAGENS.ChaveImg AND PIZZAS.IdMenu=MENU.IdMenu";
    $pizzas = mysqli_query($conexion,$sql);

echo '<div class="container" style="margin-bottom: 128px;">
	<div class="row">
		<h5 class="center-align">PIZZAS</h5>
		<a id="btn-modal" class="btn-floating btn-large waves-effect waves-light green"><i class="tccpizza tccpizza-plus"></i></a>  
		<div class="col s12">
			<table class="responsive-table">
				<thead>
					<tr>
					
						<th data-field="id">CHAVE PIZZA</th>
						<th data-field="name">NOME</th>
						<th data-field="name">Quantidade</th>
						<th data-field="name">PRECIO</th>
						<th data-field="name">IMAGEN</th>
						<th data-field="name">NOME IMG</th>
                        <th data-field="name">DÍA</th>
						<th data-field="option">OPCIONES</th>
						
					</tr>
				</thead>
				<tbody>';
				 while($row = mysqli_fetch_array($pizzas)) 
                {
					echo'<tr>';
					
					echo'<td>'.$row['ChavePizza'].'</td>';
					echo'<td>'.$row['Nome'].'</td>';
					 echo'<td>'.$row['Quantidade'].'</td>';
					 echo'<td>'.$row['Precio'].'</td>';
					echo '<td>
					    <img src="./assets/img/'.$row['NomeP'].'" alt="" style="max-width: 40%;max-height: 40%;">';
					echo '</td>';
					echo'<td>'.$row['NomeP'].'</td>';
                    echo'<td>'.$row['Dia'].'</td>';
					echo '<td>
					 <button class="waves-effect waves-light red btn" id="btnEliminarP" data-id="'. $row['IdPizza'] .'"><i class="tccpizza tccpizza-minus"></i></button>		
	                 <button class="waves-effect waves-light btn" id="btnEditarP" data-id="'. $row['IdPizza'] .'" data-img="'.$row['ChaveImg'].'" data-dia="'.$row['IdMenu'].'"><i class="tccpizza tccpizza-edit"></i></button>
	                 </td>';
                     echo "</tr>";
                }
          echo '</tbody>
			</table>
		</div>
	</div>

</div>';
echo'<!---------Modal guardar Pizzaslatillos---------->
<div id="modalGI" class="modal modal-fixed-footer">
	<div class="modal-content">

		<!--Input fields-->
		<div class="container">
			<div class="row">
				<h4 class="center-align">Guardar Pizzas</h4>
				<form class="col s12" autocomplete="off" id="form-pizzas">
					<div class="row">
						<div class="input-field col s6">
							<input  id="ChavePizza" type="text" class="validate">
							<label for="ChavePizza">Chave del Pizza</label>
						</div>
						<div class="input-field col s6">
							<input id="nomePizza" type="text" class="validate">
							<label for="nomePizza">Nome del Pizza</label>
						</div>
						
					</div>
					
					<div class="row">
						<div class="input-field col s6">
							<input id="quantidadePizza" type="text" class="validate">
							<label for="quantidadePlattillo">Quantidade de los Pizza</label>
						</div>
				       <div class="input-field col s6">
							<input id="precioPizza" type="text" class="validate">
							<label for="precioPizza">Precio del Pizza</label>
                         </div>
                        
				      </div>
                      <div class="row">
                      	  <input  id="idMenu" type="text" style="display:none;">
						 </div>
                       
                      <div class="row">
					   
					    <ul class="collapsible" data-collapsible="accordion">
						  <li>
							<div class="collapsible-header">
							<input  id="menuDiaP" type="text" placeholder="Elige Un día" readonly="readonly">
							</div>
							<div class="collapsible-body">
							<table class="responsive-table">
							<tbody>';
	
							$img="SELECT MENU.IdMenu,MENU.Dia,MENU.Promociones FROM MENU";
							$menu = mysqli_query($conexion,$img);
							 while($row = mysqli_fetch_array($menu)) 
							 { 
							
							echo'<tr>
							<td>
							
							<button class="waves-effect waves-light btn" id="btnSelectMenu" data-idm="'.$row['IdMenu'] .'" data-dia="'.$row['Dia'] .'">Seleccionar</button>
	                        </td>
							<td>'.$row['Dia'].'</td>
							<td>'.$row['Promociones'].'</td>
							 </tr>';
							 }
	       
							echo'</tbody>
							</table>
							</div>
						  </li>
					    </ul>
					   
					</div>
                      
						<div class="row">
                      	  <input  id="id" type="text" style="display:none">
						 </div>
					
				</form>
				</div>
					<div class="row">
					   
					    <ul class="collapsible" data-collapsible="accordion">
						  <li>
							<div class="collapsible-header">
							<input  id="nomeimg" type="text" placeholder="Elige una imagen" readonly="readonly">
							</div>
							<div class="collapsible-body">
							<table class="responsive-table">
							<tbody>';
	
							$img="SELECT IMAGENS.ChaveImg,IMAGENS.Nome FROM IMAGENS";
							$pizzas = mysqli_query($conexion,$img);
							 while($row = mysqli_fetch_array($pizzas)) 
							 { 
							
							echo'<tr>
							<td>
							
							<button class="waves-effect waves-light btn" id="btnSeleccionGurdarP"  data-idimg="'.$row['ChaveImg'] .'" data-nom="'.$row['Nome'].'">Seleccionar</button>
	                        </td>
							<td>'.$row['Nome'].'</td>
							<td><img src="./assets/img/'.$row['Nome'].'" alt="" style="max-width: 40%;max-height: 40%">
							
							</td>
							 </tr>';
							 }
	       
							echo'</tbody>
							</table>
							</div>
						  </li>
					    </ul>
					   
					</div>
		</div>

	</div>
	<div class="modal-footer">
	
		<td>
		<button class="waves-effect waves-light btn" id="btnGuardarpizzas">Guardar</button>
		<a id="btnCancelar" class="
		modal-action waves-effect waves-light red btn">Cancelar</a>
			
		</td>

	</div>
</div>
<!---------Fin modal---------->';

echo'<!---------Modal Actualizar Pizzas---------->
         <div id="modalAI" class="modal modal-fixed-footer">
       <div class="modal-content">

		<!--Input fields-->
		<div class="container">
			<div class="row">
				<h4 class="center-align">Actualizar Pizzas</h4>
				<form class="col s12" autocomplete="off" id="form-pizzas">
					<div class="row">
						<div class="input-field col s6">
							<input  id="chavePizzaA" type="text" class="validate">
							<label for="chavePizza">Chave del Pizza</label>
						</div>
						<div class="input-field col s6">
							<input id="nomePizzaA" type="text" class="validate">
							<label for="nomePizza">Nome del Pizza</label>
						</div>
						
					</div>
					
					<div class="row">
						<div class="input-field col s6">
							<input id="quantidadePizzaA" type="text" class="validate">
							<label for="quantidadePlattillo">Quantidade de los Pizza</label>
						</div>
							<div class="input-field col s6">
							<input id="precioPizzaA" type="text" class="validate">
							<label for="precioPizza">Precio del Pizza</label>
						
						</div>
                       </div> 
                        
                        <div class="row">
                      	  <input  id="idMenuA" type="text" style="display:none;">
						 </div>
                       
                      <div class="row">
					   
					    <ul class="collapsible" data-collapsible="accordion">
						  <li>
							<div class="collapsible-header">
							<input  id="menuDiaPA" type="text" placeholder="Elige Un día" readonly="readonly">
							</div>
							<div class="collapsible-body">
							<table class="responsive-table">
							<tbody>';
	
							$img="SELECT MENU.IdMenu,MENU.Dia,MENU.Promociones FROM MENU";
							$menu = mysqli_query($conexion,$img);
							 while($row = mysqli_fetch_array($menu)) 
							 { 
							
							echo'<tr>
							<td>
							
							<button class="waves-effect waves-light btn" id="btnSelectMenuA" data-idm="'.$row['IdMenu'] .'" data-dia="'.$row['Dia'] .'">Seleccionar</button>
	                        </td>
							<td>'.$row['Dia'].'</td>
							<td>'.$row['Promociones'].'</td>
							 </tr>';
							 }
	       
							echo'</tbody>
							</table>
							</div>
						  </li>
					    </ul>
					   
					</div>
                        
						<div class="row">
                      	<input  id="idA" type="text" style="display:none">
						</div>
					
				</form>
				</div>
					<div class="row">
					   
					    <ul class="collapsible" data-collapsible="accordion">
						  <li>
							<div class="collapsible-header">
							<input  id="nomeimgA" type="text" placeholder="Elige una imagen" readonly="readonly">
							</div>
							<div class="collapsible-body">
							<table class="responsive-table">
							<tbody>';
	
							$img="SELECT IMAGENS.ChaveImg AS 'IdImg',IMAGENS.Nome AS 'NomeI' FROM pizzas,IMAGENS WHERE PIZZAS.Imagen=IMAGENS.ChaveImg";
							$pizzas = mysqli_query($conexion,$img);
							 while($row = mysqli_fetch_array($pizzas)) 
							 { 
							
							echo'<tr>
							<td>
							
							<button class="waves-effect waves-light btn" id="btnSeleccionActualizarP"  value="'.$row['IdImg'] .'" data-id="'.$row['NomeI'].'">Seleccionar</button>
	                        </td>
							<td>'.$row['NomeI'].'</td>
							<td><img src="./assets/img/'.$row['NomeI'].'" alt="" style="max-width: 30%;max-height: 30%">
							
							</td>
							 </tr>';
							 }
	       
							echo'</tbody>
							</table>
							</div>
						  </li>
					    </ul>
					</div>
		</div>
	</div>
          <div class="modal-footer">
          <td>
           <button id="btnActulizarP" class="modal-action waves-effect waves-light btn">Actualizar</button>
        </td>
           <td>
            <a href="#!" class="
            modal-action modal-close waves-effect waves-light red btn">Cancelar</a>
            </td>
   
          </div>
        </div>
        <!---------Fin modal---------->

<script src="./js/controladorAjax.js"></script>';
	
mysqli_close($conexion);  
};
// função carregar dados do menu
function menu($conexion){
		$sql="SELECT * FROM MENU ORDER BY IdMenu";
    $menu = mysqli_query($conexion,$sql);

echo '<div class="container" style="margin-bottom: 128px;">
	<div class="row">
		<h5 class="center-align">MÉNU</h5>
		<a id="btn-modal" class="btn-floating btn-large waves-effect waves-light green"><i class="tccpizza tccpizza-plus"></i></a>  
		<div class="col s12">
			<table class="responsive-table">
				<thead>
					<tr>
					
						<th data-field="id">CHAVE MENÚ</th>
						<th data-field="name">DÍA</th>
						<th data-field="name">PROMOCIONES</th>
						<th data-field="name">HORA APERTURA</th>
						<th data-field="name">HORA CIERRE</th>
						<th data-field="option">OPCIONES</th>
						
					</tr>
				</thead>
				<tbody>';
				 while($row = mysqli_fetch_array($menu)) 
                {
					echo'<tr>';
					echo'<td>'.$row['IdMenu'].'</td>';
					echo'<td>'.$row['Dia'].'</td>';
					 echo'<td>'.$row['Promociones'].'</td>';
					 echo'<td>'.$row['HorarioApertura'].'</td>';
					echo '<td>'.$row['HorarioCierre'].'</td>';
					echo '<td>
					 <button class="waves-effect waves-light red btn" id="btnEliminarMenu" data-id="'. $row['IdMenu'] .'"><i class="tccpizza tccpizza-minus"></i></button>		
	                 <button class="waves-effect waves-light btn" id="btnEditarM" data-id="'. $row['IdMenu'] .'"><i class="tccpizza tccpizza-edit"></i></button>
	                 </td>';
                     echo "</tr>";
                }
          echo '</tbody>
			</table>
		</div>
	</div>

</div>';
echo'<!---------Modal guardar Menu---------->
<div id="modalGI" class="modal modal-fixed-footer">
	<div class="modal-content">
		<!--Input fields-->
		<div class="container">
			<div class="row">
				<h4 class="center-align">Guardar Menú</h4>
				<form class="col s12" autocomplete="off" id="form-pizzas">
                
                 <div class="row">
					   
					    <ul class="collapsible" data-collapsible="accordion">
						  <li>
							<div class="collapsible-header">
							<input  id="diaMenuG" type="text" placeholder="Selecciona un día" readonly="readonly">
							</div>
							<div class="collapsible-body">
							
							
							<td>
							<button class="waves-effect waves-light btn-flat" id="btnSeleccionDiaG"  value="Lunes">Lunes</button>
	                        </td>
                            <td>
							<button class="waves-effect waves-light btn-flat" id="btnSeleccionDiaG"  value="Martes">Martes</button>
	                        </td>
                            <td>
							<button class="waves-effect waves-light btn-flat" id="btnSeleccionDiaG"  value="Miércoles">Miércoles</button>
	                        </td>
                             <td>
							<button class="waves-effect waves-light btn-flat" id="btnSeleccionDiaG"  value="Jueves">Jueves</button>
	                        </td>
                             <td>
							<button class="waves-effect waves-light btn-flat" id="btnSeleccionDiaG"  value="Viernes">Viernes</button>
	                        </td>
                               <td>
							<button class="waves-effect waves-light btn-flat" id="btnSeleccionDiaG"  value="Sábado">Sábado</button>
	                        </td>
                               <td>
							<button class="waves-effect waves-light btn-flat" id="btnSeleccionDiaG"  value="Domingo">Domingo</button>
	                        </td>
					
							</div>
						  </li>
					    </ul>
		</div>
                <div class="row">
			         <div class="input-field col s12">
							<input  id="promocionM" type="text" class="validate">
							<label for="promocion">promocion del día</label>
						</div>
				 </div>
					
					
					<div class="row">
						<div class="input-field col s6">
							<input  id="horaapeM" type="text" class="timepicker">
							<label for="horaape">Hora de apertura</label>
						</div>
						<div class="input-field col s6">
							<input id="horacierM" type="text" class="timepicker">
							<label for="horacier">Hora de cierre</label>
						</div>	
					</div> 
				</form>
				</div>	
		</div>
	</div>
	<div class="modal-footer">
		<td>
		<button class="waves-effect waves-light btn" id="btnGuardarMenu">Guardar</button>
		<a id="btnCancelar" class="
		modal-action waves-effect waves-light red btn">Cancelar</a>
		</td>
	</div>
</div>
<!---------Fin modal---------->';
echo'<!---------Modal Actualizar Menu---------->
         <div id="modalAI" class="modal modal-fixed-footer">
       <div class="modal-content">
		<!--Input fields-->
		<div class="container">
			<div class="row">
				<h4 class="center-align">Actualizar Menú</h4>
				<form class="col s12" autocomplete="off" id="form-menu">
                
                
                <div class="row">
					   
					    <ul class="collapsible" data-collapsible="accordion">
						  <li>
							<div class="collapsible-header">
							<input  id="diaMenuActualizar" type="text" placeholder="Selecciona un día" readonly="readonly">
							</div>
							<div class="collapsible-body">
							
							
							<td>
							<button class="waves-effect waves-light btn-flat" id="btnSeleccionDia"  value="Lunes">Lunes</button>
	                        </td>
                            <td>
							<button class="waves-effect waves-light btn-flat" id="btnSeleccionDia"  value="Martes">Martes</button>
	                        </td>
                            <td>
							<button class="waves-effect waves-light btn-flat" id="btnSeleccionDia"  value="Miércoles">Miércoles</button>
	                        </td>
                             <td>
							<button class="waves-effect waves-light btn-flat" id="btnSeleccionDia"  value="Jueves">Jueves</button>
	                        </td>
                             <td>
							<button class="waves-effect waves-light btn-flat" id="btnSeleccionDia"  value="Viernes">Viernes</button>
	                        </td>
                               <td>
							<button class="waves-effect waves-light btn-flat" id="btnSeleccionDia"  value="Sábado">Sábado</button>
	                        </td>
                               <td>
							<button class="waves-effect waves-light btn-flat" id="btnSeleccionDia"  value="Domingo">Domingo</button>
	                        </td>
					
							</div>
						  </li>
					    </ul>
					</div>
					<div class="row">
                       
    
			          <div class="input-field col s12">
							<input  id="promocionMA" type="text" class="validate">
							<label for="promocion">promocion del día</label>
						</div>
						
						
					</div>
					
					<div class="row">
						<div class="input-field col s6">
							<input  id="horaapeMA" type="text" class="timepicker">
							<label for="horaape">Hora de apertura</label>
						</div>
						<div class="input-field col s6">
							<input id="horacierMA" type="text" class="timepicker">
							<label for="horacier">Hora de cierre</label>
						</div>	
					</div> 
				</form>
				</div>	
		</div>
	</div>
          <div class="modal-footer">
          <td>
           <button id="btnActulizarM" class="modal-action waves-effect waves-light btn">Actualizar</button>
        </td>
           <td>
            <a href="#!" class="
            modal-action modal-close waves-effect waves-light red btn">Cancelar</a>
            </td>
          </div>
        </div>
        <!---------Fin modal---------->
<script src="./js/controladorAjax.js"></script>';
mysqli_close($conexion);  
}
function admin($conexion){
		$sql="SELECT*FROM ADMIN";
    $admin = mysqli_query($conexion,$sql);
echo '<div class="container" style="margin-bottom: 128px;margin-bottom: 400px;">
	<div class="row">
		<h5 class="center-align">ADMIN</h5>
		<a id="btn-modalAdmin" class="btn-floating btn-large waves-effect waves-light green"><i class="tccpizza tccpizza-plus"></i></a>  
		<div class="col s12">
			<table class="responsive-table">
				<thead>
					<tr>
						<th data-field="id">CHAVE USUARIO</th>
						<th data-field="name">NOME</th>
						<th data-field="option">OPCIONES</th>
					</tr>
				</thead>
				<tbody>';
				 while($row = mysqli_fetch_array($admin)) 
                {
					echo'<tr>';
					echo'<td>'.$row['IdAdmin'].'</td>';
					echo'<td>'.$row['Nome'].'</td>';
					echo '<td>
					 <button class="waves-effect waves-light red btn" id="btnEliminarAdmin" data-id="'. $row['IdAdmin'] .'"><i class="tccpizza tccpizza-minus"></i></button></td>	
					 <td><button class="waves-effect waves-light btn" id="btnEditarAdmin" data-senha="'. $row['Senha'] .'" data-nome="'. $row['Nome'] .'" data-id="'. $row['IdAdmin'] .'"><i class="tccpizza tccpizza-edit"></i></button>
	                 </td>';
                     echo "</tr>";
                }
          echo '</tbody>
			</table>
		</div>
	</div>
</div>
<!---------Modal guardar admin---------->
<div id="modalGAdmin" class="modal modal-fixed-footer">
	<div class="modal-content">

		<!--Input fields-->
		<div class="container">
			<div class="row">
				<h4 class="center-align">Guardar Admin</h4>
				<form class="col s12" autocomplete="off" id="form-pizzas">
					<div class="row">
						<div class="input-field col s6">
							<input  id="nomeAdmin" type="text" class="validate">
							<label for="NomeAdmin">Nome del administrador</label>
						</div>
						<div class="input-field col s6">
							<input id="senhaAdmin" type="password" class="validate">
							<label for="senhaAdmin">Senha seña del administrador</label>
						</div>
			</div>
            </div>
		</div>

	</div>
	<div class="modal-footer">
	
		<td>
		<button class="waves-effect waves-light btn" id="btnGuardarAdmin">Guardar</button>
		<a id="btnCancelarAdmin" class="
		modal-action waves-effect waves-light red btn">Cancelar</a>
			
		</td>

	</div>
</div>
<!---------Fin modal---------->';

echo'<!---------Modal actualizar admin---------->
<div id="modalAAdmin" class="modal modal-fixed-footer">
	<div class="modal-content">

		<!--Input fields-->
		<div class="container">
			<div class="row">
				<h4 class="center-align">Actualizar Admin</h4>
				<form class="col s12" autocomplete="off" id="form-pizzas">
					<div class="row">
						<div class="input-field col s6">
							<input  id="nomeAdminA" type="text" class="validate">
							<label for="NomeAdminA">Nome del administrador</label>
						</div>
						<div class="input-field col s6">
							<input id="senhaAdminA" type="password" class="validate">
							<label for="senhaAdminA">Senha seña del administrador</label>
						</div>
						
					</div>
		</div>
        </div>

	</div>
	<div class="modal-footer">
	
		<td>
		<button class="waves-effect waves-light btn" id="btnActualizarAdmin">Actualizar</button>
		<a id="btnCancelarAdminA" class="
		modal-action waves-effect waves-light red btn">Cancelar</a>
			
		</td>

	</div>
</div>
<!---------Fin modal---------->

<script src="./js/controladorAjax.js"></script>';
mysqli_close($conexion);
}

?>