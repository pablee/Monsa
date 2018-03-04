<h2>Creación de Pedido Cabecera</h2>

<?php echo validation_errors(); ?>

<?php echo form_open('pedido_cabecera/create'); ?>

    <label for="id_pedido">Identificador</label>
    <input type="input" name="id_pedido" /><br />

    <label for="cod_cliente">Código de cliente</label>
    <textarea name="cod_cliente"></textarea><br />

    <label for="fec_creacion">Fecha de Creación</label>
    <textarea name="fec_creacion"></textarea><br />
	
    <input type="submit" name="submit" value="Create pedido_cabecera item" />

</form>