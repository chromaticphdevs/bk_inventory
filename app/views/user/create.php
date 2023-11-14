<?php build('content') ?>
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Create User</h4>
			<?php echo wLinkDefault(_route('user:index'))?>
			<?php Flash::show()?>
		</div>

		<div class="card-body">
			<?php echo $user_form->start()?>
				<div class="form-group">
					<?php echo $user_form->addAndCall([
						'type' => 'hidden',
						'name' => 'user_type',
						'value' => 'factory'
					])?>
					<?php echo $user_form->getRow('firstname'); ?>
					<?php echo $user_form->getRow('lastname'); ?>
					<?php echo $user_form->getRow('username'); ?>
					<?php echo $user_form->getRow('password'); ?>
				</div>

				<div class="form-group">
					<?php Form::submit('', 'Create User')?>
				</div>
			<?php echo $user_form->end(); ?>
		</div>
	</div>
<?php endbuild()?>
<?php loadTo()?>