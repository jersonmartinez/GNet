<!-- Este es el fichero de cabecera!. -->
<meta charset="utf-8">
<title>GNet <?php echo empty(@$_SESSION['username']) ? "" : " | ".@$_SESSION['username']; ?></title>
<meta name="keywords" content="GNet - Sistema de Gestión de Red" />
<meta name="description" content="GNet - Sistema de Gestión de Red">
<meta name="author" content="GNet">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="<?php echo PDS_CTL_SRC; ?>/plugins/assets/img/favicon.ico">

<!-- FullCalendar Plugin CSS -->
<!-- <link rel="stylesheet" type="text/css" href="app/controller/src/plugins/vendor/plugins/fullcalendar/fullcalendar.min.css"> -->

<link rel="stylesheet" type="text/css" href="<?php echo PDS_SRC_PLUGINS_ASSETS_SKIN; ?>/default_skin/css/theme.css">

<!-- Admin Forms CSS -->
<link rel="stylesheet" type="text/css" href="<?php echo PDS_SRC_PLUGINS_ASSETS_ADMINTOOLS; ?>/admin-forms/css/admin-forms.min.css">

<!-- Editable -->
<link href="<?php echo PDS_SRC_PLUGINS_VENDOR_PLUGINS; ?>/xeditable/css/bootstrap-editable.css" rel="stylesheet" type="text/css">

<!-- Esta libreria es para el efecto de carga, es necesaria su version en JS, esta en el fichero ic.foot_js.php -->
<link rel="stylesheet" type="text/css" href="<?php echo PDS_SRC_PLUGINS_VENDOR_PLUGINS; ?>/ladda/ladda.min.css">

<link rel="stylesheet" type="text/css" href="<?php echo PDS_DESKTOP_ROOT_CSS; ?>/battery.css">
<link href="<?php echo PDS_SRC_PLUGINS_VENDOR_PLUGINS; ?>/bstour/bootstrap-tour.css" rel="stylesheet" type="text/css"> 

<!-- Para los calendarios... -->
<!-- <link rel="stylesheet" type="text/css" href="<?php echo PDS_SRC_PLUGINS_VENDOR_PLUGINS; ?>/datepicker/css/bootstrap-datetimepicker.css"> -->