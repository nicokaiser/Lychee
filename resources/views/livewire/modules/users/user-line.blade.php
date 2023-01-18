<div class="users_view_line">
	<p>
		<input class="text" wire:model="username" type="text" placeholder="{{ Lang::get('LOGIN_USERNAME') }}">
		<input class="text" wire:model="password" type="text" placeholder="{{ Lang::get('LOGIN_PASSWORD') }}">
		<span class="choice" title="{{ Lang::get('ALLOW_UPLOADS') }}">
			<label>
				<input wire:model='may_upload' type="checkbox">
				<span class="checkbox">
					<x-icons.iconic icon="check" />
				</span>
			</label>
		</span>
		<span class="choice" title="{{ Lang::get('ALLOW_USER_SELF_EDIT') }}">
			<label>
				<input wire:model='may_edit_own_settings' type="checkbox">
				<span class="checkbox">
					<x-icons.iconic icon="check" />
				</span>
			</label>
		</span>
	</p>
	@if($this->hasChanged)
	<a wire:click='save' class="basicModal__button basicModal__button_OK basicModal__button_OK_no_DEL">{{ Lang::get('SAVE') }}</a>
	@elseif($user->may_administrate !== true)
	<a wire:click='delete' class="basicModal__button basicModal__button_DEL basicModal__button_OK_no_DEL">{{ Lang::get('DELETE') }}</a>
	@endif
</div>