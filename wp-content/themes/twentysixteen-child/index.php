<?php get_header(); ?>
    <nav class="navbar navbar-default navbar-fixed-top custom-navbar">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#about">Portfolio</a>
        </div>
        <ul class="nav navbar-nav">
          <li class="active page-scroll"><a href="#about">Home</a></li>
          <li class="page-scroll"><a href="#services">Compétences</a></li>
          <li class="page-scroll"><a href="#timeline">Curriculum Vitae</a></li>
          <li class="page-scroll"><a href="#contact">Contact</a></li>
        </ul>
      </div>
    </nav>
    <section class="bg-primary" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">Bienvenue sur mon portfolio !</h2>
                    <hr class="light">
                    <p class="text-faded">Bonjour, je m'appelle <b>Théo Alloin</b>, je suis <span id="self-def">développeur web</span>. Pasionné de [...] depuis 2008.</p>
                    <a href="#services" class="page-scroll btn btn-default btn-xl sr-button">C'est parti !</a>
                </div>
            </div>
        </div>
    </section>

    <section id="services">
        <div class="container">
            <div class="row"> <!-- banniere -->
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Voici quelques unes de mes compétences :</h2>
                    <hr class="primary">
                </div>
            </div>
        </div>
      
        <div class="container">
            <div class="container slideshow">
                <ul>
                    <?php $skills = getSkills();
                        foreach ($skills as $skill) {
                            $skill->link = stripslashes($skill->link);?>
                            <li class="skills">
                                <div class="col-lg-4 col-md-6 text-center">
                                
                                    <div class="service-box">
                                        <?php 
                                        echo "<i class='". $skill->link ." text-primary fa-4x sr-icons'></i>";
                                        echo "<h3>" . $skill->title . "</h3>";
                                        echo "<p class='text-muted'>" . $skill->skill_desc . "</p>";
                                        ?>
                                    </div>
                                 </div>
                             </li>
                             
                           
                    <?php } ?>
                </ul>
            </div>
        </div>
        
    </section>
    <section class="no-padding" id="portfolio">
        <div class="container-fluid">
            <div class="row no-gutter popup-gallery">
                <div class="col-lg-4 col-sm-6">
                    <a href="img/portfolio/fullsize/1.jpg" class="portfolio-box">
                        <img src="<?php echo get_bloginfo('template_directory'); ?>/img/portfolio/thumbnails/1.jpg" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-name">
                                    <  Intégration />                                
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="img/portfolio/fullsize/2.jpg" class="portfolio-box">
                        <img src="<?php echo get_bloginfo('template_directory'); ?>/img/portfolio/thumbnails/2.jpg" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-name">
                                    < Développement spécifique />
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="img/portfolio/fullsize/3.jpg" class="portfolio-box">
                        <img src="<?php echo get_bloginfo('template_directory'); ?>/img/portfolio/thumbnails/3.jpg" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-name">
                                  <  Contact humain />
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <aside class="bg-dark">
        <div class="container text-center">
            <div class="call-to-action">
                <h2>N'hésitez pas à me contacter !</h2>
                <a href="#contact" class="page-scroll btn btn-default btn-xl sr-button">Contact</a>
            </div>
        </div>
    </aside>
    
    <!--------------------------------------------- TIMELINE ---------------------------------------->
    
    <section id="timeline">
        <div class="container">
            <div class="row">
                    <ul class="timeline">
                        <?php 
                        $i = 0;
                        $date_tampon = 0;
                        $results = get_cv_fields();

                        foreach ( $results as $result ) {
                            $date = $result->date;
                            $date_format = date_format( date_create($date) , 'd/m/Y');
                            //date[0]->année
                            //date[1]->mois
                            //date[2]->jour
                            $date = explode('-', $date);
                            if ($date[0]){
                                if($date[0] > $date_tampon) {
                                    echo '<li class="date_timeline">' . $date[0] . '</li>';    
                                    $date_tampon = $date[0];
                                }
                            }
                            
                            //pas de glyphon predefini
                            if(!$result->glyphon){
                                $result->glyphon = 'glyphicon-check';
                            }
                            
                            //droite ou gauche
                            if($i == 0){
                                echo "<li>";                            
                            }elseif($i == 1){
                                echo "<li class='timeline-inverted'>";
                            }
                           ?>
                              <div class="timeline-badge" style="background-color:<?php echo $result->color; ?>"><i class="timeline_glyph glyphicon <?php echo $result->glyphon ?>"></i></div>
                              <div class="timeline-panel">
                                <div class="timeline-heading">
                                  <h4 class="timeline-title"><?php echo $result->titre ?></h4>
                                  <?php if($result->date){ ?><p><small class="text-muted"><i class="glyphicon glyphon-default glyphicon-time"></i> <?php echo $date_format; ?></small></p><?php } ?>
                                </div>
                                <div class="timeline-body">
                                  <p><?php echo $result->contenu ?></p>
                                </div>
                              </div>
                            </li>
                            
                        <?php 
                            $i++;
                            if( $i > 1 ){
                                $i = 0;
                            }
                        } ?>
                </ul>
            </div>
        </div>
    </section>
    
    <aside class="bg-dark">
        <div class="container">
                <div class="text-center col-lg-12">
                    <div class="add_me col-lg-3">
                        <a class="no-decoration" href="#">
                            <i class="add_me fa fa-github fa-4x" aria-hidden="true"></i>
                            <h2>GitHub</h2> 
                        </a>
                    </div>
                    <div class="add_me col-lg-3">
                        <a class="no-decoration" href="#">
                            <i class="add_me fa fa-bitbucket fa-4x" aria-hidden="true"></i>
                            <h2>Bitbucket</h2>
                        </a>
                    </div>                    
                    <div class="add_me col-lg-3">
                        <a class="page-scroll no-decoration" href="#contact">
                            <i class="add_me fa fa-envelope-o fa-4x" aria-hidden="true"></i>
                            <h2>E-mail</h2>
                        </a>
                    </div>
                    <div class="add_me col-lg-3">
                        <a class="no-decoration" href="#">
                            <i class="add_me fa fa-google-plus fa-4x" aria-hidden="true"></i>
                            <h2>Google +</h2>
                        </a>
                    </div>
                 </div>
            </div>
    </aside>
