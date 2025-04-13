    <?php
    $title = 'Bienvenue | Sandwicherie chez David';
    $meta_content = '';

    ?>
    <div id="banner" class="banner  ">
        <div id="demo1" class="owl-carousel  owl-theme ">
            <?php $sliders = $DB->select('SELECT * FROM slider'); ?>
            <?php foreach ($sliders as $slider) : ?>
            <div class="item">
                <img src="../Dashboard/upload/slider/<?= $slider->images; ?>" alt="">
                <div class="caption ">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="banner-static">
                            <div class="banner-text">
                                <div class="banner-cell container">
                                    <h1><?= $slider->texte; ?></h1>

                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <?php endforeach; ?>

        </div>

    </div>


    <div id="apropos" class="about-main pad-top-100 pad-bottom-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="wow fadeIn" data-wow-duration="1s" data-wow-delay="0.1s">
                        <h2 class="block-title"> A Propos </h2>
                        <h3>DE LA SANDWICHERIE CHEZ DAVID</h3>
                        <p style="font-family:  'nautilus_pompiliusregular';font-size:19px;">
                            Nous sommes specialisé dans la restauration rapide qu'on appel fast food notre but
                            est de faire gagner du temps aux clients en leurs permettant de consommer les plats
                            commandés
                            ou de les emportés et ce pour un prix generalement moindre que dans les autres restaurants.
                        </p>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="wow fadeIn" data-wow-duration="1s" data-wow-delay="0.1s">
                        <div class="about-images">
                            <img class="about-main" src="../assets/images/large_slider_img.jpg" height="410"
                                alt="About Main Image">
                            <img class="about-inset" src="../assets/images/header_bg.jpg" width="160" height="160"
                                alt="About Inset Image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="special-menu pad-top-100 parallax">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="wow fadeIn" data-wow-duration="1s" data-wow-delay="0.1s">
                        <h2 class="block-title color-white text-center">Nos Specialité </h2>
                        <h5 class="title-caption text-center"
                            style="font-weight:600 ;font-family:Arial, Helvetica, sans-serif;">Nous vous offrons une
                            large variété de sandwichs
                            (egg burger, fish burger, burger au paté de campagne ),
                            de chawarmas (au poulet, à la viande et à la langue de boeuf) et aussi des
                            kits. </h5>
                    </div>
                    <div class="special-box">
                        <div id="owl-demo">
                            <?php $fastfood = $DB->select('SELECT * FROM food   where id in (1,3,14,75,77,7,46,51,15,17,63,60) limit 13'); ?>
                            <?php foreach ($fastfood as $food) : ?>
                            <div class="item item-type-zoom">
                                <a href="<?= $router->generate('menu'); ?>" class="item-hover">
                                    <div class="item-info">
                                        <div class="headline">
                                            <?= $food->nom; ?>
                                            <div class="line"></div>
                                            <div class="dit-line"><?= $food->details; ?></div>
                                        </div>
                                    </div>
                                </a>
                                <div class="item-img">
                                    <img src="../Dashboard/upload/food/<?= $food->images; ?>"
                                        style="height:300px;width:380;" alt="sp-menu">
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="blog-btn-v">
                            <a class="hvr-underline-from-center" href="<?= $router->generate('menu'); ?>"
                                style="border-radius:4px;">Consulter notre menu</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="plats" class="gallery-main pad-top-100 pad-bottom-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="wow fadeIn" data-wow-duration="1s" data-wow-delay="0.1s">
                        <h2 class="block-title text-center">
                            Nos Plats
                        </h2>
                        <p class="title-caption text-center"
                            style="font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;font-weight:bold;">
                            Nous vous donnons la possibilité de créer, et de composer votre propre sandwichs + de 10
                            combinaisons possibles. </p>
                    </div>
                    <div class="gal-container clearfix">
                        <div class="col-md-8 col-sm-12 co-xs-12 gal-item">
                            <div class="box">
                                <a href="#" data-toggle="modal" data-target="#1">
                                    <img src="assets/images/gallery_01.jpg" alt="" />
                                </a>
                                <div class="modal fade" id="1" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close"><span aria-hidden="true">×</span></button>
                                            <div class="modal-body">
                                                <img src="assets/images/gallery_01.jpg" alt="" />
                                            </div>
                                            <div class="col-md-12 description">
                                                <h4>This is the 1 one on my Gallery</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 co-xs-12 gal-item">
                            <div class="box">
                                <a href="#" data-toggle="modal" data-target="#2">
                                    <img src="assets/images/gallery_02.jpg" alt="" />
                                </a>
                                <div class="modal fade" id="2" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close"><span aria-hidden="true">×</span></button>
                                            <div class="modal-body">
                                                <img src="assets/images/gallery_02.jpg" alt="" />
                                            </div>
                                            <div class="col-md-12 description">
                                                <h4>This is the 2 one on my Gallery</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 co-xs-12 gal-item">
                            <div class="box">
                                <a href="#" data-toggle="modal" data-target="#3">
                                    <img src="assets/images/gallery_03.jpg" alt="" />
                                </a>
                                <div class="modal fade" id="3" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close"><span aria-hidden="true">×</span></button>
                                            <div class="modal-body">
                                                <img src="assets/images/gallery_03.jpg" alt="" />
                                            </div>
                                            <div class="col-md-12 description">
                                                <h4>This is the 3 one on my Gallery</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 co-xs-12 gal-item">
                            <div class="box">
                                <a href="#" data-toggle="modal" data-target="#4">
                                    <img src="assets/images/gallery_04.jpg" alt="" />
                                </a>
                                <div class="modal fade" id="4" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close"><span aria-hidden="true">×</span></button>
                                            <div class="modal-body">
                                                <img src="assets/images/gallery_04.jpg" alt="" />
                                            </div>
                                            <div class="col-md-12 description">
                                                <h4>This is the 4 one on my Gallery</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 co-xs-12 gal-item">
                            <div class="box">
                                <a href="#" data-toggle="modal" data-target="#5">
                                    <img src="assets/images/gallery_05.jpg" alt="" />
                                </a>
                                <div class="modal fade" id="5" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close"><span aria-hidden="true">×</span></button>
                                            <div class="modal-body">
                                                <img src="assets/images/gallery_05.jpg" alt="" />
                                            </div>
                                            <div class="col-md-12 description">
                                                <h4>This is the 5 one on my Gallery</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 co-xs-12 gal-item">
                            <div class="box">
                                <a href="#" data-toggle="modal" data-target="#9">
                                    <img src="assets/images/gallery_06.png" alt="" />
                                </a>
                                <div class="modal fade" id="9" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close"><span aria-hidden="true">×</span></button>
                                            <div class="modal-body">
                                                <img src="assets/images/gallery_06.png" alt="" />
                                            </div>
                                            <div class="col-md-12 description">
                                                <h4>This is the 6 one on my Gallery</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-12 co-xs-12 gal-item">
                            <div class="box">
                                <a href="#" data-toggle="modal" data-target="#10">
                                    <img src="assets/images/gallery_07.jpg" alt="" />
                                </a>
                                <div class="modal fade" id="10" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close"><span aria-hidden="true">×</span></button>
                                            <div class="modal-body">
                                                <img src="assets/images/gallery_07.jpg" alt="" />
                                            </div>
                                            <div class="col-md-12 description">
                                                <h4>This is the 7 one on my Gallery</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 co-xs-12 gal-item">
                            <div class="box">
                                <a href="#" data-toggle="modal" data-target="#11">
                                    <img src="assets/images/gallery_08.jpg" alt="" />
                                </a>
                                <div class="modal fade" id="11" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close"><span aria-hidden="true">×</span></button>
                                            <div class="modal-body">
                                                <img src="assets/images/gallery_08.jpg" alt="" />
                                            </div>
                                            <div class="col-md-12 description">
                                                <h4>This is the 8 one on my Gallery</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 co-xs-12 gal-item">
                            <div class="box">
                                <a href="#" data-toggle="modal" data-target="#12">
                                    <img src="assets/images/gallery_09.jpg" alt="" />
                                </a>
                                <div class="modal fade" id="12" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close"><span aria-hidden="true">×</span></button>
                                            <div class="modal-body">
                                                <img src="assets/images/gallery_09.jpg" alt="" />
                                            </div>
                                            <div class="col-md-12 description">
                                                <h4>This is the 9 one on my Gallery</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 co-xs-12 gal-item">
                            <div class="box">
                                <a href="#" data-toggle="modal" data-target="#13">
                                    <img src="assets/images/gallery_10.jpg" alt="" />
                                </a>
                                <div class="modal fade" id="13" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close"><span aria-hidden="true">×</span></button>
                                            <div class="modal-body">
                                                <img src="assets/images/gallery_10.jpg" alt="" />
                                            </div>
                                            <div class="col-md-12 description">
                                                <h4>This is the 10 one on my Gallery</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="blog" class="blog-main pad-top-100 pad-bottom-100 parallax">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h2 class="block-title text-center">
                        #NosPublications
                    </h2>
                    <div class="blog-box clearfix">

                        <div class="wow fadeIn" data-wow-duration="1s" data-wow-delay="0.1s">
                            <div class="col-md-6 col-sm-6">
                                <div class="blog-block">
                                    <div class="blog-img-box">
                                        <img src="assets/images/featured-image-03.jpg" alt="" />
                                        <div class="overlay">
                                            <a href=""><i class="fa fa-link" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                    <div class="blog-dit">
                                        <p><span>4 NOVEMBER, 2014</span></p>
                                        <h2>BAKING TIPS FROM THE PROS</h2>
                                        <h5>BY Monica Reyes</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wow fadeIn" data-wow-duration="1s" data-wow-delay="0.1s">
                            <div class="col-md-6 col-sm-6">
                                <div class="blog-block">
                                    <div class="blog-img-box">
                                        <img src="assets/images/featured-image-04.jpg" alt="" />
                                        <div class="overlay">
                                            <a href=""><i class="fa fa-link" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                    <div class="blog-dit">
                                        <p><span>12 NOVEMBER, 2014</span></p>
                                        <h2>ALL YOUR EGGS BELONG TO US</h2>
                                        <h5>BY John Doggett</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="blog-btn-v">
                        <a class="hvr-underline-from-center" href="#" style="border-radius:45px;">Voir plus postes</a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div id="contact" class="pricing-main pad-top-100 pad-bottom-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h2 class="block-title text-center">
                        Restons en contact
                    </h2>
                    <p>Contactez-nous pour touts vos commandes ou renseignements . Nous sommes disponible aussi sur les
                        reseaux sociaux .</p>
                </div>
                <div class="panel-pricing-in">
                    <div class="col-md-6 col-sm-6 text-center">
                        <div class="panel panel-pricing">
                            <div class="panel-heading">

                            </div>
                            <div class="panel-body text-center">
                                <p><strong><span
                                            style="font-family: 'nautilus_pompiliusregular';">Contacts</span></strong>
                                </p>
                            </div>
                            <p style="font-family: 'nautilus_pompiliusregular';">
                                Contactez-nous aux numeros suivants :
                            </p>
                            <ul class="list-group">
                                <li class="list-group-item"><i class="fa fa-phone"></i> 09 72 66 46 | <i
                                        class="fa fa-phone"></i> 42 03 19 95 | <i class="fa fa-phone"></i> 65 06 90 25
                                </li>
                                <li class="list-group-item"><i class="fa fa-envelope"></i>
                                    alipoegroupentreprise@gmail.com </li>

                            </ul>
                            <p style="font-family: 'nautilus_pompiliusregular';">
                                Retrouvez nous sur les reseaux sociaux
                            </p>

                            <ul>
                                <li class="list-group-item"><i class="fa fa-whatsapp"
                                        style="font-size:20px ; color:#0e9017;"></i> Whatsapp</li>
                                <a href="https://www.facebook.com" target="blank">
                                    <li class="list-group-item"><i class="fa fa-facebook-square"
                                            style="font-size:20px;color:#4c34d2"></i> La sandwicherie chez David</li>
                                </a>
                            </ul>

                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 text-center">
                        <div class="panel panel-pricing">
                            <div class="panel-heading">

                            </div>
                            <div class="panel-body text-center">
                                <p><strong><span style="font-family: 'nautilus_pompiliusregular';">Où nous-sommes
                                            ?</span></strong></p>
                            </div>
                            <div>
                                <p style="font-family: 'nautilus_pompiliusregular';">
                                    La sandwicherie chez David est à Dabou, taxis gare en face de la station Total.

                                </p>
                                <h2>
                                    Localisation
                                </h2>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>