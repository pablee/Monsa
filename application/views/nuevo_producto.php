
<div class="row">

    <div class="col-md-2"></div>

    <div class="col-md-8">
        <div class="panel panel-primary">
            <div class="panel-heading">Nuevo producto</div>
            <div class="panel-body">
                <form name="grilla" method="POST" action="upload_producto" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="sku"> SKU </label>
                        <input type="text" class="form-control" id="sku" name="grilla[sku]" required></input>
                    </div>

                    <div class="form-group">
                        <label for="titulo"> Titulo </label>
                        <!--label style="color: red; font-size: 10px;">No puede contener ms de 24 caracteres</label-->
                        <input type="text" class="form-control" id="titulo" name="grilla[titulo]" maxlength="25"></input>
                        <h5 style="color: red; font-size: 10px;">No puede contener ms de 24 caracteres</h5>
                    </div>

                    <div class="form-group">
                        <label for="stock"> Stock </label>
                        <input type="text" class="form-control" id="stock" name="grilla[stock]"></input>
                    </div>

                    <div class="form-group">
                        <label for="precio"> Precio </label>
                        <input type="text" class="form-control" id="precio" name="grilla[precio]"></input>
                    </div>

                    <div class="form-group">
                        <label for="rubro"> Rubro </label>
                        <!--input type="text" class="form-control" id="rubro" name="grilla[rubro]"></input-->
                        <select class="form-control" id="rubro" name="grilla[rubro]" required>
                            <option value=""></option>
                            <?php foreach($rubros AS $rubro): ?>
                                <option value="<?php echo $rubro; ?>"> <?php echo $rubro; ?> </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="marca"> Marca </label>
                        <!--input type="text" class="form-control" id="marca" name="grilla[marca]"></input-->
                        <select class="form-control" id="marca" name="grilla[marca]" required>
                            <option value=""></option>
                            <?php foreach($marcas AS $marca): ?>
                                <option value="<?php echo $marca; ?>"> <?php echo $marca; ?> </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tipo"> Tipo </label>
                        <!--input type="text" class="form-control" id="marca" name="grilla[marca]"></input-->
                        <select class="form-control" id="marca" name="grilla[tipo]" required>
                            <option value=""></option>
                            <?php foreach($tipos AS $tipo): ?>
                                <option value="<?php echo $tipo; ?>"> <?php echo $tipo; ?> </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="modelo"> Modelo </label>
                        <input type="text" class="form-control" id="marca" name="grilla[modelo]"></input>
                    </div>

                    <div class="form-group">
                        <label for="talle"> Talle </label>
                        <input type="text" class="form-control" id="marca" name="grilla[talle]"></input>
                    </div>

                    <div class="form-group">
                        <label for="destacado"> Destacado </label>
                        <select class="form-control" id="destacado" name="grilla[destacado]">
                            <option value="0"> No </option>
							<option value="1"> Si </option>                            
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="publicado"> Publicado </label>
                        <select class="form-control" id="publicado" name="grilla[publicado]">
                            <option value="1"> Si </option>
                            <option value="0"> No </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="archivo"> Seleccione la imagen principal del producto </label>
                        <input type="file" class="form-control" id="archivo" name="archivo"></input>
                    </div>

                    <div class="form-group">
                        <label for="archivo"> Seleccione la segunda imagen del producto </label>
                        <input type="file" class="form-control" id="archivo" name="archivo_2"></input>
                    </div>

                    <div class="form-group">
                        <label for="archivo"> Seleccione la tercer imagen del producto </label>
                        <input type="file" class="form-control" id="archivo" name="archivo_3"></input>
                    </div>

                    <div class="text-right">
                        <br>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <div class="col-md-2"></div>
</div>
