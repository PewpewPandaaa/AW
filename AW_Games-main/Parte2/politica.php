<?php
namespace es\ucm\fdi\aw;
require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Politica';

$contenidoPrincipal = '';

$contenidoPrincipal.=<<<EOS
    <div id="contenido_gestion_user">
EOS;

$contenidoPrincipal .= <<<EOS
<div class="polit_content_wrapper">
<div class="titulo">
    <div>
        <h2> Privacy policy </h2>
    </div>
</div>
<div class="content_texto" id="1">
    <p> 
    <apartado>
    1. Definitions</apartado><br>
    <br><br>
        Wherever we talk about Personal Data below, we mean any information that can either itself identify you as an individual ("Personally Identifying Information") or that can be connected to you indirectly by linking it to Personally Identifying Information. AWDS also processes anonymous data, aggregated or not, to analyze and produce statistics related to the habits, usage patterns, and demographics of customers as a group or as individuals. Such anonymous data does not allow the identification of the customers to which it relates. AWDS may share anonymous data, aggregated or not, with third parties.

        <br><br>Other capitalized terms in this Privacy Policy shall have the meanings defined in the AWDS Subscriber Agreement ("SSA").
        <br><br>
        <br><apartado>2. Why AWDS Collects and Processes Data</apartado><br>
        <br><br>
        AWDS collects and processes Personal Data for the following reasons:<br><br>

        a) where it is necessary for the performance of our agreement with you to provide a full-featured gaming service and deliver associated Content and Services;<br>
        <br> b) where it is necessary for compliance with legal obligations that we are subject to (e.g. our obligations to keep certain information under tax laws);<br>
        <br>c) where it is necessary for the purposes of the legitimate and legal interests of AWDS or a third party (e.g. the interests of our other customers), except where such interests are overridden by your prevailing legitimate interests and rights; or<br>
        <br> d) where you have given consent to it.

        <br> <br>These reasons for collecting and processing Personal Data determine and limit what Personal Data we collect and how we use it (section 3. below), how long we store it (section 4. below), who has access to it (section 5. below) and what rights and other control mechanisms are available to you as a user (section 6. below).
        <br><br><br><apartado>3. The Types and Sources of Data We Collect</apartado>
        <br><br><br><subapartado> 3.1 Basic Account Data</subapartado>
        <br><br>
        <br>When setting up an Account, AWDS will collect your email address and country of residence. You are also required to choose a user name and a password. The provision of this information is necessary to register a AWDS User Account.
        <br><br> During setup of your account, the account is automatically assigned a number (the "AWDS ID") that is later used to reference your user account without directly exposing Personally Identifying Information about you.
        <br><br>We do not require you to provide or use your real name for the setup of a AWDS User Account.
        <br><br>
        <br> <subapartado>3.2 Transaction and Payment Data</subapartado>
        <br><br>
        <br> In order to make a transaction on AWDS (e.g. to purchase Subscriptions for Content and Services or to fund your AWDS Wallet), you may need to provide payment data to AWDS to enable the transaction. 
        <br><br>If you pay by credit card, you need to provide typical credit card information (name, address, credit card number, expiration date and security code) to AWDS, which AWDS will process and transmit to the payment service provider of your choice to enable the transaction and perform anti-fraud checks. 
        <br><br>Likewise, AWDS will receive data from your payment service provider for the same reasons.
        <br><br>
        <br> <subapartado>3.3 Other Data You Explicitly Submit</subapartado>
        <br><br>
        We will collect and process Personal Data whenever you explicitly provide it to us or send it as part of communication with others on AWDS, e.g. in AWDS Community Forums, chats, or when you provide feedback or other user generated content. This data includes:<br>
        <br> 1. Information that you post, comment or follow in any of our Content and Services;<br>
        <br> 2. Information sent through chat;<br>
        <br>3. Information you provide when you request information or support from us or purchase Content and Services from us, including information necessary to process your orders with the relevant payment merchant or, in case of physical goods, shipping providers;<br>
        <br>4. Information you provide to us when participating in competitions, contests and tournaments or responding to surveys, e.g. your contact details.<br>
        <br> <subapartado>
        <br>3.4 Your Use of the AWDS Client and Websites </subapartado>
        <br><br>
        <br>We collect a variety of information through your general interaction with the websites, Content and Services offered by AWDS. Personal Data we collect may include, but is not limited to, browser and device information, data collected through automated electronic interactions and application usage data.
        <br><br>Likewise, we will track your process across our websites and applications to verify that you are not a bot and to optimize our services.
        <br><br>
        <br><br>
        <br><br>
    </p>
</div>

</div>
EOS;
require __DIR__.'/includes/vistas/plantillas/plantillaUser.php';
?>