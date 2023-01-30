@once
<link type="text/css" rel="stylesheet" href="{{ URL::asset(Helpers::cacheBusting('dist/landing.css')) }}">
<script type="text/javascript" src="{{ URL::asset(Helpers::cacheBusting('dist/landing.js')) }}"></script>
@endonce

<div>
	<div id="header" class="animate animate-down">
		<div id="logo">
			<a href="#"><h1>{{ $title }}<span>{{ $subtitle }}</span></h1></a>
		</div>
	</div>

	<div id="menu_wrap" class="animate animate-down">
		<div id="menu">
			<ul class="menu">
				<li class="menu-item">
					<a href="{{ route('livewire_index', ['page' => 'gallery']) }}">GALLERY</a>
				</li>
			</ul>
		</div>
	</div>

	<div id="intro">
		<div id="intro_content">
			<h1 class="animate_slower pop-in">{{ $title }}</h1>
			<h2><span class="animate_slower pop-in">{{ $subtitle }}</span></h2>
		</div>
	</div>

	<div id="slides" class="animate_slower pop-in-last">
		<div class="slides-container">
			<ul>
				<li>
					<div class="overlay"></div>
					<img src="{{ $background }}" alt="">
				</li>
			</ul>
		</div>
	</div>

	<!-- TODO: footer -->
</div>
