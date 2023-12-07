<?php
// Panggil koneksi database Anda dan buat objek Data (atau sesuaikan dengan implementasi Anda)
// include 'php/db.php'; // Gantilah dengan file koneksi Anda
// $data = new Database();

// require_once('php/functions.php'); // Memanggil file functions.php
include dirname(__DIR__) . '/Autoloader.php';
// include '../Autoloader.php';
// include '../config/load.php';

// $database = new Database($dbConfig);

// Gantilah 'users' dengan nama tabel pengguna Anda
// $user = $database->read('warga', "nik = " . $_SESSION['user_id'] . "");
// $data = new Functions(); // Membuat objek Functions

// Menghitung jumlah seluruh warga=
// Menghitung jumlah warga laki-laki
// $maleCount = $data->countResidents('jk', 'L');
// $FemaleCount = $data->countResidents('jk', 'P');
// $AllCount = $data->countResidents();
include __DIR__ . '/templates/header.php'; // Memanggil file functions.php
include __DIR__ . '/templates/menu.php'; // Memanggil file functions.php

?>
<!-- END NAVIGATION -->

<!-- MAIN PANEL -->
<div id="main" role="main">

    <!-- RIBBON -->
    <div id="ribbon">

        <span class="ribbon-button-alignment">
            <span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh" rel="tooltip"
                data-placement="bottom"
                data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings."
                data-html="true">
                <i class="fa fa-refresh"></i>
            </span>
        </span>

        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li>Home</li>
            <li>Tables</li>
            <li>Data Tables</li>
        </ol>
        <!-- end breadcrumb -->

    </div>
    <!-- END RIBBON -->

    <!-- MAIN CONTENT -->
    <div id="content">



        <!-- widget grid -->
        <section id="widget-grid" class="">

            <!-- row -->
            <div class="row">

                <!-- NEW WIDGET START -->
                <!-- NEW COL START -->
                <article class="col-sm-12 col-md-12 col-lg-12">

                    <!-- Widget ID (each widget will need unique ID)-->
                    <div class="jarviswidget" id="wid-id-8" data-widget-colorbutton="false"
                        data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false"
                        data-widget-fullscreenbutton="false" data-widget-custombutton="false"
                        data-widget-sortable="false">
                        <!-- widget options:
																usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

																data-widget-colorbutton="false"
																data-widget-editbutton="false"
																data-widget-togglebutton="false"
																data-widget-deletebutton="false"
																data-widget-fullscreenbutton="false"
																data-widget-custombutton="false"
																data-widget-collapsed="true"
																data-widget-sortable="false"

																-->
                        <header>
                            <h2>Header Tabs Right</h2>
                            <ul class="nav nav-tabs pull-right in">

                                <li class="active">

                                    <a data-toggle="tab" href="#hb1"> <i class="fa fa-lg fa-arrow-circle-o-down"></i>
                                        <span class="hidden-mobile hidden-tablet"> Profil Identitas </span> </a>

                                </li>

                                <li>
                                    <a data-toggle="tab" href="#hb2"> 
                                        <span class="hidden-mobile hidden-tablet"> Pekerjaan </span> </a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#hb2"> 
                                        <span class="hidden-mobile hidden-tablet"> Sekolah <span
                                                class="label bg-color-blue txt-color-white"> label <i
                                                    class="fa fa-exclamation"></i> </span> </span> </a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#hb2"> 
                                        <span class="hidden-mobile hidden-tablet"> Catatan Kriminal <span
                                                class="label bg-color-blue txt-color-white"> label <i
                                                    class="fa fa-exclamation"></i> </span> </span> </a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#hb2"> 
                                        <span class="hidden-mobile hidden-tablet"> Tanah <span
                                                class="label bg-color-blue txt-color-white"> label <i
                                                    class="fa fa-exclamation"></i> </span> </span> </a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#hb2"> 
                                        <span class="hidden-mobile hidden-tablet"> Anggota Keluarga <span
                                                class="label bg-color-blue txt-color-white"> label <i
                                                    class="fa fa-exclamation"></i> </span> </span> </a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#hb2"> 
                                        <span class="hidden-mobile hidden-tablet"> Password <span
                                                class="label bg-color-blue txt-color-white"> label <i
                                                    class="fa fa-exclamation"></i> </span> </span> </a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#hb2"> 
                                        <span class="hidden-mobile hidden-tablet"> Password <span
                                                class="label bg-color-blue txt-color-white"> label <i
                                                    class="fa fa-exclamation"></i> </span> </span> </a>
                                </li>

                            </ul>
                        </header>

                        <!-- widget div-->
                        <div>

                            <!-- widget edit box -->
                            <div class="jarviswidget-editbox">
                                <!-- This area used as dropdown edit box -->

                            </div>
                            <!-- end widget edit box -->

                            <!-- widget content -->
                            <div class="widget-body">

                                <div class="tab-content">
                                    <div class="tab-pane active" id="hb1">

                                        <form class="form-horizontal">

                                            <fieldset>
                                                <legend>Default Form Elements</legend>
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">NIK</label>
                                                    <div class="col-md-4">
                                                        <input class="form-control" placeholder="Default Text Field"
                                                            type="text">
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label class="col-md-2 control-label">NO. KK</label>
                                                    <div class="col-md-4">
                                                        <input class="form-control" placeholder="Default Text Field"
                                                            type="text">
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label class="col-md-2 control-label">Nama Lengkap</label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" placeholder="Default Text Field"
                                                            type="text">
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label class="col-md-2 control-label">Nama Panggilan</label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" placeholder="Default Text Field"
                                                            type="text">
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label class="col-md-2 control-label">Tempat</label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" placeholder="Default Text Field"
                                                            type="text">
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label class="col-md-2 control-label">Tanggal Lahir</label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" placeholder="Default Text Field"
                                                            type="text">
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label class="col-md-2 control-label">Hubungan Dalam Keluarga</label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" placeholder="Default Text Field"
                                                            type="text">
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label class="col-md-2 control-label">Tempat</label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" placeholder="Default Text Field"
                                                            type="text">
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label class="col-md-2 control-label">Tempat</label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" placeholder="Default Text Field"
                                                            type="text">
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label class="col-md-2 control-label">Tempat</label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" placeholder="Default Text Field"
                                                            type="text">
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label class="col-md-2 control-label">Tempat</label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" placeholder="Default Text Field"
                                                            type="text">
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label class="col-md-2 control-label">Tempat</label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" placeholder="Default Text Field"
                                                            type="text">
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label class="col-md-2 control-label">Tempat</label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" placeholder="Default Text Field"
                                                            type="text">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Auto Complete</label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" placeholder="Type somethine..."
                                                            type="text" list="list">
                                                        <datalist id="list">
                                                            <option value="Alexandra">Alexandra</option>
                                                            <option value="Alice">Alice</option>
                                                            <option value="Anastasia">Anastasia</option>
                                                            <option value="Avelina">Avelina</option>
                                                            <option value="Basilia">Basilia</option>
                                                            <option value="Beatrice">Beatrice</option>
                                                            <option value="Cassandra">Cassandra</option>
                                                            <option value="Cecil">Cecil</option>
                                                            <option value="Clemencia">Clemencia</option>
                                                            <option value="Desiderata">Desiderata</option>
                                                            <option value="Dionisia">Dionisia</option>
                                                            <option value="Edith">Edith</option>
                                                            <option value="Eleanora">Eleanora</option>
                                                            <option value="Elizabeth">Elizabeth</option>
                                                            <option value="Emma">Emma</option>
                                                            <option value="Felicia">Felicia</option>
                                                            <option value="Florence">Florence</option>
                                                            <option value="Galiana">Galiana</option>
                                                            <option value="Grecia">Grecia</option>
                                                            <option value="Helen">Helen</option>
                                                            <option value="Helewisa">Helewisa</option>
                                                            <option value="Idonea">Idonea</option>
                                                            <option value="Isabel">Isabel</option>
                                                            <option value="Joan">Joan</option>
                                                            <option value="Juliana">Juliana</option>
                                                            <option value="Karla">Karla</option>
                                                            <option value="Karyn">Karyn</option>
                                                            <option value="Kate">Kate</option>
                                                            <option value="Lakisha">Lakisha</option>
                                                            <option value="Lana">Lana</option>
                                                            <option value="Laura">Laura</option>
                                                            <option value="Leona">Leona</option>
                                                            <option value="Mandy">Mandy</option>
                                                            <option value="Margaret">Margaret</option>
                                                            <option value="Maria">Maria</option>
                                                            <option value="Nanacy">Nanacy</option>
                                                            <option value="Nicole">Nicole</option>
                                                            <option value="Olga">Olga</option>
                                                            <option value="Pamela">Pamela</option>
                                                            <option value="Patricia">Patricia</option>
                                                            <option value="Qiana">Qiana</option>
                                                            <option value="Rachel">Rachel</option>
                                                            <option value="Ramona">Ramona</option>
                                                            <option value="Samantha">Samantha</option>
                                                            <option value="Sandra">Sandra</option>
                                                            <option value="Tanya">Tanya</option>
                                                            <option value="Teresa">Teresa</option>
                                                            <option value="Ursula">Ursula</option>
                                                            <option value="Valerie">Valerie</option>
                                                            <option value="Veronica">Veronica</option>
                                                            <option value="Wilma">Wilma</option>
                                                            <option value="Yasmin">Yasmin</option>
                                                            <option value="Zelma">Zelma</option>
                                                        </datalist>
                                                        <p class="note"><strong>Note:</strong> works in Chrome, Firefox,
                                                            Opera and IE10.
                                                        </p>
                                                    </div>

                                                </div>

                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Password field</label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" placeholder="Password field"
                                                            type="password" value="mypassword">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Alamat</label>
                                                    <div class="col-md-10">
                                                        <textarea class="form-control" placeholder="Textarea"
                                                            rows="4"></textarea>
                                                    </div>
                                                </div>


                                            </fieldset>

                                            <fieldset>
                                                <legend>Hobi</legend>
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Checkbox default</label>
                                                    <div class="col-md-10">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox">
                                                                Checkbox 1 </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox">
                                                                Checkbox 2 </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox">
                                                                Checkbox 3 </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Inline</label>
                                                    <div class="col-md-10">
                                                        <label class="checkbox-inline">
                                                            <input type="checkbox">
                                                            Checkbox 2 </label>
                                                        <label class="checkbox-inline">
                                                            <input type="checkbox">
                                                            Checkbox 2 </label>
                                                        <label class="checkbox-inline">
                                                            <input type="checkbox">
                                                            Checkbox 3 </label>
                                                    </div>
                                                </div>

                                            </fieldset>

                                            <fieldset>
                                                <legend>Unstyled Radiobox</legend>
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Radios default</label>
                                                    <div class="col-md-10">
                                                        <div class="radio">
                                                            <label>
                                                                <input type="radio">
                                                                Radiobox 1 </label>
                                                        </div>
                                                        <div class="radio">
                                                            <label>
                                                                <input type="radio">
                                                                Radiobox 2 </label>
                                                        </div>
                                                        <div class="radio">
                                                            <label>
                                                                <input type="radio">
                                                                Radiobox 3 </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Inline</label>
                                                    <div class="col-md-10">
                                                        <label class="radio radio-inline">
                                                            <input type="radio">
                                                            Radiobox 1 </label>
                                                        <label class="radio radio-inline">
                                                            <input type="radio">
                                                            Radiobox 2 </label>
                                                        <label class="radio radio-inline">
                                                            <input type="radio">
                                                            Radiobox 3 </label>
                                                    </div>
                                                </div>



                                            </fieldset>

                                            <fieldset>
                                                <legend>File inputs</legend>

                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">File input</label>
                                                    <div class="col-md-10">
                                                        <input type="file" class="btn btn-default"
                                                            id="exampleInputFile1">
                                                        <p class="help-block">
                                                            some help text here.
                                                        </p>
                                                    </div>
                                                </div>

                                            </fieldset>

                                            <fieldset class="demo-switcher-1">
                                                <legend>Styled Checkbox and Radiobox</legend>

                                                <span class="toggle-demo">
                                                    <span>Styles: </span>
                                                    <span class="btn-group btn-group-justified" data-toggle="buttons">
                                                        <label class="btn btn-default btn-xs active">
                                                            <input type="radio" name="demo-switcher-1" id="style-0"> 1
                                                        </label>
                                                        <label class="btn btn-default btn-xs">
                                                            <input type="radio" name="demo-switcher-1" id="style-1"> 2
                                                        </label>
                                                        <label class="btn btn-default btn-xs">
                                                            <input type="radio" name="demo-switcher-1" id="style-2"> 3
                                                        </label>
                                                        <label class="btn btn-default btn-xs">
                                                            <input type="radio" name="demo-switcher-1" id="style-3"> 4
                                                        </label>
                                                    </span>
                                                </span>
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Checkbox Styles</label>
                                                    <div class="col-md-10">

                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" class="checkbox style-0"
                                                                    checked="checked">
                                                                <span>Checkbox 1</span>
                                                            </label>
                                                        </div>

                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" class="checkbox style-0">
                                                                <span>Checkbox 2</span>
                                                            </label>
                                                        </div>

                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" class="checkbox style-0">
                                                                <span>Checkbox 3</span>
                                                            </label>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Inline</label>
                                                    <div class="col-md-10">
                                                        <label class="checkbox-inline">
                                                            <input type="checkbox" class="checkbox style-0">
                                                            <span>Checkbox 1</span>
                                                        </label>
                                                        <label class="checkbox-inline">
                                                            <input type="checkbox" class="checkbox style-0">
                                                            <span>Checkbox 2</span>
                                                        </label>
                                                        <label class="checkbox-inline">
                                                            <input type="checkbox" class="checkbox style-0">
                                                            <span>Checkbox 3</span>
                                                        </label>
                                                    </div>
                                                </div>

                                            </fieldset>

                                            <fieldset class="demo-switcher-1">
                                                <legend></legend>

                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Radios Styles</label>
                                                    <div class="col-md-10">
                                                        <div class="radio">
                                                            <label>
                                                                <input type="radio" class="radiobox style-0"
                                                                    checked="checked" name="style-0">
                                                                <span>Radiobox 1</span>
                                                            </label>
                                                        </div>
                                                        <div class="radio">
                                                            <label>
                                                                <input type="radio" class="radiobox style-0"
                                                                    name="style-0">
                                                                <span>Radiobox 2</span>
                                                            </label>
                                                        </div>
                                                        <div class="radio">
                                                            <label>
                                                                <input type="radio" class="radiobox style-0"
                                                                    name="style-0">
                                                                <span>Radiobox 3</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Inline</label>
                                                    <div class="col-md-10">
                                                        <label class="radio radio-inline">

                                                            <input type="radio" class="radiobox" name="style-0a">
                                                            <span>Radiobox 1</span>

                                                        </label>
                                                        <label class="radio radio-inline">
                                                            <input type="radio" class="radiobox" name="style-0a">
                                                            <span>Radiobox 2</span>
                                                        </label>
                                                        <label class="radio radio-inline">
                                                            <input type="radio" class="radiobox" name="style-0a">
                                                            <span>Radiobox 3</span>
                                                        </label>
                                                    </div>
                                                </div>

                                            </fieldset>

                                            <fieldset>
                                                <legend>Unstyled Select</legend>
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label" for="select-1">Select</label>
                                                    <div class="col-md-10">

                                                        <select class="form-control" id="select-1">
                                                            <option>Amsterdam</option>
                                                            <option>Atlanta</option>
                                                            <option>Baltimore</option>
                                                            <option>Boston</option>
                                                            <option>Buenos Aires</option>
                                                            <option>Calgary</option>
                                                            <option>Chicago</option>
                                                            <option>Denver</option>
                                                            <option>Dubai</option>
                                                            <option>Frankfurt</option>
                                                            <option>Hong Kong</option>
                                                            <option>Honolulu</option>
                                                            <option>Houston</option>
                                                            <option>Kuala Lumpur</option>
                                                            <option>London</option>
                                                            <option>Los Angeles</option>
                                                            <option>Melbourne</option>
                                                            <option>Mexico City</option>
                                                            <option>Miami</option>
                                                            <option>Minneapolis</option>
                                                        </select>

                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label" for="multiselect1">Multiple
                                                        select</label>
                                                    <div class="col-md-10">
                                                        <select multiple="multiple" id="multiselect1"
                                                            class="form-control custom-scroll"
                                                            title="Click to Select a City">
                                                            <option>Amsterdam</option>
                                                            <option selected="selected">Atlanta</option>
                                                            <option>Baltimore</option>
                                                            <option>Boston</option>
                                                            <option>Buenos Aires</option>
                                                            <option>Calgary</option>
                                                            <option selected="selected">Chicago</option>
                                                            <option>Denver</option>
                                                            <option>Dubai</option>
                                                            <option>Frankfurt</option>
                                                            <option>Hong Kong</option>
                                                            <option>Honolulu</option>
                                                            <option>Houston</option>
                                                            <option>Kuala Lumpur</option>
                                                            <option>London</option>
                                                            <option>Los Angeles</option>
                                                            <option>Melbourne</option>
                                                            <option>Mexico City</option>
                                                            <option>Miami</option>
                                                            <option>Minneapolis</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </fieldset>

                                            <fieldset>
                                                <legend>Input States</legend>

                                                <div class="form-group has-warning">
                                                    <label class="col-md-2 control-label">Input warning</label>
                                                    <div class="col-md-10">
                                                        <div class="input-group">
                                                            <input class="form-control" type="text">
                                                            <span class="input-group-addon"><i
                                                                    class="fa fa-warning"></i></span>
                                                        </div>
                                                        <span class="help-block">Something may have gone wrong</span>
                                                    </div>

                                                </div>

                                                <div class="form-group has-error">
                                                    <label class="col-md-2 control-label">Input error</label>
                                                    <div class="col-md-10">
                                                        <div class="input-group">
                                                            <input class="form-control" type="text">
                                                            <span class="input-group-addon"><i
                                                                    class="glyphicon glyphicon-remove-circle"></i></span>
                                                        </div>
                                                        <span class="help-block"><i class="fa fa-warning"></i> Please
                                                            correct the
                                                            error</span>
                                                    </div>
                                                </div>

                                                <div class="form-group has-success">
                                                    <label class="col-md-2 control-label">Input success</label>
                                                    <div class="col-md-10">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i
                                                                    class="fa fa-dollar"></i></span>
                                                            <input class="form-control" type="text">
                                                            <span class="input-group-addon"><i
                                                                    class="fa fa-check"></i></span>
                                                        </div>
                                                        <span class="help-block">Something may have gone wrong</span>
                                                    </div>
                                                </div>

                                            </fieldset>

                                            <fieldset>
                                                <legend>Input sizes</legend>

                                                <div class="form-group">
                                                    <label class="control-label col-md-2">Extra Small Input</label>
                                                    <div class="col-md-10">
                                                        <input class="form-control input-xs" placeholder=".input-xs"
                                                            type="text">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-2">Small Input</label>
                                                    <div class="col-md-10">
                                                        <input class="form-control input-sm" placeholder=".input-sm"
                                                            type="text">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-2">Default Input</label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" placeholder="Default input"
                                                            type="text">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-2">Large Input</label>
                                                    <div class="col-md-10">
                                                        <input class="form-control input-lg" placeholder=".input-lg"
                                                            type="text">
                                                    </div>
                                                </div>

                                            </fieldset>

                                            <fieldset>
                                                <legend>Select Sizes</legend>
                                                <div class="form-group">
                                                    <label class="control-label col-md-2">Small Select</label>
                                                    <div class="col-md-10">
                                                        <select class="form-control input-sm">
                                                            <option>Amsterdam</option>
                                                            <option>Atlanta</option>
                                                            <option>Baltimore</option>
                                                            <option>Boston</option>
                                                            <option>Buenos Aires</option>
                                                            <option>Calgary</option>
                                                            <option>Chicago</option>
                                                            <option>Denver</option>
                                                            <option>Dubai</option>
                                                            <option>Frankfurt</option>
                                                            <option>Hong Kong</option>
                                                            <option>Honolulu</option>
                                                            <option>Houston</option>
                                                            <option>Kuala Lumpur</option>
                                                            <option>London</option>
                                                            <option>Los Angeles</option>
                                                            <option>Melbourne</option>
                                                            <option>Mexico City</option>
                                                            <option>Miami</option>
                                                            <option>Minneapolis</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-2">Default Select</label>
                                                    <div class="col-md-10">
                                                        <select class="form-control">
                                                            <option>Amsterdam</option>
                                                            <option>Atlanta</option>
                                                            <option>Baltimore</option>
                                                            <option>Boston</option>
                                                            <option>Buenos Aires</option>
                                                            <option>Calgary</option>
                                                            <option>Chicago</option>
                                                            <option>Denver</option>
                                                            <option>Dubai</option>
                                                            <option>Frankfurt</option>
                                                            <option>Hong Kong</option>
                                                            <option>Honolulu</option>
                                                            <option>Houston</option>
                                                            <option>Kuala Lumpur</option>
                                                            <option>London</option>
                                                            <option>Los Angeles</option>
                                                            <option>Melbourne</option>
                                                            <option>Mexico City</option>
                                                            <option>Miami</option>
                                                            <option>Minneapolis</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-2">Large Select</label>
                                                    <div class="col-md-10">
                                                        <select class="form-control input-lg">
                                                            <option>Amsterdam</option>
                                                            <option>Atlanta</option>
                                                            <option>Baltimore</option>
                                                            <option>Boston</option>
                                                            <option>Buenos Aires</option>
                                                            <option>Calgary</option>
                                                            <option>Chicago</option>
                                                            <option>Denver</option>
                                                            <option>Dubai</option>
                                                            <option>Frankfurt</option>
                                                            <option>Hong Kong</option>
                                                            <option>Honolulu</option>
                                                            <option>Houston</option>
                                                            <option>Kuala Lumpur</option>
                                                            <option>London</option>
                                                            <option>Los Angeles</option>
                                                            <option>Melbourne</option>
                                                            <option>Mexico City</option>
                                                            <option>Miami</option>
                                                            <option>Minneapolis</option>
                                                        </select>
                                                    </div>
                                                </div>

                                            </fieldset>

                                            <fieldset>
                                                <legend>Prepend &amp; Append</legend>

                                                <div class="form-group">
                                                    <label class="control-label col-md-2" for="prepend">Prepended
                                                        Input</label>
                                                    <div class="col-md-10">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">@</span>
                                                                    <input class="form-control" id="prepend"
                                                                        placeholder="Username" type="text">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-md-2" for="prepend">W/ input &amp;
                                                        radios</label>
                                                    <div class="col-md-10">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">
                                                                        <span class="checkbox">
                                                                            <label>
                                                                                <input type="checkbox"
                                                                                    class="checkbox style-0"
                                                                                    checked="checked">
                                                                                <span></span>
                                                                            </label>
                                                                        </span>
                                                                    </span>
                                                                    <input class="form-control" placeholder=""
                                                                        type="text">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-md-2"></label>
                                                    <div class="col-md-10">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="input-group">
                                                                    <input class="form-control"
                                                                        placeholder="With switch" type="text">
                                                                    <span class="input-group-addon">
                                                                        <span class="onoffswitch">
                                                                            <input type="checkbox" name="start_interval"
                                                                                class="onoffswitch-checkbox" id="st3">
                                                                            <label class="onoffswitch-label" for="st3">
                                                                                <span class="onoffswitch-inner"
                                                                                    data-swchon-text="YES"
                                                                                    data-swchoff-text="NO"></span>
                                                                                <span class="onoffswitch-switch"></span>
                                                                            </label>
                                                                        </span>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-md-2"></label>
                                                    <div class="col-md-10">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">
                                                                        <span class="radio">
                                                                            <label>
                                                                                <input type="radio"
                                                                                    class="radiobox style-0"
                                                                                    name="style-0a2">
                                                                                <span> Left</span>
                                                                            </label>
                                                                        </span>
                                                                    </span>
                                                                    <input class="form-control" placeholder=""
                                                                        type="text">
                                                                    <span class="input-group-addon">
                                                                        <span class="radio">
                                                                            <label>
                                                                                <input type="radio"
                                                                                    class="radiobox style-0"
                                                                                    name="style-0a2">
                                                                                <span> Right</span>
                                                                            </label>
                                                                        </span>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-md-2" for="append">Appended
                                                        Input</label>
                                                    <div class="col-md-10">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="input-group">
                                                                    <input class="form-control" id="append" type="text">
                                                                    <span class="input-group-addon">.00</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-md-2"
                                                        for="appendprepend">Combined</label>
                                                    <div class="col-md-10">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">$</span>
                                                                    <input class="form-control" id="appendprepend"
                                                                        type="text">
                                                                    <span class="input-group-addon">.00</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-md-2" for="appendbutton">With
                                                        buttons</label>
                                                    <div class="col-md-10">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="input-group">
                                                                    <input class="form-control" id="appendbutton"
                                                                        type="text">
                                                                    <div class="input-group-btn">
                                                                        <button class="btn btn-default" type="button">
                                                                            Search
                                                                        </button>
                                                                        <button class="btn btn-default" type="button">
                                                                            Options
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-md-2">With dropdowns</label>
                                                    <div class="col-md-10">
                                                        <div class="row">
                                                            <div class="col-sm-12">

                                                                <div class="input-group">
                                                                    <input type="text" class="form-control">
                                                                    <div class="input-group-btn">
                                                                        <button type="button" class="btn btn-default"
                                                                            tabindex="-1">Action</button>
                                                                        <button type="button"
                                                                            class="btn btn-default dropdown-toggle"
                                                                            data-toggle="dropdown" tabindex="-1">
                                                                            <span class="caret"></span>
                                                                        </button>
                                                                        <ul class="dropdown-menu pull-right"
                                                                            role="menu">
                                                                            <li><a href="javascript:void(0);">Action</a>
                                                                            </li>
                                                                            <li><a href="javascript:void(0);">Another
                                                                                    action</a></li>
                                                                            <li><a href="javascript:void(0);">Something
                                                                                    else here</a>
                                                                            </li>
                                                                            <li class="divider"></li>
                                                                            <li><a href="javascript:void(0);">Cancel</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-md-2"></label>
                                                    <div class="col-md-10">
                                                        <div class="row">
                                                            <div class="col-sm-12">

                                                                <div class="input-group">
                                                                    <div class="input-group-btn">
                                                                        <button type="button" class="btn btn-default"
                                                                            tabindex="-1">Action</button>
                                                                        <button type="button"
                                                                            class="btn btn-default dropdown-toggle"
                                                                            data-toggle="dropdown" tabindex="-1">
                                                                            <span class="caret"></span>
                                                                        </button>
                                                                        <ul class="dropdown-menu" role="menu">
                                                                            <li><a href="javascript:void(0);">Action</a>
                                                                            </li>
                                                                            <li><a href="javascript:void(0);">Another
                                                                                    action</a></li>
                                                                            <li><a href="javascript:void(0);">Something
                                                                                    else here</a>
                                                                            </li>
                                                                            <li class="divider"></li>
                                                                            <li><a href="javascript:void(0);">Cancel</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                    <input type="text" class="form-control">
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </fieldset>

                                            <fieldset>
                                                <legend>Flexible Input fields with icons</legend>

                                                <div class="form-group">

                                                    <label class="control-label col-md-2" for="prepend">Addon
                                                        Large</label>
                                                    <div class="col-md-10">
                                                        <div class="icon-addon addon-lg">
                                                            <input type="text" placeholder="Email" class="form-control">
                                                            <label for="email" class="glyphicon glyphicon-search"
                                                                rel="tooltip" title="email"></label>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="form-group">

                                                    <label class="control-label col-md-2" for="prepend">Addon
                                                        Medium</label>
                                                    <div class="col-md-10">
                                                        <div class="icon-addon addon-md">
                                                            <input type="text" placeholder="Email" class="form-control">
                                                            <label for="email" class="glyphicon glyphicon-search"
                                                                rel="tooltip" title="email"></label>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="form-group">

                                                    <label class="control-label col-md-2" for="prepend">Addon
                                                        Small</label>
                                                    <div class="col-md-10">
                                                        <div class="icon-addon addon-sm">
                                                            <input type="text" placeholder="Email" class="form-control">
                                                            <label for="email" class="glyphicon glyphicon-search"
                                                                rel="tooltip" title="email"></label>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="form-group">

                                                    <label class="control-label col-md-2" for="prepend">Select
                                                        Large</label>
                                                    <div class="col-md-10">
                                                        <div class="icon-addon addon-lg">
                                                            <select class="form-control">
                                                                <option>Select Option</option>
                                                                <option>Sample</option>
                                                                <option>Sample</option>
                                                            </select>
                                                            <label for="email" class="glyphicon glyphicon-search"
                                                                rel="tooltip" title="email"></label>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="form-group">

                                                    <label class="control-label col-md-2" for="prepend">Select
                                                        Medium</label>
                                                    <div class="col-md-10">
                                                        <div class="icon-addon addon-md">
                                                            <select class="form-control">
                                                                <option>Select Option</option>
                                                                <option>Sample</option>
                                                                <option>Sample</option>
                                                            </select>
                                                            <label for="email" class="glyphicon glyphicon-search"
                                                                rel="tooltip" title="email"></label>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="form-group">

                                                    <label class="control-label col-md-2" for="prepend">Select
                                                        Small</label>
                                                    <div class="col-md-10">
                                                        <div class="icon-addon addon-sm">
                                                            <select class="form-control">
                                                                <option>Select Option</option>
                                                                <option>Sample</option>
                                                                <option>Sample</option>
                                                            </select>
                                                            <label for="email" class="glyphicon glyphicon-search"
                                                                rel="tooltip" title="email"></label>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="form-group">

                                                    <label class="control-label col-md-2" for="prepend">Prepended
                                                        Large</label>
                                                    <div class="col-md-10">
                                                        <div class="input-group input-group-lg">
                                                            <span class="input-group-addon"><i
                                                                    class="glyphicon glyphicon-filter"></i></span>
                                                            <div class="icon-addon addon-lg">
                                                                <input type="text" placeholder="Email"
                                                                    class="form-control">
                                                                <label for="email" class="glyphicon glyphicon-search"
                                                                    rel="tooltip" title="email"></label>
                                                            </div>
                                                            <span class="input-group-btn">
                                                                <button class="btn btn-default"
                                                                    type="button">Go!</button>
                                                            </span>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="form-group">

                                                    <label class="control-label col-md-2" for="prepend">Prepended
                                                        Medium</label>
                                                    <div class="col-md-10">
                                                        <div class="input-group input-group-md">
                                                            <span class="input-group-addon"><i
                                                                    class="glyphicon glyphicon-filter"></i></span>
                                                            <div class="icon-addon addon-md">
                                                                <input type="text" placeholder="Email"
                                                                    class="form-control">
                                                                <label for="email" class="glyphicon glyphicon-search"
                                                                    rel="tooltip" title="email"></label>
                                                            </div>
                                                            <span class="input-group-btn">
                                                                <button class="btn btn-default"
                                                                    type="button">Go!</button>
                                                            </span>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="form-group">

                                                    <label class="control-label col-md-2" for="prepend">Prepended
                                                        Small</label>
                                                    <div class="col-md-10">
                                                        <div class="input-group input-group-sm">
                                                            <span class="input-group-addon"><i
                                                                    class="glyphicon glyphicon-filter"></i></span>
                                                            <div class="icon-addon addon-sm">
                                                                <input type="text" placeholder="Email"
                                                                    class="form-control">
                                                                <label for="email" class="glyphicon glyphicon-search"
                                                                    rel="tooltip" title="email"></label>
                                                            </div>
                                                            <span class="input-group-btn">
                                                                <button class="btn btn-default"
                                                                    type="button">Go!</button>
                                                            </span>
                                                        </div>
                                                    </div>

                                                </div>

                                            </fieldset>

                                            <fieldset>
                                                <legend>Simple input with icons</legend>

                                                <div class="form-group">
                                                    <label class="control-label col-md-2">Input with icon</label>
                                                    <div class="col-md-10">
                                                        <div class="row">
                                                            <div class="col-sm-12">

                                                                <div class="input-icon-left">
                                                                    <i class="fa fa-microphone"></i>
                                                                    <input class="form-control" placeholder="Left Icon"
                                                                        type="text">
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-md-2">With right icon</label>
                                                    <div class="col-md-10">
                                                        <div class="row">
                                                            <div class="col-sm-12">

                                                                <div class="input-icon-right">
                                                                    <i class="fa fa-microphone"></i>
                                                                    <input class="form-control" placeholder=""
                                                                        type="text">
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-md-2">Input with spinner</label>
                                                    <div class="col-md-10">
                                                        <div class="row">
                                                            <div class="col-sm-12">

                                                                <input class="form-control ui-autocomplete-loading"
                                                                    placeholder="" type="text">

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>



                                            </fieldset>

                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <button class="btn btn-default" type="submit">
                                                            Cancel
                                                        </button>
                                                        <button class="btn btn-primary" type="submit">
                                                            <i class="fa fa-save"></i>
                                                            Submit
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                        </form>

                                    </div>
                                    <div class="tab-pane" id="hb2">

                                        <ul id="internal-tab-1" class="nav nav-tabs tabs-pull-right">
                                            <li class="active">
                                                <a href="#is1" data-toggle="tab">Item 1</a>
                                            </li>
                                            <li>
                                                <a href="#is2" data-toggle="tab">Item 2</a>
                                            </li>
                                            <li>
                                                <a href="#is3" data-toggle="tab">Item 3</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content padding-10">
                                            <div class="tab-pane active" id="is1">
                                                <p>
                                                    I love everyone! I love to be around some people, I love to stay
                                                    away from others, and some I'd just love to punch right in the face!

                                                </p>
                                            </div>
                                            <div class="tab-pane fade" id="is2">
                                                <p>
                                                    Food truck fixie locavore, accusamus mcsweeney's marfa nulla
                                                    single-origin coffee squid. Exercitation +1 labore velit, blog
                                                    sartorial PBR leggings next level wes anderson artisan four loko
                                                    farm-to-table craft beer twee.
                                                </p>
                                            </div>
                                            <div class="tab-pane fade" id="is3">
                                                <p>
                                                    Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art
                                                    party before they sold out master cleanse gluten-free squid
                                                    scenester freegan cosby sweater. Fanny pack portland seitan DIY, art
                                                    party locavore wolf cliche high life echo park Austin. Cred vinyl
                                                    keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table.
                                                </p>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <!-- end widget content -->

                        </div>
                        <!-- end widget div -->

                    </div>
                    <!-- end widget -->

                </article>
                <!-- WIDGET END -->

            </div>

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget" id="wid-id-1" data-widget-colorbutton="false" data-widget-editbutton="false"
                data-widget-custombutton="false">
                <!-- widget options:
									usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

									data-widget-colorbutton="false"
									data-widget-editbutton="false"
									data-widget-togglebutton="false"
									data-widget-deletebutton="false"
									data-widget-fullscreenbutton="false"
									data-widget-custombutton="false"
									data-widget-collapsed="true"
									data-widget-sortable="false"

									-->
                <header>
                    <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                    <h2>Basic Form Elements </h2>

                </header>

                <!-- widget div-->
                <div>

                    <!-- widget edit box -->
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->

                    </div>
                    <!-- end widget edit box -->

                    <!-- widget content -->
                    <div class="widget-body ">




                        <form class="smart-form" action="process_form.php" method="post" enctype="multipart/form-data">

                            <!-- Personal Information Section -->
                            <fieldset>
                                <legend>Personal Information</legend>

                                <div class="form-group">
                                    <label for="kk">KK:</label>
                                    <input type="text" class="form-control" name="kk" required>
                                </div>

                                <div class="form-group">
                                    <label for="nik">NIK:</label>
                                    <input type="text" class="form-control" name="nik" required>
                                </div>

                                <div class="form-group">
                                    <label for="nama">Nama:</label>
                                    <input type="text" class="form-control" name="nama" required>
                                </div>

                                <div class="form-group">
                                    <label for="jk">Jenis Kelamin:</label>
                                    <select class="form-control" name="jk">
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="tempat_lahir">Tempat Lahir:</label>
                                    <input type="text" class="form-control" name="tempat_lahir">
                                </div>

                                <div class="form-group">
                                    <label for="tanggal_lahir">Tanggal Lahir:</label>
                                    <input type="date" class="form-control" name="tanggal_lahir">
                                </div>
                            </fieldset>

                            <!-- Residence Information Section -->
                            <fieldset>
                                <legend>Residence Information</legend>

                                <div class="form-group">
                                    <label for="alamat">Alamat:</label>
                                    <textarea class="form-control" name="alamat"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="rt">RT:</label>
                                    <input type="text" class="form-control" name="rt">
                                </div>

                                <div class="form-group">
                                    <label for="rw">RW:</label>
                                    <input type="text" class="form-control" name="rw">
                                </div>
                            </fieldset>
                            <!-- Education and Employment Section -->
                            <fieldset>
                                <legend>Education and Employment</legend>

                                <div class="form-group">
                                    <label for="pendidikan">Pendidikan:</label>
                                    <input type="text" class="form-control" name="pendidikan">
                                </div>

                                <div class="form-group">
                                    <label for="jenis_pekerjaan">Jenis Pekerjaan:</label>
                                    <input type="text" class="form-control" name="jenis_pekerjaan">
                                </div>
                            </fieldset>
                            <!-- Other Information Section -->
                            <fieldset>
                                <legend>Other Information</legend>

                                <div class="form-group">
                                    <label for="hobi">Hobi:</label>
                                    <input type="text" class="form-control" name="hobi" required>
                                </div>

                                <div class="form-group">
                                    <label for="gambar">Gambar:</label>
                                    <input type="file" class="form-control-file" name="gambar" accept="image/*"
                                        required>
                                </div>
                            </fieldset>
                            <!-- Account Information Section -->
                            <fieldset>
                                <legend>Account Information</legend>

                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" name="email" required>
                                </div>

                                <div class="form-group">
                                    <label for="password">Password:</label>
                                    <input type="password" class="form-control" name="password" required>
                                </div>

                                <div class="form-group">
                                    <label for="username">Username:</label>
                                    <input type="text" class="form-control" name="username" required>
                                </div>

                                <div class="form-group">
                                    <label for="user_type">User Type:</label>
                                    <input type="text" class="form-control" name="user_type" required>
                                </div>
                            </fieldset>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Submit</button>
                </form>

            </div>
            <!-- end widget content -->

    </div>
    <!-- end widget div -->

