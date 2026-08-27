<?php


function get_users_by_role($role, $orderby, $order) {
	global $wpdb;
	$args = array(
		'role'    => $role,
		'orderby' => $orderby,
		'order'   => $order
	);
	$users = get_users( $args );
	$usersArray = null;

	if(is_array($users)){
		foreach($users as $user ){
			$userCountry = '';
			$sql = "SELECT uwp_country FROM {$wpdb->prefix}uwp_usermeta WHERE user_id = %d";
			$query = $wpdb->prepare($sql, $user->ID);
			$result = $wpdb->get_var($query);
			
			if (!empty($result)) {
				$userCountry = $result;
			}

			$user->data->country = $userCountry;
			


			$user->data->avatar = get_avatar_url($user->ID, [
				'size' => 400
			]);
			$usersArray[] = $user->data;
		}
	}
	return $usersArray;
}

$users = get_users_by_role('heelsmaster', 'user_nicename', 'ASC');

?>

<?php if (is_array($users)) : ?>
	<!-- pagination here -->
	 <div class="row ">
		 <!-- the loop -->
		 <?php foreach ($users as $k => $user) { ?>
			 <span class="col-6 col-lg-3 opacity-100 mb-4">
				<?php if($user->avatar) : ?> 
					<div class="img-wrap mb-3">
						<?php $src = $user->avatar ?>
						<img loading="lazy" decoding="async" src="<?php echo $src ?>" alt="<?php echo $user->display_name; ?>">
					</div>
					
					<?php endif ?>
				<h3> <?php echo $user->display_name; ?> </h3>
				<p class="text-uppercase"> <?php echo $user->country ?? '[Country]: '; ?> </p>
				<div class="row align-items-center">
					<div class="col-6 voting">
						<button class="btn btn-primary px-3 text-black" onclick="vote(event, <?php echo $user->ID ?>);">Vote</button>
						<br>
					</div>
					<div class="col-6 text-end">
						Votes:  <?php 
							$sql = " SELECT id as count FROM {$wpdb->prefix}votes WHERE master = %d" ;
							$result = $wpdb->get_results($wpdb->prepare($sql, [$user->ID]));
						?>
						<?php echo !empty($result) ? count($result) : 0; ?>
					</div>
					<div class="col-12 pt-2">
						<div class="alert alert-success success" role="alert" style="display: none;">
							Thanks for you're vote!
						</div>
						<div class="alert alert-info failure" role="alert" style="display: none;">
							You already voted, only one vote allowed
						</div>
					</div>
				</div>
			 </span>
		 <?php }; ?>
		 <!-- end of the loop -->
	 </div>

<?php else : ?>
	<p><?php esc_html_e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>
