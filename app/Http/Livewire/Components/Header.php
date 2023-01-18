<?php

namespace App\Http\Livewire\Components;

use App\Enum\Livewire\GalleryMode;
use App\Enum\Livewire\PageMode;
use App\Http\Livewire\Traits\AlbumProperty;
use App\Http\Livewire\Traits\InteractWithModal;
use App\Models\Extensions\BaseAlbum;
use App\SmartAlbums\BaseSmartAlbum;
use Illuminate\View\View;
use Livewire\Component;

/**
 * This is the "start" page of the gallery
 * Integrate the list of all albums at top level.
 */
class Header extends Component
{
	use InteractWithModal;
	use AlbumProperty;

	public ?PageMode $page_mode = null;
	public ?GalleryMode $gallery_mode = null;
	public string $title = '';
	public bool $is_hidden = false;

	public ?BaseAlbum $baseAlbum = null;
	public ?BaseSmartAlbum $smartAlbum = null;

	/**
	 * Render the header.
	 *
	 * @return View
	 */
	public function render(): View
	{
		return view('livewire.components.header');
	}

	/**
	 * Open a login modal box.
	 * TODO Consider moving this directly to Blade.
	 *
	 * @return void
	 */
	public function openLoginModal(): void
	{
		$this->openModal('forms.login');
	}

	/**
	 * Go back one step.
	 * TODO Consider moving this directly to Blade.
	 *
	 * @return void
	 */
	public function back(): void
	{
		if ($this->page_mode === PageMode::GALLERY) {
			$this->emitTo('pages.gallery', 'back');
		} else {
			$this->emitTo('index', 'back');
		}
	}

	/**
	 * Open the Left menu.
	 * TODO Consider moving this directly to Blade.
	 *
	 * @return void
	 */
	public function openLeftMenu(): void
	{
		$this->emitTo('components.left-menu', 'open');
	}

	/**
	 * Toggle the side bar.
	 * TODO Consider moving this directly to Blade.
	 *
	 * @return void
	 */
	public function toggleSideBar(): void
	{
		$this->emitTo('components.sidebar.sidebar', 'toggle');
	}
}