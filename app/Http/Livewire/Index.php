<?php

namespace App\Http\Livewire;

use App\Enum\Livewire\PageMode;
use App\Factories\AlbumFactory;
use App\Http\Controllers\IndexController;
use App\Http\Livewire\Traits\UrlChange;
use App\Models\Configs;
use App\Models\Extensions\BaseAlbum;
use App\Models\Photo;
use Illuminate\View\View;
use Livewire\Component;

class Index extends Component
{
	use UrlChange;

	public PageMode $mode;
	public ?string $albumId = null;
	public ?string $photoId = null;

	// listeners of click events
	protected $listeners = [
		'openPage',
		'reloadPage',
	];

	public function mount(?string $page = 'gallery', ?string $albumId = null, ?string $photoId = null): void
	{
		$this->mode = PageMode::from($page);
		$this->albumId = $albumId;
		$this->photoId = $photoId;
	}

	/**
	 * Rendering of the front-end.
	 *
	 * @return View
	 */
	public function render(): View
	{
		return view('livewire.index')->layout('layouts.livewire', $this->getLayout())->slot('fullpage');
	}

	/**
	 * Fetch layout data for the head, meta etc.
	 *
	 * @return array{pageTitle:string,pageDescrption:string,siteOwner:string,imageUrl:string,pageUrl:string,rssEnable:string,rssEnable:string,userCssUrl:string}
	 */
	private function getLayout(): array
	{
		$siteTitle = Configs::getValueAsString('site_title');
		$title = '';
		$description = '';
		$imageUrl = '';

		if ($this->photoId !== null) {
			$photo = Photo::findOrFail($this->photoId);
			$title = $photo->title;
			$description = $photo->description;
			$imageUrl = url()->to($photo->size_variants->getMedium()?->url ?? $photo->size_variants->getOriginal()->url);
		} elseif ($this->albumId !== null) {
			$albumFactory = resolve(AlbumFactory::class);
			$album = $albumFactory->findAbstractAlbumOrFail($this->albumId, false);
			$title = $album->title;
			$description = $album instanceof BaseAlbum ? $album->description : '';
			$imageUrl = url()->to($album->thumb->thumbUrl ?? '');
		}

		return [
			'pageTitle' => $siteTitle . (!blank($siteTitle) && !blank($title) ? ' – ' : '') . $title,
			'pageDescription' => !blank($description) ? $description . ' – via Lychee' : '',
			'siteOwner' => Configs::getValueAsString('site_owner'),
			'imageUrl' => $imageUrl,
			'pageUrl' => url()->current(),
			'rssEnable' => Configs::getValueAsBool('rss_enable'),
			'userCssUrl' => IndexController::getUserCss(),
			'frame' => '',
		];
	}

	/**
	 * Open page.
	 *
	 * @return void
	 */
	public function openPage(string $page): void
	{
		$this->albumId = null;
		$this->photoId = null;
		$this->mode = PageMode::from($page);

		// update URL
		$this->emitUrlChange($this->mode, $this->albumId ?? '', $this->photoId ?? '');
		// $this->render();
	}

	/*
	 ** This triggers a full reloading of the page
	 */
	public function reloadPage()
	{
		return redirect(route('livewire_index', ['page' => $this->mode->value, 'albumId' => $this->albumId, 'photoId' => $this->photoId]));
	}
}
