<?php
namespace es\ucm\fdi\aw;
require_once __DIR__.'/includes/config.php';
$tituloPagina = 'Informacion legal';

$contenidoPrincipal = '';

$contenidoPrincipal = <<<EOS
<div class="polit_content_wrapper">
<div class="titulo">
    <div>
        <h2> Legal information </h2>
    </div>
</div>
<div class="content_texto" id="1">
    <p> <subapartado>THIRD PARTY LEGAL NOTICES </subapartado><br>
    <br>AWDS and other AWDS products distributed via AWDS use certain third party materials that require notifications about their license terms.
    <br><br> You can find a list of these notifications in the file called ThirdPartyLegalNotices.doc distributed with the AWDS client and/or a particular AWDS product. Where license terms require AWDS to make source code available for redistribution, the code may be found here. Some geospatial data on this website is provided by geonames.org
    <br>
    <br> <subapartado> CLAIMS OF COPYRIGHT INFRINGEMENT </subapartado>
    <br>
    <br> AWDS respects the intellectual property rights of others, and we ask that everyone using our internet sites and services do the same. 
    <br><br>Anyone who believes that their work has been reproduced in one of our internet sites or services in a way that constitutes copyright infringement may notify AWDS via this page.
    <br>
    <br> <subapartado> DIGITAL SERVICES ACT NOTICE </subapartado>
    <br>
    <br>Declaration in accordance with Art. 24 (2) of Regulation (EU) 2022/2065 of the European Parliament and of the Council of 19 October 2022 on a Single Market For Digital Services: 
    <br><br>During the six-month period of August 1, 2022, to January 31, 2023, AWDS had an average of 26.3 million monthly active recipients from the European Union.</p>
</div>
<br><br>


</div>
EOS;

require __DIR__.'/includes/vistas/plantillas/plantillaUser.php';
?>