</div>
<!-- end widget -->

</article>
<!-- END COL -->
<!-- WIDGET END -->
<!-- NEW WIDGET START -->
<article class="col-xs-12 col-sm-12 col-md-8 col-lg-8">

    <!-- Widget ID (each widget will need unique ID)-->
    <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false">

        <header>
            <span class="widget-icon"> <i class="fa fa-table"></i> </span>
            <h2>Standard Data Tables </h2>

        </header>

        <!-- widget div-->
        <div>

            <!-- widget edit box -->
            <div class="jarviswidget-editbox">
                <!-- This area used as dropdown edit box -->

            </div>
            <!-- end widget edit box -->

            <!-- widget content -->
            <div class="widget-body no-padding">

                <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                    <thead>
                        <tr>
                            <th data-hide="phone">ID</th>
                            <th data-class="expand"><i
                                    class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i> Name</th>
                            <th data-hide="phone"><i
                                    class="fa fa-fw fa-phone text-muted hidden-md hidden-sm hidden-xs"></i> Phone</th>
                            <th>Company</th>
                            <th data-hide="phone,tablet"><i
                                    class="fa fa-fw fa-map-marker txt-color-blue hidden-md hidden-sm hidden-xs"></i> Zip
                            </th>
                            <th data-hide="phone,tablet">City</th>
                            <th data-hide="phone,tablet"><i
                                    class="fa fa-fw fa-calendar txt-color-blue hidden-md hidden-sm hidden-xs"></i> Date
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

            </div>
            <!-- end widget content -->

        </div>
        <!-- end widget div -->

    </div>
    <!-- end widget -->

