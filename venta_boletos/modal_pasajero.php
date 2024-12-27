<div class="modal fade" id="asientos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header text-center">
				<center><h4 class="modal-title" id="myModalLabel">Registrar pasajero</h4></center>
			</div>
			<div class="modal-body">
				<div class="container-fluid text-center">
					<form enctype="multipart/form-data" class="form-horizontal" method="post" name="frm_asientos" id="frm_asientos">
						<div class="form-group input-group" hidden="">
							<input type="text" class="form-control" id="id_asiento" name="id_asiento">
						</div>
						<div class="form-group">
							<label>Asiento numero</label>
							<input type="text" class="form-control" id="asiento" name="asiento" disabled="">
						</div>
						<div class="form-group">
							<label>Nombre del pasajero</label>
							<input type="text" name="nombre" class="form-control" required="">
						</div>
					</form>
				</div>
			</div>
			<div class="modal-footer">
				<input type="submit" value="Registrar" class="btn btn-sm btn-block btn-success" onclick="asientos();">
			</div>
		</div>
	</div>
</div>