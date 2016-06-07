<div class="entry-content" id="one">
	<div class="main-content-one">	
		<div id="content-one">
		
			<div id="profil-one">
				<div id="content-one-img">
					<img src="<?php bloginfo('template_directory'); ?>/img/profil.jpg" alt="" />
				</div>
				<p>description</p>
			</div>
			<div id="profil-two">
				<p>Bonjour, je m'appelle <b>Théo Alloin</b>, je suis aujourd'hui [...]. Pasionné de [...] de puis 2008.</p> 
			</div>
			presentation
		</div>
	</div>
	<div class="main-content-two">
		<div id="content-two">
			<ul class="banniere">
			<?php $skills = getSkills();
				foreach ($skills as $skill) {
				$skill->link = stripslashes($skill->link);
					echo '<li> '. $skill->link .'</li>';
				}
			?>
			</ul>
		</div>
	</div>
</div>