
<?php if($envio==true): ?>
    <div class="row">
        <div class="col-md-12">
            <p>Su consulta fue enviada.</p>
        </div>
    </div>
<?php elseif($envio==false): ?>
    <div class="row">
        <div class="col-md-12">
            <p>No se pudo enviar la consulta.</p>
        </div>
    </div>
<?php endif; ?>