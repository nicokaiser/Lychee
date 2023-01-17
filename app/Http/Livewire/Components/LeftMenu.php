<?php

namespace App\Http\Livewire\Components;

use App\Http\Livewire\Components\Base\Openable;
use App\Http\Livewire\Traits\InteractWithModal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

/**
 * This is the Left menu component.
 * In here we will manage the different links:
 * - settings.
 * - logout
 * - users
 * - U2F
 * - sharing
 * - Diagnostics
 * - Logs
 * - About.
 */
class LeftMenu extends Openable
{
	use InteractWithModal;

	/**
	 * Method called from user-land.
	 * Log out the user.
	 */
	public function logout(): \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
	{
		Auth::logout();
		Session::flush();

		return redirect(route('livewire_index'));
	}

	/**
	 * Render the Left menu.
	 *
	 * @return View
	 */
	public function render(): View
	{
		return view('livewire.components.left-menu');
	}

	/**
	 * Open a about modal box.
	 *
	 * @return void
	 */
	public function openAboutModal(): void
	{
		$this->openClosableModal('components.about', 'CLOSE');
	}
}