</article>
<!-- WIDGET END -->

</div>

<!-- end row -->

<!-- end row -->

</section>
<!-- end widget grid -->

</div>
<!-- END MAIN CONTENT -->

</div>
<!-- END MAIN PANEL -->


<!-- PAGE FOOTER -->

<?php include __DIR__ . '/templates/footer.php'; // Memanggil file functions.php ?>
<!-- END PAGE FOOTER -->


<script>
// DO NOT REMOVE : GLOBAL FUNCTIONS!

$(document).ready(function() {

    pageSetUp();

    /* // DOM Position key index //

    l - Length changing (dropdown)
    f - Filtering input (search)
    t - The Table! (datatable)
    i - Information (records)
    p - Pagination (paging)
    r - pRocessing
    < and > - div elements
    <"#id" and > - div with an id
    <"class" and > - div with a class
    <"#id.class" and > - div with an id and class

    Also see: http://legacy.datatables.net/usage/features
    */

    /* BASIC ;*/
    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };

    $(document).ready(function() {
        $('#dt_basic').dataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "ajax/serverside-umum.php?table=warga", // Specify the table name here
                "type": "POST"
            },
            // Define your DataTables options
            "preDrawCallback": function() {
                // Initialize the responsive datatables helper once.
                if (!responsiveHelper_dt_basic) {
                    responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($(
                        '#dt_basic'), breakpointDefinition);
                }
            },
            "rowCallback": function(nRow) {
                responsiveHelper_dt_basic.createExpandIcon(nRow);
            },
            "drawCallback": function(oSettings) {
                responsiveHelper_dt_basic.respond();
            }
        });
    });

    /* END BASIC */

    /* COLUMN FILTER  */
    var otable = $('#datatable_fixed_column').DataTable({
        //"bFilter": false,
        //"bInfo": false,
        //"bLengthChange": false
        //"bAutoWidth": false,
        //"bPaginate": false,
        //"bStateSave": true // saves sort state using localStorage
        "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6 hidden-xs'f><'col-sm-6 col-xs-12 hidden-xs'<'toolbar'>>r>" +
            "t" +
            "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
        "autoWidth": true,
        "oLanguage": {
            "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
        },
        "preDrawCallback": function() {
            // Initialize the responsive datatables helper once.
            if (!responsiveHelper_datatable_fixed_column) {
                responsiveHelper_datatable_fixed_column = new ResponsiveDatatablesHelper($(
                    '#datatable_fixed_column'), breakpointDefinition);
            }
        },
        "rowCallback": function(nRow) {
            responsiveHelper_datatable_fixed_column.createExpandIcon(nRow);
        },
        "drawCallback": function(oSettings) {
            responsiveHelper_datatable_fixed_column.respond();
        }

    });

    // custom toolbar
    $("div.toolbar").html(
        '<div class="text-right"><img src="img/logo.png" alt="SmartAdmin" style="width: 111px; margin-top: 3px; margin-right: 10px;"></div>'
    );

    // Apply the filter
    $("#datatable_fixed_column thead th input[type=text]").on('keyup change', function() {

        otable
            .column($(this).parent().index() + ':visible')
            .search(this.value)
            .draw();

    });
    /* END COLUMN FILTER */

    /* COLUMN SHOW - HIDE */
    $('#datatable_col_reorder').dataTable({
        "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-6 hidden-xs'C>r>" +
            "t" +
            "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
        "autoWidth": true,
        "oLanguage": {
            "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
        },
        "preDrawCallback": function() {
            // Initialize the responsive datatables helper once.
            if (!responsiveHelper_datatable_col_reorder) {
                responsiveHelper_datatable_col_reorder = new ResponsiveDatatablesHelper($(
                    '#datatable_col_reorder'), breakpointDefinition);
            }
        },
        "rowCallback": function(nRow) {
            responsiveHelper_datatable_col_reorder.createExpandIcon(nRow);
        },
        "drawCallback": function(oSettings) {
            responsiveHelper_datatable_col_reorder.respond();
        }
    });

    /* END COLUMN SHOW - HIDE */

    /* TABLETOOLS */
    $('#datatable_tabletools').dataTable({

        // Tabletools options:
        //   https://datatables.net/extensions/tabletools/button_options
        "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-6 hidden-xs'T>r>" +
            "t" +
            "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
        "oLanguage": {
            "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
        },
        "oTableTools": {
            "aButtons": [
                "copy",
                "csv",
                "xls",
                {
                    "sExtends": "pdf",
                    "sTitle": "SmartAdmin_PDF",
                    "sPdfMessage": "SmartAdmin PDF Export",
                    "sPdfSize": "letter"
                },
                {
                    "sExtends": "print",
                    "sMessage": "Generated by SmartAdmin <i>(press Esc to close)</i>"
                }
            ],
            "sSwfPath": "js/plugin/datatables/swf/copy_csv_xls_pdf.swf"
        },
        "autoWidth": true,
        "preDrawCallback": function() {
            // Initialize the responsive datatables helper once.
            if (!responsiveHelper_datatable_tabletools) {
                responsiveHelper_datatable_tabletools = new ResponsiveDatatablesHelper($(
                    '#datatable_tabletools'), breakpointDefinition);
            }
        },
        "rowCallback": function(nRow) {
            responsiveHelper_datatable_tabletools.createExpandIcon(nRow);
        },
        "drawCallback": function(oSettings) {
            responsiveHelper_datatable_tabletools.respond();
        }
    });

    /* END TABLETOOLS */

})
</script>


</body>

</html>