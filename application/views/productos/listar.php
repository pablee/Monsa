<div class="container-fluid contenido">
    <div class="container ">

        <div class="row">

            <div class="col-md-2 filtro text-left panel-degrade" style="max-height: inherit; height: 100%;">
                <div>
                    <div style="padding: 10px 15px;">
                        <h2>Filtrar por</h2>
                    </div>

                    <!--Marca-->
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-degrade">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"> Marca </a>
                                </h4>
                            </div>
                            <div id="collapse1" class="panel-collapse collapse ">
                                <ul class="list-group">
                                    <?php  if($productos==false): ?>
                                        <li class="list-group-item">No existen marcas para la busqueda realizada</li>
                                    <?php else: ?>
                                        <?php foreach($marcas AS $marca): ?>
                                            <li class="list-group-item panel-degrade" style="font-size: 12px;">
                                               <a href="filtrar?marca=<?php echo $marca["nombre"]; ?>&rubro=<?php echo $filtrado["rubro"]; ?>"><?php echo $marca["nombre"]; ?></a>
                                            </li>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!--Tipo-->
                    <div class="panel panel-degrade">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse2"> Tipo </a>
                            </h4>
                        </div>
                        <div id="collapse2" class="panel-collapse collapse ">
                            <ul class="list-group">
                                <?php  if($productos==false): ?>
                                    <li class="list-group-item">No existen tipos para la busqueda realizada</li>
                                <?php else: ?>
                                    <?php foreach($tipos AS $tipo): ?>
                                        <li class="list-group-item panel-degrade">
                                            <a href="filtrar?tipo=<?php echo $tipo["nombre"]; ?>&rubro=<?php echo $filtrado["rubro"]; ?>"><?php echo $tipo["nombre"]; ?></a>
                                        </li>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>

                    <!--Modelo-->
                    <div class="panel panel-degrade">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse3"> Modelo </a>
                            </h4>
                        </div>
                        <div id="collapse3" class="panel-collapse collapse">
                            <ul class="list-group">
                                <?php  if($productos==false): ?>
                                    <li class="list-group-item">No existen marcas para la busqueda realizada</li>
                                <?php else: ?>
                                    <?php foreach($modelos AS $modelo): ?>
                                        <li class="list-group-item panel-degrade">
                                            <a href="filtrar?modelo=<?php echo $modelo["nombre"]; ?>&rubro=<?php echo $filtrado["rubro"]; ?>"><?php echo $modelo["nombre"]; ?></a>
                                        </li>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-10 container contenido" >
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 filtro-barra" id="filtro-barra">
                        <a href="categoria?rubro=<?php echo $filtrado["rubro"]; ?>"> <?php echo ucwords($filtrado["rubro"]);?> </a>
                            <?php
                                if($filtrado["marca"]!="")
                                {
                                    echo '> '.ucwords($filtrado["marca"]);
                                }

                                if($filtrado["tipo"]!="")
                                {
                                    echo '> '.ucwords($filtrado["tipo"]);
                                }

                                if($filtrado["modelo"]!="")
                                {
                                    echo '> '.ucwords($filtrado["modelo"]);
                                }
                            ?>
                    </div>
                </div>

                <div class="row" style="margin-top: 2%;">
                    <?php  if($productos==false): ?>
                        <div class="col-xs-12 col-sm-12 col-md-3 text-center">
                            <h5>No existen productos para la busqueda realizada</h5>
                        </div>
                    <?php else: ?>
                        <?php foreach($productos AS $producto): ?>
                           <div class="col-md-3" style="margin-top: 2%; margin-bottom: 2%;">
                            <div class="thumbnail thumbnail-producto">
                                <img src="<?php echo base_url(); ?>uploads/img/productos/<?php echo $producto["img"]; ?>" alt="<?php echo $producto["titulo"]; ?>" height="auto" width="auto">
                                <div class="caption">
                                    <div class="text-center" style="height: 120px;">
                                        <!--a href="#" target="_blank"><?php echo $producto["titulo"]; ?></a-->
                                        <a href="#" target="_blank"><?php
                                                                        $titulo = substr($producto["titulo"], 0, 24);
                                                                        $titulo = strtolower($titulo);
                                                                        echo ucwords($titulo);
                                                                        ?></a>
                                        <p class="descripcion"><?php echo $producto["modelo"]; ?></p>

                                        <?php if($producto["rubro"]=="Motos"): ?>
                                            <p style="font-size: 17px;"><?php echo $producto["precio"]; ?></p>
                                        <?php else: ?>
                                            <p><?php echo '$ '.$producto["precio"]; ?></p>
                                        <?php endif; ?>

                                        <!--button type="button" class="btn btn-danger" data-toggle="modal" data-target="#comprar_<?php echo $producto["sku"]; ?>">Lo quiero!</--button-->
                                    </div>
                                    <a href="producto?sku=<?php echo $producto["sku"]; ?>" class="btn btn-danger btn-xs">Ver m&aacute;s</a>
                                </div>
                            </div>
                           </div>
                        <?php
                        $i++;
                            if($i == 4)
                            {
                                $i=0;
                                echo '</div><div class="row">';
                            }
                        ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

        </div>

    </div>
</div>