<x-view-container>
	@if (!$smartalbums && !$albums && !$shared_albums)
	<div class='no_content fadeIn'>
		{{-- TODO : GIVE LOGIN PAGE INSTEAD --}}
		<x-icons.iconic icon="eye" />
		<p>{{ __('lychee.VIEW_NO_PUBLIC_ALBUMS') }}</p>
	</div>
	@else
	<div id="lychee_view_content" class="vflex-item-stretch contentZoomIn">
		<!-- test comment-->
		@if($smartalbums->count() > 0)
			<div class='divider'>
				<h1>{{ __('lychee.SMART_ALBUMS') }}</h1>
			</div>
			@foreach ($smartalbums as $album)
				<x-album :data="$album" />
			@endforeach
			@if($albums->count() > 0)
			<div class='divider'>
				<h1>{{ __('lychee.ALBUMS') }}</h1>
			</div>
			@endif
		@endif

		@if($albums->count() > 0)
			@foreach ($albums as $album)
				<x-album :data="$album" />
			@endforeach
		@endif

		@if($shared_albums->count() > 0)
		<div class='divider'>
			<h1>{{ __('lychee.SHARED_ALBUMS') }}</h1>
		</div>
			@foreach ($shared_albums as $album)
				<x-album :data="$album" />
			@endforeach
		@endif
	</div>
	@endif
</x-view-container>