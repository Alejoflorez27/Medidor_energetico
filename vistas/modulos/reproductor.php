<!DOCTYPE html>
<html>
	<head>

		<title>Reproductor de Música</title>
		<link rel="stylesheet" href="src/style.css">
		
	</head>
	<body>
		<div class="audio-player" id="skin">
			
			<div class="user_avatar">
				<br />
				<a href="usuarios" title="Sci-High Music"><img src="vistas/img/plantilla/sci_high.jpeg"></a>
				<nav class="set">
					<a class="dropdown-toggle" href="#" title="Menu"><i class="fa fa-cogs"></i></a>
					<ul class="dropdown">
						<li><a href="#" id="darkButton">Tema Oscuro</a></li>
						<li><a href="#" id="whiteButton">Por Defecto</a></li>
						<li><a href="#" id="blueButton">Morado</a></li>
					</ul>
				</nav>
			</div>
			<div class="holder">
				<div class="cover">
					
					<img src="./assets/cover.PNG">
				</div>
				<div class="audio-wrapper" id="player-container" href="javascript:;">
					<audio id="player" preload="metadata" onloadedmetadata="mDur()" ontimeupdate="initProgressBar()">
						<source src="" type="audio/mp3">
					</audio>
				</div>
				<div class="player-controls scrubber">
					<div>
						<div>
							<p class="title"></p>
						</div>
						<div class="range">
							<input  id="dur" type="range" class="range" name="rng" min="0" max="1" step="0.00000001" value="0" onchange="mSet()" style="width: 100%">
						</div>
						<br>
						<span class="time start-time"></span>
						<span class="time end-time"></span>
						<br>
						<div class="ctrl">
							<div>
								<a href="#prev" class="ctrl_btn " id="prev"><i class="fa fa-arrow-left" ></i></a>
								<span id="play-btn" class="fa fa-play "></span>
								<a href="#next" class="ctrl_btn " id="next"><i class="fa fa-arrow-right" ></i></a>
							</div>
							<div class="volumeControl" >
								<div class="wrapper">
									<i class="fa fa-volume-up"></i>
									<span class="outer">
										<span class="inner"></span>
									</span>
								</div>
							</div>
						</div>
					</div>
					<div>
					</div>
				</div>
			</div>
		
			
		</div>
		
		<script type="text/javascript" src="assets/jquery/jquery.min.js"></script>
		<script type="text/javascript" src="src/script.js"></script>

		<div class="footer">
			<h1 style="text-align: center; "><a href="usuarios">El mejor reproductor de musica</a></h1>
		  </div>
	</body>
</html>