<div class="container-fluid">
    <div class="row" style="margin: 0px; background-color: #FFFFFF;">
        <div class="col-xs-12 col-sm-12 col-md-1"></div>

        <!--Imagen del producto-->
        <div class="col-xs-12 col-sm-12 col-md-5" style="padding: 0px 0px;">
            <div class="thumbnail thumbnail-producto" style="margin: 0px; padding: 30px 0px;">
                <!--Carousel with zoom-->
                <div style="width: auto; height: auto; padding: 0px;">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="false">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                            <li data-target="#myCarousel" data-slide-to="2"></li>
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" style="margin: 0 auto; width: 70%;">
                            <div class="item active">
                                <a rev="group1" rel="zoomHeight:400, zoomWidth:600, adjustX: 10, adjustY:-4, position:'body'" class='cloud-zoom' href="<?php echo base_url(); ?>uploads/img/productos/<?php echo $producto["img"]; ?>"><img src="<?php echo base_url(); ?>uploads/img/productos/<?php echo $producto["img"]; ?>" alt="<?php echo $producto["img"]; ?> 1" height="300" width="100%"/></a>
                            </div>

                            <div class="item">
                                <a rev="group1" rel="zoomHeight:400, zoomWidth:600, adjustX: 10, adjustY:-4, position:'body'" class='cloud-zoom' href="<?php echo base_url(); ?>uploads/img/productos/<?php echo $producto["img2"]; ?>"><img src="<?php echo base_url(); ?>uploads/img/productos/<?php echo $producto["img2"]; ?>" alt="<?php echo $producto["img"]; ?> 2" height="300" width="100%"/></a>
                            </div>

                            <div class="item">
                                <a rev="group1" rel="zoomHeight:400, zoomWidth:600, adjustX: 10, adjustY:-4, position:'body'" class='cloud-zoom' href="<?php echo base_url(); ?>uploads/img/productos/<?php echo $producto["img3"]; ?>"><img src="<?php echo base_url(); ?>uploads/img/productos/<?php echo $producto["img3"]; ?>" alt="<?php echo $producto["img"]; ?> 3" height="300" width="100%"/></a>
                            </div>
                        </div>

                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" style="color: black"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" style="color: black"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!--Descripcion del producto Color - Talle - Cantidad - Descripción -->
        <div class="col-xs-12 col-sm-12 col-md-5" style="padding: 0px 0px;">
            <div class="thumbnail thumbnail-producto" style="margin: 0px; padding: 30px 0px;">
             <div class="caption">
                 <div class="text-left">
                     <!--Titulo-->
                     <h1><a href="#" target="_blank"><?php echo $producto["titulo"]; ?></a></h1>
                     <!--Descripcion-->
                     <p class="descripcion"><?php echo $producto["modelo"]; ?></p>
                     <!--Marca-->
                     <p><?php echo $producto["marca"]; ?></p>
                     <!--Precio-->
                     <h5>Precio:</h5>
                     <?php if($producto["rubro"]=="Motos"): ?>
                        <p><?php echo $producto["precio"]; ?></p>
                     <?php else: ?>
                         <p><?php echo '$ '.$producto["precio"]; ?></p>
                         <!--Talle, cantidad-->
                         <div class="row">
                             <div class="col-xs-12 col-sm-12 col-md-4">
                                 <h5>Talle:</h5>
                                 <select class="form-control" id="talle" onchange="cargar_talle()">
                                     <option value=""></option>
                                     <?php foreach($producto["talles"] AS $talle): ?>
                                         <option value="<?php echo $talle ?>"><?php echo $talle; ?></option>
                                     <?php endforeach; ?>
                                 </select>
                             </div>
                             <div class="col-xs-12 col-sm-12 col-md-4">
                                 <h5>Cantidad:</h5>
                                 <select class="form-control" id="cantidad" onchange="cargar_cantidad()">
                                     <option value=""></option>
                                     <option value="1"> 1 </option>
                                     <option value="2"> 2 </option>
                                     <option value="3"> 3 </option>
                                 </select>
                             </div>
                         </div>
                     <?php endif; ?>
                     <div style="margin-top: 2%;">
                         <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#comprar_<?php echo $producto["sku"]; ?>">Lo quiero!</button>
                     </div>
                 </div>
             </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-1"></div>
    </div>
</div>

<!-- The JavaScript -->
<script type="text/javascript" src="http://code.jquery.com/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/fancybox/jquery.easing-1.3.pack.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/fancybox/jquery.fancybox-1.3.4.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/cloud-zoom/cloud-zoom.1.0.2.js"></script>
<script type="text/javascript" >
    $(function() {
        /*
        fancybox init on each cloud-zoom element
         */
        $("#content .cloud-zoom").fancybox({
            'transitionIn'	:	'elastic',
            'transitionOut'	:	'none',
            'speedIn'		:	600,
            'speedOut'		:	200,
            'overlayShow'	:	true,
            'overlayColor'	:	'#000',
            'cyclic'		:	true,
            'easingIn'		:	'easeInOutExpo'
        });

        /*
        because the cloud zoom plugin draws a mousetrap
        div on top of the image, the fancybox click needs
        to be changed. What we do here is to trigger the click
        the fancybox expects, when we click the mousetrap div.
        We know the mousetrap div is inserted after
        the <a> we want to click:
         */
        $("#content .mousetrap").live('click',function(){
            $(this).prev().trigger('click');
        });

        /*
        the content element;
        each list item / group with several images
         */
        var $content	= $('#content'),
            $thumb_list = $content.find('.thumb > ul');
        /*
        we need to set the width of each ul (sum of the children width);
        we are also defining the click events on the right and left arrows
        of each item.
         */
        $thumb_list.each(function(){
            var $this_list	= $(this),
                total_w		= 0,
                loaded		= 0,
                //preload all the images first
                $images		= $this_list.find('img'),
                total_images= $images.length;
            $images.each(function(){
                var $img	= $(this);
                $('<img/>').load(function(){
                    ++loaded;
                    if (loaded == total_images){
                        $this_list.data('current',0).children().each(function(){
                            total_w	+= $(this).width();
                        });
                        $this_list.css('width', total_w + 'px');

                        //next / prev events

                        $this_list.parent()
                            .siblings('.next')
                            .bind('click',function(e){
                                var current = $this_list.data('current');
                                if(current == $this_list.children().length -1) return false;
                                var	next	= ++current,
                                    ml		= -next * $this_list.children(':first').width();

                                $this_list.data('current',next)
                                    .stop()
                                    .animate({
                                        'marginLeft'	: ml + 'px'
                                    },400);
                                e.preventDefault();
                            })
                            .end()
                            .siblings('.prev')
                            .bind('click',function(e){
                                var current = $this_list.data('current');
                                if(current == 0) return false;
                                var	prev	= --current,
                                    ml		= -prev * $this_list.children(':first').width();

                                $this_list.data('current',prev)
                                    .stop()
                                    .animate({
                                        'marginLeft'	: ml + 'px'
                                    },400);
                                e.preventDefault();
                            });
                    }
                }).attr('src',$img.attr('src'));
            });
        });
    });
</script>