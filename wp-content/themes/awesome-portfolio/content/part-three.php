<section id="timeline">
        <div class="container">
            <div class="row"> <!-- banniere -->
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Curiculum Vitae :</h2>
                    <hr class="primary">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                    <ul class="timeline">
                        <?php 
                        $i = 0;
                        $date_tampon = array();
                        $results = get_cv_fields();
                        foreach ( $results as $result ) {
                            $date = $result->date;
                            $date_format = date_format(date_create($date), 'd/m/Y');
                            $date = explode('-', $date);
                            
                            //Ne pas ajouter deux fois les bannieres de la même date
                            if(!in_array($date[0], $date_tampon)){
                                echo '<li class="date_timeline">' . $date[0] . '</li>';
                                array_push($date_tampon, $date[0]);
                            }
                            //pas de glyphon predefini
                            if(!$result->glyphon){
                                $result->glyphon = 'glyphicon-check';
                            }
                            //droite ou gauche
                            if($i == 0){
                                echo "<li data-position='left' class='notViewed animBlock'>";
                            }elseif($i == 1){
                                echo "<li data-position='right' class='notViewed animBlock timeline-inverted'>";
                            }
                            ?>
                            <div class="timeline-badge" style="background-color:<?php echo $result->color; ?>"><i class="timeline_glyph glyphicon <?php echo $result->glyphon ?>"></i></div>
                              <div class="timeline-panel">
                                <div class="timeline-heading">
                                  <h4 class="timeline-title"><?php echo stripslashes($result->titre); ?></h4>
                                  <?php if($result->date){ ?><p><small class="text-muted"><i class="glyphicon glyphon-default glyphicon-time"></i> <?php echo $date_format; ?></small></p><?php } ?>
                                </div>
                                <div class="timeline-body">
                                  <p><?php echo stripslashes($result->contenu); ?></p>
                                </div>
                              </div>
                            </li>
                            
                        <?php
						$i++;
						if ($i > 1) {
							$i = 0;
						}
				    }
 ?>
                </ul>
            </div>
        </div>
    </section>
    
    <aside class="bg-dark">
        <div class="container">
                <div class="text-center col-lg-12">
                    <div class="add_me grow col-lg-3">
                        <a id="liens" class="no-decoration" href="https://github.com/TheoAlloin">
                            <i class="add_me fa fa-github fa-4x" aria-hidden="true"></i>
                            <h2>GitHub</h2> 
                        </a>
                    </div>
                    <div class="add_me grow col-lg-3">
                        <a id="liens" class="no-decoration" href="https://bitbucket.org/TheoAlloin/">
                            <i class="add_me fa fa-bitbucket fa-4x" aria-hidden="true"></i>
                            <h2>Bitbucket</h2>
                        </a>
                    </div>                    
                    <div class="add_me grow col-lg-3">
                        <a id="liens" class="page-scroll no-decoration" href="#contact">
                            <i class="add_me fa fa-envelope-o fa-4x" aria-hidden="true"></i>
                            <h2>E-mail</h2>
                        </a>
                    </div>
                    <div class="add_me grow col-lg-3">
                        <a id="liens" class="no-decoration" href="https://www.linkedin.com/in/alloin-th%C3%A9o-087685aa?trk=hp-identity-name">
                            <i class="add_me fa fa-linkedin-square fa-4x" aria-hidden="true"></i>
                            <h2>Linkedin</h2>
                        </a>
                    </div>
                 </div>
            </div>
    </aside>