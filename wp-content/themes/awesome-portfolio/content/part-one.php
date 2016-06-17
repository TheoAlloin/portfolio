<section class="bg-primary" id="about">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-lg-offset-2 text-center">
				<h2 class="section-heading">Bienvenue sur mon portfolio !</h2>
				<hr class="light">
				<p class="text-faded">
					Bonjour, je m'appelle <b>Théo Alloin</b>, je suis <span id="self-def">développeur web</span>. Pasionné par les technologies du web, je vous présente aujourd'hui mon portfolio qui, j'espère me présentera au mieux.
				</p>
				<a href="#services" class="page-scroll btn btn-default btn-xl sr-button">C'est parti !</a>
			</div>
		</div>
	</div>
</section>

<section id="services">
	<div class="container">
		<div class="row">
			<!-- banniere -->
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
$skill->link = stripslashes($skill->link);
				?>
				<li class="skills">
					<div class="col-lg-4 col-md-6 text-center my_skill">

						<div class="service-box">
							<?php
							echo "<i class='" . $skill->link . " text-primary fa-4x sr-icons'></i>";
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