<!-------------------------------------------- CONTACT ------------------------------------------->
    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">Formulaire de contact</h2>
                    <hr class="primary">
                    <p>Vous avez un projet derrière la tête ? Il vous manque un développeur dans votre équipe ?</p>
                    <p> N'hésitez pas à me contacter !</p>
                </div>
            </div>
            <div class="row">
                <form class="well form-horizontal form_global" action="" method="post"  id="contact_form">
                    <fieldset>
                    <!-- Text input-->
                  <div class="col-md-6 form">
                          <div class="form-group">
                            <label class="col-md-5 control-label">Nom</label>  
                            <div class="col-md-5 inputGroupContainer">
                            <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphon-default glyphicon-user"></i></span>
                            <input  name="first_name" placeholder="Nom" class="form-control"  type="text">
                              </div>
                            </div>
                          </div>
                        
                        <!-- Text input-->
                        
                        <div class="form-group">
                          <label class="col-md-5 control-label" >Prénom</label> 
                            <div class="col-md-5 inputGroupContainer">
                            <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphon-default glyphicon-user"></i></span>
                          <input name="last_name" placeholder="Prénom" class="form-control"  type="text">
                            </div>
                          </div>
                        </div>
                        
                        <!-- Text input-->
                               <div class="form-group">
                          <label class="col-md-5 control-label">E-Mail</label>  
                            <div class="col-md-5 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphon-default glyphicon-envelope"></i></span>
                          <input name="email" placeholder="Adresse E-Mail" class="form-control"  type="text">
                            </div>
                          </div>
                        </div>
                    
                    </div>
                    <!-- Text input-->
                    <div class="col-md-6 form"> 
                        <!-- Text input-->
                               
                        <div class="form-group">
                          <label class="col-md-5 control-label">Téléphone</label>  
                            <div class="col-md-5 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphon-default glyphicon-earphone"></i></span>
                          <input name="phone" placeholder="Numéro" class="form-control" type="text">
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-5 control-label">Adresse</label>  
                            <div class="col-md-5 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphon-default glyphicon-home"></i></span>
                          <input name="address" placeholder="Adresse" class="form-control" type="text">
                            </div>
                          </div>
                        </div>
                         
                        <!-- Text input-->
                        <div class="form-group">
                          <label class="col-md-5 control-label">Site web</label>  
                           <div class="col-md-5 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphon-default glyphicon-globe"></i></span>
                          <input name="website" placeholder="Site web" class="form-control" type="text">
                            </div>
                          </div>
                        </div>
                      </div>
                      
                    <!-- Text area -->
                    <div class="col-md-12">  
                        <div class="form-group">
                          <label class="col-md-4 control-label">Project Description</label>
                            <div class="col-md-5 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphon-default glyphicon-pencil"></i></span>
                                    <textarea class="form-control" name="comment" placeholder="Project Description"></textarea>
                          </div>
                          </div>
                        </div>
                    </div>
                    <!-- Success message -->
                    <div class="alert alert-success" role="alert" id="success_message">Success <i class="glyphon-default glyphicon glyphicon-thumbs-up"></i> Thanks for contacting us, we will get back to you shortly.</div>
                    
                    <!-- Button -->
                    <div class="form-group">
                      <label class="col-md-5 control-label"></label>
                      <div class="col-md-5">
                        <button type="submit" class="btn btn-warning" >Send <span class="glyphicon glyphon-default glyphicon-send"></span></button>
                      </div>
                    </div>
                    
                    </fieldset>
                    </form>
                    </div>
                    </div>
                        </div><!-- /.container -->
                                </div>
                            </div>
                        </section>

<?php get_footer(); ?>