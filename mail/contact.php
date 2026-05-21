<?php
// Validar campos obligatorios
if(
    empty($_POST['nombre']) ||
    empty($_POST['email']) ||
    empty($_POST['number']) ||
    empty($_POST['projectType']) ||
    empty($_POST['budget']) ||
    empty($_POST['urgency']) ||
    !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)
) {
    http_response_code(500);
    exit();
}

$nombre = strip_tags(htmlspecialchars($_POST['nombre']));
$email = strip_tags(htmlspecialchars($_POST['email']));
$celular = strip_tags(htmlspecialchars($_POST['number']));
$tipoProyecto = strip_tags(htmlspecialchars($_POST['projectType']));
$presupuesto = strip_tags(htmlspecialchars($_POST['budget']));
$urgencia = strip_tags(htmlspecialchars($_POST['urgency']));
$mensaje = isset($_POST['message']) ? strip_tags(htmlspecialchars($_POST['message'])) : '';

$to = "Henaoortegonvalerin@gmail.com";
$subject = "Nuevo mensaje de contacto desde la web";
$body = "<html><body style='font-family: Arial, sans-serif; background: #f8e6ff; padding: 24px;'>";
$body .= "<div style='max-width: 520px; margin: auto; background: #fff; border-radius: 18px; box-shadow: 0 2px 12px #9B7E9B22; padding: 32px;'>";
$body .= "<h2 style='color: #9B7E9B; text-align: center; margin-bottom: 24px;'>Nuevo mensaje de contacto</h2>";
$body .= "<table cellpadding='8' style='width:100%; border-collapse:collapse; font-size: 1.08em; color: #2f2237;'>";
$body .= "<tr><td style='font-weight: bold; color: #9B7E9B;'>Nombre:</td><td>".$nombre."</td></tr>";
$body .= "<tr><td style='font-weight: bold; color: #9B7E9B;'>Email:</td><td>".$email."</td></tr>";
$body .= "<tr><td style='font-weight: bold; color: #9B7E9B;'>Celular:</td><td>".$celular."</td></tr>";
$body .= "<tr><td style='font-weight: bold; color: #9B7E9B;'>Tipo de Proyecto:</td><td>".$tipoProyecto."</td></tr>";
$body .= "<tr><td style='font-weight: bold; color: #9B7E9B;'>Presupuesto Aproximado:</td><td>$".number_format($presupuesto, 0, ',', '.')."</td></tr>";
$body .= "<tr><td style='font-weight: bold; color: #9B7E9B;'>Urgencia:</td><td>".$urgencia."</td></tr>";
$body .= "<tr><td style='font-weight: bold; color: #9B7E9B;'>Mensaje:</td><td>".nl2br($mensaje)."</td></tr>";
$body .= "</table>";
$body .= "</div>";
$body .= "</body></html>";

$header = "MIME-Version: 1.0" . "\r\n";
$header .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$header .= "From: $email\r\nReply-To: $email";

if(!mail($to, $subject, $body, $header))
    http_response_code(500);
?>
